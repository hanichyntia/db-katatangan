<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // Create a new event
    public function createEvent(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'link_kitabisa' => 'required',
            'tanggal_berakhir' => 'required|date',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'link_kitabisa' => $request->link_kitabisa,
            'tanggal_berakhir' => $request->tanggal_berakhir,
        ]);

        return response()->json([
            'message' => 'Event created successfully',
            'data' => $event,
        ]);
    }

    // Get all events
    public function getAllEvent()
    {
        $events = Event::all();
        return response()->json($events);
    }

    // Get event by ID
    public function getByIdEvent($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        return response()->json($event);
    }

    // Update event
    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'link_kitabisa' => 'required',
            'tanggal_berakhir' => 'required|date',
        ]);

        $ubah=event::where('id',$id)->update([
            'title'=> $request->title,
            'deskripsi'=>$request->deskripsi,
            'link_kitabisa'=>$request->link_kitabisa,
            'tanggal_berakhir'=>$request->tanggal_berakhir
        ]);
        if ($ubah) {
            $terbaru=event::latest()->first();
            return response()->json([
                'data'=>$terbaru,
                'messege'=>'Event update successfully'
            ]);
        }else{
            return response()->json([
                'messege'=>'Event update failed'
            ]);
        }
    }

    // Delete event
    public function deleteEvent($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
