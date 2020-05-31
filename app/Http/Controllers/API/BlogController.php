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
        $blog = BlogModel::where('title', 'LIKE', '%' . $title . '%')->get();
        return response()->json(['list' => $blog], 200);
    }
}