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
                            <h4 class="ms-2 pt-2">PENDING RESERVATION</h4>
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
                        <div class="row g-2" id="showPendingReservation"></div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script>
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                showBookingPerUser();
            });
            function showBookingPerUser(){
                    $.ajax({
                        url: "/getBookPerUser",
                        method: 'GET',
                        success : function(data) {
                            $("#showPendingReservation").html(data);
                        }
                    })
                }
                function cancelReservation(id){
                    async function cancelReservation() {
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
                            (async () => {
                                const { value: reason } = await Swal.fire({
                                    input: 'textarea',
                                    title: 'Reason for Cancelling?',
                                    text: "Once you submit, You agree to continue to cancel this booking and you won't be able to revert this",
                                    inputPlaceholder: 'Type your reason here...',
                                    inputAttributes: {
                                    'aria-label': 'Type your message here'
                                    },
                                    showCancelButton: true
                                })
                                if(reason){
                                    $.ajax({
                                        url: '/cancelReservation',
                                        type: 'GET',
                                        dataType: 'text',
                                        data: {reason: reason, reservationId: id},
                                        success: function(response) {
                                            if(response == 1){
                                                Swal.fire({
                                                    title: 'CANCEL SUCCESSFULLY',
                                                    icon: 'success',
                                                    showConfirmButton: false,
                                                    timer: 1000,
                                                }).then((result) => {if (result) {showBookingPerUser()}});
                                            }else if(response == 0){
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Back Out Failed',
                                                    text: 'Something wrong at the backend',
                                                })
                                            }
                                        }
                                    });
                                }
                            })()
                        }
                    }
                    cancelReservation();
                }
        </script>
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}
</body>
</html>
