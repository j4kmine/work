<?php

namespace App\Http\Controllers\API;

use App\Models\TrackingModel;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrackingEmail;

class TrackingController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function listing(Request $request)
    {
        $id_order = $request->input('id_order');
        // $id_user = $request->input('id_user');
        $page = $request->input('page');

        $data = TrackingModel::where('id_order','=',$id_order)
        // ->where('id_user', 'like', '%' . $id_user . '%')
        ->orderBy('id', 'desc')
        ->paginate($page);
        
        foreach ($data as $key => $value) {
             $data[$key]->date_create = date('d F Y', strtotime($value->created_at ));
             $where = array('id' => $id_order);
             $data[$key]->order =  OrderModel::where($where)->first();
        }
        $response = [
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem()
            ],
            'data' => $data
        ];
        return response()->json([$response], 200);
    }

    public function detail(Request $request)
    {

        // $this->validate($request, [
        //     'title' => 'required'

        // ]);

        $id = $request->id;
        $id_order = $request->id_order;

        $where = [];
        if ($id != "") {
            $where['id'] = $id;
        }
        if ($id_order != "") {
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
            $data_email['tracking'] = [
                'id_order' => $request->input('id_order'),
                'keterangan' => $request->input('keterangan'),
                'flag' => $request->input('flag'),
                'status' => $request->input('status'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            ## get detail order
            $where = array('id' => $data_email['tracking']['id_order']);
            $data_email['order'] = OrderModel::where($where)->first();

            $send = Mail::to($data_email['order']->pengirim_email)->send(new TrackingEmail($data_email));
            // Mail::to("faturrachmandonny@gmail.com")->send(new TrackingEmail($data_email));
            if ($send) {
                return response()->json(["status_query" => $data, "status_mail" => $send, "email_tujuan" => $data_email['order']->pengirim_email, "message" => "INSERT SUKSES, KIRIM EMAIL SUKSES"], 200);
            } else {
                return response()->json(["status_query" => $data, "status_mail" => $send, "email_tujuan" => $data_email['order']->pengirim_email, "message" => "INSERT SUKSES, KIRIM EMAIL GAGAL"], 200);
            }
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
        // $data_email['tracking'] = [
        //     'id_order' => $request->input('id_order'),
        //     'keterangan' => $request->input('keterangan'),
        //     'flag' => $request->input('flag'),
        //     'status' => $request->input('status'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ];
        // $return = new TrackingEmail($data_email);
        // return response()->json([$return], 200);

        $update = [
            'id_order' => $request->input('id_order'),
            'keterangan' => $request->input('keterangan'),
            'flag' => $request->input('flag'),
            'status' => $request->input('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data = TrackingModel::where('id', $id)->update($update);
        if ($data) {
            $data_email['tracking'] = [
                'id_order' => $request->input('id_order'),
                'keterangan' => $request->input('keterangan'),
                'flag' => $request->input('flag'),
                'status' => $request->input('status'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            ## get detail order
            $where = array('id' => $data_email['tracking']['id_order']);
            $data_email['order'] = OrderModel::where($where)->first();

            $send = Mail::to($data_email['order']->pengirim_email)->send(new TrackingEmail($data_email));

            if ($send) {
                return response()->json(["status_query" => $data, "status_mail" => $send, "email_tujuan" => $data_email['order']->pengirim_email, "message" => "UPDATE SUKSES, KIRIM EMAIL SUKSES"], 200);
            } else {
                return response()->json(["status_query" => $data, "status_mail" => $send, "email_tujuan" => $data_email['order']->pengirim_email, "message" => "UPDATE SUKSES, KIRIM EMAIL GAGAL"], 200);
            }
        } else {
            return response()->json(["UPDATE GAGAL"], 200);
        }
    }

    public function destroy($id)
    {
        $query = TrackingModel::where('id', $id)->delete();
        if ($query) {
            return response()->json(["DELETE SUKSES"], 200);
        } else {
            return response()->json(["DELETE GAGAL"], 200);
        }
    }
}
