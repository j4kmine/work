<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\KotaModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class PriceController extends Controller
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
        //     'panjang' => 'required',
        //     'jenis' => 'required',
        //     'tipe_pengiriman' => 'required',
        //     'lebar' => 'required',
        //     'tinggi' => 'required',
        //     'destination' => 'required',
        //     'dimensi_compare' => 'required',
           
        // ]);
        $panjang = $request->panjang;
        $destination = $request->destination;
        $jenis = $request->jenis;
        $tipe_pengiriman = $request->tipe_pengiriman;
        $lebar = $request->lebar;
        $tinggi = $request->tinggi;
        $dimensi = $request->dimensi;
        $field = "";
        $harga = 0;
        $total = 0;   
        $fob = 0;
        if($tipe_pengiriman == 1){
            $dimensi_compare = ($panjang * $lebar * $tinggi) / 5000;
            if($dimensi_compare >= $dimensi){
                $dimensi =  $dimensi_compare;
            }
            if($jenis == 1){
                if($dimensi >= 50 && $dimensi < 100){
                    $field = "U_DTD_GC_50";
                }else if($dimensi >= 100 && $dimensi < 350){
                    $field = "U_DTD_GC_100";
                }else if($dimensi >= 350 &&  $dimensi < 500){
                    $field = "U_DTD_GC_350";
                }else if($dimensi >= 500 && $dimensi < 1000){
                    $field = "U_DTD_GC_500";
                }else if($dimensi >= 1000){
                    $field = "U_DTD_GC_1000";
                }
               
            }else{
               
                if($dimensi <= 50){
                    $field = "U_DTP_GC_50";
                }else if($dimensi <= 100){
                    $field = "U_DTP_GC_100";
                }else if($dimensi <= 350){
                    $field = "U_DTP_GC_350";
                }else if($dimensi <= 500){
                    $field = "U_DTP_GC_500";
                }else if($dimensi <= 1000){
                    $field = "U_DTD_GC_1000";
                }
                $fob = $dimensi* 3000;
                $fob = $fob + 4000000;
                     
            }
           
        }else if($tipe_pengiriman == 2){
            $dimensi_compare = ($panjang * $lebar * $tinggi) / 1000000;
            $dimensi =  $dimensi_compare;
            if ($jenis == 1) {
                if($dimensi < 6){
                    $field = "L_DTD_GC_LCL_2";
                }else if($dimensi < 10){
                    $field = "L_DTD_GC_LCL_6";
                }else if($dimensi >= 10){
                    $field = "L_DTD_GC_LCL_10";
                }
              
                    
            }else{
                $fob = 3000000;
                if($dimensi <= 2){
                    $field = "L_DTP_GC_LCL_2";
                }else if($dimensi  == 3){
                    $field = "L_DTP_GC_LCL_3";
                }else if($dimensi == 4){
                    $field = "L_DTP_GC_LCL_4";
                }else if($dimensi == 5){
                    $field = "L_DTP_GC_LCL_5";
                }else if($dimensi == 6){
                    $field = "L_DTP_GC_LCL_6";
                }else if($dimensi == 7){
                    $field = "L_DTP_GC_LCL_7";
                }else if($dimensi == 8){
                    $field = "L_DTP_GC_LCL_8";
                }else if($dimensi == 9){
                    $field = "L_DTP_GC_LCL_9";
                }else if($dimensi >= 10){
                    $field = "L_DTP_GC_LCL_10";
                }
                   
            }
        }
   
      
       
        $harga = KotaModel::select('*')->where('id', $destination)->first();
        if($harga->$field){
            $total =  $dimensi* $harga->$field + $fob;
            return response()->json(['harga' => $total], 200);
        }
      
    }
}