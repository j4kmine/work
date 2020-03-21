<?php


namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImagesModel;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ImagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //
        $search = $request->input('search');
       
        $images = ImagesModel::where('title', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.images.index', compact('images'));
    }
    public function imagepopup(Request $request)
    {
        //
        $search = $request->input('search');
       
        $images = ImagesModel::where('title', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.images.popup', compact('images'));
    }
    public function listtinymce(Request $request)
    {
        $search = $request->input('search');
       
        $images = ImagesModel::where('title', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.images.listtinymce', compact('images'));
    }
    public function addimagepopup(){
        return view('cms.pages.images.addpopup');
    }
    
    public function create()
    {
        
        return view('cms.pages.images.add');
    }
    public function addimagepopuppost(Request $request){
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();

            request()->image->move(public_path('images'), $imageName);
            ImagesModel::create([
                'path' => $imageName,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return redirect('/imagepopup')->with('success', 'Success Input Data');
        }
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();

            request()->image->move(public_path('images'), $imageName);
            ImagesModel::create([
                'path' => $imageName,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return redirect('/image/create')->with('success', 'Success Input Data');
        }
        
    }
    public function destroy($id)
    {
        $image = ImagesModel::find($id)->delete();
        File::delete('image/'.$image);
        return redirect('/image')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        $image = ImagesModel::find($id)->first();
        File::delete('image/'.$image->path);
        $image = ImagesModel::find($id)->delete();
        return redirect('/image')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                $image = ImagesModel::where('id',$data)->first();
                File::delete('image/'.$image->path);
                $image = ImagesModel::where('id',$data)->delete();
              
			}
            echo "success";
		}else{
            echo "failed";
        }
	}
    public function edit($id)
    {
        //
        $where = array('id' => $id);
        $data['image'] = ImagesModel::where($where)->first();
      
        return view('cms.pages.images.edit', $data);
    }
    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
            ]);
        }
        if ($request->hasFile('image')) {
           
            $image = ImagesModel::find($id)->first();
            File::delete('images/'.$image->path);
            $imageName = time().'.'.request()->image->getClientOriginalExtension();

            request()->image->move(public_path('images'), $imageName);
            $update = [ 'path' => $imageName,'description' => $request->description, 'title' => $request->title];
        }else{
            $update = ['description' => $request->description, 'title' => $request->title];
        }
        ImagesModel::where('id',$id)->update($update);
        return redirect('/image/'.$id.'/edit')->with('success', 'Success Input Data');      
    }
}