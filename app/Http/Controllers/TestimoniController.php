<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    // Create a new testimonial
    public function createTest(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'komentar' => 'required',
        ]);

        $testimoni = Testimoni::create([
            'nama' => $request->nama,
            'komentar' => $request->komentar,
        ]);

        return response()->json([
            'message' => 'Testimonial created successfully',
            'data' => $testimoni,
        ]);
    }

    // Get all testimonials
    public function getAllTest()
    {
        $testimonis = Testimoni::all();
        return response()->json($testimonis);
    }

    // Get testimonial by ID
    public function getByIdTest($id)
    {
        $testimoni = Testimoni::find($id);
        if (!$testimoni) {
            return response()->json(['message' => 'Testimonial not found'], 404);
        }
        return response()->json($testimoni);
    }

    // Update testimonial
    public function updateTest(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'komentar' => 'required',
        ]);

        $ubah=Testimoni::where('id',$id)->update([
            'nama'=>$request->nama,
            'komentar'=>$request->komentar,
        ]);
        if ($ubah) {
            $terbaru=Testimoni::latest()->first();
            return response()->json([
                'data'=>$terbaru,
                'messege'=>'Testimoni update successfully'
            ]);
        }else{
            return response()->json([
                'messege'=>'Testimoni update failed'
            ]);
        }

    }

    // Delete testimonial
    public function deleteTest($id)
    {
        $testimoni = Testimoni::find($id);
        if (!$testimoni) {
            return response()->json(['message' => 'Testimonial not found'], 404);
        }
        $testimoni->delete();
        return response()->json(['message' => 'Testimonial deleted successfully']);
    }
}
