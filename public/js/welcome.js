$(document).ready(function(){
  $('.getUser').on('click', function(e){
      var id = $(this).data('id');
      var type = $(this).attr('id');

      $.ajax({
        url: 'users/get/'+id,
        type: 'GET',
        data: {id:id},
        success: function(response){
          console.log(response);
          $("#myModal").modal();
          populateModal(response, id, type);
        },
        error: function(response){
          console.log(response);
        }
      });
  });

  function populateModal(response, id, type) {
    var first = response.first_name;
    var last = response.last_name;
    var position = response.position;
    var eligibility = response.elig_year;
    var posArr = ['P', 'C', '1B', '2B', '3B', 'SS', 'LF', 'CF', 'RF'];
    position = posArr[position - 1];

    $('#userForm').attr('action', 'users/'+type);

    $('#userId').val(id);
    $('#firstname').val(first);
    $('#lastname').val(last);
    $('#position').val(position);
    $('#eligyear').val(eligibility);

  }

});
