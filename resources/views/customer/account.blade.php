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
                            <h4 class="ms-2 pt-2">MANAGE ACCOUNT</h4>
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
                    <div class="container-fluid mainBar my-4">
                        <div class="card p-5 bg-body rounded-0 shadow-lg">
                            <h5 class="mb-4 text-lg-start text-center">PERSONAL INFORMATION</h4>
                            <ul class="nav nav-tabs mb-4 text-lg-start text-center">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">&nbsp;&nbsp;Information&nbsp;&nbsp;</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/customerCredentials">Credentials</a>
                                </li>
                            </ul>
                            {{-- INFO --}}
                                <form id="updateUserAccount" name="updateUserAccount">
                                    @csrf
                                    <div class="row gap-0">
                                        <div class="col-9 pt-5" >
                                            <div class="mb-3">
                                                <label class="form-label" style="padding-top: 50px">Profile Picture:</label>
                                                <input class="form-control shadow-sm bg-body rounded-0" type="file" name="userProfile" accept="image/png, image/jpg, image/jpeg, image/gif, image/svg">
                                            </div>
                                        </div>
                                        <div class="col-3 text-start ps-4">
                                            <div class="mb-3">
                                                <img class="img-thumbnail border-0 profilePicture" id="userProfile" style="height:170px;" src="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gap-0">
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label class="form-label">First Name:</label>
                                                <input readonly required class="form-control shadow-sm rounded-0" type="text"  id="userFirstName" name="userFirstName">
                                                <input required class="form-control shadow-sm rounded-0" type="hidden" id="userUniqueId" name="userUniqueId">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label class="form-label">Middle Name:</label>
                                                <input readonly class="form-control shadow-sm rounded-0" type="text"  id="userMiddleName"  name="userMiddleName" >
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name:</label>
                                                <input readonly required class="form-control shadow-sm rounded-0" type="text"  id="userLastName"  name="userLastName" >
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label class="form-label">Extention: </label>
                                                <select class="form-select shadow-sm rounded-0" id="userExtension" name="userExtension">
                                                    <option value="" selected>None</option>
                                                    <option value="Jr.">Junior.</option>
                                                    <option value="Sr.">Senior.</option>
                                                    <option value="II">The Second.</option>
                                                    <option value="III">The Third.</option>
                                                    <option value="IV">The Fourth.</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gap-0">
                                        <div class="col-3">
                                            <label class="form-label">Email Address: </label>
                                            <input type="text" class="form-control shadow-sm rounded-0" id="userEmail" Name="userEmail" readonly>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label">Phone Number: </label>
                                            <input required type="text" class="form-control shadow-sm bg-body rounded-0" id="userPhoneNumber" Name="userPhoneNumber">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label">Birthday: </label>
                                            <input readonly type="date" class="form-control shadow-sm rounded-0" onchange="calculateAge()"  id="userBirthday" name="userBirthday">
                                        </div>
                                        <div class="col-2">
                                            <label class="form-label">Age:</label>
                                            <input type="text" class="form-control shadow-sm  rounded-0" id="userAge" Name="userAge" readonly>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-3 d-flex ms-auto">
                                            <button type="submit" readonly class="btn btn-primary px-4 py-2 rounded-0">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/customer/account.js') }}"></script>
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}
</body>
</html>
