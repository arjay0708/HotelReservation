$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    manageAccount();
});

// MANAGE EMPLOYEES
    $('#updateUserAccount').on( 'submit' , function(e){
        e.preventDefault();
        if(document.getElementById("userAge").value < 5){
            Swal.fire(
                'Update Failed',
                'Sorry Invalid Age',
                'error'
            )
        }else {
            const firstName = $('#userFirstName').val();
            const middleName = $('#userMiddleName').val();
            const lastName = $('#userLastName').val();
            const age = $('#userAge').val();

            var regex = /[0-9!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/;
            if (regex.test(firstName) || regex.test(middleName) || regex.test(lastName)) {
                manageAccount();
                Swal.fire(
                    'Update Failed',
                    'First name, middle name, and last name must not contain digits or special characters.',
                    'error'
                );
            }else if (firstName.length < 3 || middleName.length < 3 || lastName.length < 3) {
                manageAccount();
                Swal.fire(
                    'Update Failed',
                    'The first name, middle name, and last name must be at least 3 characters long.',
                    'error'
                );
            } else if (age < 18) {
                manageAccount();
                Swal.fire(
                    'Update Failed',
                    'Age restriction: No minors allowed at the hotel.',
                    'error'
                );
            }else {
                var currentForm = $('#updateUserAccount')[0];
                var data = new FormData(currentForm);
                $.ajax({
                    url: "/updateUserAccount",
                    type: "post",
                    method: "post",
                    dataType: "text",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response == 1) {
                            Swal.fire({
                                title: 'Update Successfully',
                                text: "New information has stored",
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500,
                            }).then((result) => {
                            if (result) {
                                manageAccount();
                            }
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        }
    });
// MANAGE EMPLOYEES

// FETCH INFO MANAGE ACCOUNT
    function manageAccount(){
        $.ajax({
            url: "/getUserInfo",
            type: 'GET',
            dataType: 'json',
        })
        .done(function(response) {
            $('#userUniqueId').val(response.user_id )
            $('#userLastName').val(response.lastname)
            $('#userFirstName').val(response.firstname)
            $('#userMiddleName').val(response.middlename)
            $('#userExtension').val(response.extention)
            $('#userBirthday').val(response.birthday)
            $('#userEmail').val(response.email)
            $('#userPhoneNumber').val(response.phoneNumber)
            $('#userAge').val(response.age);
            $('#updateEmployeeEmail').val(response.email)
            if(response.photos != ''){
                $('#userProfile').attr("src",response.photos)
            }else{
                $('#userProfile').attr("src","/storage/employees/defaultImage.png")
            }
        })
    }
// FETCH INFO MANAGE ACCOUNT

// GENERATE AGE
    function calculateAge() {
        var birthDate = new Date($('#userBirthday').val());
        var birthDateDay = birthDate.getDate();
        var birthDateMonth = birthDate.getMonth();
        var birthDateYear = birthDate.getFullYear();

        var todayDate = new Date();
        var todayDay = todayDate.getDate();
        var todayMonth = todayDate.getMonth();
        var todayYear = todayDate.getFullYear();

        var calculateAge = 0;

        if(todayMonth > birthDateMonth) calculateAge  = todayYear - birthDateYear;
        else calculateAge = todayYear - birthDateYear - 1;

        var outputValue = calculateAge;
        document.getElementById("userAge").value = calculateAge;
    }
// GENERATE AGE

// FUNCTION FOR PASSWORD ENABLE
    function seePassword() {
        var x = document.getElementById("currentPassword");
        var a = document.getElementById("newPassword");
        var b = document.getElementById("confirmPassword");
        if (x.type === 'password' && a.type === 'password' && b.type === 'password'){
            x.type ="text";
            a.type ="text";
            b.type ="text";
        }else{
            x.type="password";
            a.type="password";
            b.type="password";
        }

    }
// FUNCTION FOR PASSWORD ENABLE