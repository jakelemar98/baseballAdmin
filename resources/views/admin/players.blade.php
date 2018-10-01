@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                  <h3>WSC Baseball Roster</h3>
                </div>

                    @if(Auth::check())
                      @if(isset($players))
                      <div id="accordion">
                        <?php
                          $posArr = [
                                      1 => 'Pitcher',
                                      2 => 'Catcher',
                                      3 => 'First Base',
                                      4 => 'Second Base',
                                      5 => 'Third Base',
                                      6 => 'Short Stop',
                                      7 => 'Left Field',
                                      8 => 'Center Field',
                                      9 => 'Right Field'
                                    ];
                            $html = '';
                            for ($i=0; $i < count($posArr) ; $i++) {
                              $k = $i + 1;
                              $pos = $posArr[$k];

                              $currentPos = $players->where('position', $k);

                              $html .= <<<HTML
                              <div class="card">
                                <div class="card-header" id="headingOne">
                                  <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse$i" aria-expanded="true" aria-controls="collapse$i">
                                      $pos
                                    </button>
                                  </h5>
                                </div>

                                <div id="collapse$i" class="collapse" aria-labelledby="heading$i" data-parent="#accordion">
                                  <div class="card-body">
                                    <table class="table">
                                      <thead class="thead-dark">
                                        <th>Name</th>
                                        <th>Year</th>
                                        <th>Edit</th>
                                      </thead>
                                      <tbody>
HTML;
                                        foreach ($currentPos as $player) {
                                          $fname = $player->first_name;
                                          $lname = $player->last_name;
                                          $name = $fname." ".$lname;
                                          $year = $player->elig_year;

                                          $html .= <<<HTML
                                          <tr>
                                            <td>$name</td><td>$year</td>
                                            <td>
                                              <button type="button" id="update" class="btn btn-warning getUser" data-id="$player->id" name="button">Edit</button>
                                              <button type="button" id="delete" class="btn btn-danger getUser" data-id="$player->id" name="button">Delete</button>
                                            </td>
                                          </tr>
HTML;
                                        };
                                    $html .= <<<HTML
                                  </tbody>
                                </table>
                               </div>
                             </div>
                           </div>
HTML;

                            }
                            echo $html;
                        ?>

                      </div>
                      <div class="form-group">
                        <button name="button" class="btn btn-lg" data-toggle="modal" data-target="#myModal">Add Player</button>
                      </div>
                      @else
                        <h1>No Players</h1>
                      @endif
                    @endif
            </div>
            @if(Auth::guest())
              <a href="/login" class="btn btn-info"> You need to login to see the list 😜😜 >></a>
            @endif
        </div>
    </div>
</div>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Player</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form class="form-control" id="userForm" action="players/add" method="post">
          <input type="hidden" id="userId" name="id" value="">
        <div class="modal-body">
            @csrf
            <div class="form-group">
              <label for="firstname">First Name</label>
              <input id="firstname" class="form-control" type="text" name="firstname" value="">
            </div>
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input id="lastname" class="form-control" type="text" name="lastname" value="">
            </div>
            <div class="form-group">
              <label for="position">Position</label>
              <select id="position" class="form-control" type="text" name="position" value="">
                <option>P</option>
                <option>C</option>
                <option>1B</option>
                <option>2B</option>
                <option>3B</option>
                <option>SS</option>
                <option>LF</option>
                <option>CF</option>
                <option>RF</option>
              </select>
            </div>
            <div class="form-group">
              <label for="eligyear">Eligibility Year</label>
              <select id="eligyear" class="form-control" type="text" name="eligyear" value="">
                <option>Freshman</option>
                <option>Sophomore</option>
                <option>Junior</option>
                <option>Senior</option>
              </select>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="button">Submit</button>
        </div>
      </form>

      </div>
    </div>
  </div>

@endsection
