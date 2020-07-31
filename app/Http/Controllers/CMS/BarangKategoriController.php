<?php


namespace App\Http\Controllers\CMS;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BarangKategoriModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
class BarangKategoriController extends Controller
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
       
        $barangkategori = BarangKategoriModel::where('title', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.barangkategori.index', compact('barangkategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('cms.pages.barangkategori.add');
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
            'title'=>'required'
        ]);
        
        $barangkategori = new BarangKategoriModel([
            'title' => $request->get('title'),
            'is_aktif' => $request->get('is_aktif'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->name
        ]);
        $data = $barangkategori->save();
       
        return redirect('/barangkategori/create')->with('success', 'Success Input Data');
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
        $data['barangkategori'] = BarangKategoriModel::where($where)->first();
      
   
        return view('cms.pages.barangkategori.edit', $data);
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
            'title'=>'required'
        ]);
        
        $update = [
                    'title' => $request->title,
                    'is_aktif' => $request->is_aktif,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => Auth::user()->name
                ];
        BarangKategoriModel::where('id',$id)->update($update);
        return redirect('/barangkategori/'.$id.'/edit')->with('success', 'Success Input Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BarangKategoriModel::where('id',$id)->delete();
        return redirect('/barangkategori')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        BarangKategoriModel::where('id',$id)->delete();
        return redirect('/barangkategori')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                BarangKategoriModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}
}