<?php

namespace App\Http\Controllers;

use App\Models\paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    //Create
    public function createPaket(Request $request)
    {
        $request->validate([
            'nama_paket'=>'required',
            'harga'=>'required'
        ]);
        $add=paket::create([
            'nama_paket'=>$request->nama_paket,
            'harga'=>$request->harga,
        ]);
        if ($add) {
            $tambah=paket::latest()->first();
            return response()->json([
                'data'=>$tambah,
                'messege'=>'Paket created successfully'
            ]);
        }else {
            return response()->json(['message' => 'Paket created failed'], 404);
        }
    }

    //getAll
    public function getAllPaket()
    {
        $getAll=paket::all();
        if ($getAll) {
            return response()->json([
                'data'=>$getAll
            ]);
        }else{
            return response()->json(['message' => 'Paket not found'], 404);
        }
    }
    //getId
    public function getIdPaket($id)
    {
        $getId=paket::find('id',$id);
        if ($getId) {
            return response()->json([
                'data'=>$getId
            ]);
        }else{
            return response()->json(['message' => 'Paket not found'], 404);
        }
    }

    //Update
    public function updatePaket(Request $request,$id)
    {
        $request->validate([
            'harga'=>'required'
        ]);
        $update=paket::where('id',$id)->update([
            'harga'=>$request->harga
        ]);

        if ($update) {
            $newdt=paket::latest()->first();
            return response()->json([
                'data'=>$newdt,
                'messege'=>'Paket update successfully'
            ]);
        }else {
            return response()->json(['message' => 'Paket update failed'], 404);
        }
    }

    //delete
    public function deletePaket($id){
        $delete=paket::find('id',$id);
        $hapus = $delete->delete();
        return response()->json([
            'messege'=> 'Paket deleted',
            'data'=>$hapus
        ]);
    }
}
