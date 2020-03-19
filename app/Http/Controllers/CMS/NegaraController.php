<?php


namespace App\Http\Controllers\CMS;

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
       
        $Negara = NegaraModel::where('nama', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.Negara.index', compact('Negara'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('cms.pages.Negara.add');
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
        
        $Negara = new NegaraModel([
            'nama' => $request->get('nama'),
            'id_negara' => $request->get('id_negara'),
            'kode_pos' => $request->get('kode_pos'),
            'lang' => $request->get('lang'),
            'lat' => $request->get('lat')
        ]);
        $data = $Negara->save();
       
        return redirect('/Negara/create')->with('success', 'Success Input Data');
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
        $data['Negara'] = NegaraModel::where($where)->first();
      
        return view('cms.pages.Negara.edit', $data);
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
        NegaraModel::where('id',$id)->update($update);
        return redirect('/Negara/'.$id.'/edit')->with('success', 'Success Input Data');      
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
        return redirect('/Negara')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        NegaraModel::where('id',$id)->delete();
        return redirect('/Negara')->with('success', 'Deleted Successfully');
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
}