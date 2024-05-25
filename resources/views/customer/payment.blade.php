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
    <link rel="shortcut icon" href="{{ URL('/img/icon.png') }}" type="image/x-icon">
    {{-- CSS --}}
    <title>H0SS</title>
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
                    <h4 class="ms-2 pt-2">Payment</h4>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li>
                                <a class="nav-link me-3">
                                    <span>{{ auth()->guard('userModel')->user()->firstname }}</span>
                                    <span>{{ auth()->guard('userModel')->user()->lastname }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            {{-- NAV BAR --}}

            {{-- MAIN CONTENT --}}
            @foreach ($data as $item)
                <div class="container-fluid mainBar">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <img src="{{ $item->photos }}" class="img-fluid rounded-start"
                                            style="height: 100%">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item fw-bold">
                                                    <h5 class="card-title">Reservation Code: <span class="fw-normal">
                                                            {{ $item->book_code }}</span> </h5>
                                                </li>
                                                <li class="list-group-item fw-bold">Room Number: <span
                                                        class="fw-normal"> {{ $item->room_number }}</span> </li>
                                                <li class="list-group-item fw-bold">Floor: <span class="fw-normal">
                                                        {{ $item->floor }}</span> </li>
                                                <li class="list-group-item fw-bold">Type of Room: <span
                                                        class="fw-normal"> {{ $item->type_of_room }}</span> </li>
                                                <li class="list-group-item fw-bold">Number of Bed: <span
                                                        class="fw-normal"> {{ $item->number_of_bed }}</span> </li>
                                                <li class="list-group-item fw-bold">Price Per Night: <span
                                                        class="fw-normal"> ₱{{ $item->price_per_hour }}.00</span> </li>
                                                <li class="list-group-item fw-bold">Details: <span class="fw-normal">
                                                        {{ $item->details }}</span> </li>
                                                <li class="list-group-item fw-bold">Check In: <span
                                                        class="fw-normal">{{ \Carbon\Carbon::parse($item->start_dataTime)->format('F d, Y ) }}</span>
                                                </li>
                                                <li class="list-group-item fw-bold">Check Out: <span
                                                        class="fw-normal">{{ \Carbon\Carbon::parse($item->end_dateTime)->format('F d, Y ) }}</span>
                                                </li>
                                                <li class="list-group-item fw-bold">Total Night(s):<span
                                                        class="fw-normal">
                                                        {{ ceil(\Carbon\Carbon::parse($item->start_dataTime)->diffInHours(\Carbon\Carbon::parse($item->end_dateTime)) / 24) }}
                                                        Night(s)</span></li>
                                                <li class="list-group-item fw-bold">Total Payment: <span
                                                        class="fw-normal">₱{{ $item->price_per_hour * ceil(\Carbon\Carbon::parse($item->start_dataTime)->diffInHours(\Carbon\Carbon::parse($item->end_dateTime)) / 24) }}.00</span>
                                                </li>
                                                <p class="card-text pt-3 ms-3 fw-bold">Notes: To proceed with securing
                                                    this reservation, you are required to make the necessary payment.
                                                </p>
                                            </ul>
                                        </div>
                                        <div class="card-footer bg-white text-end">
                                            <a onclick="deleteReservation({{$item->reservation_id}})" type='button' class='btn btn-sm btn-danger px-3 py-2 rounded-0 mt-2 text-white'>Cancel Booking</a>
                                            <button data-bs-toggle="modal" data-bs-target="#updateUnpaidReservationModal" type='button' class='btn btn-sm btn-secondary px-3 py-2 rounded-0 mt-2 text-white'>Update Booking</button>
                                            <a href="{{ route('stripePayment', [
                                                'total_payment' =>
                                                    $item->price_per_hour *
                                                    ceil(
                                                        \Carbon\Carbon::parse($item->start_dataTime)->diffInHours(\Carbon\Carbon::parse($item->end_dateTime)) / 24,
                                                    ),
                                                'type_of_room' => $item->type_of_room,
                                                'total_nights' => ceil(
                                                    \Carbon\Carbon::parse($item->start_dataTime)->diffInHours(\Carbon\Carbon::parse($item->end_dateTime)) / 24,
                                                ),
                                                'reservation_id' => $item->reservation_id,
                                            ]) }}"
                                                class="btn btn-sm btn-primary px-3 py-2 rounded-0 mt-2 text-white">Continue to Pay</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- MAIN CONTENT --}}
        </div>
        {{-- END MAIN CONTENT --}}
    </div>

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
                            <input type="hidden" id="reservationId" name="reservationId" value="{{$item->reservation_id}}">
                            <input required type="date" class="form-control shadow-sm bg-body rounded-0" id="checkInDate" name="checkInDate" value="{{ \Carbon\Carbon::parse($item->start_dataTime)->format('Y-m-d') }}">
                        </div>
                        <div class="col-6 my-2">
                            <label class="form-label">CHECK OUT:</label>
                            <input required type="date" class="form-control shadow-sm rounded-0" id="checkOutDate" name="checkOutDate" value="{{ \Carbon\Carbon::parse($item->end_dateTime)->format('Y-m-d') }}">
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
    @endforeach

    {{-- JS --}}
    <script>
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
                                }).then((result) => {if (result) {
                                    window.location.replace("/customerRoom");
                                }});
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
                            location.reload();
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
