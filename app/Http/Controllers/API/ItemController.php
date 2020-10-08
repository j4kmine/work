<?php

namespace App\Http\Controllers\API;

use App\Models\ItemModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getItemById(Request $request)
    {

        // $this->validate($request, [
        //     'title' => 'required'

        // ]);

        $id = $request->id;

        $item = ItemModel::where('id', '=', $id)->paginate(10);
        return response()->json([$item], 200);
    }

    public function listing(Request $request)
    {
        $kategori = $request->input('kategori');
        $page = $request->input('page');

        $data = ItemModel::where('kategori', '=', $kategori)
            ->orderBy('id', 'desc')
            ->paginate($page);

        foreach ($data as $key => $value) {
            $data[$key]->date_create = date('d F Y', strtotime($value->created_at));
        }
        $response = [
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem()
            ],
            'data' => $data
        ];
        return response()->json([$response], 200);
    }

    public function select2(Request $request)
    {

        // $this->validate($request, [
        //     'id_kota' => 'required'

        // ]);

        $title = $request->input('q');
        $kategori = $request->input('kategori');

        $data = ItemModel::select('id as id', 'title as text', 'kategori')  
            ->where('title', 'like', '%' . $title . '%')
            ->where('kategori', '=', $kategori)
            ->get();

        return response()->json([$data], 200);
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'title'=>'required',
        //     'id_barang_Package'=>'required'
        // ]);

        $Fob = new ItemModel([
            'title' => $request->input('title'),
            'harga' => $request->input('harga'),
            'kategori' => $request->input('kategori'),
            'is_tampil' => $request->input('is_tampil'),
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
            'title' => $request->title,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'is_tampil' => $request->is_tampil,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data = ItemModel::where('id', $id)->update($update);
        if ($data) {
            return response()->json(['UPDATE SUKSES'], 200);
        } else {
            return response()->json(['UPDATE GAGAL'], 201);
        }
    }

    public function destroy($id)
    {
        $data = ItemModel::where('id', $id)->delete();
        if ($data) {
            return response()->json(['DELETE SUKSES'], 200);
        } else {
            return response()->json(['DELETE GAGAL'], 201);
        }
    }
}
