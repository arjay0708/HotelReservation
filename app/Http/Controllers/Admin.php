<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\ReasonBackOut;
use App\Models\Payment;

class Admin extends Controller
{
    // ROUTES
        public function adminDashboard(){
            return view('admin/dashboard');
        }
        public function adminRoom(){
            return view('admin/room');
        }
        public function adminNotAvailableRoom(){
            return view('admin/notAvailableRoom');
        }
        public function addNewRoom(){
            return view('admin/addNewRoom');
        }
        public function adminReservation(){
            return view('admin/reservation');
        }
        public function adminOnGoingReservation(){
            return view('admin/ongoingReservation');
        }
        public function adminCancelledReservation(){
            return view('admin/cancelledReservation');
        }
        public function adminUnpaidReservation(){
            return view('admin/unpaidReservation');
        }
        public function adminUnattendedReservation(){
            return view('admin/unattendedReservation');
        }
        public function adminCompletedReservation(){
            return view('admin/completedReservation');
        }
        public function adminCustomer(){
            return view('admin/customer');
        }
        public function adminInActiveCustomer(){
            return view('admin/inactiveCustomer');
        }
        public function adminAccount(){
            return view('admin/account');
        }
    // ROUTES

    // FUNCTION
            // ACTIVE USER DATA FOR TABLE
            public function getActiveCustomer(Request $request){
                $data = User::where([['is_active', '=', 1],['is_admin', '=', 0],['lastname', '!=', 'NULL']])->select(
                    'user_id','lastname','firstname','middlename','extention','email','phoneNumber'
                )->get();
                return response()->json($data);
            }

            // IN-ACTIVE USER DATA FOR TABLE
            public function getInActiveCustomer(Request $request){
                $data = User::where([['is_active', '=', 0],['is_admin', '=', 0],['lastname', '!=', 'NULL']])->select(
                    'user_id','lastname','firstname','middlename','extention','email','phoneNumber'
                )->get();
                return response()->json($data);
            }

            // PERSONAL INFORMATION FOR ACCOUNT
            public function getUserInfo(Request $request){
                $data = User::where([['user_id', '=', auth()->guard('userModel')->user()->user_id]])->first();
                return response()->json($data);
            }

            // AVAILABLE ROOM FOR TABLE
            public function getAvailableRoom(Request $request){
                $data = Room::where([['is_available', '=', 1]])->select(
                    'room_id','room_number','floor','type_of_room','price_per_hour'
                )->get();
                return response()->json($data);
            }

            // NOT AVAILABLE ROOM FOR TABLE
            public function getNotAvailableRoom(Request $request){
                $data = Room::where([['is_available', '=', 0]])->select(
                    'room_id','room_number','floor','type_of_room','price_per_hour'
                )->get();
                return response()->json($data);
            }

            // ADD ROOM FUNCTION
            public function addRoom(Request $request){
                $data = Room::where([['room_number', '=', $request->roomNumber]])->get();
                if(!$data->isNotEmpty()){
                    $filename = $request->file('roomPhoto');
                    $imageName =   time().rand() . '.' .  $filename->getClientOriginalExtension();
                    $path = $request->file('roomPhoto')->storeAs('roomPhotos', $imageName, 'public');
                    $imageData['roomPhoto'] = '/storage/'.$path;
                    $addRoom = Room::create([
                    'photos' => $imageData['roomPhoto'],
                    'room_number' => $request->roomNumber,
                    'floor' => $request->roomFloor,
                    'type_of_room' => $request->roomType,
                    'number_of_bed' => $request->bedNumber,
                    'details' => $request->detailsOfRoom,
                    'max_person' => $request->maxPerson,
                    'price_per_hour' => $request->pricePerHour,
                    'is_available' => 1
                    ]);
                    return response()->json($addRoom ? 1 : 0);
                    // exit();
                }else{
                    return response()->json(2);
                }
            }

            // ALL PENDING RESERVATION
            public function getAllPendingReservation(Request $request) {
                $data = Reservation::join('roomTable', 'reservationTable.room_id', '=', 'roomTable.room_id')
                    ->join('userTable', 'reservationTable.user_id', '=', 'userTable.user_id')
                    ->where([['reservationTable.status', '=', 'Pending']])
                    ->orderBy('reservationTable.reservation_id', 'ASC')
                    ->select(
                        'reservationTable.reservation_id', 'userTable.user_id', 'userTable.lastname', 'userTable.firstname', 'userTable.middlename',
                        'userTable.extention', 'roomTable.room_number', 'roomTable.floor', 'roomTable.price_per_hour', 'reservationTable.start_dataTime', 'reservationTable.end_dateTime',
                    )->orderBy('reservationTable.start_dataTime', 'ASC')->get();

                foreach ($data as $reservation) {
                    $startDateTime = Carbon::parse($reservation->start_dataTime);
                    $endDateTime = Carbon::parse($reservation->end_dateTime);

                    $totalNights = ceil($startDateTime->diffInHours($endDateTime) / 24);
                    $totalPayment = $totalNights * $reservation->price_per_hour;
                    $halfTotalPayment = $totalPayment / 2;

                    $reservation->totalNights = $totalNights;
                    $reservation->totalPayment = $totalPayment;
                    $reservation->balance = $halfTotalPayment;
                }

                return response()->json($data);
            }

            // ALL ON GOING RESERVATION
            public function getAllOnGoingReservation(Request $request){
                $data = Reservation::join('roomTable', 'reservationTable.room_id', '=', 'roomTable.room_id')
                ->join('userTable', 'reservationTable.user_id', '=', 'userTable.user_id')
                ->where([['reservationTable.status', '=', 'OnGoing']])
                ->orderBy('reservationTable.reservation_id', 'ASC')
                ->select(
                    'reservationTable.reservation_id', 'userTable.user_id', 'userTable.lastname', 'userTable.firstname', 'userTable.middlename',
                    'userTable.extention', 'roomTable.room_number', 'roomTable.floor', 'roomTable.price_per_hour', 'reservationTable.start_dataTime', 'reservationTable.end_dateTime',
                )->orderBy('reservationTable.start_dataTime', 'ASC')->get();

                foreach ($data as $reservation) {
                    $startDateTime = Carbon::parse($reservation->start_dataTime);
                    $endDateTime = Carbon::parse($reservation->end_dateTime);

                    $totalNights = ceil($startDateTime->diffInHours($endDateTime) / 24);
                    $totalPayment = $totalNights * $reservation->price_per_hour;
                    $halfTotalPayment = $totalPayment / 2;

                    $reservation->totalNights = $totalNights;
                    $reservation->totalPayment = $totalPayment;
                    $reservation->balance = $halfTotalPayment;
                }

                return response()->json($data);
            }

            // ALL CANCELLED RESERVATION
            public function getAllCancelledReservation(Request $request){
                $data = Reservation::join('roomTable', 'reservationTable.room_id', '=', 'roomTable.room_id')
                ->join('userTable', 'reservationTable.user_id', '=', 'userTable.user_id')
                ->where([['reservationTable.status', '=', 'Cancel']])
                ->orderBy('reservationTable.is_noted', 'ASC')->orderBy('reservationTable.start_dataTime', 'DESC')
                ->select(
                    'reservationTable.reservation_id','reservationTable.is_noted', 'userTable.user_id', 'userTable.lastname', 'userTable.firstname', 'userTable.middlename',
                    'userTable.extention', 'roomTable.room_number', 'roomTable.floor', 'roomTable.price_per_hour', 'reservationTable.start_dataTime', 'reservationTable.end_dateTime',
                )->get();

                foreach ($data as $reservation) {
                    $startDateTime = Carbon::parse($reservation->start_dataTime);
                    $endDateTime = Carbon::parse($reservation->end_dateTime);

                    $totalNights = ceil($startDateTime->diffInHours($endDateTime) / 24);
                    $totalPayment = $totalNights * $reservation->price_per_hour;
                    $halfTotalPayment = $totalPayment / 2;

                    $reservation->totalNights = $totalNights;
                    $reservation->totalPayment = $totalPayment;
                    $reservation->balance = $halfTotalPayment;
                }

                return response()->json($data);
            }

            // ALL UNPAID RESERVATION
            public function getAllUnpaidReservation(Request $request){
                $data = Reservation::join('roomTable', 'reservationTable.room_id', '=', 'roomTable.room_id')
                ->join('userTable', 'reservationTable.user_id', '=', 'userTable.user_id')
                ->where([['reservationTable.status', '=', 'Unpaid']])
                ->orderBy('reservationTable.reservation_id', 'ASC')
                ->select(
                    'reservationTable.reservation_id', 'userTable.user_id', 'userTable.lastname', 'userTable.firstname', 'userTable.middlename',
                    'userTable.extention', 'roomTable.room_number', 'roomTable.floor', 'roomTable.price_per_hour', 'reservationTable.start_dataTime', 'reservationTable.end_dateTime',
                )->orderBy('reservationTable.start_dataTime', 'ASC')->get();

                foreach ($data as $reservation) {
                    $startDateTime = Carbon::parse($reservation->start_dataTime);
                    $endDateTime = Carbon::parse($reservation->end_dateTime);

                    $totalNights = ceil($startDateTime->diffInHours($endDateTime) / 24);
                    $totalPayment = $totalNights * $reservation->price_per_hour;
                    $halfTotalPayment = $totalPayment / 2;

                    $reservation->totalNights = $totalNights;
                    $reservation->totalPayment = $totalPayment;
                    $reservation->balance = $halfTotalPayment;
                }

                return response()->json($data);
            }

            // ALL COMPLETED RESERVATION
            public function getAllCompletedReservation(Request $request){
                $data = Reservation::join('roomTable', 'reservationTable.room_id', '=', 'roomTable.room_id')
                ->join('userTable', 'reservationTable.user_id', '=', 'userTable.user_id')
                ->where([['reservationTable.status', '=', 'Complete']])->orderBy('reservationTable.reservation_id', 'ASC')
                ->select(
                    'reservationTable.reservation_id','userTable.user_id','userTable.lastname','userTable.firstname','userTable.middlename','userTable.extention',
                    'roomTable.room_id', 'roomTable.room_number','roomTable.floor','roomTable.price_per_hour','reservationTable.start_dataTime','reservationTable.end_dateTime',
                )->orderBy('reservationTable.end_dateTime' , 'ASC')->get();
                foreach ($data as $reservation) {
                    $startDateTime = Carbon::parse($reservation->start_dataTime);
                    $endDateTime = Carbon::parse($reservation->end_dateTime);

                    $totalNights = ceil($startDateTime->diffInHours($endDateTime) / 24);
                    $totalPayment = $totalNights * $reservation->price_per_hour;

                    $reservation->totalPayment = $totalPayment;
                }
                return response()->json($data);
            }

            public function getAllUnattendedReservation(Request $request){
                $data = Reservation::join('roomTable', 'reservationtable.room_id', '=', 'roomTable.room_id')
                ->join('userTable', 'reservationtable.user_id', '=', 'userTable.user_id')
                ->where([['reservationtable.status', '=', 'UnAttended']])->orderBy('reservationtable.reservation_id', 'ASC')
                ->select(
                    'reservationTable.reservation_id','userTable.user_id','userTable.lastname','userTable.firstname','userTable.middlename','userTable.extention',
                    'roomTable.room_id', 'roomTable.room_number','roomTable.floor','roomTable.price_per_hour','reservationtable.start_dataTime','reservationtable.end_dateTime',
                )->orderBy('reservationTable.end_dateTime' , 'ASC')->get();
                foreach ($data as $reservation) {
                    $startDateTime = Carbon::parse($reservation->start_dataTime);
                    $endDateTime = Carbon::parse($reservation->end_dateTime);

                    $totalNights = ceil($startDateTime->diffInHours($endDateTime) / 24);
                    $totalPayment = $totalNights * $reservation->price_per_hour;

                    $reservation->totalPayment = $totalPayment;
                }
                return response()->json($data);
            }

            public function unAttendedReservation(Request $request){
                // Fetch the reservation data
                $reservation = Reservation::find($request->reservationId);
            
                // Check if the reservation exists
                if($reservation) {
                    // Update the reservation status to "UnAttended"
                    $reservation->status = 'UnAttended';
                    $reservation->save();
            
                    // Return success response
                    return response()->json(1);
                } else {
                    // If the reservation does not exist, return failure response
                    return response()->json(0);
                }
            }

            // ON-GOING RESERVATION
            public function ongoingReservation(Request $request){
                date_default_timezone_set('Asia/Manila');
                $currentDate = date('m-d-Y h:i A', strtotime(now()));
                $data = Reservation::where([['reservation_id', '=', $request->reservationId]])->first();
                $checkInDateTime = date('m-d-Y h:i A',strtotime($data->start_dataTime));
                $checkOutDateTime = date('m-d-Y h:i A',strtotime($data->end_dateTime));
                if($currentDate >= $checkInDateTime && $currentDate <= $checkOutDateTime){
                    $ongoingReservation = Reservation::where([['reservation_id', '=', $request->reservationId]])->update(['status' => 'OnGoing']);
                    return response()->json($ongoingReservation ? 1 : 0);
                }else{
                    return response()->json(2);
                }
            }

            // COMPLETE RESERVATION
            public function completeReservation(Request $request){
                date_default_timezone_set('Asia/Manila');
                $currentDate = date('m-d-Y h:i A', strtotime("+1 hours", strtotime(now())));
                $data = Reservation::where([['reservation_id', '=', $request->reservationId]])->first();
                $checkOutDateTime = date('m-d-Y h:i A',strtotime($data->end_dateTime));
                if($currentDate > $checkOutDateTime){
                    $completeReservation = Reservation::where([['reservation_id', '=', $request->reservationId]])->update(['status' => 'Complete']);
                    return response()->json($completeReservation ? 1 : 0);
                }else{
                    return response()->json(2);
                }
            }

            // GET ALL TOTAL
            public function getAllTotalForAdmin(Request $request){
                $pending = Reservation::where([['status', '=' ,'Pending']])->get();
                $totalPendingReservation = $pending->count();

                $onGoingReservation = Reservation::where([['status', '=' ,'OnGoing']])->get();
                $totalOnGoingReservation = $onGoingReservation->count();

                $completeReservation = Reservation::where([['status', '=' ,'Completed']])->get();
                $totalCompletedReservation = $completeReservation->count();

                $customer = User::where([['is_active', '=' ,1], ['is_admin', '=' ,0]])->get();
                $totalCustomer = $customer->count();

                return response()->json([
                    'totalPendingReservation' => $totalPendingReservation,
                    'totalOnGoingReservation' => $totalOnGoingReservation,
                    'totalCompletedReservation' => $totalCompletedReservation,
                    'totalCustomer' => $totalCustomer,
                ]);
            }

            // VIEW DETAILS OF ROOM
            public function viewRoomDetails(Request $request){
                $data = Room::where([['room_id', '=' ,$request->roomId]])->first();
                return response()->json($data);
            }

            // UPDATE ROOM
            public function updateRoom(Request $request) {
                $update = Room::find($request->room_id);

                if ($request->hasFile('roomPhoto')) {
                    $filename = $request->file('roomPhoto');
                    $imageName = time() . rand() . '.' . $filename->getClientOriginalExtension();
                    $path = $request->file('roomPhoto')->storeAs('roomPhotos', $imageName, 'public');
                    $update->photos = '/storage/' . $path;
                }

                $update->room_number = $request->input('roomNumber');
                $update->floor = $request->input('roomFloor');
                $update->type_of_room = $request->input('roomType');
                $update->number_of_bed = $request->input('roomBedNumber');
                $update->details = $request->input('detailsOfRoom');
                $update->max_person = $request->input('roomMaxPerson');
                $update->price_per_hour = $request->input('roomPricePerHour');
                $update->save();

                return response()->json(1);
            }

            // DEACTIVATE ROOM
            public function deactivateRoom(Request $request){
                Room::where([['room_id', '=', $request->roomId]])->update(['is_available' => 0]);
                return response()->json(1);
            }

            // ACTIVATE ROOM
            public function activateRoom(Request $request){
                Room::where([['room_id', '=', $request->roomId]])->update(['is_available' => 1]);
                return response()->json(1);
            }

            // FETCH THE CANCELLED REASON
            public function viewReasonCancelled(Request $request){
                $data = ReasonBackOut::where([['reservation_id', '=', $request->reservationId]])->select('reason','created_at')->first();
                $formattedCreatedAt = Carbon::parse($data->created_at)->format('Y-m-d ');
                $data->created_at = $formattedCreatedAt;
                return response()->json($data);
            }

            // DEACTIVATE CUSTOMER
            public function deactivateCustomer(Request $request){
                User::where([['user_id', '=', $request->customerId]])->update(['is_active' => 0]);
                return response()->json(1);
            }

            // ACTIVATE CUSTOMER
            public function activateCustomer(Request $request){
                User::where([['user_id', '=', $request->customerId]])->update(['is_active' => 1]);
                return response()->json(1);
            }

            // VIEW CUSTOMER
            public function viewCustomer(Request $request){
                $viewCustomer = User::where([['user_id', '=', $request->customerId]])->first();
                return response()->json($viewCustomer);
            }

            // AUTOMATIC DELETE UNPAID RESERVATION
            public function deleteUnpaidReservation(Request $request) {
                $currentDateTime = Carbon::now()->toDateTimeString();
                Reservation::where([['status', '=', 'Unpaid'],['end_dateTime', '<', $currentDateTime],])->delete();
                return response()->json(1);
            }

            //  NOTE CANCELED RESERVATION
            public function noteCancelReservation(Request $request) {
                Reservation::where([['reservation_id', '=', $request->reservationId]])->update(['is_noted' => 1]);
                return response()->json(1);
            }

            // CHECK CANCELLED RESERVATION
            // public function checkCancelledReservation(Request $request) {
            //     $check = Reservation::where([['status', '=', 'Cancel'],['is_noted', '=', 0]])->get();
            //     return response()->json($check->count() > 0 ? 1 : 0);
            // }

            // FUNCTION FOR CHART
            public function paymentGraph(Request $request){
                $monthNames = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];

                $orders = Payment::selectRaw('DATE_FORMAT(created_at, "%M") as monthName,  SUM(amount) as totalSales')
                    ->groupBy('monthName')->orderByRaw('MONTH(created_at)')->get()->keyBy('monthName')->map(fn($data) => $data->totalSales)->toArray();

                $formattedOrders = array_replace(array_fill_keys($monthNames, 0), $orders);

                $response = ['months' => $monthNames,'sales' => array_values($formattedOrders),];

                return response()->json($response);
            }

    // FUNCTION
}
