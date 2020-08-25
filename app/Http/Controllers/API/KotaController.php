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
        $nama = $request->input('q');
     
        $kotaQuery = KotaModel::join('negara', 'kota.id_negara', '=', 'negara.id')
                        ->select('kota.*', 'kota.nama as text')  
                        ->where('kota.nama', 'like', '%' . $nama . '%')
                        ->orWhere('negara.nama', 'like', '%' . $nama . '%')
                        ->paginate(10);
                      
        return response()->json([$kotaQuery], 200);
    }
   
    public function getKota(Request $request)
    {
   
        // $this->validate($request, [
        //     'id_kota' => 'required'
           
        // ]);
        $conditional = "";
        $id = $request->input('id');
        $kotaQuery = KotaModel::join('negara', 'kota.id_negara', '=', 'negara.id')
                        ->select('kota.*', 'kota.nama as text')  
                        ->where('kota.id', '=', $id)
                        ->first();

        return response()->json([$kotaQuery], 200);
    } 

    public function getDataById(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $id = $request->id;

        $address = KotaModel::where('id', '=', $id)->paginate(10);
        return response()->json(['list' => $address], 200);
    }    
}