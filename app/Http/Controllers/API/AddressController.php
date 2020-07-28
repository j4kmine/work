<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\AddressModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class AddressController extends Controller
{
      /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
                    ])
                    ->paginate(10);
        return response()->json(['list' => $address], 200);
    }

    public function getAddressById(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $id = $request->id;

        $address = AddressModel::where('id', '=', $id)->paginate(10);
        return response()->json(['list' => $address], 200);
    }
}