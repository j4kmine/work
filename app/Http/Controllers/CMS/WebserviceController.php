<?php


namespace App\Http\Controllers\CMS;

use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NegaraModel;
use App\Models\OrderModel;
use App\Models\UserModel;
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

        $arr = OrderModel::select('id as id','id_user')->Where('id', 'like', '%' . Input::get('q') . '%')->paginate(10);
        $arra = array();
        foreach($arr as $key=>$value){
            if($value->id_user != 0){
                $where = array('id' => $value->id_user);
                $arr[$key]->user = UserModel::where($where)->first();
            }
        }
        foreach($arr as $keyz=>$valuez){
            $arra[$key]['id'] = $valuez->id;
            $arra[$key]['text'] = $valuez->id." / ".$valuez->user->name;
        }
     
        header('Content-Type: application/json');
        echo json_encode( $arra );
    }
}