<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\KotaModel;
 use App\Models\NegaraModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class KotaController extends Controller
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
        //     'id_kota' => 'required'
           
        // ]);
        $conditional = "";
        $id_kota = $request->id_kota;
        $nama_kota = $request->nama_kota;
        $id_negara = $request->id_negara;
        $nama_negara = $request->nama_negara;
        if ($id_kota != null) {
            $conditional .= "AND kota.id = '".$id_kota."' ";
        }
        if ($nama_kota != null) {
            $conditional .= "AND kota.nama LIKE '%".$nama_kota."%' ";
        }
        if ($id_negara != null) {
            $conditional .= "AND kota.id_negara = '".$id_negara."' ";
        }
        if ($nama_negara != null) {
            $conditional .= "AND negara.nama LIKE '%".$nama_negara."%' ";
        }
        
        $kotaQuery = KotaModel::join('negara', 'kota.id_negara', '=', 'negara.id')
                        ->select('kota.*', 'negara.nama as nama_negara')  
                        ->whereRaw("1=1  ".$conditional." ")
                        ->paginate(10);
        return response()->json(['list' => $kotaQuery], 200);
    }
}