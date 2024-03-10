<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(){
        return view('home.userpage');
    }
    
    public function redirect(){
        $usertype=auth::user()->usertype;

        if($usertype== "1"){

            return view('admin.home');
    }

    else{
        $event=event::all();
        return view('home.userpage', compact('event'));
}
}

public function home(){
    $event=event::all();
    return view('home.userpage',compact('event'));
}

public function addreservation(Request $request, $id){

    $request->validate([
        'startDate' => 'required|date',
        'endDate'=> 'date|after:startDate',
    ]);

    $data = new event;
    $data->event_id = $id;
    $data ->name = $request->name;
    $data ->email = $request->email;
    $data ->phone = $request->phone;

    $startDate = $request->startDate;
    $endDate = $request->endDate;

    $isReservation = Reservation::where('event_id', $id)
    ->where('start_date', '<=', $endDate)
    ->where('end_date', '>=', $startDate)->exists();

    if ($isReservation) {
        return redirect()->back()->with('message', 'Event Already Booked Pleased try different date!');
    }
    else{
        $data ->start_date = $request->startDate;
        $data ->end_date = $request->endDate;
        $data->save();
        return redirect()->back()->with('message', 'Event Booked Succesfully!');
    }



    $data ->start_date = $request->startDate;
    $data ->end_date = $request->endDate;

}

public function event_details($id){
    $event = Event::find($id);
    return view('home.view_reservation', compact('event'));
}

public function checkEmailAvailability(Request $request){
    $email = $request->input('email');

    // Check if the email exists in the database
    $user = User::where('email', $email)->first();

    if ($user) {
        // Email already exists, return error response
        return response()->json(['error' => 'Email already registered'], 400);
    }

    // Email is available, return success response
    return response()->json(['message' => 'Email is available']);
    }
    
    public function sendPasswordResetLink(Request $request){
    $request->validate(['email' => 'required|email']);

    // Check if the user with the provided email exists
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // If the user exists, send the password reset link
    $status = Password::sendResetLink(
        $request->only('email')
    );

    if ($status === Password::RESET_LINK_SENT) {
        return response()->json(['message' => 'Password reset link sent successfully']);
    } else {
        return response()->json(['error' => 'Failed to send password reset link'], 500);
    }
    }
    
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(['user' => $user]);
    }
    
    public function login(Request $request)
    {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Authentication passed...
        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token]);
    }

    // Authentication failed...
    return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function store(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = bcrypt($request->password); 
    
        $user->save();
    
        return response()->json(['user' => $user]); 
    }

}