$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// FUNCTION FOR PASSWORD ENABLE
    function seePasswordUserRegistration() {
        var x = document.getElementById("userPassword");
        var a = document.getElementById("userConfirmPassword");
        if (x.type === 'password' && a.type === 'password'){
            x.type ="text";
            a.type ="text";
        }else{
            x.type="password";
            a.type="password";
        }

    }
// FUNCTION FOR PASSWORD ENABLE

// FUNCTION FOR PASSWORD ENABLE
    function seePasswordUserLogin() {
        var x = document.getElementById("userLoginPassword");
        if (x.type === 'password'){
            x.type ="text";
        }else{
            x.type="password";
        }

    }
// FUNCTION FOR PASSWORD ENABLE

// FUNCTION FOR PASSWORD ENABLE IN ADMIN LOGIN
    function seePasswordAdminLogin() {
        var x = document.getElementById("adminPassword");
        if (x.type === 'password'){
            x.type ="text";
        }else{
            x.type="password";
        }
    }
// FUNCTION FOR PASSWORD ENABLE IN ADMIN LOGIN

// SIGN UP FUNCTION
    $('#registrationForm').on( 'submit' , function(e){
        e.preventDefault();
        async function showTermsAndConditions() {
            const { value: accept } = await Swal.fire({
              title: 'Are you sure?',
              text: "Do you want to continue to register your account?",
              icon: 'question',
              input: "checkbox",
              inputValue: 1,
              inputPlaceholder: `
              I read the <a href="privacyPolicy">terms and condition</a> before register my account.
              `,
              confirmButtonText: `
              Continue&nbsp;<i class="fa fa-arrow-right"></i>
              `,
              inputValidator: (result) => {
                return !result && "You need to read the <a href='privacyPolicy'>terms and condition</a> before register your account";
              }
            });
            if (accept) {
                const firstName = $('#userFirstName').val();
                const middleName = $('#userMiddleName').val();
                const lastName = $('#userLastName').val();
                const age = $('#userAge').val();
                const password = $('#userRegisterPassword').val();
                const confirmPassword = $('#userRegisterConPassword').val();
                const data = $('#registrationForm').serialize();
                var regex = /[0-9!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/;
                if(regex.test(firstName) || regex.test(middleName) || regex.test(lastName)) {
                    Swal.fire(
                        'Register Failed',
                        'First name, middle name, and last name must not contain digits or special characters.',
                        'error'
                    );
                }else if (firstName.length < 3 || middleName.length < 3 || lastName.length < 3) {
                    Swal.fire(
                        'Register Failed',
                        'The first name, middle name, and last name must be at least 3 characters long.',
                        'error'
                    );
                }else if (age < 18) {
                    Swal.fire(
                        'Register Failed',
                        'Age restriction: No minors allowed at the hotel.',
                        'error'
                    );
                }else if(password < 6 || password > 20){
                    Swal.fire(
                        'PASSWORD FAILED',
                        'The password must be longer than 6 characters and less than 20 characters',
                        'error'
                    )
                }else if(password != confirmPassword){
                    Swal.fire(
                        'PASSWORD MISMATCH',
                        'Please, check your password',
                        'error'
                    )
                }else if(password === 'password'){
                    Swal.fire(
                        'PASSWORD FAILED',
                        'The password can not be set to password',
                        'error'
                    )
                }else{
                    $.ajax({
                        url:"/registrationFunction",
                        method:"POST",
                        dataType:"text",
                        data:data,
                        beforeSend: function () {
                            let timerInterval;
                            Swal.fire({
                                title: "PROCESSING...",
                                html: "Please Wait, The System will send you an email to verify your account",
                                timer: 8000,
                                didOpen: () => {
                                    Swal.showLoading();
                                    const timer = Swal.getPopup().querySelector("b");
                                    timerInterval = setInterval(() => {
                                        timer.textContent = `${Swal.getTimerLeft()}`;
                                    }, 100);
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                },
                            })
                        },
                        success: function(response) {
                        if(response == 1){
                        Swal.fire({
                        icon: 'success',
                        title: 'REGISTER SUCCESSFULLY',
                        showConfirmButton: false,
                        timer: 1500
                        }).then((result) => {
                        if (result) {
                            $("#registrationForm").trigger("reset");
                            window.location = "/";
                        }
                        })
                        }
                        else if(response == 0){
                            Swal.fire(
                            'SORRY REGISTRATION FAILED',
                            'Sorry, please re-enter your credentials',
                            'error'
                            )
                        }
                        else if(response == 2){
                            Swal.fire(
                            'EMAIL ADDRESS NOT AVAILABLE',
                            'Sorry, please choose another valid email',
                            'error'
                            )
                        }
                        },
                        error:function(er){
                        console.log(er)
                        }
                    });
                }
            }
        }
        showTermsAndConditions();
    });
// SIGN UP FUNCTION

// USER LOGIN FUNCTION
    $('#userLoginForm').on( 'submit' , function(e){
        e.preventDefault();
        var data = $('#userLoginForm').serialize();
        $.ajax({
        url:"/userLoginFunction",
        method:"POST",
        dataType:"text",
        data:data
        })
        .done(function(response) {
            if(response == 1){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    },
                    didClose: () =>{
                        window.location = "/customerDashboard";
                    }
                    })
                    Toast.fire({
                    icon: 'success',
                    title: 'Signed in successfully',
                    text: 'Welcome Customer',
                    })
            }else if(response == 0){
                Swal.fire(
                'Sorry Login Failed',
                'Wrong Email or Password',
                'error'
                )
            }else if(response == 3){
                Swal.fire(
                'Inactive Account',
                'Your account is disable to access the Hoss Application',
                'error'
                )
            }else if(response == 2){
                Swal.fire(
                'Sorry Login Failed',
                'Email verification required. Please check your inbox to verify it.',
                'error'
                )
            }
            $('#userLoginForm')[0].reset()
        });
    });

    setTimeout(function() {
        $('.alert.alert-success').hide();
    }, 5000);
// USER LOGIN FUNCTION

// ADMIN LOGIN FUNCTION
    $('#adminLoginForm').on( 'submit' , function(e){
    e.preventDefault();
    var data = $('#adminLoginForm').serialize();
    $.ajax({
        url:"/adminLoginFunction",
        method:"POST",
        dataType:"text",
        data:data
    })
    .done(function(response) {
        if(response == 1){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                didClose: () =>{
                    window.location = "/adminDashboard";
                }
                })
                Toast.fire({
                icon: 'success',
                title: 'Signed in successfully',
                text: 'Welcome Admin',
                })
        }else if(response == 0){
            Swal.fire(
            'Sorry Login Failed',
            'Wrong Email or Password',
            'error'
            )
        }
        $('#adminLoginForm')[0].reset()
    });
    });
// ADMIN LOGIN FUNCTION

// GENERATE AGE
function calculateAge() {
    var birthDate = new Date($('#userBirthdate').val());
    var birthDateDay = birthDate.getDate();
    var birthDateMonth = birthDate.getMonth();
    var birthDateYear = birthDate.getFullYear();

    var todayDate = new Date();
    var todayDay = todayDate.getDate();
    var todayMonth = todayDate.getMonth();
    var todayYear = todayDate.getFullYear();

    var calculateAge = 0;

    if (todayMonth > birthDateMonth || (todayMonth === birthDateMonth && todayDay >= birthDateDay)) {
        calculateAge = todayYear - birthDateYear;
    } else {
        calculateAge = todayYear - birthDateYear - 1;
    }

    var outputValue = calculateAge;
    document.getElementById("userAge").value = calculateAge;
}

// GENERATE AGE

// TRANSITION FOR SWITCHING PAGE
    // var sideButtons = document.querySelectorAll('.bottomLink');
    //     sideButtons.forEach(btn => btn.addEventListener('click', () => {
    //     document.body.classList.toggle('signup');
    // }))
// TRANSITION FOR SWITCHING PAGE
