<?php


namespace App\Http\Controllers\Frontend;
use App\Models\BlogModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ImagesModel;
class BlogController extends Controller
{
    public function index()
    {
        $blogs = BlogModel::orderBy('id', 'DESC')->where('url_youtube','=',"")->paginate(9);
        $youtube = BlogModel::orderBy('id', 'DESC')->where('url_youtube','!=',"")->paginate(9);
        foreach($blogs as $key=>$value){
            if($value->id_image != 0){
                $where = array('id' => $value->id_image);
                $blogs[$key]->imagesdetail = ImagesModel::where($where)->first();
            }
        }
        foreach($youtube as $key=>$value){
            if($value->id_image != 0){
                $where = array('id' => $value->id_image);
                $youtube[$key]->imagesdetail = ImagesModel::where($where)->first();
            }
        }
     
      
        return view('frontend.pages.blog.index', compact('blogs','youtube'));
    }
    public function loadmore(Request $request){
        
        $blogs = BlogModel::orderBy('id', 'DESC')->where('id', '<', $request->get('current_value'))->paginate(9);
        foreach($blogs as $key=>$value){
            if($value->id_image != 0){
                $where = array('id' => $value->id_image);
                $blogs[$key]->imagesdetail = ImagesModel::where($where)->first();
            }
        }
      
        return view('frontend.pages.blog.loadmore', compact('blogs'));
    }
    public  function read($slug="-",$id="-"){
        $blogs['blogs'] = BlogModel::orderBy('id', 'DESC')->where([
            ['slug', '=', $slug],
            ['id', '=', $id]
        ])->first();
        if( $blogs['blogs']->id_image != 0){
            $where = array('id' =>  $blogs['blogs']->id_image);
             $blogs['blogs']->imagesdetail = ImagesModel::where($where)->first();
        }
        $blogs['lainnya'] = BlogModel::orderBy('id', 'DESC')->where('url_youtube','=',"")->paginate(2);
        if(isset( $blogs['lainnya']) && count( $blogs['lainnya'])>0){
            foreach($blogs['lainnya'] as $key=>$value){
                if($value->id_image != 0){
                    $where = array('id' => $value->id_image);
                    $blogs['lainnya'][$key]->imagesdetail = ImagesModel::where($where)->first();
                }
            }
        }
      
        return view('frontend.pages.blog.read', compact('blogs'));
    }
}