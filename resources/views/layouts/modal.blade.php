<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Player</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="form-control" action="/users" method="post">
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
