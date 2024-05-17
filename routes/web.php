<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Customer;
use App\Http\Controllers\Stripe;

// LANDING PAGE
Route::get('/', [Home::class, 'harborView'])->name('harborView');
Route::get('/harborView', [Home::class, 'harborView'])->name('harborView');

// AUTHENTICATION
Route::get('/login', [Authentication::class, 'login'])->name('login');
Route::get('/registration', [Authentication::class, 'registration'])->name('registration');
Route::get('/adminLogin', [Authentication::class, 'adminLogin'])->name('adminLogin');
Route::get('/privacyPolicy', [Authentication::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/dataPrivacy', [Authentication::class, 'dataPrivacy'])->name('dataPrivacy');
Route::get('/notesRemarks', [Authentication::class, 'notesRemarks'])->name('notesRemarks');

Route::post('/registrationFunction', [Authentication::class, 'registrationFunction'])->name('registrationFunction');
Route::post('/userLoginFunction', [Authentication::class, 'userLoginFunction'])->name('userLoginFunction');
Route::post('/adminLoginFunction', [Authentication::class, 'adminLoginFunction'])->name('adminLoginFunction');
Route::get('/logoutFunction', [Authentication::class, 'logoutFunction'])->name('logoutFunction');
Route::get('/userVerify/{token}', [Authentication::class, 'userVerify'])->name('userVerify');

// ADMIN DASHBOARD
// ROUTES
Route::get('/adminDashboard', [Admin::class, 'adminDashboard'])->name('adminDashboard');
Route::get('/adminRoom', [Admin::class, 'adminRoom'])->name('adminRoom');
Route::get('/adminNotAvailableRoom', [Admin::class, 'adminNotAvailableRoom'])->name('adminNotAvailableRoom');
Route::get('/addNewRoom', [Admin::class, 'addNewRoom'])->name('addNewRoom');
Route::get('/adminReservation', [Admin::class, 'adminReservation'])->name('adminReservation');
Route::get('/adminCancelledReservation', [Admin::class, 'adminCancelledReservation'])->name('adminCancelledReservation');
Route::get('/adminOnGoingReservation', [Admin::class, 'adminOnGoingReservation'])->name('adminOnGoingReservation');
Route::get('/adminUnpaidReservation', [Admin::class, 'adminUnpaidReservation'])->name('adminUnpaidReservation');
Route::get('/adminUnattendedReservation', [Admin::class, 'adminUnattendedReservation'])->name('adminUnattendedReservation');
Route::get('/getAllUnpaidReservation', [Admin::class, 'getAllUnpaidReservation'])->name('getAllUnpaidReservation');
Route::get('/adminCompletedReservation', [Admin::class, 'adminCompletedReservation'])->name('adminCompletedReservation');
Route::get('/adminCustomer', [Admin::class, 'adminCustomer'])->name('adminCustomer');
Route::get('/adminInActiveCustomer', [Admin::class, 'adminInActiveCustomer'])->name('adminInActiveCustomer');
Route::get('/adminAccount', [Admin::class, 'adminAccount'])->name('adminAccount');

// FUNCTION
Route::get('/getActiveCustomer', [Admin::class, 'getActiveCustomer'])->name('getActiveCustomer');
Route::get('/getInActiveCustomer', [Admin::class, 'getInActiveCustomer'])->name('getInActiveCustomer');
Route::get('/getUserInfo', [Admin::class, 'getUserInfo'])->name('getUserInfo');
Route::get('/getAvailableRoom', [Admin::class, 'getAvailableRoom'])->name('getAvailableRoom');
Route::get('/getNotAvailableRoom', [Admin::class, 'getNotAvailableRoom'])->name('getNotAvailableRoom');
Route::post('/addRoom', [Admin::class, 'addRoom'])->name('addRoom');
Route::get('/getAllPendingReservation', [Admin::class, 'getAllPendingReservation'])->name('getAllPendingReservation');
Route::get('/getAllOnGoingReservation', [Admin::class, 'getAllOnGoingReservation'])->name('getAllOnGoingReservation');
Route::get('/getAllCancelledReservation', [Admin::class, 'getAllCancelledReservation'])->name('getAllCancelledReservation');
Route::get('/getAllDeclineReservation', [Admin::class, 'getAllDeclineReservation'])->name('getAllDeclineReservation');
Route::get('/getAllCompletedReservation', [Admin::class, 'getAllCompletedReservation'])->name('getAllCompletedReservation');
Route::get('/getAllUnattendedReservation', [Admin::class, 'getAllUnattendedReservation'])->name('getAllUnattendedReservation');
Route::get('/acceptReservation', [Admin::class, 'acceptReservation'])->name('acceptReservation');
Route::get('/declineReservation', [Admin::class, 'declineReservation'])->name('declineReservation');
Route::get('/ongoingReservation', [Admin::class, 'ongoingReservation'])->name('ongoingReservation');
Route::get('/completeReservation', [Admin::class, 'completeReservation'])->name('completeReservation');
Route::get('/viewRoomDetails', [Admin::class, 'viewRoomDetails'])->name('viewRoomDetails');
Route::post('/updateRoom', [Admin::class, 'updateRoom'])->name('updateRoom');
Route::get('/deactivateRoom', [Admin::class, 'deactivateRoom'])->name('deactivateRoom');
Route::get('/activateRoom', [Admin::class, 'activateRoom'])->name('activateRoom');
Route::get('/getBackOutContentForAdmin', [Admin::class, 'getBackOutContentForAdmin'])->name('getBackOutContentForAdmin');
Route::get('/viewReasonCancelled', [Admin::class, 'viewReasonCancelled'])->name('viewReasonCancelled');
Route::get('/deactivateCustomer', [Admin::class, 'deactivateCustomer'])->name('deactivateCustomer');
Route::get('/activateCustomer', [Admin::class, 'activateCustomer'])->name('activateCustomer');
Route::get('/viewCustomer', [Admin::class, 'viewCustomer'])->name('viewCustomer');
Route::get('/deleteUnpaidReservation', [Admin::class, 'deleteUnpaidReservation'])->name('deleteUnpaidReservation');
Route::get('/noteCancelReservation', [Admin::class, 'noteCancelReservation'])->name('noteCancelReservation');
Route::get('/checkCancelledReservation', [Admin::class, 'checkCancelledReservation'])->name('checkCancelledReservation');
Route::get('/getAllTotalForAdmin', [Admin::class, 'getAllTotalForAdmin'])->name('getAllTotalForAdmin');
Route::get('/paymentGraph', [Admin::class, 'paymentGraph'])->name('paymentGraph');
Route::get('/unAttendedReservation', [Admin::class, 'unAttendedReservation'])->name('unAttendedReservation');


// CUSTOMER DASHBOARD

// ROUTES
Route::get('/customerDashboard', [Customer::class, 'customerDashboard'])->name('customerDashboard');
Route::get('/customerRoom', [Customer::class, 'customerRoom'])->name('customerRoom');
Route::get('/customerReservation', [Customer::class, 'customerReservation'])->name('customerReservation');
Route::get('/customerAcceptReservation', [Customer::class, 'customerAcceptReservation'])->name('customerAcceptReservation');
Route::get('/customerDeclinedReservation', [Customer::class, 'customerDeclinedReservation'])->name('customerDeclinedReservation');
Route::get('/customerUnpaidReservation', [Customer::class, 'customerUnpaidReservation'])->name('customerUnpaidReservation');
Route::get('/customerCancelReservation', [Customer::class, 'customerCancelReservation'])->name('customerCancelReservation');
Route::get('/customerCompleted', [Customer::class, 'customerCompleted'])->name('customerReservation');
Route::get('/customerAccount', [Customer::class, 'customerAccount'])->name('customerReservation');
Route::get('/customerCredentials', [Customer::class, 'customerCredentials'])->name('customerCredentials');
Route::get('/payment/{book_code}', [Customer::class, 'payment'])->name('payment');


// STRIPE
// Route::post('/stripePayment', [Stripe::class, 'stripePayment'])->name('stripePayment');
Route::match(['get', 'post'], '/stripePayment', [Stripe::class, 'stripePayment'])->name('stripePayment');
Route::get('/success', [Stripe::class, 'success'])->name('success');
Route::get('/cancel', [Stripe::class, 'cancel'])->name('cancel');


// FUNCTION
Route::get('/getCustomerRoom', [Customer::class, 'getCustomerRoom'])->name('getCustomerRoom');
Route::post('/bookReservation', [Customer::class, 'bookReservation'])->name('bookReservation');
Route::get('/cancelReservation', [Customer::class, 'cancelReservation'])->name('cancelReservation');
Route::get('/getBookPerUser', [Customer::class, 'getBookPerUser'])->name('getBookPerUser');
Route::get('/getAcceptBookPerUser', [Customer::class, 'getAcceptBookPerUser'])->name('getAcceptBookPerUser');
Route::get('/getCancelBookPerUser', [Customer::class, 'getCancelBookPerUser'])->name('getCancelBookPerUser');
Route::get('/getDeclineBookPerUser', [Customer::class, 'getDeclineBookPerUser'])->name('getDeclineBookPerUser');
Route::get('/getUnpaidBooking', [Customer::class, 'getUnpaidBooking'])->name('getUnpaidBooking');
Route::get('/getCompleteBookPerUser', [Customer::class, 'getCompleteBookPerUser'])->name('getCompleteBookPerUser');
Route::get('/archivedCancelledReservation', [Customer::class, 'archivedCancelledReservation'])->name('archivedCancelledReservation');
Route::get('/cancelReservation', [Customer::class, 'cancelReservation'])->name('cancelReservation');
Route::get('/deleteReservation', [Customer::class, 'deleteReservation'])->name('deleteReservation');
Route::get('/getUserInfo', [Customer::class, 'getUserInfo'])->name('getUserInfo');
Route::post('/updateUserAccount', [Customer::class, 'updateUserAccount'])->name('updateUserAccount');
Route::post('/updateUserCredentials', [Customer::class, 'updateUserCredentials'])->name('updateUserCredentials');
Route::get('/getAllTotalForCustomer', [Customer::class, 'getAllTotalForCustomer'])->name('getAllTotalForCustomer');
Route::post('/updateUnpaidReservation', [Customer::class, 'updateUnpaidReservation'])->name('updateUnpaidReservation');
Route::get('/viewUnpaidReservation', [Customer::class, 'viewUnpaidReservation'])->name('viewUnpaidReservation');
