<?php


namespace App\Http\Controllers\Frontend;
use App\Models\BlogModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ImagesModel;
class BlogController extends Controller
{
    public function index()
    {
        $blogs = BlogModel::paginate(9);
        foreach($blogs as $key=>$value){
            if($value->id_image != 0){
                $where = array('id' => $value->id_image);
                $blogs[$key]->imagesdetail = ImagesModel::where($where)->first();
            }
        }
      
        return view('frontend.pages.blog.index', compact('blogs'));
    }
    public function loadmore(){
        $blogs = BlogModel::paginate(9);
        foreach($blogs as $key=>$value){
            if($value->id_image != 0){
                $where = array('id' => $value->id_image);
                $blogs[$key]->imagesdetail = ImagesModel::where($where)->first();
            }
        }
      
        return view('frontend.pages.blog.loadmore', compact('blogs'));
    }
}