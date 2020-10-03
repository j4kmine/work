<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\BlogModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class BlogController extends Controller
{
      /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $title = $request->title;
        $blog = BlogModel::where('title', 'LIKE', '%' . $title . '%')->paginate(10);
        return response()->json([$blog], 200);
    }

    public function listing()
    {
        $data = BlogModel::paginate(10);

        return response()->json([$data], 200);
    }

    public function detail(Request $request)
    {
   
        // $this->validate($request, [
        //     'title' => 'required'
           
        // ]);

        $id = $request->id;

        $where = [];
        if ($id != "") {
            $where['id'] = $id;
        }

        $query = BlogModel::where($where)->paginate(10);

        return response()->json([$query], 200);
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'id_user'=>'required',
        //     'nama'=>'required',
        //     'company'=>'required',
        //     'no_hp'=>'required',
        //     'email'=>'required',
        //     'tipe_user'=>'required'
        // ]);
        
        $query = new BlogModel([
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'body' => $request->input('body'),
            'keyword' => $request->input('keyword'),
            'id_image' => $request->input('id_image'),
            'url_youtube' => $request->input('url_youtube'),
            'slug' => $request->input('slug')
        ]);
        $data = $query->save();
        if($data){
            return response()->json(['INSERT SUKSES'], 200);
        } else {
            return response()->json(['INSERT GAGAL'], 201);
        }
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'id_user'=>'required',
        //     'nama'=>'required',
        //     'company'=>'required',
        //     'no_hp'=>'required',
        //     'email'=>'required',
        //     'tipe_user'=>'required'
        // ]);
         
        $update = [
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'body' => $request->input('body'),
            'keyword' => $request->input('keyword'),
            'id_image' => $request->input('id_image'),
            'url_youtube' => $request->input('url_youtube'),
            'slug' => $request->input('slug')
        ];
        $data = BlogModel::where('id',$id)->update($update);
        if($data){
            return response()->json(['UPDATE SUKSES'], 200);
        } else {
            return response()->json(['UPDATE GAGAL'], 201);
        }   
    }

    public function destroy($id)
    {
        $query = BlogModel::where('id',$id)->delete();
        if($query){
            return response()->json(['DELETE SUKSES'], 200);
        } else {
            return response()->json(['DELETE GAGAL'], 201);
        }   
    }
}