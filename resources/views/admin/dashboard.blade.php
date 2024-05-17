<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>HOSS</title>
        <!-- CSS -->
            <link rel="shortcut icon" href="{{ URL('/img/icon.png')}}" type="image/x-icon">
            <link href="{{ asset('/css/adminDashboard.css') }}" rel="stylesheet">
        <!-- CSS -->
    @include('cdn')
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- SIDE NAV -->
            @include('layouts.adminSidebar')
        <!-- SIDE NAV -->

        <div id="page-content-wrapper">
            <!-- NAV BAR -->
                <nav class="navbar navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <h4 class="ms-2"> DASHBOARD</h4>
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
            <!-- NAV BAR -->

            <!-- MAIN CONTENT -->
                <div class="container-fluid mainBar">
                    <div class="row mb-3">
                        <div class="col-3">
                            <div class="card shadow" style="height:8.1rem; border-radius:10px; background-color:#ffff;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 text-center mt-2">
                                            <i class="bi bi-calendar-event "></i>
                                        </div>
                                        <div class="col-9 text-center" style="line-height:19px; padding-top:1.5rem">
                                            <p class="card-text fw-bold" style="font-size: 2rem; color:#8d8a85;" id="totalPendingReservation">0</p>
                                            <p class="card-text fw-bold" style="font-size: 12px; color:#8d8a85;">PENDING RESERVATION</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card shadow" style="height:8.1rem; border-radius:10px; background-color:#ffff;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 text-start mt-2">
                                            <i class="bi bi-calendar-check "></i>
                                        </div>
                                        <div class="col-9 text-start" style="line-height:19px; padding-top:1.5rem">
                                            <p class="card-text fw-bold text-center pe-4" style="font-size: 2rem; color:#8d8a85;" id="totalOnGoingReservation">0</p>
                                            <p class="card-text fw-bold  ps-3" style="font-size: 12px; color:#8d8a85;">ON-GOING RESERVATION</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card shadow" style="height:8.1rem; border-radius:10px; background-color:#ffff;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 text-start mt-2">
                                            <i class="bi bi-person-workspace pt"></i>
                                        </div>
                                        <div class="col-9 text-center" style="line-height:19px; padding-top:1.5rem">
                                            <p class="card-text fw-bold pe-4" style="font-size: 2rem; color:#8d8a85;" id="totalCompletedReservation">0</p>
                                            <p class="card-text fw-bold" style="font-size: 12px; color:#8d8a85;">COMPLETED RESERVATION</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card shadow" style="height:8.1rem; border-radius:10px; background-color:#ffff;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 text-start mt-2">
                                            <i class="bi bi-people-fill pt-"></i>
                                        </div>
                                        <div class="col-9 text-center" style="line-height:19px; padding-top:1.5rem">
                                            <p class="card-text fw-bold pe-2" style="font-size: 2rem; color:#8d8a85;" id="totalCustomer">0</p>
                                            <p class="card-text fw-bold" style="font-size: 13px; letter-spacing:1px; color:#8d8a85;">TOTAL CUSTOMER</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 mt-2 border-2 shadow">
                        {{-- <div class="card p-lg-5 p-0 rounded-0" id="fetchAllBackOut"> --}}
                        <div class="card p-lg-4 p-0 rounded">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            <!-- MAIN CONTENT -->
        </div>
    </div>

        <!-- JS -->
            <script src="{{ asset('/js/admin/dashboard.js') }}"></script>
            <script src="{{ asset('/js/dateTime.js') }}"></script>
            <script src="{{ asset('/js/logout.js') }}"></script>
</body>
</html>
