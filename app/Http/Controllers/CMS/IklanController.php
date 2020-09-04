<?php


namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IklanModel;
use App\Models\ImagesModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class IklanController extends Controller
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
       
        $iklan = IklanModel::where('nama', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.iklan.index', compact('iklan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('cms.pages.iklan.add');
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
            'lokasi'=>'required',
            'id_image'=>'required'
        ]);
        
        $iklan = new IklanModel([
            'nama' => $request->get('nama'),
            'lokasi' => $request->get('lokasi'),
            'id_image' => $request->get('id_image'),
        ]);
        $data = $iklan->save();
       
        return redirect('/iklan/create')->with('success', 'Success Input Data');
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
        $query = IklanModel::where($where)->first();
        $data['iklan'] = $query;
        
        if($query->id_image != 0){
            $where = array('id' => $query->id_image);
            $data['image'] = ImagesModel::where($where)->first();
        }
      
      
        return view('cms.pages.iklan.edit', $data);
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
            'lokasi'=>'required',
            'id_image'=>'required'
        ]);
         
        $update = ['nama' => $request->nama, 'lokasi' => $request->lokasi,'id_image' => $request->id_image];
        IklanModel::where('id',$id)->update($update);
        return redirect('/iklan/'.$id.'/edit')->with('success', 'Success Input Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        IklanModel::where('id',$id)->delete();
        return redirect('/iklan')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        IklanModel::where('id',$id)->delete();
        return redirect('/iklan')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                IklanModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}
}