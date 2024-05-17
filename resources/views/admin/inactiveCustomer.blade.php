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

        <!-- MAIN CONTENT -->
            <div id="page-content-wrapper">
                <!-- NAV BAR -->
                    <nav class="navbar navbar-expand-lg border-bottom">
                        <div class="container-fluid">
                            <h4 class="ms-2"> MANAGE CUSTOMER</h4>
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
                        <div class="container-fluid">
                            <div class="container-fluid px-5 py-4 bg-body rounded shadow-lg">
                                    <ul class="nav nav-tabs mb-4">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/adminCustomer">Customer</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Inactive Customer</a>
                                    </li>
                                </ul>
                                    <table id="inactiveCustomer" class="table table-sm table-bordered text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Customer Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Phone Number</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                            </div>
                        </div>
                    </div>
                <!-- MAIN CONTENT -->
            </div>
        <!-- MAIN CONTENT -->
    </div>

        <!-- JS -->
            <script src="{{ asset('/js/admin/customer.js') }}"></script>
            <script src="{{ asset('/js/dateTime.js') }}"></script>
            <script src="{{ asset('/js/logout.js') }}"></script>
        <!-- JS -->

        {{-- MODAL --}}
            <div class="modal fade" id="viewCustomerDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-11">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Customer Details</h1>
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="row g-0 mt-3 text-center">
                                <img src="" class="rounded mx-auto d-block" id="photo" style="height: 120px; width:25%; padding:0 !important;">
                            </div>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <label class="form-label">Last Name:</label>
                                    <input readonly type="text" class="form-control shadow-sm bg-body rounded" required id="lastname" name="lastname">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">First Name:</label>
                                    <input readonly type="text" class="form-control shadow-sm bg-body rounded" required id="firstname" name="firstname">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Middle Name:</label>
                                    <input readonly type="text" class="form-control shadow-sm bg-body rounded" required id="middlename" name="middlename">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <label class="form-label">Extention:</label>
                                    <input readonly type="text" class="form-control shadow-sm bg-body rounded" required id="extention" name="extention">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Birthdate:</label>
                                    <input readonly type="date" class="form-control shadow-sm bg-body rounded" required id="birthdate" name="birthdate">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Age:</label>
                                    <input readonly type="text" class="form-control shadow-sm bg-body rounded" required id="age" name="age">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label class="form-label">Email:</label>
                                    <input readonly type="text" class="form-control shadow-sm bg-body rounded" required id="email" name="email">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Phone:</label>
                                    <input readonly type="text" class="form-control shadow-sm bg-body rounded" required id="phone" name="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- MODAL --}}
</body>
</html>
