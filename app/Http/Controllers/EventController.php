<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
{
    $events = Event::all();

    if ($events->isEmpty()) {
        Log::info('No events found.');
    } else {
        Log::info('Events retrieved: ', $events->toArray());
    }

    return view('userblade', compact('events'));
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        
        $path = $request->file('image')->store('event_img', 'public');

        $event = Event::create(array_merge($validatedData, ['image' => $path]));
        return response()->json($event, 201);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        
        $event->image_url = asset('storage/' . $event->image);

        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'event_title' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $event = Event::findOrFail($id);

        
        if ($request->hasFile('image')) {
            
            $path = $request->file('image')->store('event_img', 'public');
            
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validatedData['image'] = $path;
        }

        $event->update($validatedData);
        return response()->json($event, 200);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();
        return response()->json(null, 204);
    }

    public function getImageByName($imageName)
    {
        if (Storage::disk('public')->exists('event_img/' . $imageName)) {
            $imageContent = Storage::disk('public')->get('event_img/' . $imageName);

            $mimeType = Storage::disk('public')->mimeType('event_img/' . $imageName);

            Log::info('Image retrieved successfully: ' . $imageName);

            return response($imageContent)->header('Content-Type', $mimeType);
        } else {
            Log::error('Image not found: ' . $imageName);

            return response()->json(['error' => 'Image not found.'], 404);
        }
    }
}