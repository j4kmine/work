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
        $nama = $request->nama;
        
        $kotaQuery = KotaModel::join('negara', 'kota.id_negara', '=', 'negara.id')
                        ->select('kota.*', 'negara.nama as nama_negara')  
                        ->where('kota.nama', 'like', '%' . $nama . '%')
                        ->orWhere('negara.nama', 'like', '%' . $nama . '%')
                        ->paginate(10);
        return response()->json(['list' => $kotaQuery], 200);
    }
}