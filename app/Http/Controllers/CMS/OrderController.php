<?php


namespace App\Http\Controllers\CMS;

use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\NegaraModel;
use App\Models\KotaModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
        $negara = NegaraModel::select()->get();
        $order = OrderModel::where('pengirim_nama', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        return view('cms.pages.order.index', compact(['order','negara']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['negara'] = NegaraModel::select()->get();
        $data['user'] = UserModel::select()->get();
        $data['tipe_pengiriman'] = array(
            array('id'=>'U_DTD_GC_50','nama'=>'tes'),
            array('id'=>'U_DTD_GC_100','nama'=>'tes'),
            array('id'=>'U_DTD_GC_350','nama'=>'tes'),
            array('id'=>'U_DTD_GC_500','nama'=>'tes'),
            array('id'=>'U_DTD_GC_1000','nama'=>'tes'),
            array('id'=>'L_DTD_GC_LCL_2','nama'=>'tes'),
            array('id'=>'L_DTD_GC_LCL_6','nama'=>'tes'),
            array('id'=>'L_DTD_GC_LCL_10','nama'=>'tes'),
            array('id'=>'L_DTD_GC_FCL_20ft','nama'=>'tes'),
            array('id'=>'L_DTD_GC_FCL_40ft','nama'=>'tes'),
            array('id'=>'U_DTP_GC_50','nama'=>'tes'),
            array('id'=>'U_DTP_GC_100','nama'=>'tes'),
            array('id'=>'U_DTP_GC_350','nama'=>'tes'),
            array('id'=>'U_DTP_GC_500','nama'=>'tes'),
            array('id'=>'U_DTP_GC_1000','nama'=>'tes'),
            array('id'=>'L_DTP_GC_LCL_2','nama'=>'tes'),
            array('id'=>'L_DTP_GC_LCL_3','nama'=>'tes'),
            array('id'=>'L_DTP_GC_LCL_4','nama'=>'tes'),
            array('id'=>'L_DTP_GC_LCL_5','nama'=>'tes'),
            array('id'=>'L_DTP_GC_LCL_6','nama'=>'tes'),
            array('id'=>'L_DTP_GC_LCL_7','nama'=>'tes'),
            array('id'=>'L_DTP_GC_LCL_8','nama'=>'tes'),
            array('id'=>'L_DTP_GC_LCL_9','nama'=>'tes'),
            array('id'=>'L_DTP_GC_LCL_10','nama'=>'tes'),
            array('id'=>'L_DTP_GC_FCL_20ft','nama'=>'tes'),
            array('id'=>'L_DTP_GC_FCL_40ft','nama'=>'tes'),
        );
        echo "<pre>";
        var_dump($data['tipe_pengiriman']);
        exit();
        return view('cms.pages.order.add', $data);
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
            'nama'=>'required',
            'id_negara'=>'required'
        ]);
        
        $Order = new OrderModel([
            'nama' => $request->get('nama')
            ,'longitude' => $request->get('longitude')
            ,'latitude' => $request->get('latitude')
            ,'kode_pos' => $request->get('kode_pos')
            ,'id_negara' => $request->get('id_negara')
            ,'origin' => $request->get('origin')
            ,'U_DTD_GC_50' => $request->get('U_DTD_GC_50')
            ,'U_DTD_GC_100' => $request->get('U_DTD_GC_100')
            ,'U_DTD_GC_350' => $request->get('U_DTD_GC_350')
            ,'U_DTD_GC_500' => $request->get('U_DTD_GC_500')
            ,'U_DTD_GC_1000' => $request->get('U_DTD_GC_1000')
            ,'L_DTD_GC_LCL_2' => $request->get('L_DTD_GC_LCL_2')
            ,'L_DTD_GC_LCL_6' => $request->get('L_DTD_GC_LCL_6')
            ,'L_DTD_GC_LCL_10' => $request->get('L_DTD_GC_LCL_10')
            ,'L_DTD_GC_FCL_20ft' => $request->get('L_DTD_GC_FCL_20ft')
            ,'L_DTD_GC_FCL_40ft' => $request->get('L_DTD_GC_FCL_40ft')
            ,'U_DTP_GC_50' => $request->get('U_DTP_GC_50')
            ,'U_DTP_GC_100' => $request->get('U_DTP_GC_100')
            ,'U_DTP_GC_350' => $request->get('U_DTP_GC_350')
            ,'U_DTP_GC_500' => $request->get('U_DTP_GC_500')
            ,'U_DTP_GC_1000' => $request->get('U_DTP_GC_1000')
            ,'L_DTP_GC_LCL_2' => $request->get('L_DTP_GC_LCL_2')
            ,'L_DTP_GC_LCL_3' => $request->get('L_DTP_GC_LCL_3')
            ,'L_DTP_GC_LCL_4' => $request->get('L_DTP_GC_LCL_4')
            ,'L_DTP_GC_LCL_5' => $request->get('L_DTP_GC_LCL_5')
            ,'L_DTP_GC_LCL_6' => $request->get('L_DTP_GC_LCL_6')
            ,'L_DTP_GC_LCL_7' => $request->get('L_DTP_GC_LCL_7')
            ,'L_DTP_GC_LCL_8' => $request->get('L_DTP_GC_LCL_8')
            ,'L_DTP_GC_LCL_9' => $request->get('L_DTP_GC_LCL_9')
            ,'L_DTP_GC_LCL_10' => $request->get('L_DTP_GC_LCL_10')
            ,'L_DTP_GC_FCL_20ft' => $request->get('L_DTP_GC_FCL_20ft')
            ,'L_DTP_GC_FCL_40ft' => $request->get('L_DTP_GC_FCL_40ft')
            ,'created_at' => date('Y-m-d H:i:s')
            ,'created_by' => Auth::user()->name
        ]);
        $data = $Order->save();
       
        return redirect('/Order/create')->with('success', 'Success Input Data');
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
        $data['Order'] = OrderModel::where($where)->first();
        $data['negara'] = NegaraModel::select()->get();
        
        return view('cms.pages.order.edit', $data);
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
            'nama'=>'required',
            'id_negara'=>'required'
        ]);
         
        $update = [
            'nama' => $request->nama
            ,'longitude' => $request->longitude
            ,'latitude' => $request->latitude
            ,'kode_pos' => $request->kode_pos
            ,'id_negara' => $request->id_negara
            ,'origin' => $request->origin
            ,'U_DTD_GC_50' => $request->U_DTD_GC_50
            ,'U_DTD_GC_100' => $request->U_DTD_GC_100
            ,'U_DTD_GC_350' => $request->U_DTD_GC_350
            ,'U_DTD_GC_500' => $request->U_DTD_GC_500
            ,'U_DTD_GC_1000' => $request->U_DTD_GC_1000
            ,'L_DTD_GC_LCL_2' => $request->L_DTD_GC_LCL_2
            ,'L_DTD_GC_LCL_6' => $request->L_DTD_GC_LCL_6
            ,'L_DTD_GC_LCL_10' => $request->L_DTD_GC_LCL_10
            ,'L_DTD_GC_FCL_20ft' => $request->L_DTD_GC_FCL_20ft
            ,'L_DTD_GC_FCL_40ft' => $request->L_DTD_GC_FCL_40ft
            ,'U_DTP_GC_50' => $request->U_DTP_GC_50
            ,'U_DTP_GC_100' => $request->U_DTP_GC_100
            ,'U_DTP_GC_350' => $request->U_DTP_GC_350
            ,'U_DTP_GC_500' => $request->U_DTP_GC_500
            ,'U_DTP_GC_1000' => $request->U_DTP_GC_1000
            ,'L_DTP_GC_LCL_2' => $request->L_DTP_GC_LCL_2
            ,'L_DTP_GC_LCL_3' => $request->L_DTP_GC_LCL_3
            ,'L_DTP_GC_LCL_4' => $request->L_DTP_GC_LCL_4
            ,'L_DTP_GC_LCL_5' => $request->L_DTP_GC_LCL_5
            ,'L_DTP_GC_LCL_6' => $request->L_DTP_GC_LCL_6
            ,'L_DTP_GC_LCL_7' => $request->L_DTP_GC_LCL_7
            ,'L_DTP_GC_LCL_8' => $request->L_DTP_GC_LCL_8
            ,'L_DTP_GC_LCL_9' => $request->L_DTP_GC_LCL_9
            ,'L_DTP_GC_LCL_10' => $request->L_DTP_GC_LCL_10
            ,'L_DTP_GC_FCL_20ft' => $request->L_DTP_GC_FCL_20ft
            ,'L_DTP_GC_FCL_40ft' => $request->L_DTP_GC_FCL_40ft
            ,'updated_at' => date('Y-m-d H:i:s')
            ,'modified_by' => Auth::user()->name
        ];
        OrderModel::where('id',$id)->update($update);
        return redirect('/Order/'.$id.'/edit')->with('success', 'Success Input Data');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        OrderModel::where('id',$id)->delete();
        return redirect('/Order')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
       
        OrderModel::where('id',$id)->delete();
        return redirect('/Order')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                OrderModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}

    public function import()
    {
        $data['negara'] = NegaraModel::select()->get();

        return view('cms.pages.order.import', $data);
    }

    public function importData(Request $request)
    {
        // $this->validate($request,[
        //     'import_file' => 'required|file|mimes:xls,xlsx|max:215'
        // ]);
        $this->validate($request,[
            'import_file' => 'required|file|mimes:xls,xlsx'
        ]);
        $path = $request->file('import_file')->getRealPath();

        Excel::filter('chunk')->load($path)->chunk(1000, function($results)
        {   
            if($results->count()){
                ini_set('max_execution_time', 360);
                foreach($results as $value)
                {
                    if (!is_null($value->id)) {
                        $arr[] = [
                                    'id' => $value->id    
                                    ,'nama' => $value->nama
                                    ,'longitude' => $value->longitude
                                    ,'latitude' => $value->latitude
                                    ,'kode_pos' => $value->kode_pos
                                    ,'id_negara' => $value->id_negara
                                    ,'origin' => $value->origin
                                    ,'U_DTD_GC_50' => $value->u_dtd_gc_50
                                    ,'U_DTD_GC_100' => $value->u_dtd_gc_100
                                    ,'U_DTD_GC_350' => $value->u_dtd_gc_350
                                    ,'U_DTD_GC_500' => $value->u_dtd_gc_500
                                    ,'U_DTD_GC_1000' => $value->u_dtd_gc_1000
                                    ,'L_DTD_GC_LCL_2' => $value->l_dtd_gc_lcl_2
                                    ,'L_DTD_GC_LCL_6' => $value->l_dtd_gc_lcl_6
                                    ,'L_DTD_GC_LCL_10' => $value->l_dtd_gc_lcl_10
                                    ,'L_DTD_GC_FCL_20ft' => $value->l_dtd_gc_fcl_20ft
                                    ,'L_DTD_GC_FCL_40ft' => $value->l_dtd_gc_fcl_40ft
                                    ,'U_DTP_GC_50' => $value->u_dtp_gc_50
                                    ,'U_DTP_GC_100' => $value->u_dtp_gc_100
                                    ,'U_DTP_GC_350' => $value->u_dtp_gc_350
                                    ,'U_DTP_GC_500' => $value->u_dtp_gc_500
                                    ,'U_DTP_GC_1000' => $value->u_dtp_gc_1000
                                    ,'L_DTP_GC_LCL_2' => $value->l_dtp_gc_lcl_2
                                    ,'L_DTP_GC_LCL_3' => $value->l_dtp_gc_lcl_3
                                    ,'L_DTP_GC_LCL_4' => $value->l_dtp_gc_lcl_4
                                    ,'L_DTP_GC_LCL_5' => $value->l_dtp_gc_lcl_5
                                    ,'L_DTP_GC_LCL_6' => $value->l_dtp_gc_lcl_6
                                    ,'L_DTP_GC_LCL_7' => $value->l_dtp_gc_lcl_7
                                    ,'L_DTP_GC_LCL_8' => $value->l_dtp_gc_lcl_8
                                    ,'L_DTP_GC_LCL_9' => $value->l_dtp_gc_lcl_9
                                    ,'L_DTP_GC_LCL_10' => $value->l_dtp_gc_lcl_10
                                    ,'L_DTP_GC_FCL_20ft' => $value->l_dtp_gc_fcl_20ft
                                    ,'L_DTP_GC_FCL_40ft' => $value->l_dtp_gc_fcl_40ft
                                    ,'created_at' => date('Y-m-d H:i:s')
                                    ,'created_by' => Auth::user()->name
                                ];
                    }
                }
                if(!empty($arr)){
                    OrderModel::insert($arr);
                }
            }
        });

        // $data = Excel::load($path)->get();
        // Excel::load($path, function($reader) {
        //     $data = $reader->get();
        //     echo "<pre>";
        //     var_dump($data);
        //     exit();
        //     if($data->count()){
        //         foreach ($data as $key => $value) {
        //             $arr[] = [
        //                         'nama' => $value->nama
        //                         ,'longitude' => $value->longitude
        //                         ,'latitude' => $value->latitude
        //                         ,'kode_pos' => $value->kode_pos
        //                         ,'id_negara' => $value->id_negara
        //                         ,'origin' => $value->origin
        //                         ,'U_DTD_GC_50' => $value->u_dtd_gc_50
        //                         ,'U_DTD_GC_100' => $value->u_dtd_gc_100
        //                         ,'U_DTD_GC_350' => $value->u_dtd_gc_350
        //                         ,'U_DTD_GC_500' => $value->u_dtd_gc_500
        //                         ,'U_DTD_GC_1000' => $value->u_dtd_gc_1000
        //                         ,'L_DTD_GC_LCL_2' => $value->l_dtd_gc_lcl_2
        //                         ,'L_DTD_GC_LCL_6' => $value->l_dtd_gc_lcl_6
        //                         ,'L_DTD_GC_LCL_10' => $value->l_dtd_gc_lcl_10
        //                         ,'L_DTD_GC_FCL_20ft' => $value->l_dtd_gc_fcl_20ft
        //                         ,'L_DTD_GC_FCL_40ft' => $value->l_dtd_gc_fcl_40ft
        //                         ,'U_DTP_GC_50' => $value->u_dtp_gc_50
        //                         ,'U_DTP_GC_100' => $value->u_dtp_gc_100
        //                         ,'U_DTP_GC_350' => $value->u_dtp_gc_350
        //                         ,'U_DTP_GC_500' => $value->u_dtp_gc_500
        //                         ,'U_DTP_GC_1000' => $value->u_dtp_gc_1000
        //                         ,'L_DTP_GC_LCL_2' => $value->l_dtp_gc_lcl_2
        //                         ,'L_DTP_GC_LCL_3' => $value->l_dtp_gc_lcl_3
        //                         ,'L_DTP_GC_LCL_4' => $value->l_dtp_gc_lcl_4
        //                         ,'L_DTP_GC_LCL_5' => $value->l_dtp_gc_lcl_5
        //                         ,'L_DTP_GC_LCL_6' => $value->l_dtp_gc_lcl_6
        //                         ,'L_DTP_GC_LCL_7' => $value->l_dtp_gc_lcl_7
        //                         ,'L_DTP_GC_LCL_8' => $value->l_dtp_gc_lcl_8
        //                         ,'L_DTP_GC_LCL_9' => $value->l_dtp_gc_lcl_9
        //                         ,'L_DTP_GC_LCL_10' => $value->l_dtp_gc_lcl_10
        //                         ,'L_DTP_GC_FCL_20ft' => $value->l_dtp_gc_fcl_20ft
        //                         ,'L_DTP_GC_FCL_40ft' => $value->l_dtp_gc_fcl_40ft
        //                         ,'created_at' => date('Y-m-d H:i:s')
        //                         ,'created_by' => Auth::user()->name
        //                     ];
        //         }
        //         if(!empty($arr)){
        //             OrderModel::insert($arr);
        //         }
        //     }
        // });
        return back()->with('success', 'Insert Record successfully.');
    }
}