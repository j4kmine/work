<?php


namespace App\Http\Controllers\CMS;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ItemModel;
use App\Models\OrderModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
class ItemController extends Controller
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
       
        $item = ItemModel::where('title', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.item.index', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('cms.pages.item.add');
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
            'harga'=>'required',
            'kategori'=>'required',
            'is_tampil'=>'required'
        ]);
        
        $item = new ItemModel([
            'title' => $request->get('title'),
            'harga' => $request->get('harga'),
            'kategori' => $request->get('kategori'),
            'is_tampil' => $request->get('is_tampil'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $data = $item->save();
       
        return redirect('/item/create')->with('success', 'Success Input Data');
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
        $data['item'] = ItemModel::where($where)->first();
      
   
        return view('cms.pages.item.edit', $data);
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
            'harga'=>'required',
            'kategori'=>'required',
            'is_tampil'=>'required'
        ]);
        
         
        $update = [
                    'title' => $request->title, 
                    'harga' => $request->harga,
                    'kategori' => $request->kategori,
                    'is_tampil' => $request->is_tampil,
                    'updated_at' => date('Y-m-d H:i:s'),
                  
                ];
        ItemModel::where('id',$id)->update($update);
        return redirect('/item/'.$id.'/edit')->with('success', 'Success Input Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        ItemModel::where('id',$id)->delete();
        return redirect('/item')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        ItemModel::where('id',$id)->delete();
        return redirect('/item')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                ItemModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}
}