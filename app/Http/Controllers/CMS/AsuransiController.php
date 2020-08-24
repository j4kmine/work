<?php


namespace App\Http\Controllers\CMS;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AsuransiModel;
use App\Models\BarangJenisModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
class AsuransiController extends Controller
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
        $search = $request->input('search');
       
        $asuransi = AsuransiModel::where('title', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        $barangjenis = BarangJenisModel::select()->get();

        return view('cms.pages.asuransi.index', compact('asuransi','barangjenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['barangjenis'] = BarangJenisModel::select()->get();
        return view('cms.pages.asuransi.add', $data);
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
            'title'=>'required',
            'id_barang_jenis'=>'required',
            'is_aktif'=>'required',
            'rate'=>'required',
            'harga'=>'required'
        ]);
        
        $asuransi = new AsuransiModel([
            'title' => $request->get('title'),
            'id_jenis_barang' => $request->get('id_barang_jenis'),
            'is_aktif' => $request->get('is_aktif'),
            'rate' => $request->get('rate'),
            'harga' => $request->get('harga'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->name
        ]);
        $data = $asuransi->save();
       
        return redirect('/asuransi/create')->with('success', 'Success Input Data');
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
        $data['asuransi'] = AsuransiModel::where($where)->first();
        $data['barangjenis'] = BarangJenisModel::select()->get();
        return view('cms.pages.asuransi.edit', $data);
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
            'title'=>'required',
            'id_barang_jenis'=>'required',
            'is_aktif'=>'required',
            'rate'=>'required',
            'harga'=>'required'
        ]);
        
        $update = [
                    'title' => $request->title, 
                    'id_jenis_barang' => $request->id_barang_jenis,
                    'is_aktif' => $request->is_aktif,
                    'rate' => $request->rate,
                    'harga' => $request->harga,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => Auth::user()->name
                ];
        AsuransiModel::where('id',$id)->update($update);
        return redirect('/asuransi/'.$id.'/edit')->with('success', 'Success Input Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AsuransiModel::where('id',$id)->delete();
        return redirect('/asuransi')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        AsuransiModel::where('id',$id)->delete();
        return redirect('/asuransi')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                AsuransiModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}
}