<?php


namespace App\Http\Controllers\CMS;

use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KotaModel;
use App\Models\NegaraModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $negara= NegaraModel::select()->get();
        $kota = KotaModel::where('nama', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.kota.index', compact(['kota','negara']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['negara'] = NegaraModel::select()->get();
        return view('cms.pages.kota.add', $data);
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
        $data['negara'] = NegaraModel::select()->get();
        
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
        $data['negara'] = NegaraModel::select()->get();

        return view('cms.pages.kota.import', $data);
    }

    public function importData(Request $request)
    {
        $this->validate($request,[
            'import_file' => 'required|mimes:xls'
        ]);
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = [
                            'nama' => $value->nama
                            ,'kode_pos' => $value->kode_pos
                            ,'lang' => $value->lang
                            ,'lat' => $value->lat
                            ,'id_negara' => $value->id_negara
                            ,'created_at' => date('Y-m-d H:i:s')
                        ];
            }
            if(!empty($arr)){
                KotaModel::insert($arr);
            }
        }
        return back()->with('success', 'Insert Record successfully.');
    }
}