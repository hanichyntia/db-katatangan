<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{
    // Create a new level
    public function createLevel(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'lesson_id' => 'required|exists:lessons,id', // ensure lesson_id exists in lessons table
        ]);

        $level = Level::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lesson_id' => $request->lesson_id,
        ]);

        return response()->json([
            'message' => 'Level created successfully',
            'data' => $level,
        ]);
    }

    // Get all levels
    public function getAllLevel()
    {
        $levels = Level::all();
        return response()->json($levels);
    }

    // Get level by ID
    public function getByIdLevel($id)
    {
        $level = Level::find($id);
        if (!$level) {
            return response()->json(['message' => 'Level not found'], 404);
        }
        return response()->json($level);
    }

    // Update level
    public function updateLevel(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'lesson_id' => 'required|exists:lessons,id',
        ]);

        $ubah=level::where('id',$id)->update([
            'judul'=>$request->judul,
            'deskripsi'=>$request->deskripsi,
            'lesson_id'=>$request->lesson_id
        ]);
        if ($ubah) {
            $terbaru=level::latest()->first();
            return response()->json([
                'data'=>$terbaru,
                'messege'=>'Level update successfully'
            ]);
        }else{
            return response()->json([
                'messege'=>'Level update failed'
            ]);
        }
    }

    // Delete level
    public function deleteLevel($id)
    {
        $level = Level::find($id);
        if (!$level) {
            return response()->json(['message' => 'Level not found'], 404);
        }
        $level->delete();
        return response()->json(['message' => 'Level deleted successfully']);
    }
}
