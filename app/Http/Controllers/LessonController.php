<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    // Create a new lesson
    public function createLesson(Request $request)
    {
        $request->validate([
            'judul_lesson' => 'required',
            'deskripsi' => 'required',
            'video_url' => 'required',
            'status' => 'required|in:true,false', // ensure status is either true or false
        ]);

        $lesson = Lesson::create([
            'judul_lesson' => $request->judul_lesson,
            'deskripsi' => $request->deskripsi,
            'video_url' => $request->video_url,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Lesson created successfully',
            'data' => $lesson,
        ]);
    }

    // Get all lessons
    public function getAllLesson()
    {
        $lessons = Lesson::all();
        return response()->json($lessons);
    }

    // Get lesson by ID
    public function getByIdLesson($id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }
        return response()->json($lesson);
    }

    // Update lesson
    public function updateLesson(Request $request, $id)
    {
        $request->validate([
            'judul_lesson' => 'required',
            'deskripsi' => 'required',
            'video_url' => 'required',
            'status' => 'required|in:true,false',
        ]);

        $ubah=lesson::where('id',$id)->update([
            'judul_lesson'=>$request->judul_lesson,
            'deskripsi'=>$request->deskripsi,
            'video_url'=>$request->video_url,
            'status'=>$request->status,
        ]);

        if ($ubah) {
            $terbaru=Lesson::latest()->first();
            return response()->json([
                'data'=>$terbaru,
                'messege'=>'Lesson update successfully'
            ]);
        }else{
            return response()->json([
                'messege'=>'Lesson update failed'
            ]);
        }

    }

    // Delete lesson
    public function deleteLesson($id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }
        $lesson->delete();
        return response()->json(['message' => 'Lesson deleted successfully']);
    }
}
