<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ URL('/img/icon.png')}}" type="image/x-icon">
    @include('cdn')
    <title>HOSS</title>
</head>
<body>
        {{-- CONTENT --}}
            <div class="back-image"><img src="./img/hotel.jpg" alt="background image"></div>
            <section class="left"></section>
            <section class="rightRegister">
                <section class="main">
                    <div class="container mt-5 pt-2">
                        <a class='homeButton' href="/" data-title='Back to Home?'><i class="bi bi-house"></i></a>
                        <img class="border-0 logo" src="{{ URL('/img/icon.png')}}" style="">
                        <p class="title mt-lg-3">CREATE ACCOUNT</p>
                        <form name="registrationForm" id="registrationForm">
                            @csrf
                            <div class="row mb-4 mx-3">
                                <div class="col-4 px-2">
                                    <input type="text" class="form-control rounded" required id="userFirstName" name="userFirstName" placeholder="First Name">
                                </div>
                                <div class="col-4 px-2">
                                    <input type="text" class="form-control rounded" required id="userMiddleName" name="userMiddleName" placeholder="Middle Name">
                                </div>
                                <div class="col-4 px-2">
                                    <input type="text" class="form-control rounded" required id="userLastName" name="userLastName" placeholder="Last Name">
                                </div>

                            </div>
                            <div class="row mb-4 mx-3">
                                <div class="col-4 px-2">
                                <select class="form-select" id="userExtension" name="userExtension">
                                    <option value="" selected>Suffix</option>
                                    <option value="Jr.">Junior.</option>
                                    <option value="Sr.">Senior.</option>
                                    <option value="II">The Second.</option>
                                    <option value="III">The Third.</option>
                                    <option value="IV">The Fourth.</option>
                                </select>
                                </div>
                                <div class="col-5 px-2">
                                    <input type="date" class="form-control rounded" required id="userBirthdate" name="userBirthdate" onchange="calculateAge()" placeholder="Birth Date">
                                </div>
                                <div class="col-3 px-2">
                                    <input type="text" class="form-control rounded" required id="userAge" name="userAge" placeholder="Age" readonly>
                                </div>
                            </div>
                            <div class="row mb-4 mx-3">
                                <div class="col-6 px-2">
                                    <input type="email" class="form-control rounded" required id="userEmailAddress" name="userEmailAddress" placeholder="Email Address">
                                </div>
                                <div class="col-6 px-2">
                                    <input type="text" class="form-control rounded" required id="userPhone" name="userPhone" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="row mb-4 mx-3">
                                <div class="col-6 px-2">
                                    <input type="password" class="form-control rounded" required id="userPassword" name="userPassword" placeholder="Password">
                                </div>
                                <div class="col-6 px-2">
                                    <input type="password" class="form-control rounded" required id="userConfirmPassword" name="userConfirmPassword" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="row mb-4 mx-3">
                                <div class="col-6 px-2">
                                    <input type="checkbox" class="form-check-input ms-1" onclick="seePasswordUserRegistration()">
                                    <label class="form-check-label ms-4">Show Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn rounded">SUBMIT</button>
                                </div>
                            </div>
                            <ul class="navbar-nav text-center">
                                <li class="nav-item"><a href="/login" class="nav-link bottomLink">Already Have an Account?</a></li>
                            </ul>
                        </form>
                    </div>
                </section>
            </section>
        {{-- END OF CONTENT --}}

    {{-- JS --}}
        <script src="{{ asset('/js/auth.js') }}"></script>
    {{-- JS --}}
</body>
</html>
