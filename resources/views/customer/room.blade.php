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
                            <h4 class="me-3 me-lg-0 pt-2 ms-lg-2">AVAILABLE ROOM</h4>
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
                    <div class="container-fluid mainBar">
                        <div class="row g-2" id="showTotalRoom"></div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/customer/room.js') }}"></script>
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

    {{-- MODAL --}}
    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BOOK NOW</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookReservationForm" name="bookReservationForm">
                    @csrf
                    <div class="row gap-0">
                        <div class="col-6 my-2">
                            <label class="form-label">CHECK IN:</label>
                            <input required type="date" class="form-control shadow-sm bg-body rounded-0" id="checkInDate" name="checkInDate">
                            <input required type="time" class="form-control shadow-sm bg-body rounded-0 mt-2" id="checkInTime" name="checkInTime" value="{{ date('H:i') }}">
                        </div>
                        <div class="col-6 my-2">
                            <label class="form-label">CHECK OUT:</label>
                            <input required type="date" class="form-control shadow-sm rounded-0" id="checkOutDate" name="checkOutDate">
                            <input required type="time" class="form-control shadow-sm bg-body rounded-0 mt-2" id="checkOutTime" name="checkOutTime" value="{{ date('H:i') }}">
                        </div>
                        <div class="col-12 my-2">
                            <label class="form-label">ROOM ID:</label>
                            <input required type="text" class="form-control shadow-sm bg-body rounded-0" id="roomId" name="roomId">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-0 px-4" data-bs-dismiss="modal">Close</button>
                <button type="button" id="submitBookingButton" class="btn btn-primary rounded-0 px-4">Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
function submitBookingForm() {
    try {
        const checkInDate = document.getElementById('checkInDate').value;
        const checkInTime = document.getElementById('checkInTime').value;
        const checkOutDate = document.getElementById('checkOutDate').value;
        const checkOutTime = document.getElementById('checkOutTime').value;
        const roomId = document.getElementById('roomId').value;

        // Log the values for debugging purposes
        console.log('Check-in Date:', checkInDate);
        console.log('Check-in Time:', checkInTime);
        console.log('Check-out Date:', checkOutDate);
        console.log('Check-out Time:', checkOutTime);
        console.log('Room ID:', roomId);

        // Validate the date and time values
        if (!checkInDate || !checkInTime || !checkOutDate || !checkOutTime || !roomId) {
            throw new Error('All fields are required.');
        }

        const checkInDateTime = new Date(`${checkInDate}T${checkInTime}`);
        const checkOutDateTime = new Date(`${checkOutDate}T${checkOutTime}`);

        // Check if the date objects are valid
        if (isNaN(checkInDateTime.getTime()) || isNaN(checkOutDateTime.getTime())) {
            throw new RangeError('Invalid time value');
        }

        // Convert dates to ISO strings
        const checkInISO = checkInDateTime.toISOString();
        const checkOutISO = checkOutDateTime.toISOString();

        // Log the ISO strings for debugging purposes
        console.log('Check-in ISO:', checkInISO);
        console.log('Check-out ISO:', checkOutISO);

        // Prepare the booking data
        const bookingData = {
            checkInDate: checkInDate,
            checkInTime: checkInTime,
            checkOutDate: checkOutDate,
            checkOutTime: checkOutTime,
            checkInDateTime: checkInISO,
            checkOutDateTime: checkOutISO,
            roomId: roomId
        };

        // Perform the AJAX request
        fetch('http://127.0.0.1:8000/bookReservation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Assuming CSRF token is in a meta tag
            },
            body: JSON.stringify(bookingData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 1) {
                alert('Booking successful! Booking code: ' + data.book_code);
            } else {
                alert('Booking failed: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error in submitBookingForm:', error);
            alert('An error occurred while submitting the booking form: ' + (error.message || error.statusText));
        });

    } catch (error) {
        console.error('Error in submitBookingForm:', error.message);
        alert('An error occurred while submitting the booking form: ' + error.message);
    }
}

// Attach the submitBookingForm function to the button's click event
document.getElementById('submitBookingButton').onclick = submitBookingForm;
</script>
</body>
</html>
