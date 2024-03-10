<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reservation;

use App\Models\Event;

class AdminController extends Controller
{
    public function add_event(Request $request){
        $event=new event;
        $event->event_title=$request->title;
        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('event_img', $imagename);
        $event->image=$imagename;
        $event->description=$request->description;
        $event->price=$request->price;
        $event->save();
        return redirect()->back()->with('message', 'Event Added Successfully');
    }

    public function create_event()  {
        return view('admin.event');
    }

    public function show_event(){
        $event = event::all();
        return view('admin.show_event', compact('event'));
    }

    public function delete_event($id){
        $event=event::find($id);
        $event->delete();
        return redirect()->back()->with('message','Event Deleted Successfully');
    }

        public function show_reservation(){
            $data=reservation::all();
            return view('admin.show_reservation', compact('data'));
        }

}
