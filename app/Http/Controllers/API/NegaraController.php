<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\NegaraModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class NegaraController extends Controller
{
      /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
   
    public function index(Request $request)
    {
        $search = $request->input('search');
       
        $negara = NegaraModel::where('nama', 'LIKE', '%' . $search . '%')->paginate(10);
        
        return response()->json([$negara], 200);
    }  

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'nama'=>'required',
        //     'id_negara'=>'required'
        // ]);
        
        $negara = new NegaraModel([
            'nama' => $request->input('nama'),
            'longitude' => $request->input('longitude'),
            'latitude' => $request->input('latitude'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $request->input('created_by')
        ]);
        $data = $negara->save();
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
            'nama' => $request->nama, 
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'modified_at' => date('Y-m-d H:i:s'),
            'modified_by' => $request->modified_by
        ];
        $data = NegaraModel::where('id',$id)->update($update);
        if ($data) {
            return response()->json(['response' => $data,'message' => 'UPDATE SUKSES'], 200);
        } else {
            return response()->json(['response' => $data,'message' => 'UPDATE GAGAL'], 201);
        } 
    }

    public function destroy($id)
    {
        $data = NegaraModel::where('id',$id)->delete();
        if ($data) {
            return response()->json(['response' => $data,'message' => 'DELETE SUKSES'], 200);
        } else {
            return response()->json(['response' => $data,'message' => 'DELETE GAGAL'], 201);
        } 
    }
}