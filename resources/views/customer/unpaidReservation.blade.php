<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('cdn')
    {{-- CSS --}}
        <link href="{{ asset('/css/customerDashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/sideBar.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ URL('/img/icon.png')}}" type="image/x-icon">
    {{-- CSS --}}
    <title>HOSS</title>
</head>
<body>

    <div class="d-flex" id="wrapper">
        {{-- SIDE NAV --}}
            @include('layouts.customerSidebar')
        {{-- SIDE NAV --}}

        {{-- MAIN CONTENT --}}
            <div id="page-content-wrapper">
                {{-- NAV BAR --}}
                    <nav class="navbar navbar-expand-lg text-white border-bottom">
                        <div class="container-fluid">
                            <button class="btn btn-lg" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
                            <h4 class="ms-2 pt-2">UNPAID RESERVATION</h4>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                    <li>
                                        <a class="nav-link me-3">
                                            <span>{{ auth()->guard('userModel')->user()->firstname}}</span>
                                            <span>{{ auth()->guard('userModel')->user()->lastname}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                {{-- NAV BAR --}}

                {{-- MAIN CONTENT --}}
                    <div class="container-fluid mainBar">
                        <div class="row g-2" id="showUnpaidReservation"></div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- MODAL --}}
        <div class="modal fade" id="updateUnpaidReservationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">UPDATE BOOK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form id="updateUnpaidReservation" name="updateUnpaidReservation">
                    @csrf
                        <div class="row gap-0">
                            <div class="col-6 my-2">
                                <label class="form-label">CHECK IN:</label>
                                <input type="hidden" id="reservationId" name="reservationId">
                                <input required type="date" class="form-control shadow-sm bg-body rounded-0" id="checkInDate" name="checkInDate">
                            </div>
                            <div class="col-6 my-2">
                                <label class="form-label">CHECK OUT:</label>
                                <input required type="date" class="form-control shadow-sm rounded-0" id="checkOutDate" name="checkOutDate">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0 px-4" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary rounded-0 px-4">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- MODAL --}}

    {{-- JS --}}
        <script>
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                showUnpaidBookingPerUser();
            });
            function showUnpaidBookingPerUser(){
                $.ajax({
                    url: "/getUnpaidBooking",
                    method: 'GET',
                    success : function(data) {
                        $("#showUnpaidReservation").html(data);
                    }
                })
            }
            function deleteReservation(id){
                async function showNotesAndRemarks() {
                    const { value: accept } = await Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to continue to cancel this booking?",
                        icon: 'question',
                        input: "checkbox",
                        inputValue: 1,
                        inputPlaceholder: `
                        I read the <a href='notesRemarks'>notes and remarks</a>.
                        `,
                        confirmButtonText: `
                        Continue&nbsp;<i class="fa fa-arrow-right"></i>
                        `,
                        inputValidator: (result) => {
                            return !result && "You need to read the notes and remarks before cancel this";
                        }
                    });
                    if (accept) {
                        $.ajax({
                            url: "/deleteReservation",
                            type: 'GET',
                            dataType: 'text',
                            data: {reservationId: id},
                            success: function(response) {
                                if(response == 1){
                                    Swal.fire({
                                        title: 'CANCEL SUCCESSFULLY',
                                        text: "Please, Book another reservation",
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 2000,
                                    }).then((result) => {if (result) {showUnpaidBookingPerUser()}});
                                }
                            },

                            error:function(error){
                                console.log(error)
                            }
                        })
                    }
                }
                showNotesAndRemarks();
            }
            function getUpdateUnpaidReservation(id){
                $('#updateUnpaidReservationModal').modal('show')
                $.ajax({
                    url: '/viewUnpaidReservation',
                    type: 'GET',
                    dataType: 'json',
                    data: {reservationId: id},
                })
                .done(function(response) {
                    $('#checkInDate').val(moment(response.start_dataTime).format('YYYY-MM-DD')),
                    $('#checkOutDate').val(moment(response.end_dateTime).format('YYYY-MM-DD'))
                    $('#reservationId').val(response.reservation_id)
                })
            }
            $('#updateUnpaidReservation').on( 'submit' , function(e){
                e.preventDefault();
                var currentForm = $('#updateUnpaidReservation')[0];
                var data = new FormData(currentForm);
                $.ajax({
                    url: "/updateUnpaidReservation",
                    type: "post",
                    method: "post",
                    dataType: "text",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == 1) {
                            $('#updateUnpaidReservationModal').modal('hide')
                            Swal.fire({
                                title: 'Update Successfully',
                                text: "New Reservation Booked",
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500,
                            }).then((result) => {
                            if (result) {
                                showUnpaidBookingPerUser();
                            }
                            });
                        } else if (response == 0) {
                            Swal.fire('Update Failed', 'Sorry, the operation has not been stored', 'error');
                        } else if (response == 4) {
                            Swal.fire('Invalid Check In', 'Please check the date and time of the CHECK IN', 'error');
                        } else if (response == 3) {
                            Swal.fire('Invalid Check Out', 'Please check the date and time of the CHECK OUT', 'error');
                        } else if (response == 2) {
                            Swal.fire('Invalid Date and Time', 'The date of both CHECK IN and CHECK OUT must not be the same', 'error');
                        } else if (response == 6) {
                            Swal.fire('Update FAILED', 'A reservation for the given time has already been made.', 'error');
                        } else {
                            Swal.fire('Unknown Response', 'An unexpected response was received', 'error');
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        </script>
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}
</body>
</html>
