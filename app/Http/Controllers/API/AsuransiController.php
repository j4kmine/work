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
   
        $this->validate($request, [
            'id_barang_jenis' => 'required'
           
        ]);

        $id_barang_jenis = $request->id_barang_jenis;

        $address = AsuransiModel::where('id_jenis_barang', '=', $id_barang_jenis)->paginate(10);
        return response()->json(['list' => $address], 200);
    }

    public function getDataById(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $id = $request->id;

        $address = AsuransiModel::where('id', '=', $id)->paginate(10);
        return response()->json(['list' => $address], 200);
    }
}