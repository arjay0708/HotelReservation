$(document).ready(function(){
    getAllTotalForAdmin();
    chart();
    checkCancelledReservation();
});

    function getAllTotalForAdmin(){
        $.ajax({
            url: '/getAllTotalForAdmin',
            method: 'GET',
            success : function(data) {
                $("#totalPendingReservation").html(data.totalPendingReservation);
                $("#totalOnGoingReservation").html(data.totalOnGoingReservation);
                $("#totalCompletedReservation").html(data.totalCompletedReservation);
                $("#totalCustomer").html(data.totalCustomer);

            }
        })
    }

    function chart(){
        $.ajax({
            url: 'paymentGraph',
            method: 'GET',
            success : function(data) {
                if(data != ""){
                    const ctx = document.getElementById('myChart');
                    new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: data.months,
                        datasets: [{
                          label: 'Sales Per Month',
                          data : data.sales,
                          borderWidth: 1,
                          backgroundColor: [
                            '#f8d38d',
                          ],
                            borderColor: [
                                '#f8d38d',
                            ],
                        }]
                      },
                      options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max:30000
                            },
                        }
                        }
                    });
                }else{
                    var target = document.getElementById("visualization");
                    target.innerHTML += "<div class='text-danger fs-4 text-center' style='position:absolute; top:19rem; width:100%' role='alert'>NO DATA AVAILABLE</div>";
                }
            }
        })
    }

    // AUTOMATIC DELETE THE UNPAID RESERVATION
    if(window.location.href === 'http://127.0.0.1:8000/adminDashboard'){
        $.ajax({
            url: '/deleteUnpaidReservation',
            type: 'GET',
            dataType: 'json',
        })
        .done(function(response) {
            $('#ongoingReservationTable').DataTable().ajax.reload();
        })
    }

    // function checkCancelledReservation(){
    //     $.ajax({
    //         url: '/checkCancelledReservation',
    //         type: 'GET',
    //         dataType: 'json',
    //     })
    //     .done(function(response) {
    //         if(response === 1){
    //             Swal.fire({
    //                 position: "top-center",
    //                 icon: "warning",
    //                 title: "SOMEONE CANCELLED THEIR BOOKING",
    //                 footer: '<a href="/adminCancelledReservation">REDIRECT TO CANCELLED RESERVATION PAGE?</a>'
    //             });
    //         }
    //     })
    // }
