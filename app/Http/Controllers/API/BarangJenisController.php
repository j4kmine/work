<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\BarangJenisModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class BarangJenisController extends Controller
{
      /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByBarangKategori(Request $request)
    {
   
        $this->validate($request, [
            'id_barang_kategori' => 'required'
           
        ]);

        $id_barang_kategori = $request->id_barang_kategori;

        $address = BarangJenisModel::where('id_barang_kategori', '=', $id_barang_kategori)->paginate(10);
        return response()->json(['list' => $address], 200);
    }

    public function getDataById(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $id = $request->id;

        $address = BarangJenisModel::where('id', '=', $id)->paginate(10);
        return response()->json(['list' => $address], 200);
    }
}