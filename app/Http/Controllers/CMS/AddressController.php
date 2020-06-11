<?php


namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use App\Models\UserModel;
use App\Models\NegaraModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AddressController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //
        $search = $request->input('search');
       
        $address = AddressModel::where('alamat', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.address.index', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $negara= NegaraModel::select()->get();
        return view('cms.pages.address.add', compact('negara'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id_user'=>'required',
            'company'=>'required',
            'no_hp'=>'required',
            'email'=>'required',
            'tipe_user'=>'required'
        ]);
        
        $address = new AddressModel([
            'id_user' => $request->get('id_user'),
            'company' => $request->get('company'),
            'no_hp' => $request->get('no_hp'),
            'email' => $request->get('email'),
            'tipe_user' => $request->get('tipe_user'),
            'catatan' => $request->get('catatan'),
            'id_kota' => $request->get('id_kota'),
            'id_negara' => $request->get('id_negara'),
            'kode_pos' => $request->get('kode_pos'),
            'alamat' => $request->get('alamat'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->name
        ]);
        $data = $address->save();
       
        return redirect('/address/create')->with('success', 'Success Input Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $where = array('id' => $id);
        // $data['address'] = AddressModel::where($where)->first();

        $data['address'] = AddressModel::join('users', 'address.id_user', '=', 'users.id')
                            ->join('kota', 'address.id_kota', '=', 'kota.id')
                            ->select('address.*', 'kota.nama as text_kota', 'users.name as text_user')  
                            ->where('address.id', '=', $id)
                            ->first();

        $data['negara'] = NegaraModel::select()->get();
      
        return view('cms.pages.address.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'id_user'=>'required',
            'company'=>'required',
            'no_hp'=>'required',
            'email'=>'required',
            'tipe_user'=>'required'
        ]);
         
        $update = [
            'id_user' => $request->id_user,
            'company' => $request->company,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'tipe_user' => $request->tipe_user,
            'catatan' => $request->catatan,
            'id_kota' => $request->id_kota,
            'id_negara' => $request->id_negara,
            'kode_pos' => $request->kode_pos,
            'alamat' => $request->alamat,
            'updated_at' => date('Y-m-d H:i:s'),
            'modified_by' => Auth::user()->name
        ];
        AddressModel::where('id',$id)->update($update);
        return redirect('/address/'.$id.'/edit')->with('success', 'Success Update Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        AddressModel::where('id',$id)->delete();
        return redirect('/address')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        AddressModel::where('id',$id)->delete();
        return redirect('/address')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                AddressModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}
}