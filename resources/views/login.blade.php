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
        <section class="rightLogin">
            <section class="main login">
                <div class="container mt-5 pt-5">
                    <a class='homeButton' href="/" data-title='Back to Home?'><i class="bi bi-house"></i></a>
                    <img class="border-0 logo" src="{{ URL('/img/icon.png')}}">
                    <p class="title mt-lg-3">HOTEL OPERATION SOLUTION SYSTEM</p>
                    <form name="userLoginForm" id="userLoginForm">
                        @if(session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="Email" required>
                            <label for="floatingInput" class="text-muted">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="userLoginPassword" id="userLoginPassword" placeholder="Password" required>
                            <label for="floatingInput" class="text-muted">Password</label>
                        </div>
                        <div class="mb-3 checkBox ms-4">
                            <input type="checkbox" class="form-check-input" onclick="seePasswordUserLogin()">
                            <label class="form-check-label">Show Password</label>
                        </div>
                        <ul class="navbar-nav text-center">
                            <li class="nav-item"><a href="/forgotPasswordRoutes" class="nav-link">Forgot Password?</a></li>
                        </ul>
                            <button type="submit" id="appLoginBtn" name="appLoginBtn" class="btn rounded">LOGIN</button>
                        <ul class="navbar-nav text-center">
                            <li class="nav-item"><a href="/registration" class="nav-link bottomLink">Create Your Account</a></li>
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
