<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class EventController extends Controller
{
    public function index()
{
    $events = Event::all();

    // Append the image URL to each event
    foreach ($events as $event) {
        $event->image_url = asset($event->image); // Assuming 'image' contains the path to the image
    }

    return response()->json($events);
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_title' => 'required|string',
            'image' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $event = Event::create($validatedData);
        return response()->json($event, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = event::findOrFail($id);

        // Get the image data from storage
        $imageData = Storage::disk('public/event')->get($event->image);

        // Encode the image data to base64
        $base64Image = base64_encode($imageData);

        // Append the base64 image data to the event object
        $event->image = $base64Image;

        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'event_title' => 'required|string',
            'image' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $event = Event::findOrFail($id);
        $event->update($validatedData);
        return response()->json($event, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json(null, 204);
    }

public function getImageByName($imageName)
{
    // Check if the image exists in the event_img directory
    if (Storage::disk('public')->exists('event_img/' . $imageName)) {
        // Get the image content
        $imageContent = Storage::disk('public')->get('event_img/' . $imageName);

        // Determine the image MIME type
        $mimeType = Storage::disk('public')->mimeType('event_img/' . $imageName);

        // Log successful image retrieval
        Log::info('Image retrieved successfully: ' . $imageName);

        // Return the image data in the response with appropriate headers
        return response($imageContent)->header('Content-Type', $mimeType);
    } else {
        // Log image not found error
        Log::error('Image not found: ' . $imageName);

        // Return a 404 response if the image does not exist
        return response()->json(['error' => 'Image not found.'], 404);
    }
}

    
}
