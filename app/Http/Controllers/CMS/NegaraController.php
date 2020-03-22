<?php


namespace App\Http\Controllers\CMS;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NegaraModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class NegaraController extends Controller
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
       
        $negara = NegaraModel::where('nama', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.negara.index', compact('negara'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('cms.pages.negara.add');
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
            'lang'=>'required',
            'lat'=>'required',
            'base_harga_udara_document'=>'required',
            'harga_fcl20ft'=>'required',
            'harga_fcl40ft'=>'required',
            'harga_fcl40fthq'=>'required',
            'harga_bulk5kdwt'=>'required',
            'harga_bulk10kdwt'=>'required',
            'harga_bulk25kdwt'=>'required',
            'harga_bulk50kdwt'=>'required'
        ]);
        
        $negara = new NegaraModel([
            'nama' => $request->get('nama'),
            'lang' => $request->get('lang'),
            'lat' => $request->get('lat'),
            'base_harga_udara_document' => $request->get('base_harga_udara_document'),
            'harga_fcl20ft' => $request->get('harga_fcl20ft'),
            'harga_fcl40ft' => $request->get('harga_fcl40ft'),
            'harga_fcl40fthq' => $request->get('harga_fcl40fthq'),
            'harga_bulk5kdwt' => $request->get('harga_bulk5kdwt'),
            'harga_bulk10kdwt' => $request->get('harga_bulk10kdwt'),
            'harga_bulk25kdwt' => $request->get('harga_bulk25kdwt'),
            'harga_bulk50kdwt' => $request->get('harga_bulk50kdwt')

        ]);
        $data = $negara->save();
       
        return redirect('/negara/create')->with('success', 'Success Input Data');
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
        $data['negara'] = NegaraModel::where($where)->first();
      
        return view('cms.pages.negara.edit', $data);
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
            'lang'=>'required',
            'lat'=>'required',
            'base_harga_udara_document'=>'required',
            'harga_fcl20ft'=>'required',
            'harga_fcl40ft'=>'required',
            'harga_fcl40fthq'=>'required',
            'harga_bulk5kdwt'=>'required',
            'harga_bulk10kdwt'=>'required',
            'harga_bulk25kdwt'=>'required',
            'harga_bulk50kdwt'=>'required'
        ]);
         
        $update = [
                    'nama' => $request->nama, 
                    'lang' => $request->lang,
                    'lat' => $request->lat,
                    'base_harga_udara_document' => $request->base_harga_udara_document,
                    'harga_fcl20ft' => $request->harga_fcl20ft,
                    'harga_fcl40ft' => $request->harga_fcl40ft,
                    'harga_fcl40fthq' => $request->harga_fcl40fthq,
                    'harga_bulk5kdwt' => $request->harga_bulk5kdwt,
                    'harga_bulk10kdwt' => $request->harga_bulk10kdwt,
                    'harga_bulk25kdwt' => $request->harga_bulk25kdwt,
                    'harga_bulk50kdwt' => $request->harga_bulk50kdwt
                ];
        NegaraModel::where('id',$id)->update($update);
        return redirect('/negara/'.$id.'/edit')->with('success', 'Success Input Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        NegaraModel::where('id',$id)->delete();
        return redirect('/negara')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        NegaraModel::where('id',$id)->delete();
        return redirect('/negara')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                NegaraModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}

    public function import()
    {
        return view('cms.pages.negara.import');
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
                            'nama' => $value->nama, 
                            'lang' => $value->lang,
                            'lat' => $value->lat,
                            'base_harga_udara_document' => $value->base_harga_udara_document,
                            'harga_fcl20ft' => $value->harga_fcl20ft,
                            'harga_fcl40ft' => $value->harga_fcl40ft,
                            'harga_fcl40fthq' => $value->harga_fcl40fthq,
                            'harga_bulk5kdwt' => $value->harga_bulk5kdwt,
                            'harga_bulk10kdwt' => $value->harga_bulk10kdwt,
                            'harga_bulk25kdwt' => $value->harga_bulk25kdwt,
                            'harga_bulk50kdwt' => $value->harga_bulk50kdwt,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
            }

            if(!empty($arr)){
                NegaraModel::insert($arr);
            }
        }
        return back()->with('success', 'Insert Record successfully.');
    }
}