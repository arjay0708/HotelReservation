$(document).ready(function(){
    pendingReservationTable();
    ongoingReservationTable();
    cancelledReservationTable();
    unpaidReservationTable();
    completedReservationTable();
    checkCancelledReservation();
    unattendedReservationTable();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// FETCH ALL PENDING RESERVATION FOR TABLES
    function pendingReservationTable(){
    var table = $('#pendingReservationTable').DataTable({
        "language": {
            "emptyTable": "No Reservation Found"
        },
        "lengthChange": true,
        "paging": true,
        "info": true,
        "responsive": true,
        "ordering": false,
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
        "ajax":{
            "url":"/getAllPendingReservation",
            "dataSrc": "",
        },
        "columns":[
            {"data":"reservation_id"},
            { "mData": function (data, type, row) {
                if(data.extention != null){
                    return data.firstname+ " " +data.lastname+ " " +data.extention;
                }else{
                    return data.firstname+ " " +data.lastname;
                }
            }},
            { "mData": function (data, type, row) {
                    return data.floor+ " - Room " +data.room_number;
            }},
            {"data": "start_dataTime",
                "render": function(data) {
                return moment(data).format('MMM DD, YYYY | hh:mm A');
            },
            "targets": 1
            },
            {"data": "end_dateTime",
                "render": function(data) {
                return moment(data).format('MMM DD, YYYY | hh:mm A');
            },
            "targets": 1
            },
            { "mData": function (data, type, row) {
                return "₱"+data.totalPayment+ ".00" ;
            }},
            { "mData": function (data, type, row) {
                return '<button type="button" data-title="Set Reservation?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick="ongoingReservation('+data.reservation_id+', '+data.room_id+')" class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-check2-square"></i></button></button> <button type="button" data-title="Not Attend?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick="unAttendedReservation('+data.reservation_id+', '+data.room_id+')" class="btn rounded-0 btn-outline-danger btn-sm py-2 px-3"><i class="bi bi-x-square"></i></button></button>'
            }},
        ],
        order: [[1, 'asc']],
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    }

// FETCH ALL ONGOING RESERVATION FOR TABLE
    function ongoingReservationTable(){
        var table = $('#ongoingReservationTable').DataTable({
            "language": {
                "emptyTable": "No Reservation Found"
            },
            "lengthChange": true,
            "scrollCollapse": true,
            "paging": true,
            "info": true,
            "responsive": true,
            "ordering": false,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "ajax":{
                "url":"/getAllOnGoingReservation",
                "dataSrc": "",
            },
            "columns":[
                {"data":"reservation_id"},
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.firstname+ " " +data.lastname+ " " +data.extention;
                    }else{
                        return data.firstname+ " " +data.lastname;
                    }
                }},
                { "mData": function (data, type, row) {
                        return data.floor+ " - Room " +data.room_number;
                }},
                {"data": "start_dataTime",
                    "render": function(data) {
                    return moment(data).format('MMM DD, YYYY | hh:mm A');
                },
                "targets": 1
                },
                {"data": "end_dateTime",
                    "render": function(data) {
                    return moment(data).format('MMM DD, YYYY | hh:mm A');
                },
                "targets": 1
                },
                { "mData": function (data, type, row) {
                    return "₱"+data.totalPayment+ ".00" ;
                }},
                { "mData": function (data, type, row) {
                    return '<button type="button" data-title="Complete Transaction?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick="completeTransaction('+data.reservation_id+' , '+data.roomId+')" class="btn rounded-0 btn-outline-success btn-sm py-2 px-3"><i class="bi bi-check2-square"></i></button>'
                }},
            ],
            order: [[1, 'asc']],
        });
        table.on('order.dt search.dt', function () {
            let i = 1;
            table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    }

// FETCH ALL CANCELLED RESERVATION FOR TABLE
    function cancelledReservationTable(){
        var table = $('#cancelledReservationTable').DataTable({
            "language": {
                "emptyTable": "No Reservation Found"
            },
            "lengthChange": true,
            "scrollCollapse": true,
            "paging": true,
            "info": true,
            "responsive": true,
            "ordering": false,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "ajax":{
                "url":"/getAllCancelledReservation",
                "dataSrc": "",
            },
            "columns":[
                {"data":"reservation_id"},
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.firstname+ " " +data.lastname+ " " +data.extention;
                    }else{
                        return data.firstname+ " " +data.lastname;
                    }
                }},
                { "mData": function (data, type, row) {
                        return data.floor+ " - Room " +data.room_number;
                }},
                {"data": "start_dataTime",
                    "render": function(data) {
                    return moment(data).format('MMM DD, YYYY | hh:mm A');
                },
                "targets": 1
                },
                {"data": "end_dateTime",
                    "render": function(data) {
                    return moment(data).format('MMM DD, YYYY | hh:mm A');
                },
                "targets": 1
                },
                { "mData": function (data, type, row) {
                    return "₱"+data.totalPayment+ ".00" ;
                }},
                { "mData": function (data, type, row) {
                    if(data.is_noted != 1){

                        return '<button type="button" data-title="View Reason?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick="viewReason('+data.reservation_id+', '+data.room_id+')" class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-chat-dots"></i></button> <button type="button" data-title="Note This?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick="noteCancelReservation('+data.reservation_id+')" class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-journal-check"></i></button>'
                    }else{
                        return '<button type="button" data-title="View Reason?" data-bs-toggle="tooltip" data-bs-placement="top" onclick="viewReason(' + data.reservation_id + ', ' + data.room_id + ')" class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-chat-dots"></i></button>';
                    }
                }},
            ],
            "createdRow": function(row, data, dataIndex) {
                if (data.is_noted != 1) {
                    $(row).addClass('highlighted-row');
                }
            },
            order: [[1, 'asc']],
        });
        table.on('order.dt search.dt', function () {
            let i = 1;
            table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    }

// FETCH ALL UNPAID RESERVATION FOR TABLE
    function unpaidReservationTable(){
        var table = $('#unpaidReservationTable').DataTable({
            "language": {
                "emptyTable": "No Reservation Found"
            },
            "lengthChange": true,
            "scrollCollapse": true,
            "paging": true,
            "info": true,
            "responsive": true,
            "ordering": false,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "ajax":{
                "url":"/getAllUnpaidReservation",
                "dataSrc": "",
            },
            "columns":[
                {"data":"reservation_id"},
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.firstname+ " " +data.lastname+ " " +data.extention;
                    }else{
                        return data.firstname+ " " +data.lastname;
                    }
                }},
                { "mData": function (data, type, row) {
                        return data.floor+ " - Room " +data.room_number;
                }},
                {"data": "start_dataTime",
                    "render": function(data) {
                    return moment(data).format('MMM DD, YYYY | hh:mm A');
                },
                "targets": 1
                },
                {"data": "end_dateTime",
                    "render": function(data) {
                    return moment(data).format('MMM DD, YYYY | hh:mm A');
                },
                "targets": 1
                },
                { "mData": function (data, type, row) {
                    return "₱"+data.totalPayment+ ".00" ;
                }},
            ],
            order: [[1, 'asc']],
        });
        table.on('order.dt search.dt', function () {
            let i = 1;
            table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    }

// FETCH ALL COMPLETED TRANSACTION
    function completedReservationTable(){
    var table = $('#completedReservationTable').DataTable({
        "language": {
            "emptyTable": "No Reservation Found"
        },
        "lengthChange": true,
        "scrollCollapse": true,
        "paging": true,
        "info": true,
        "responsive": true,
        "ordering": false,
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
        "ajax":{
            "url":"/getAllCompletedReservation",
            "dataSrc": "",
        },
        "columns":[
            {"data":"reservation_id"},
            { "mData": function (data, type, row) {
                if(data.extention != null){
                    return data.firstname+ " " +data.lastname+ " " +data.extention;
                }else{
                    return data.firstname+ " " +data.lastname;
                }
            }},
            { "mData": function (data, type, row) {
                    return data.floor+ " - Room " +data.room_number;
            }},
            {"data": "start_dataTime",
                "render": function(data) {
                return moment(data).format('MMM DD, YYYY | hh:mm A');
            },
            "targets": 1
            },
            {"data": "end_dateTime",
                "render": function(data) {
                return moment(data).format('MMM DD, YYYY | hh:mm A');
            },
            "targets": 1
            },
            { "mData": function (data, type, row) {
                return "₱"+data.totalPayment+ ".00" ;
            }},
        ],
        order: [[1, 'asc']],
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    }

// FETCH ALL UNATTENDED TRANSACTION
    function unattendedReservationTable(){
    var table = $('#unattendedReservationTable').DataTable({
        "language": {
            "emptyTable": "No Reservation Found"
        },
        "lengthChange": true,
        "scrollCollapse": true,
        "paging": true,
        "info": true,
        "responsive": true,
        "ordering": false,
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
        "ajax":{
            "url":"/getAllUnattendedReservation",
            "dataSrc": "",
        },
        "columns":[
            {"data":"reservation_id"},
            { "mData": function (data, type, row) {
                if(data.extention != null){
                    return data.firstname+ " " +data.lastname+ " " +data.extention;
                }else{
                    return data.firstname+ " " +data.lastname;
                }
            }},
            { "mData": function (data, type, row) {
                    return data.floor+ " - Room " +data.room_number;
            }},
            {"data": "start_dataTime",
                "render": function(data) {
                return moment(data).format('MMM DD, YYYY | hh:mm A');
            },
            "targets": 1
            },
            {"data": "end_dateTime",
                "render": function(data) {
                return moment(data).format('MMM DD, YYYY | hh:mm A');
            },
            "targets": 1
            },
            { "mData": function (data, type, row) {
                return "₱"+data.totalPayment+ ".00" ;
            }},
        ],
        order: [[1, 'asc']],
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    }

// SET RESERVATION
    function ongoingReservation(reservationId , roomId){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to SET this BOOKING?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Accept it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/ongoingReservation',
            type: 'GET',
            dataType: 'json',
            data: {reservationId: reservationId, roomId: roomId},
            success: function(response) {
                if(response == 1){
                    Swal.fire({
                        title: 'ON-GOING BOOKING',
                        text: "Reservation was set to ON-GOING successfully",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                    }).then((result) => {
                    if (result) {
                        $('#ongoingReservationTable').DataTable().ajax.reload();
                    }
                    });
                }else if(response == 2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Set Failed',
                        text: 'The BOOKING was not reach the Check In Date and Time',
                    })
                }
            }
        });
        }
        });
    }

// COMPLETE TRANSACTION
    function completeTransaction(reservationId){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to COMPLETE this BOOKING?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Accept it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/completeReservation',
            type: 'GET',
            dataType: 'json',
            data: {reservationId: reservationId},
            success: function(response) {
                if(response == 1){
                    Swal.fire({
                        title: 'COMPLETE BOOKING',
                        text: "Reservation was COMPLETE successfully",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                    }).then((result) => {
                    if (result) {
                        $('#ongoingReservationTable').DataTable().ajax.reload();
                    }
                    });
                }else if(response == 2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Complete Failed',
                        text: 'The reservation was not done yet',
                    })
                }
            }
        });
        }
        });
    }

// VIEW CANCELLED REASON
    function viewReason(id){
        $('#cancelledReasonModal').modal('show')
        $.ajax({
            url: '/viewReasonCancelled',
            type: 'GET',
            dataType: 'json',
            data: {reservationId: id},
        })
        .done(function(response) {
            $('#cancelledReason').text(response.reason);
            $('#cancelledLast').text(moment(response.created_at).format('MMM DD, YYYY | hh:mm A'));
        })
    }

// NOTE CANCEL RESERVATION
    function noteCancelReservation(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to NOTE this BOOKING?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Continue'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: '/noteCancelReservation',
                type: 'GET',
                dataType: 'json',
                data: {reservationId: id},
                success: function(response) {
                    if(response == 1){
                        Swal.fire({
                            title: 'SUCCESSFULLY NOTED',
                            text: "Reservation was completely noted",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                        }).then((result) => {
                        if (result) {
                            $('#cancelledReservationTable').DataTable().ajax.reload();
                        }
                        });
                    }
                }
            });
            }
            });
    }

 // CHECK CANCELLED RESERVATION
    function checkCancelledReservation(){
        $.ajax({
            url: '/checkCancelledReservation',
            type: 'GET',
            dataType: 'json',
        })
        .done(function(response) {
            if(response === 1){
                Swal.fire({
                    position: "top-center",
                    icon: "warning",
                    title: "SOMEONE CANCELLED THEIR BOOKING",
                    footer: '<a href="/adminCancelledReservation">REDIRECT TO CANCELLED RESERVATION PAGE?</a>'
                });
            }
        })
    }

// NOT ATTENDED RESERVATION
    function unAttendedReservation(reservationId , roomId){
        Swal.fire({
        title: 'Are you sure?',
        text: "The customer not attend?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Continue'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/unAttendedReservation',
            type: 'GET',
            dataType: 'json',
            data: {reservationId: reservationId, roomId: roomId},
            success: function(response) {
                if(response == 1){
                    Swal.fire({
                        title: 'UNATTENDED BOOKING',
                        text: "Reservation was set to unattended successfully",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                    }).then((result) => {
                    if (result) {
                        $('#ongoingReservationTable').DataTable().ajax.reload();
                    }
                    });
                }else if(response == 2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Set Failed',
                        text: 'The BOOKING was not reach the Check In Date and Time',
                    })
                }
            }
        });
        }
        });
    }
