@extends('layouts.admin')

@section('content')
  <div class="text-center bold">
    <h3>Practice Admin Section</h3>
  </div>
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-2"></div>

      <div class="well well-lg col-md-8">
        <button type="button" name="button" class="float-right btn btn-lg btn-primary" data-toggle="modal" data-target="#practiceModal">Add Practice Plan</button>
        <div class="form-group" style="padding-top: 5px">
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <th>Practice Name</th>
              <th>Date</th>
              <th>Edit/Delete</th>
            </thead>
            <tbody>
              @foreach($practices as $practice)
                <tr class="trow" data-id="{{ $practice->practice_id }}">
                  <td> {{ $practice->practice_name }} </td>
                  <td> {{ $practice->practice_date }} </td>
                  <td>
                    <button type="button" id="update" class="btn btn-warning getPracticeInfo" data-id="{{ $practice->practice_id }}" name="button">Edit</button>
                    <button type="button" id="delete" class="btn btn-danger getPracticeInfo" data-id="{{ $practice->practice_id }}" name="button">Delete</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="practiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Practice Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="practice/add" method="post">
        @csrf
        <div class="modal-body">
          <div id="inital-asks">
            <div class="form-group">
              <label for="name">Enter Name:</label>
              <input type="text" class="form-control" id="name" name="name" value="Today's Practice">
            </div>
            <div class="form-group">
              <label for="date">Select Date:</label>
              <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
              <label for="start-time">Select Start Time:</label>
              <input type="time" class="form-control" id="start-time" name="startTime" value="">
            </div>
            <div class="form-group">
              <label for="end-time">Select End Time:</label>
              <input type="time" class="form-control" id="end-time" name="endTime" value="">
            </div>
            <div class="form-group">
              <label for="interval">Select Standard Time Intervals:</label>
              <input type="number" class="form-control" id="interval" step="5" name="interval" value="">
            </div>
          </div>
          <div id="time-table">
            <table class="table">
              <thead class="thead-dark">
                <th>Start Time</th>
                <th>End Time</th>
                <th>Practice Event</th>
              </thead>
              <tbody id="time-tbody">

              </tbody>
            </table>
          </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="submit" disabled class="btn btn-primary">Submit Practice</button>
          </div>
        </form>

    </div>
  </div>
</div>
@endsection
