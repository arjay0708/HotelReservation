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
                            <h4 class="ms-2"> MANAGE ROOM</h4>
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
                        <div class="card p-5 bg-body rounded-0 shadow-lg">
                            <h5 class="mb-4 text-lg-start text-center">ADD NEW ROOM</h5>
                            <ul class="nav nav-tabs mb-4">
                                <li class="nav-item">
                                    <a class="nav-link active" href="/adminRoom">Available Room</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="/adminNotAvailableRoom">Not Available Room</a>
                                </li>
                            </ul>
                                <form id="addRoomDetailsForm" name="addRoomDetailsForm">
                                    @csrf
                                    <div class="row gap-0 mt-3">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Image of Room</label>
                                                <input required class="form-control shadow-sm bg-body rounded-0" type="file" id="roomPhoto" name="roomPhoto" accept="image/png, image/jpg, image/jpeg, image/gif, image/svg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gap-0">
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label class="form-label">Room Number:</label>
                                                <input required class="form-control shadow-sm rounded-0" type="number"  id="roomNumber" name="roomNumber" placeholder="00#">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label class="form-label">Floor:</label>
                                                <select required class="form-select shadow-sm rounded-0" aria-label="Default select example" id="roomFloor" name="roomFloor">
                                                    <option value="First Floor" selected>First Floor</option>
                                                    <option value="Second Floor">Second Floor</option>
                                                    <option value="Third Floor">Third Floor</option>
                                                    <option value="Fourth Floor">Fourth Floor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label class="form-label">Type of Room:</label>
                                                <select class="form-select shadow-sm rounded-0" aria-label="Default select example" id="roomType" name="roomType">
                                                    <option value="Standard Room" selected>Standard Room</option>
                                                    <option value="Superior Double Room">Superior Double Room</option>
                                                    <option value="Single Deluxe Room">Single Deluxe Room</option>
                                                    <option value="Executive Deluxe King Room">Executive Deluxe King Room</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label class="form-label">Number of Bed:</label>
                                                <input required class="form-control shadow-sm rounded-0" type="number" min="0" max="5"  id="bedNumber"  name="bedNumber" >
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label class="form-label">Max Person</label>
                                                <input required class="form-control shadow-sm rounded-0" type="number" min="0" max="10"  id="maxPerson" name="maxPerson">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label class="form-label">Price Per Night</label>
                                                <input required class="form-control shadow-sm rounded-0" type="number"  id="pricePerHour" name="pricePerHour">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gap-0">
                                        <div class="col-12">
                                                <label class="form-label">Details of Room:</label>
                                                <textarea required class="form-control shadow-sm rounded-0"  style="height:80px; resize: none;" id="detailsOfRoom" name="detailsOfRoom"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-2 d-flex ms-auto">
                                            <button type="submit" class="btn btn-primary px-3 py-2 rounded-0">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                <!-- MAIN CONTENT -->
            </div>
        <!-- MAIN CONTENT -->
    </div>

        <!-- JS -->
            <script src="{{ asset('/js/admin/room.js') }}"></script>
            <script src="{{ asset('/js/dateTime.js') }}"></script>
            <script src="{{ asset('/js/logout.js') }}"></script>
        <!-- JS -->
</body>
</html>
