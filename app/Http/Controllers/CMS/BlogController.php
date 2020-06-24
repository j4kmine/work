<?php


namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use App\Models\ImagesModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
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
       
        $blog = BlogModel::where('title', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('cms.pages.blog.add');
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
            'summary'=>'required',
            'body'=>'required',
            'keyword'=>'required',
            'id_image'=>'required'
        ]);
        
        $blog = new BlogModel([
            'title' => $request->get('title'),
            'summary' => $request->get('summary'),
            'slug'=>strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->get('title')))),
            'body' => $request->get('body'),
            'keyword' => $request->get('keyword'),
            'url_youtube' => $request->get('url_youtube'),
            'id_image' => $request->get('id_image'),
        ]);
        $data = $blog->save();
       
        return redirect('/blog/create')->with('success', 'Success Input Data');
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
        $query = BlogModel::where($where)->first();
        $data['blog'] = $query;
        
        if($query->id_image != 0){
            $where = array('id' => $query->id_image);
            $data['image'] = ImagesModel::where($where)->first();
        }
      
      
        return view('cms.pages.blog.edit', $data);
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
            'slug'=>strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->get('title')))),
            'summary'=>'required',
            'body'=>'required',
            'keyword'=>'required',
            'id_image'=>'required'
        ]);
         
        $update = ['title' => $request->title, 'summary' => $request->summary,'url_youtube' => $request->url_youtube,  'body' => $request->body,'keyword' => $request->keyword,'id_image' => $request->id_image];
        BlogModel::where('id',$id)->update($update);
        return redirect('/blog/'.$id.'/edit')->with('success', 'Success Input Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        BlogModel::where('id',$id)->delete();
        return redirect('/blog')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        BlogModel::where('id',$id)->delete();
        return redirect('/blog')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                BlogModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}
}