<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\AsuransiModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class AsuransiController extends Controller
{
      /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByBarangJenis(Request $request)
    {
   
        // $this->validate($request, [
        //     'id_barang_jenis' => 'required'
           
        // ]);

        $id_barang_jenis = $request->id_barang_jenis;

        $data = AsuransiModel::where('id_jenis_barang', '=', $id_barang_jenis)->paginate(10);
        return response()->json([$data], 200);
    }

    public function getDataById(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $id = $request->id;

        $data = AsuransiModel::where('id', '=', $id)->paginate(10);
        return response()->json([$data], 200);
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'title'=>'required',
        //     'id_barang_jenis'=>'required',
        //     'is_aktif'=>'required',
        //     'rate'=>'required',
        //     'harga'=>'required'
        // ]);
        
        $asuransi = new AsuransiModel([
            'title' => $request->input('title'),
            'id_jenis_barang' => $request->input('id_barang_jenis'),
            'is_aktif' => $request->input('is_aktif'),
            'rate' => $request->input('rate'),
            'harga' => $request->input('harga'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $request->input('created_by')
        ]);
        $data = $asuransi->save();
       
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
        //     'id_barang_jenis'=>'required',
        //     'is_aktif'=>'required',
        //     'rate'=>'required',
        //     'harga'=>'required'
        // ]);
        
        $update = [
                    'title' => $request->title, 
                    'id_jenis_barang' => $request->id_barang_jenis,
                    'is_aktif' => $request->is_aktif,
                    'rate' => $request->rate,
                    'harga' => $request->harga,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $request->updated_by
                ];
        $data = AsuransiModel::where('id',$id)->update($update);
        if ($data) {
            return response()->json(['UPDATE SUKSES'], 200);
        } else {
            return response()->json(['UPDATE GAGAL'], 201);
        }
    }

    public function destroy($id)
    {
        $data = AsuransiModel::where('id',$id)->delete();
        if ($data) {
            return response()->json(['DELETE SUKSES'], 200);
        } else {
            return response()->json(['DELETE GAGAL'], 201);
        }
    }
}