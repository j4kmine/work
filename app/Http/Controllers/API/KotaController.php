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

        $kota = KotaModel::where('id', '=', $id)->paginate(10);
        return response()->json([$kota], 200);
    }    

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'nama'=>'required',
        //     'id_negara'=>'required'
        // ]);
        
        $kota = new KotaModel([
            'nama' => $request->input('nama')
            ,'longitude' => $request->input('longitude')
            ,'latitude' => $request->input('latitude')
            ,'kode_pos' => $request->input('kode_pos')
            ,'id_negara' => $request->input('id_negara')
            ,'origin' => $request->input('origin')
            ,'U_DTD_GC_50' => $request->input('U_DTD_GC_50')
            ,'U_DTD_GC_100' => $request->input('U_DTD_GC_100')
            ,'U_DTD_GC_350' => $request->input('U_DTD_GC_350')
            ,'U_DTD_GC_500' => $request->input('U_DTD_GC_500')
            ,'U_DTD_GC_1000' => $request->input('U_DTD_GC_1000')
            ,'L_DTD_GC_LCL_2' => $request->input('L_DTD_GC_LCL_2')
            ,'L_DTD_GC_LCL_6' => $request->input('L_DTD_GC_LCL_6')
            ,'L_DTD_GC_LCL_10' => $request->input('L_DTD_GC_LCL_10')
            ,'L_DTD_GC_FCL_20ft' => $request->input('L_DTD_GC_FCL_20ft')
            ,'L_DTD_GC_FCL_40ft' => $request->input('L_DTD_GC_FCL_40ft')
            ,'U_DTP_GC_50' => $request->input('U_DTP_GC_50')
            ,'U_DTP_GC_100' => $request->input('U_DTP_GC_100')
            ,'U_DTP_GC_350' => $request->input('U_DTP_GC_350')
            ,'U_DTP_GC_500' => $request->input('U_DTP_GC_500')
            ,'U_DTP_GC_1000' => $request->input('U_DTP_GC_1000')
            ,'L_DTP_GC_LCL_2' => $request->input('L_DTP_GC_LCL_2')
            ,'L_DTP_GC_LCL_3' => $request->input('L_DTP_GC_LCL_3')
            ,'L_DTP_GC_LCL_4' => $request->input('L_DTP_GC_LCL_4')
            ,'L_DTP_GC_LCL_5' => $request->input('L_DTP_GC_LCL_5')
            ,'L_DTP_GC_LCL_6' => $request->input('L_DTP_GC_LCL_6')
            ,'L_DTP_GC_LCL_7' => $request->input('L_DTP_GC_LCL_7')
            ,'L_DTP_GC_LCL_8' => $request->input('L_DTP_GC_LCL_8')
            ,'L_DTP_GC_LCL_9' => $request->input('L_DTP_GC_LCL_9')
            ,'L_DTP_GC_LCL_10' => $request->input('L_DTP_GC_LCL_10')
            ,'L_DTP_GC_FCL_20ft' => $request->input('L_DTP_GC_FCL_20ft')
            ,'L_DTP_GC_FCL_40ft' => $request->input('L_DTP_GC_FCL_40ft')
            ,'u_layanan' => $request->input('u_layanan')
            ,'l_layanan' => $request->input('l_layanan')
            ,'created_at' => date('Y-m-d H:i:s')
            ,'created_by' => $request->input('created_by')
        ]);
        $data = $kota->save();
        if ($data) {
            return response()->json(['response' => $data,'message' => 'INSERT SUKSES'], 200);
        } else {
            return response()->json(['response' => $data,'message' => 'INSERT GAGAL'], 201);
        }
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'nama'=>'required',
        //     'id_negara'=>'required'
        // ]);
         
        $update = [
            'nama' => $request->nama
            ,'longitude' => $request->longitude
            ,'latitude' => $request->latitude
            ,'kode_pos' => $request->kode_pos
            ,'id_negara' => $request->id_negara
            ,'origin' => $request->origin
            ,'U_DTD_GC_50' => $request->U_DTD_GC_50
            ,'U_DTD_GC_100' => $request->U_DTD_GC_100
            ,'U_DTD_GC_350' => $request->U_DTD_GC_350
            ,'U_DTD_GC_500' => $request->U_DTD_GC_500
            ,'U_DTD_GC_1000' => $request->U_DTD_GC_1000
            ,'L_DTD_GC_LCL_2' => $request->L_DTD_GC_LCL_2
            ,'L_DTD_GC_LCL_6' => $request->L_DTD_GC_LCL_6
            ,'L_DTD_GC_LCL_10' => $request->L_DTD_GC_LCL_10
            ,'L_DTD_GC_FCL_20ft' => $request->L_DTD_GC_FCL_20ft
            ,'L_DTD_GC_FCL_40ft' => $request->L_DTD_GC_FCL_40ft
            ,'U_DTP_GC_50' => $request->U_DTP_GC_50
            ,'U_DTP_GC_100' => $request->U_DTP_GC_100
            ,'U_DTP_GC_350' => $request->U_DTP_GC_350
            ,'U_DTP_GC_500' => $request->U_DTP_GC_500
            ,'U_DTP_GC_1000' => $request->U_DTP_GC_1000
            ,'L_DTP_GC_LCL_2' => $request->L_DTP_GC_LCL_2
            ,'L_DTP_GC_LCL_3' => $request->L_DTP_GC_LCL_3
            ,'L_DTP_GC_LCL_4' => $request->L_DTP_GC_LCL_4
            ,'L_DTP_GC_LCL_5' => $request->L_DTP_GC_LCL_5
            ,'L_DTP_GC_LCL_6' => $request->L_DTP_GC_LCL_6
            ,'L_DTP_GC_LCL_7' => $request->L_DTP_GC_LCL_7
            ,'L_DTP_GC_LCL_8' => $request->L_DTP_GC_LCL_8
            ,'L_DTP_GC_LCL_9' => $request->L_DTP_GC_LCL_9
            ,'L_DTP_GC_LCL_10' => $request->L_DTP_GC_LCL_10
            ,'L_DTP_GC_FCL_20ft' => $request->L_DTP_GC_FCL_20ft
            ,'L_DTP_GC_FCL_40ft' => $request->L_DTP_GC_FCL_40ft
            ,'u_layanan' => $request->u_layanan
            ,'l_layanan' => $request->l_layanan
            ,'updated_at' => date('Y-m-d H:i:s')
            ,'modified_by' => $request->modified_by
        ];
        $data = KotaModel::where('id',$id)->update($update);
        if ($data) {
            return response()->json(['response' => $data,'message' => 'UPDATE SUKSES'], 200);
        } else {
            return response()->json(['response' => $data,'message' => 'UPDATE GAGAL'], 201);
        } 
    }

    public function destroy($id)
    {
        $data = KotaModel::where('id',$id)->delete();
        if ($data) {
            return response()->json(['response' => $data,'message' => 'DELETE SUKSES'], 200);
        } else {
            return response()->json(['response' => $data,'message' => 'DELETE GAGAL'], 201);
        } 
    }
}