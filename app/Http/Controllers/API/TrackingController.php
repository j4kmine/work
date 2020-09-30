<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\TrackingModel;
 use App\Models\OrderModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 use Illuminate\Support\Facades\Mail;
 class TrackingController extends Controller
{
      /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function detail(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $id = $request->id;
        $id_order = $request->id_order;

        $where = [];
        if($id != ""){
            $where['id'] = $id; 
        }
        if($id_order != "") {
            $where['id_order'] = $id_order;
        }
        $data = TrackingModel::where($where)->get();

        return response()->json([$data], 200);
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'id_order'=>'required',
        //     'keterangan'=>'required',
        //     'flag'=>'required',
        //     'status'=>'required'
        // ]);

        $tracking = new TrackingModel([
            'id_order' => $request->input('id_order'),
            'keterangan' => $request->input('keterangan'),
            'flag' => $request->input('flag'),
            'status' => $request->input('status'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $data = $tracking->save();
        if ($data) {
            // $data_email['tracking'] = [
            //     'id_order' => $request->input('id_order'),
            //     'keterangan' => $request->input('keterangan'),
            //     'flag' => $request->input('flag'),
            //     'status' => $request->input('status'),
            //     'created_at' => date('Y-m-d H:i:s')
            // ];
            // ## get detail order
            // $where = array('id' => $data_email['tracking']['id_order']);
            // $data_email['order'] = OrderModel::where($where)->first();
            // // echo "<pre>";var_dump($data_email['order']->pengirim_email);exit();

            // Mail::to($data_email['order']->pengirim_email)->send(new TrackingEmail($data_email));
            // // Mail::to("faturrachmandonny@gmail.com")->send(new TrackingEmail($data_email));

            return response()->json(["INSERT SUKSES"], 200);
        } else {
            return response()->json(["INSERT GAGAL"], 200);
        }
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'id_order'=>'required',
        //     'keterangan'=>'required',
        //     'flag'=>'required',
        //     'status'=>'required'
        // ]);
         
        $update = [
            'id_order' => $request->input('id_order'),
            'keterangan' => $request->input('keterangan'),
            'flag' => $request->input('flag'),
            'status' => $request->input('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data = TrackingModel::where('id',$id)->update($update);
        if ($data) {
            // $data_email['tracking'] = [
            //     'id_order' => $request->id_order, 
            //     'keterangan' => $request->keterangan,
            //     'flag' => $request->flag,
            //     'status' => $request->status,
            //     'updated_at' => date('Y-m-d H:i:s')
            // ];
            // ## get detail order
            // $where = array('id' => $data_email['tracking']['id_order']);
            // $data_email['order'] = OrderModel::where($where)->first();
            // // echo "<pre>";var_dump($data_email['order']->pengirim_email);exit();

            // Mail::to($data_email['order']->pengirim_email)->send(new TrackingEmail($data_email));
            // // Mail::to("faturrachmandonny@gmail.com")->send(new TrackingEmail($data_email));
            return response()->json(["UPDATE SUKSES"], 200);
        } else {
            return response()->json(["UPDATE GAGAL"], 200);
        } 
    }

    public function destroy($id)
    {
        $query = TrackingModel::where('id',$id)->delete();
        if($query){
            return response()->json(["DELETE SUKSES"], 200);
        } else {
            return response()->json(["DELETE GAGAL"], 200);
        }
    }
}