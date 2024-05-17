$(document).ready(function(){
    totalPendingReservation();
    totalAcceptReservation();
    totalCompleteReservation();
    totalDeclineReservation();
    getBackOutContent();
});

    function totalPendingReservation(){
        $.ajax({
            url: '/totalPendingReservation',
            method: 'GET',
            success : function(data) {
                $("#totalPendingReservation").html(data);
            }
        })
    }

    function totalAcceptReservation(){
        $.ajax({
            url: '/totalAcceptReservation',
            method: 'GET',
            success : function(data) {
                $("#totalAcceptReservation").html(data);
            }
        })
    }

    function totalDeclineReservation(){
        $.ajax({
            url: '/totalDeclineReservation',
            method: 'GET',
            success : function(data) {
                $("#totalDeclineReservation").html(data);
            }
        })
    }

    function totalCompleteReservation(){
        $.ajax({
            url: '/totalCompleteReservation',
            method: 'GET',
            success : function(data) {
                $("#totalCompleteReservation").html(data);
            }
        })
    }

    function getBackOutContent(){
        $.ajax({
            url: '/getBackOutContent',
            method: 'GET',
            success : function(data) {
                $("#fetchAllBackOut").html(data);
            }
        })
    }

    function noteBackOutContent(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to NOTE this LETTER?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Note it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/archivedCancelledReservation',
            type: 'GET',
            dataType: 'json',
            data: {reservationId: id},
        });
        Swal.fire({
            title: 'ACCEPT BOOKING',
            text: "Reservation was accept successfully",
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
        if (result) {
            getBackOutContent();        
        }
        });
        }
        });
    } 





