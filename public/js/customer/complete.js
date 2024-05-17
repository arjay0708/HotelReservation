$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    shoCompleteReservationPerUser();
});


// SHOW TOTAL ROOM
    function shoCompleteReservationPerUser(){
        $.ajax({
            url: "/getCompleteBookPerUser",
            method: 'GET',
            success : function(data) {
                $("#showCompleteReservation").html(data);
            }
        })
    }
// SHOW TOTAL ROOM