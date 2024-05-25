$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    showTotalRoom();
});

// SHOW TOTAL ROOM
    function showTotalRoom(){
        $.ajax({
            url: "/getCustomerRoom",
            method: 'GET',
            success : function(data) {
                $("#showTotalRoom").html(data);
            }
        })
    }
// SHOW TOTAL ROOM

// FUNCTION FOR BOOKING
function bookReservation(id) {
    $('#reservationModal').modal('show');
    $('#submitDateBooking').click(function() {
        const checkInDate = $("#checkInDate").val();
        const checkOutDate = $("#checkOutDate").val();

        if (checkInDate === '' || checkOutDate === '') {
            Swal.fire({
                title: "Complete The missing fields",
                text: "Please, Check the input fields",
                icon: "warning"
            });
        } else {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to BOOK this room?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d72323',
                confirmButtonText: 'Yes, Continue!'
            }).then((result) => {
                if (result.isConfirmed) {
                    async function showNotesAndRemarks() {
                        const { value: accept } = await Swal.fire({
                            title: 'Reminders',
                            icon: 'info',
                            input: "checkbox",
                            inputValue: 1,
                            inputPlaceholder: `
                              Before book this you need to read the <a href="notesRemarks">notes and remarks</a>.
                            `,
                            confirmButtonText: `
                              Continue&nbsp;<i class="fa fa-arrow-right"></i>
                            `,
                            inputValidator: (result) => {
                                return !result && "You need to read the notes and remarks before booking this";
                            }
                        });
                        if (accept) {
                            $.ajax({
                                url: "/bookReservation",
                                type: "POST",
                                dataType: "json",
                                data: { roomId: id, checkInDate: checkInDate, checkOutDate: checkOutDate },
                                success: function(response) {
                                    if (response.status == 1) {
                                        showTotalRoom();
                                        $("#bookReservationForm").trigger("reset");
                                        $('#reservationModal').modal('hide');
                                        window.location.replace(`payment/${response.book_code}`);
                                    } else if (response.status == 0) {
                                        Swal.fire('Addition Failed', 'Sorry, the operation has not been stored', 'error');
                                    } else if (response.status == 4) {
                                        Swal.fire('Invalid Check In', 'Please check the date and time of the CHECK IN', 'error');
                                    } else if (response.status == 3) {
                                        Swal.fire('Invalid Check Out', 'Please check the date and time of the CHECK OUT', 'error');
                                    } else if (response.status == 2) {
                                        Swal.fire('Invalid Date and Time', 'The date of both CHECK IN and CHECK OUT must not be the same', 'error');
                                    } else if (response.status == 6) {
                                        Swal.fire('BOOK FAILED', 'A reservation for the given time has already been made.', 'error');
                                    } else if (response.status == 5) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'BOOK FAILED',
                                            text: 'Please complete all of your information.',
                                            footer: '<a href="/customerAccount">DIRECT ME TO MANAGE ACCOUNT</a>'
                                        });
                                    } else {
                                        Swal.fire('Unknown Response', 'An unexpected response was received', 'error');
                                    }
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });
                        }
                    }
                    showNotesAndRemarks();
                }
            });
        }
    });
}
// FUNCTION FOR BOOKING
