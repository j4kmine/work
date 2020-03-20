<?php


namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KotaModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Excel;
class KotaController extends Controller
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
       
        $kota = KotaModel::where('nama', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.kota.index', compact('kota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('cms.pages.kota.add');
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
            'nama'=>'required',
            'id_negara'=>'required',
            'kode_pos'=>'required',
            'lang'=>'required',
            'lat'=>'required'
        ]);
        
        $kota = new KotaModel([
            'nama' => $request->get('nama'),
            'id_negara' => $request->get('id_negara'),
            'kode_pos' => $request->get('kode_pos'),
            'lang' => $request->get('lang'),
            'lat' => $request->get('lat')
        ]);
        $data = $kota->save();
       
        return redirect('/kota/create')->with('success', 'Success Input Data');
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
        $data['kota'] = KotaModel::where($where)->first();
      
        return view('cms.pages.kota.edit', $data);
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
            'nama'=>'required',
            'id_negara'=>'required',
            'kode_pos'=>'required',
            'lang'=>'required',
            'lat'=>'required'
        ]);
         
        $update = ['nama' => $request->nama, 'id_negara' => $request->id_negara, 'kode_pos' => $request->kode_pos,'lang' => $request->lang,'lat' => $request->lat];
        KotaModel::where('id',$id)->update($update);
        return redirect('/kota/'.$id.'/edit')->with('success', 'Success Input Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        KotaModel::where('id',$id)->delete();
        return redirect('/kota')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        KotaModel::where('id',$id)->delete();
        return redirect('/kota')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                KotaModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}

    public function import()
    {
        var_dump('expression');
        die();
        return view('cms.pages.kota.import');
    }

    public function importData(Request $request)
    {
        var_dump('expression');
        $request->validate([
            'import_file' => 'required'
        ]);
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = ['title' => $value->title, 'description' => $value->description];
            }
            if(!empty($arr)){
                Data::insert($arr);
            }
        }
        return back()->with('success', 'Insert Record successfully.');
    }
}