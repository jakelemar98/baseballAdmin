@extends('layouts.admin')

@section('content')
<div class="text-center jumbotron">
  <table class="table table-bordered">
    <thead class="thead-inverse">
      <th>Player Name</th>
      <th>Total At-Bats</th>
      <th>Total Points</th>
    </thead>
    <tbody>
      <?php
        $names = $data['names'];
        $atBats = $data['atBats'];
      ?>
      @foreach($data['ptVals'] as $points)
      <tr>
        <td> {{ $names[$points[0]] }} </td>
        <td> {{ $atBats[$points[0]] }} </td>
        <td> {{ $points[1] }} </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
