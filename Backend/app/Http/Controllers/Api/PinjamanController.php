<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Pinjaman;

class PinjamanController extends Controller
{
    public function index()
    {
        $pinjamans = Pinjaman::all();

        if (count($pinjamans) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pinjamans
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $pinjaman = Pinjaman::find($id);

        if (!is_null($pinjaman)) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pinjaman
            ], 200);
        }

        return response([
            'message' => 'Pinjaman Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_buku' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pinjaman = Pinjaman::create($storeData);
        return response([
            'message' => 'Berhasil Melakukan Peminjaman',
            'data' => $pinjaman
        ], 200);
    }

    public function destroy($id)
    {
        $pinjaman = Pinjaman::find($id);

        if(is_null($pinjaman)){
            return response([
                'message' => 'Data Peminjaman Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        if($pinjaman->delete()){
            return response([
                'message' => 'Pengembalian Buku Berhasil',
                'data' => $pinjaman
            ], 200);
        }

        return response([
            'message' => 'Delete Data Peminjaman Gagal',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $pinjaman = Pinjaman::find($id);
        if(is_null($pinjaman)){
            return response([
                'message' => 'Data Pinjaman Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_buku' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate ->errors()], 400);

        $pinjaman->nama_buku = $updateData['nama_buku'];
        $pinjaman->penerbit = $updateData['penerbit'];
        $pinjaman->pengarang = $updateData['pengarang'];

        if($pinjaman->save()){
            return response ([
                'message' => 'Update Peminjaman Success',
                'data' => $pinjaman
            ], 200);
        }

        return response([
            'message' => 'Update Pinjaman Failed',
            'data' => null,
        ], 400);
    }
}
