<?php


namespace App\Http\Controllers\Frontend;
use App\Models\BlogModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ImagesModel;
class HomeController extends Controller
{
    public function index()
    {
        $blogs = BlogModel::where('url_youtube','=',NULL)->paginate(3);
        // echo "<pre>";var_dump($blogs);exit();
        foreach($blogs as $key=>$value){
            if($value->id_image != 0){
                $where = array('id' => $value->id_image);
                $blogs[$key]->imagesdetail = ImagesModel::where($where)->first();
            }
        }
      
        return view('frontend.pages.home.index', compact('blogs'));
    }

    public function layanan()
    { 
        $blogs = BlogModel::where('url_youtube','=',NULL)->paginate(3);
        return view('frontend.pages.layanan.index', compact('blogs'));
    }

    public function ketentuan()
    { 
        $blogs = BlogModel::where('url_youtube','=',NULL)->paginate(3);
        return view('frontend.pages.ketentuan.index', compact('blogs'));
    }

    public function panduan()
    { 
        $blogs = BlogModel::where('url_youtube','=',NULL)->paginate(3);
        return view('frontend.pages.panduan.index', compact('blogs'));
    }
}
