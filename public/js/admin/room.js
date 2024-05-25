$(document).ready(function(){
    availableRoom();
    notAvailableRoom();
    checkCancelledReservation();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// FETCH AVAILABLE ROOM FOR TABLE
    function availableRoom(){
    var table = $('#availableRoom').DataTable({
        "language": {
            "emptyTable": "No Room Found"
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
            "url":"/getAvailableRoom",
            "dataSrc": "",
        },
        "columns":[
            {"data":"room_id"},
            {"data":"room_number"},
            {"data":"floor"},
            {"data":"type_of_room"},
            { "mData": function (data, type, row) {
                return '₱'+data.price_per_hour+'.00'
            }},
            {"data": "room_id",
                mRender: function (data, type, row) {
                return '<button type="button" data-title="View Details?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick=viewRoomDetails('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-pencil-square"></i></button> <button type="button" onclick=deactivateRoom('+data+') class="btn rounded-0 ROUNDED-0 btn-outline-danger btn-sm py-2 px-3" data-title="Deactivate Room?"><i class="bi bi-trash3"></i></button>'
            }
            }
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

// FETCH AVAILABLE ROOM FOR TABLE
    function notAvailableRoom(){
    var table = $('#notAvailableRoom').DataTable({
        "language": {
            "emptyTable": "No Room Found"
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
            "url":"/getNotAvailableRoom",
            "dataSrc": "",
        },
        "columns":[
            {"data":"room_id"},
            {"data":"room_number"},
            {"data":"floor"},
            {"data":"type_of_room"},
            {"data":"price_per_hour"},
            {"data": "room_id",
                mRender: function (data, type, row) {
                    return '<button type="button" data-title="View Details?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick=viewRoomDetails('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-pencil-square"></i></button> <button type="button" onclick=activateRoom('+data+') class="btn rounded-0 ROUNDED-0 btn-outline-success btn-sm py-2 px-3" data-title="Activate Room?"><i class="bi bi-check2-square"></i></button>'
                }
            }
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

// ADD ROOM
    $(document).ready(function () {
        $('#addRoomDetailsForm').on( 'submit' , function(e){
            e.preventDefault();
            const currentForm = $('#addRoomDetailsForm')[0];
            const data = new FormData(currentForm);
            const extension = /(\.jpg|\.jpeg|\.png)$/i;
            const fileInput = $('#roomPhoto');
            var fileName = fileInput.val();
            if (!extension.test(fileName)) {
                Swal.fire(
                    'Added Failed',
                    'Sorry, the file is not supported',
                    'error'
                );
            }else{
                $.ajax({
                    url: "/addRoom",
                    type:"POST",
                    method:"POST",
                    dataType: "text",
                    data:data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response == 1){
                            $("#addRoomDetailsForm").trigger("reset");
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'NEW ROOM HAS BEEN STORED',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }else if(response == 0){
                            Swal.fire(
                            'Added Failed',
                            'Sorry room has not stored',
                            'error'
                            )
                        }else if(response == 2){
                            Swal.fire(
                            'Added Failed',
                            'Sorry, room already exists.',
                            'error'
                            )
                        }
                    },
                    error:function(error){
                        console.log(error)
                    }
                })
            }
        });
    });

// VIEW DETAILS OF ROOM
    function viewRoomDetails(id){
        $('#updateRoomModal').modal('show')
        $.ajax({
            url: '/viewRoomDetails',
            type: 'GET',
            dataType: 'json',
            data: {roomId: id},
        })
        .done(function(response) {
            $('#room_id').val(response.room_id),
            $('#roomNumber').val(response.room_number),
            $('#roomFloor').val(response.floor)
            $('#roomStart').val(response.room_number)
            $('#roomEnd').val(response.room_number)
            $('#roomPricePerHour').val(response.price_per_hour)
            $('#roomType').val(response.type_of_room)
            $('#roomBedNumber').val(response.number_of_bed)
            $('#roomMaxPerson').val(response.max_person)
            $('#detailsOfRoom').val(response.details)
            $('#roomPhotos').attr("src",response.photos)
        })
    }

// UPDATE ROOM
    $(document).ready(function () {
        $('#updateRoomForm').on( 'submit' , function(e){
            e.preventDefault();
            var currentForm = $('#updateRoomForm')[0];
            var data = new FormData(currentForm);
            $.ajax({
                url: "/updateRoom",
                type:"post",
                method:"post",
                dataType: "text",
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 1){
                        $('#availableRoom').DataTable().ajax.reload();
                        $('#notAvailableRoom').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'ROOM HAS BEEN UPDATE SUCCESSFULLY',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                error:function(error){
                    console.log(error)
                }
            })
        });
    });

// DEACTIVATE ROOM
    function deactivateRoom(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to DEACTIVATE this ROOM?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d72323',
            confirmButtonText: 'Yes, Continue'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: '/deactivateRoom',
                type: 'GET',
                dataType: 'json',
                data: {roomId: id},
            });
            Swal.fire({
                title: 'DEACTIVATE SUCCESSFULLY',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000,
            }).then((result) => {
            if (result) {
                $('#availableRoom').DataTable().ajax.reload();
            }
            });
            }
        });

        async function showTermsAndConditions() {
            const { value: accept } = await Swal.fire({
              title: 'Are you sure?',
              text: "Do you want to DEACTIVATE this ROOM?",
              icon: 'question',
              input: "checkbox",
              inputValue: 1,
              inputPlaceholder: `
              I read the <a href='notesRemarks'>notes and remarks</a> before deactivating this.
              `,
              confirmButtonText: `
                Continue&nbsp; <i class="fa fa-arrow-right"></i>
              `,
              inputValidator: (result) => {
                return !result && "You need to read the <a href='notesRemarks'>notes and remarks</a> before deactivating this";
              }
            });

            if (accept) {
                $.ajax({
                    url: '/deactivateRoom',
                    type: 'GET',
                    dataType: 'json',
                    data: {roomId: id},
                });
                Swal.fire({
                    title: 'DEACTIVATE SUCCESSFULLY',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1000,
                }).then((result) => {
                if (result) {
                    $('#availableRoom').DataTable().ajax.reload();
                }
                });
            }
          }
          showTermsAndConditions();
    }

// ACTIVATE ROOM
    function activateRoom(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to ACTIVATE this ROOM?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d72323',
        confirmButtonText: 'Yes, Continue'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/activateRoom',
            type: 'GET',
            dataType: 'json',
            data: {roomId: id},
        });
        Swal.fire({
            title: 'ACTIVATE SUCCESSFULLY',
            icon: 'success',
            showConfirmButton: false,
            timer: 1000,
        }).then((result) => {
        if (result) {
            $('#notAvailableRoom').DataTable().ajax.reload();
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