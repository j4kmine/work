<?php


namespace App\Http\Controllers\CMS;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BarangJenisModel;
use App\Models\BarangKategoriModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
class BarangJenisController extends Controller
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
       
        $barangjenis = BarangJenisModel::where('title', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        $barangkategori = BarangKategoriModel::select()->get();

        return view('cms.pages.barangjenis.index', compact('barangjenis','barangkategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['barangkategori'] = BarangKategoriModel::select()->get();
        return view('cms.pages.barangjenis.add', $data);
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
            'id_barang_kategori'=>'required'
        ]);
        
        $barangjenis = new BarangJenisModel([
            'title' => $request->get('title'),
            'id_barang_kategori' => $request->get('id_barang_kategori'),
            'is_aktif' => $request->get('is_aktif'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->name
        ]);
        $data = $barangjenis->save();
       
        return redirect('/barangjenis/create')->with('success', 'Success Input Data');
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
        $data['barangjenis'] = BarangJenisModel::where($where)->first();
        $data['barangkategori'] = BarangKategoriModel::select()->get();
        return view('cms.pages.barangjenis.edit', $data);
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
            'id_barang_kategori'=>'required',
            'is_aktif'=>'required'
        ]);
        
         
        $update = [
                    'title' => $request->title, 
                    'id_barang_kategori' => $request->id_barang_kategori,
                    'is_aktif' => $request->is_aktif,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => Auth::user()->name
                ];
        BarangJenisModel::where('id',$id)->update($update);
        return redirect('/barangjenis/'.$id.'/edit')->with('success', 'Success Input Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BarangJenisModel::where('id',$id)->delete();
        return redirect('/barangjenis')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        BarangJenisModel::where('id',$id)->delete();
        return redirect('/barangjenis')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                BarangJenisModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}
}