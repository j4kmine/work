<?php

namespace App\Http\Controllers\API;

use App\Models\BarangKategoriModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangKategoriController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        // $this->validate($request, [
        //     'title' => 'required'

        // ]);

        $title = $request->title;
        $data = BarangKategoriModel::where('title', 'LIKE', '%' . $title . '%')->paginate(10);
        return response()->json([$data], 200);
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'title'=>'required',
        //     'id_barang_kategori'=>'required'
        // ]);

        $barangKategori = new BarangKategoriModel([
            'title' => $request->input('title'),
            'is_aktif' => $request->input('is_aktif'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $request->input('created_by')
        ]);
        $data = $barangKategori->save();

        if ($data) {
            return response()->json(['INSERT SUKSES'], 200);
        } else {
            return response()->json(['INSERT GAGAL'], 201);
        }
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'title'=>'required',
        //     'id_barang_kategori'=>'required',
        //     'is_aktif'=>'required'
        // ]);

        $update = [
            'title' => $request->title,
            'is_aktif' => $request->is_aktif,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $request->updated_by
        ];
        $data = BarangKategoriModel::where('id', $id)->update($update);
        if ($data) {
            return response()->json(['UPDATE SUKSES'], 200);
        } else {
            return response()->json(['UPDATE GAGAL'], 201);
        }
    }

    public function destroy($id)
    {
        $data = BarangKategoriModel::where('id', $id)->delete();
        if ($data) {
            return response()->json(['DELETE SUKSES'], 200);
        } else {
            return response()->json(['DELETE GAGAL'], 201);
        }
    }
}
