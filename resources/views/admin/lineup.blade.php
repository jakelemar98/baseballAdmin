@extends('layouts.admin')

@section('content')
<script src="{{ asset('js/lineup.js') }}" defer></script>

<div class="container">
  <div class="text-center jumbotron">
    <h1>Current Lineup</h1>
    <br>
    <button class="btn btn-lg btn-primary pull-right" type="button" id="resetPositions" name="button">Reset Positions</button>
    <table class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col"></th>
          <th scope="col">Name</th>
          <th scope="col">Position</th>
        </tr>
      </thead>
      <tbody>
      @for($i = 1; $i < 11; $i++)
        <tr>
          @if($i < 10)
            <th scope="row">{{$i}}</th>
          @else
            <th scope="row">P</th>
          @endif
          <td>
            <select class="form-control" data-id="{{$i}}" data-label='player' id="player">
              <option value="SP" selected disabled>Select A Player</option>
              @foreach ($players as $key => $value)
                @if($i < 10)
                  <optgroup label="{{$key}}">
                    @for($k = 0; $k < sizeof($value); $k++)
                      <option value="{{$value[$k]->id}}">{{$value[$k]->first_name}} {{$value[$k]->last_name}}</option>
                    @endfor
                  </optgroup>
                @else
                  @if($key == "P")
                    <optgroup label="{{$key}}">
                      @for($j = 0; $j < sizeof($value); $j++)
                        <option value="">{{$value[$j]->first_name}} {{$value[$j]->last_name}}</option>
                      @endfor
                    </optgroup>
                  @endif
                @endif
              @endforeach

            </select>
          </td>
          <td>
            <select class="form-control" data-label='position' data-id="{{$i}}" id="position{{$i}}">
              <?php
                $posArr = array("C","P","1B","2B","3B","SS","LF","CF","RF","DH");
              ?>
              @if($i < 10)
                <option value="" selected disabled>Select A Position</option>
              @endif
              @foreach($posArr as $pos)
                @if($i < 10)
                  <option value="{{ $pos }}">{{ $pos }}</option>
                @endif
              @endforeach
              @if($i == 10)
                <option value="" selected>P</option>
              @endif
            </select>
          </td>
        </tr>
        <thead class="thead-dark">
          <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        @endfor
      </tbody>
    </table>
  </div>
</div>
@endsection
