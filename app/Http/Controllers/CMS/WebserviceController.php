<?php


namespace App\Http\Controllers\CMS;

use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NegaraModel;
use App\Models\OrderModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
class WebserviceController extends Controller
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
    public function getListNegara()
    {
        $get_data = array();
        parse_str($_SERVER['QUERY_STRING'], $get_data);
        // $get_data = $this->security->xss_clean($get_data);

        $arr = NegaraModel::select('id as id','nama as text')->Where('nama', 'like', '%' . Input::get('q') . '%')->paginate(10);
        
        header('Content-Type: application/json');
        echo json_encode( $arr );
    }
    public function getListOrder()
    {
        $get_data = array();
        parse_str($_SERVER['QUERY_STRING'], $get_data);
        // $get_data = $this->security->xss_clean($get_data);

        $arr = OrderModel::where('id', 'LIKE', '%' . isset($get_data['q'])?$get_data['q']:'' . '%');
       
        header('Content-Type: application/json');
        echo json_encode( $arr );
    }
}