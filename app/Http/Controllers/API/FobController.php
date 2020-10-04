<?php

namespace App\Http\Controllers\API;

use App\Models\FobModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FobController extends Controller
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

        $id = $request->id;
        $data = FobModel::where('id', 'LIKE', '%' . $id . '%')->paginate(10);
        return response()->json([$data], 200);
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'title'=>'required',
        //     'id_barang_Package'=>'required'
        // ]);

        $Fob = new FobModel([
            'tipe_fob' => $request->input('tipe_fob'),
            'barang_umum' => $request->input('barang_umum'),
            'agriculture' => $request->input('agriculture'),
            'hewan_hidup' => $request->input('hewan_hidup'),
            'barang_mudah_terbakar' => $request->input('barang_mudah_terbakar'),
            'storage' => $request->input('storage'),
            'storage_agriculture' => $request->input('storage_agriculture'),
            'storage_hewan_hidup' => $request->input('storage_hewan_hidup'),
            'storage_barang_mudah_terbakar' => $request->input('storage_barang_mudah_terbakar'),
            'freaight_agriculture' => $request->input('freaight_agriculture'),
            'freaight_hewan_hidup' => $request->input('freaight_hewan_hidup'),
            'freaight_barang_mudah_terbakar' => $request->input('freaight_barang_mudah_terbakar'),
            'freaight' => $request->input('freaight'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $data = $Fob->save();

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
        //     'id_barang_Package'=>'required',
        //     'is_aktif'=>'required'
        // ]);

        $update = [
            'tipe_fob' => $request->tipe_fob,
            'barang_umum' => $request->barang_umum,
            'agriculture' => $request->agriculture,
            'hewan_hidup' => $request->hewan_hidup,
            'barang_mudah_terbakar' => $request->barang_mudah_terbakar,
            'storage' => $request->storage,
            'storage_agriculture' => $request->storage_agriculture,
            'storage_hewan_hidup' => $request->storage_hewan_hidup,
            'storage_barang_mudah_terbakar' => $request->storage_barang_mudah_terbakar,
            'freaight_agriculture' => $request->freaight_agriculture,
            'freaight_hewan_hidup' => $request->freaight_hewan_hidup,
            'freaight_barang_mudah_terbakar' => $request->freaight_barang_mudah_terbakar,
            'freaight' => $request->freaight,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data = FobModel::where('id', $id)->update($update);
        if ($data) {
            return response()->json(['UPDATE SUKSES'], 200);
        } else {
            return response()->json(['UPDATE GAGAL'], 201);
        }
    }

    public function destroy($id)
    {
        $data = FobModel::where('id', $id)->delete();
        if ($data) {
            return response()->json(['DELETE SUKSES'], 200);
        } else {
            return response()->json(['DELETE GAGAL'], 201);
        }
    }
}
