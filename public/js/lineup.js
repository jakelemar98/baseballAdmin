$(document).ready(function(){
  var selectedPlayers = new Object();
  var selectedPositions = new Object();
  $("select").on('change', function(){
     var skipPlayer = false;
     var playerSelected = false;
     var positionSelected = false;
     var player_id = this.value;
     var selectRow = $(this).data('id');

     var selectBox = $(this).data('label');
     console.log(this.value);
     var label;
     if (selectBox != "position") {
       label = $(':selected', this).closest('optgroup').attr('label');
     }else {
       label = this.value;
       skipPlayer = true
     }
     if (Object.values(selectedPlayers).indexOf(player_id) !== -1 && !skipPlayer) {
       swal("ERROR!","Player is already in the lineup!", "error");
       playerSelected = true;
     }
     else if(!skipPlayer){
       var key = "key"+selectRow;
       console.log(key);
       selectedPlayers[key] = player_id;
     }
     console.log(selectedPlayers);
     if (Object.values(selectedPositions).indexOf(label) !== -1) {
       swal("ERROR!", "You selected this position already", "error");
       positionSelected = true
     }else {
       var key = "key"+selectRow;
       selectedPositions[key] = label;
     }
     if (playerSelected === false && positionSelected === false) {
       $('#position'+selectRow).val(label);
     }else {
       console.log("hey");
       this.value = "SP";
     }
     console.log(selectedPlayers, selectedPositions);
  });

  $('#resetPositions').on('click', function(){
      selectedPositions = [];
  });
});
