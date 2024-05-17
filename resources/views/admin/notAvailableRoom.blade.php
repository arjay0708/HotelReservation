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
                        <div class="container-fluid">
                            <div class="container-fluid px-5 py-4 bg-body rounded shadow-lg">
                                <ul class="nav nav-tabs mb-4">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/adminRoom">Available Room</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Not Available Room</a>
                                    </li>
                                    <li class="nav-item ms-auto">
                                        <a href="/addNewRoom" class="btn btn-primary ms-auto py-2 px-3 btn-sm rounded-0 mb-1">Add New Room <i class="bi bi-plus"></i></a>
                                    </li>
                                </ul>
                                <table id="notAvailableRoom" class="table table-sm table-bordered text-center align-middle">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Room Number</th>
                                            <th class="text-center">Floor</th>
                                            <th class="text-center">Type of Room</th>
                                            <th class="text-center">Price</th>
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
            <script src="{{ asset('/js/admin/room.js') }}"></script>
            <script src="{{ asset('/js/dateTime.js') }}"></script>
            <script src="{{ asset('/js/logout.js') }}"></script>
        <!-- JS -->

        {{-- MODAL --}}
            <div class="modal fade" id="updateRoomModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form name="updateRoomForm" id="updateRoomForm">
                                <div class="row">
                                    <div class="col-11">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Room</h1>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="row g-0 mt-3">
                                    <img src="" class="rounded mx-auto d-block" id="roomPhoto" style="height: 200px; width:100%; padding:0 !important;">
                                </div>
                                <div class="row g-0 mt-3">
                                    <div class="col-12">
                                        <label class="form-label">Ship's Photo:</label>
                                        <input type="file" class="form-control shadow-sm bg-body rounded" id="clearPhoto" name="roomPhoto" accept="image/png, image/jpg, image/jpeg, image/gif, image/svg">
                                    </div>
                                </div>
                                <div class="row g-1 mt-3">
                                    <div class="col-4">
                                        <label class="form-label">Room Number:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" required id="roomNumber" name="roomNumber">
                                        <input type="hidden" class="form-control shadow-sm bg-body rounded" required id="room_id" name="room_id">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Room Floor:</label>
                                        <select required class="form-select shadow-sm rounded-0" aria-label="Default select example" id="roomFloor" name="roomFloor">
                                            <option value="First Floor" selected>First Floor</option>
                                            <option value="Second Floor">Second Floor</option>
                                            <option value="Third Floor">Third Floor</option>
                                            <option value="Fourth Floor">Fourth Floor</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Price Per Hour</label>
                                        <input required class="form-control shadow-sm rounded-0" type="text"  id="roomPricePerHour" name="roomPricePerHour">
                                    </div>
                                </div>
                                <div class="row g-0 mt-3">
                                    <div class="col-4">
                                        <label class="form-label">Type of Room:</label>
                                        <select class="form-select shadow-sm rounded-0" aria-label="Default select example" id="roomType" name="roomType">
                                            <option value="Standard Room" selected>Standard Room</option>
                                            <option value="Superior Double Room">Superior Double Room</option>
                                            <option value="Single Deluxe Room">Single Deluxe Room</option>
                                            <option value="Executive Deluxe King Room">Executive Deluxe King Room</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Number of Bed:</label>
                                        <input required class="form-control shadow-sm rounded-0" type="number" min="0" max="5"  id="roomBedNumber"  name="roomBedNumber" >
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Max Person</label>
                                        <input required class="form-control shadow-sm rounded-0" type="number" min="0" max="10"  id="roomMaxPerson" name="roomMaxPerson">
                                    </div>
                                </div>
                                <div class="row gap-0 mt-3">
                                    <div class="col-12">
                                        <label class="form-label">Details of Room:</label>
                                        <textarea required class="form-control shadow-sm rounded-0"  style="height:80px; resize: none;" id="detailsOfRoom" name="detailsOfRoom"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 ms-auto">
                                        <button type="submit" class="btn btn-primary py-2">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        {{-- MODAL --}}
</body>
</html>
