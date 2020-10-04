<?php

namespace App\Http\Controllers\API;

use App\Models\AddressModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 use App\Models\KotaModel;
 use App\Models\NegaraModel;
class AddressController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listing()
    {
        $data = AddressModel::paginate(10);
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

    public function getAddressByUser(Request $request)
    {

        // $this->validate($request, [
        //     'title' => 'required'

        // ]);

        $id_user = $request->id_user;
        $tipe_user = $request->tipe_user;

        $address = AddressModel::where([
            ['id_user', '=', $id_user],
            ['tipe_user', '=', $tipe_user]
        ])->paginate(10);
        return response()->json([$address], 200);
    }

    public function getAddressById(Request $request,$id)
    {

        // $this->validate($request, [
        //     'title' => 'required'

        // ]);

        // $id = $request->id;

        $address = AddressModel::where('id', '=', $id)->first();
      
        if(isset($address->id_kota) && $address->id_kota != 0){
              $where = array('id' => $address->id_kota);
              $address['kota'] =  KotaModel::where($where)->first();
        }
        if(isset($address->id_negara) && $address->id_negara != 0){
             $where = array('id' => $address->id_negara);
              $address['negara'] = NegaraModel::where($where)->first();
        }
       
        return response()->json(['list' => $address], 200);
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

        $address = new AddressModel([
            'id_user' => $request->input('id_user'),
            'nama' => $request->input('nama'),
            'company' => $request->input('company'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'tipe_user' => $request->input('tipe_user'),
            'catatan' => $request->input('catatan'),
            'id_kota' => $request->input('id_kota'),
            'id_negara' => $request->input('id_negara'),
            'kode_pos' => $request->input('kode_pos'),
            'alamat' => $request->input('alamat'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $request->input('created_by')
        ]);
        $data = $address->save();
        if ($data) {
            return response()->json(['INSERT SUKSES'], 200);
        } else {
            return response()->json(['INSERT GAGAL'], 200);
        }
    }

    public function update(Request $request)
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
            'id_user' => $request->input('id_user'),
            'nama' => $request->input('nama'),
            'company' => $request->input('company'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'tipe_user' => $request->input('tipe_user'),
            'catatan' => $request->input('catatan'),
            'id_kota' => $request->input('id_kota'),
            'id_negara' => $request->input('id_negara'),
            'kode_pos' => $request->input('kode_pos'),
            'alamat' => $request->input('alamat'),
            'updated_at' => date('Y-m-d H:i:s'),
            'modified_by' => $request->input('modified_by')
        ];
        $data = AddressModel::where('id', $request->input('id'))->update($update);
        if ($data) {
            return response()->json(['UPDATE SUKSES'], 200);
        } else {
            return response()->json(['UPDATE GAGAL'], 201);
        }
    }

    public function destroy($id)
    {
        $query = AddressModel::where('id', $id)->delete();
        if ($query) {
            return response()->json(['DELETE SUKSES'], 200);
        } else {
            return response()->json(['DELETE GAGAL'], 200);
        }
    }
}
