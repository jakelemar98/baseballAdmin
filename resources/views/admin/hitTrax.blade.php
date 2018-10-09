@extends('layouts.admin')

@section('content')
<div class="jumbotron col-xs-6">
  <form class="" action="hitTrax/add" method="post"  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="name">Select Player</label>
      <select class="form-control" name="name">
        <option value="0">Insert At Bats Report</option>
        <option value="multiples">Insert Multiple Files</option>
        @foreach ($data['players'] as $player)
        <option value="{{ $player->id }}">{{ $player->first_name}}  {{ $player->last_name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="csv">Insert File</label>
      <input type="file" class="form-control" name="files[]" multiple>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-lg btn-primary" name="button">Submit</button>
    </div>
  </form>
</div>
<div class="containter">
  <div class="row">
    <div class="col-sm-2">

    </div>
    <div class="col-sm-8">
      <div class="form-group text-center">
        <p>
          <a class="btn btn-primary" data-toggle="collapse" href="#submittedFiles" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Toggle Player Files</a>
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Toggle At-bat File</button>
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle Both</button>
        </p>
        <div class="row">
          <div class="col">
            <div class="collapse multi-collapse" id="submittedFiles">
              <div class="card card-body">
                <h1>Player Files</h1>
                <table class="table table-bordered">
                  <thead>
                    <th>Player Name</th>
                    <th>File Name</th>
                    <th>Download</th>
                  </thead>
                  <tbody>
                    <?php $names = $data['names'] ?>
                    @foreach($data['files'] as $file)
                    <tr>
                      <td> {{ $names[$file->player_id] }} </td>
                      <td> {{ $file->file_name }} </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-success" onclick="window.location='hitTrax/download/{{ $file->file_name }}'" name="button">Download</button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="">
              <div class="collapse multi-collapse" id="multiCollapseExample2">
                <div class="card card-body">
                  <h1>At-Bats File</h1>
                  <table class="table table-bordered">
                    <thead>
                      <th>File Name</th>
                      <th>Date Uploaded</th>
                      <th>Download</th>
                    </thead>
                    <tbody>
                        <tr>
                          <td>At-Bats Report</td>
                          @if(isset($data['atBats']->created_at))
                          <td>{{ date('m-d-Y', strtotime($data['atBats']->created_at)) }} </td>
                          <td>
                            <button type="button" class="btn btn-sm btn-success" onclick="window.location='hitTrax/download/{{ $data['atBats']->file_name }}'" name="button">Download</button>
                          </td>
                          @else
                          <td></td>
                          <td></td>
                          @endif
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-2">

    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <div class="form-group text-center">
          <button type="button" class="btn btn-lg btn-success" onclick="window.location='hitTrax/create'" name="button">Create Report</button>
        </div>
      </div>
      <div class="col-sm-2"></div>
    </div>
  </div>
</div>

@endsection
