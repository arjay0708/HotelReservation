$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initial load of booking details
    loadBookingDetails();
});

// Function to load booking details
function loadBookingDetails() {
    showBookingPerUser();
    showAcceptBookingPerUser();
    showDeclineBookingPerUser();
}

// Function for making AJAX requests
function makeAjaxRequest(url, method, data, successCallback, errorCallback) {
    $.ajax({
        url: url,
        type: method,
        dataType: 'json', // Assuming most responses are JSON
        data: data,
        success: successCallback,
        error: errorCallback
    });
}

// Function for handling successful AJAX response
function handleSuccessResponse(response) {
    if (response.success) {
        Swal.fire({
            title: 'Success',
            text: response.message,
            icon: 'success',
            showConfirmButton: false,
            timer: 1000
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                // Reload booking details after a successful operation
                loadBookingDetails();
            }
        });
    } else {
        Swal.fire({
            title: 'Error',
            text: response.message,
            icon: 'error',
            showConfirmButton: true
        });
    }
}

// Function for handling AJAX errors
function handleAjaxError(error) {
    Swal.fire({
        title: 'Error',
        text: 'Failed to process the request. Please try again later.',
        icon: 'error',
        showConfirmButton: true
    });
}

// Example function for canceling a reservation
function cancelReservation(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to CANCEL this RESERVATION?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d72323',
        confirmButtonText: 'Yes, Cancel it'
    }).then((result) => {
        if (result.isConfirmed) {
            makeAjaxRequest(
                '/cancelReservation',
                'GET',
                { reservationID: id },
                handleSuccessResponse,
                handleAjaxError
            );
        }
    });
}

// Example function for backing out a reservation
function backOutReservation(id) {
    // Similar structure as cancelReservation
    // Handle success and error responses accordingly
}
// Define the showBookingPerUser function
function showBookingPerUser() {
    $.ajax({
        url: "/getBookPerUser",
        method: 'GET',
        success: function(data) {
            $("#showPendingReservation").html(data);
        },
        error: function() {
            console.error("Error fetching pending reservations.");
        }
    });
}

// Define the loadBookingDetails function
function loadBookingDetails() {
    showBookingPerUser(); // Call the showBookingPerUser function here
    // Other functions for loading booking details can be added here
}

// Ensure this code runs after the document is ready
$(document).ready(function() {
    loadBookingDetails(); // Call the loadBookingDetails function when the document is ready
});