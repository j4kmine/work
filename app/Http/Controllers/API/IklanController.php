<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\IklanModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class IklanController extends Controller
{
      /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listing()
    {
        $data = IklanModel::paginate(10);

        return response()->json([$data], 200);
    }

    public function getIklanById(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $id = $request->id;
        $id_image = $request->id_image;

        $where = [];
        if ($id != "") {
            $where['id'] = $id;
        }
        if ($id_image != "") {
            $where['id_image'] = $id_image;
        }

        $iklan = IklanModel::where($where)->paginate(10);

        return response()->json([$iklan], 200);
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'id_user'=>'required',
        //     'nama'=>'required',
        //     'company'=>'required',
        //     'no_hp'=>'required',
        //     'email'=>'required',
        //     'tipe_user'=>'required'
        // ]);

        $iklan = new IklanModel([
            'nama' => $request->input('nama'),
            'lokasi' => $request->input('lokasi'),
            'id_image' => $request->input('id_image')
        ]);
        $data = $iklan->save();
        if($data){
            return response()->json(['INSERT SUKSES'], 200);
        } else {
            return response()->json(['INSERT GAGAL'], 201);
        }
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'id_user'=>'required',
        //     'nama'=>'required',
        //     'company'=>'required',
        //     'no_hp'=>'required',
        //     'email'=>'required',
        //     'tipe_user'=>'required'
        // ]);
         
        $update = [
            'nama' => $request->input('nama'),
            'lokasi' => $request->input('lokasi'),
            'id_image' => $request->input('id_image')
        ];
        $data = IklanModel::where('id',$id)->update($update);
        if($data){
            return response()->json(['UPDATE SUKSES'], 200);
        } else {
            return response()->json(['UPDATE GAGAL'], 201);
        }   
    }

    public function destroy($id)
    {
        $query = IklanModel::where('id',$id)->delete();
        if($query){
            return response()->json(['DELETE SUKSES'], 200);
        } else {
            return response()->json(['DELETE GAGAL'], 201);
        }   
    }
}