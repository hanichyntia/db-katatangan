<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Paket;

class PaymentController extends Controller
{
    public function payment(Request $request, $paket_id)
    {
        $request->validate([
            'paket_id' => 'required',
            'pembayaran' => 'required|numeric|min:0' // Pembayaran harus numerik dan minimal 0
        ]);

        // Mendapatkan informasi paket
        $info_paket = Paket::find($paket_id);

        if (!$info_paket) {
            return response()->json([
                'success' => false,
                'message' => 'Paket tidak ditemukan'
            ], 404);
        }

        // Menghitung total harga termasuk pajak
        $total_harga = $info_paket->harga * 1.11; // Pajak 11%
        
        // Memastikan pembayaran mencukupi
        if ($request->pembayaran < $total_harga) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran tidak mencukupi'
            ], 400);
        }

        // Simpan pembayaran
        $save = Payment::create([
            'paket_id' => $request->paket_id,
            'pembayaran' => $request->pembayaran
        ]);

        if (!$save) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran gagal disimpan'
            ], 500);
        }

        // Ambil data level sesuai dengan paket
        if ($paket_id == 1) {
            $levels = Level::with(['lessons' => function($query) {
                $query->where('id', 1);
            }])->get();
        } elseif ($paket_id == 2) {
            $levels = Level::with(['lessons' => function($query) {
                $query->whereBetween('id', [1, 6]);
            }])->get();
        } elseif ($paket_id == 3) {
            $levels = Level::with(['lessons' => function($query) {
                $query->whereBetween('id', [1, 9]);
            }])->get();
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Paket tidak ditemukan atau tidak diizinkan mengakses lesson'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'paket' => $info_paket,
            'levels' => $levels,
            'total_harga' => $total_harga // Menyertakan total harga termasuk pajak dalam respons
        ]);
    }
}
