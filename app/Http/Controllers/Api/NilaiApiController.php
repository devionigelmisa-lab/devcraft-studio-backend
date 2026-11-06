<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NilaiApiController extends Controller
{
   //get berdasarkan id_mhs
    public function index(Request $request)
    {
        $query = Nilai::query();
        if ($request->has('id_mhs') && $request->id_mhs != '') {
            $query->where('id_mhs', $request->id_mhs);
        }
 
        if ($request->has('matakuliahid') && $matakuliahid != '') {
            $query->where('matakuliahid', $request->matakuliahid);
        }

        $nilais = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Nilai',
            'data'    => $nilais
        ], 200);
    }

   //get detail 1 nilai berdasarkan id
    public function show($id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'success' => false,
                'message' => 'Data Nilai tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Nilai',
            'data'    => $nilai
        ], 200);
    }

    //post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_mhs'       => 'required|integer',
            'matakuliahid' => 'required|integer',
            'semester'      => 'required|integer',
            'nilai'        => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $nilai = Nilai::create([
            'id_mhs'       => $request->id_mhs,
            'matakuliahid' => $request->matakuliahid,
            'semester'      => $request->semester,
            'nilai'        => $request->nilai,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Nilai Berhasil Ditambahkan',
            'data'    => $nilai
        ], 201);
    }

    //put (update)
    public function update(Request $request, $id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'success' => false,
                'message' => 'Data Nilai tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_mhs'       => 'required|integer',
            'matakuliahid' => 'required|integer',
            'semester'      => 'required|integer',
            'nilai'        => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $nilai->update([
            'id_mhs'       => $request->id_mhs,
            'matakuliahid' => $request->matakuliahid,
            'semester'      => $request->semester,
            'nilai'        => $request->nilai,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Nilai Berhasil Diperbarui',
            'data'    => $nilai
        ], 200);
    }

    //delete
    public function destroy($id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'success' => false,
                'message' => 'Data Nilai tidak ditemukan'
            ], 404);
        }

        $nilai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Nilai Berhasil Dihapus'
        ], 200);
    }
}