$(document).ready(function(){
  var selectedPlayers = new Object();
  var selectedPositions = new Object();

  // Fill position boxes on player select
  $("select").on('change', function(){
     var player_id = this.value;

     //get data value from select boxes
     var selectRow = $(this).data('id');
     var selectBox = $(this).data('label');

     var label;

     if (selectBox != "position") {
       label = $(':selected', this).closest('optgroup').attr('label');
     }else {
       label = this.value;
     }

     $('#position'+selectRow).val(label);
  });

  $('#resetPositions').on('click', function(){
      selectedPositions = [];
  });

  $('#createLineup').on('click', function(){
    $('#lineupTable select').removeClass('btn-warning');
    var players = $('.player-box');
    var positions = $('.position-box');

    jQuery.each(players, function(i, player){
      players[i] = $(player).val();
    });

    jQuery.each(positions, function(i, position){
      positions[i] = $(position).val();
    });

    var playArr = Array.from(Object.keys(players), k=>players[k]);

    duplicatePlayers = getDuplicates(playArr);

    if (!manageDuplicates(duplicatePlayers)) {
      console.log("all good");
    }
  });

  function getDuplicates(data) {
    var duplicates = {};
    for (var i = 0; i < data.length; i++) {
        if(duplicates.hasOwnProperty(data[i])) {
            duplicates[data[i]].push(i);
        } else if (data.lastIndexOf(data[i]) !== i) {
            duplicates[data[i]] = [i];
        }
    }
    return duplicates;
  };

  function manageDuplicates(data){
    dataLength = Object.keys(data).length
    dataKeys = Object.keys(data);

    for (var i = 0; i < dataKeys.length; i++) {
      for (var j = 0; j < data[dataKeys[i]].length; j++) {
        console.log(data[dataKeys[i]][j]);
        $('[data-row_id="'+data[dataKeys[i]][j]+'"]').addClass('btn-warning')

      }
      console.log("there were both " + dataKeys[i]);
    }

    return true;
  };
});
