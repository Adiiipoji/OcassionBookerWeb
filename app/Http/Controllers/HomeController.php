<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\event;
use App\Models\reservation;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(){
        return view('home.userpage');
    }
    
    public function redirect(){
        $usertype = Auth::user()->usertype;

        if ($usertype == "1") {
            return view('admin.home');
        } else {
            return $this->home(); 
        }
    }

    public function home(){
        $events = Event::all(); 
        return view('home.userpage', compact('events')); 
    }


public function addreservation(Request $request, $id)
{
    $startDate = $request->startDate;
    $endDate = $request->endDate;

    
    $isReservation = Reservation::where('event_id', $id)
        ->where(function ($query) use ($startDate, $endDate) {
            $query->where('start_date', '<=', $endDate)
                  ->where('end_date', '>=', $startDate);
        })
        ->exists();

    if ($isReservation) {
        return redirect()->back()->with('message', 'Event already booked. Please try a different date!');
    }

    
    $reservation = new Reservation();
    $reservation->event_id = $id;
    $reservation->name = $request->name;
    $reservation->email = $request->email;
    $reservation->phone = $request->phone;
    $reservation->start_date = $startDate;
    $reservation->end_date = $endDate;
    $reservation->save();

    return redirect()->back()->with('message', 'Event booked successfully!');
}




public function event_details($id){
    $event = Event::find($id);
    return view('home.view_reservation', compact('event'));
}

public function checkEmailAvailability(Request $request){
    $email = $request->input('email');

    $user = User::where('email', $email)->first();

    if ($user) {
        
        return response()->json(['error' => 'Email already registered'], 400);
    }

    
    return response()->json(['message' => 'Email is available']);
    }
    
    public function sendPasswordResetLink(Request $request){
    $request->validate(['email' => 'required|email']);

    
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    
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
        
        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token]);
    }

    
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