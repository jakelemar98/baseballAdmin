$(document).ready(function(){

  $('#time-table').hide();

  $('#start-time').val("15:00");
  $('#end-time').val("17:30");

  $('.getUser').on('click', function(e){
      var id = $(this).data('id');
      var type = $(this).attr('id');

      $.ajax({
        url: 'players/get/'+id,
        type: 'GET',
        data: {id:id},
        success: function(response){
          console.log(response);
          $("#myModal").modal();
          populatePlayersModal(response, id, type);
        },
        error: function(response){
          console.log(response);
        }
      });
  });

  function populatePlayersModal(response, id, type) {
    var first = response.first_name;
    var last = response.last_name;
    var position = response.position;
    var eligibility = response.elig_year;
    var posArr = ['P', 'C', '1B', '2B', '3B', 'SS', 'LF', 'CF', 'RF'];
    position = posArr[position - 1];

    $('#userForm').attr('action', 'players/'+type);

    $('#userId').val(id);
    $('#firstname').val(first);
    $('#lastname').val(last);
    $('#position').val(position);
    $('#eligyear').val(eligibility);
  }

  $('.getPracticeInfo').on('click', function(e){
      var id = $(this).data('id');
      var type = $(this).attr('id');

      $.ajax({
        url: 'practice/get/'+id,
        type: 'GET',
        data: {id:id},
        success: function(response){
          console.log(response);
          $("#practiceModal").modal();
          populatePracticeModal(response, id, type);
        },
        error: function(response){
          console.log(response);
        }
      });
  });



  $("#interval").change(function(){
    var num = $('#interval').val();
    console.log(num);
    if (num % 5 != 0) {
      console.log("change number");
      $('#interval').addClass('is-invalid');
      $('#submit').prop('disabled', true);
    } else {
      $('#interval').removeClass('is-invalid');
      $('#submit').prop('disabled', false);
      fillAndShowTable();
    }
  });
  function fillAndShowTable(){
    $('#time-tbody').empty();
    $('#time-table').show();

    var start = $('#start-time').val();
    var end = $('#end-time').val();
    var interval = $('#interval').val();

    var startHours = start.substr(0,2);
    var startMin = start.substr(3,5);

    var startPostfix, endPostfix

    if (startHours > 12) {
      startHours = startHours - 12;
      startPostfix = 'PM';
    }

    var endHours = end.substr(0,2)
    var endMin = end.substr(3,5);

    if (endHours > 12) {
      endHours = endHours - 12;
      endPostfix = 'PM';
    }
    startHours = startHours - 0;
    endHours = endHours - 0;
    startMin = startMin - 0;
    endMin = endMin - 0;
    interval = interval - 0;

    start = (startHours * 60) + startMin;
    end = (endHours * 60) + endMin;


    var totalTime = end - start;
    var totalIntervals = totalTime / interval;

    var curStartTime = start;
    var curEndTime = start + interval;

    var html = '';

    for (var i = 0; i < totalIntervals; i++) {
      var curStartHour = Math.floor(curStartTime / 60);
      var curStartMin = curStartTime % 60;

      if (curStartMin == 0) {
        curStartMin = '00';
      }

      var startInput = curStartHour + ":" + curStartMin + " " + startPostfix;

      var curEndHour = Math.floor(curEndTime / 60);
      var curEndMin = curEndTime % 60;

      if (curEndMin == 0) {
        curEndMin = '00';
      }

      var endInput = curEndHour + ":" + curEndMin + " " + endPostfix;

      curStartTime = curStartTime + interval;
      curEndTime = curEndTime + interval;

      html += "<tr>";
      html +=   "<td>"
      html +=     "<input type='text' name='start["+i+"]' class='form-control' id='start"+i+"' value='"+startInput+"'>";
      html +=   "</td>";
      html +=   "<td>"
      html +=     "<input type='text' name='end["+i+"]' class='form-control' id='end"+i+"' value='"+endInput+"'>";
      html +=   "</td>";
      html +=   "<td>";
      html +=     "<input type'text' name='event["+i+"]' class='form-control' id='event"+i+"'>";
      html +=   "</td>";
      html += "</tr>";
    }
    $('#time-tbody').append(html);
  }
});
