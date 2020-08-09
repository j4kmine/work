<?php


namespace App\Http\Controllers\CMS;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BarangPackageModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
class BarangPackageController extends Controller
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
       
        $barangpackage = BarangPackageModel::where('title', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.barangpackage.index', compact('barangpackage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('cms.pages.barangpackage.add');
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
        
        $barangpackage = new BarangPackageModel([
            'title' => $request->get('title'),
            'is_aktif' => $request->get('is_aktif'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->name
        ]);
        $data = $barangpackage->save();
       
        return redirect('/barangpackage/create')->with('success', 'Success Input Data');
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
        $data['barangpackage'] = BarangPackageModel::where($where)->first();
      
   
        return view('cms.pages.barangpackage.edit', $data);
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
        BarangPackageModel::where('id',$id)->update($update);
        return redirect('/barangpackage/'.$id.'/edit')->with('success', 'Success Input Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BarangPackageModel::where('id',$id)->delete();
        return redirect('/barangpackage')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        BarangPackageModel::where('id',$id)->delete();
        return redirect('/barangpackage')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                BarangPackageModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}
}