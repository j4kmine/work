<?php
 
 namespace App\Http\Controllers\API;
 
 use App\Models\KotaModel;
 use App\Models\FobModel;
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
    public function cekongkirnew(Request $request){
        $tipe_cargo = $request->tipe_cargo;
        $category_cargo =  $request->category_cargo;
        $tipe_pengiriman = $request->tipe_pengiriman;
        $tipe_delivery = $request->tipe_delivery;
        $lebar = $request->lebar;
        $tinggi = $request->tinggi;
        $dimensi = $request->dimensi;
        $dimensi2 = 0;
        $panjang = $request->panjang;
        $destination = $request->destination;
        $qty_container = $request->qty_container;
        $fob = 0;
        $barang_umum =0;
       
        if ($tipe_pengiriman == 1) {
            if($tipe_delivery == 1){
               
                $dimensi_compare = ($panjang * $lebar * $tinggi) / 5000;
                if($dimensi_compare >= $dimensi){
                    $dimensi =  $dimensi_compare;
                    $dimensi2 =  $dimensi_compare;
                }else{
                    $dimensi2 = $dimensi;
                }
                if($dimensi2 >= 100 && $dimensi2 < 350){
                    $field2 = "U_DTP_GC_100";
                }else if($dimensi2 >= 350 &&  $dimensi2 < 500){
                    $field2 = "U_DTP_GC_350";
                }else if($dimensi2 >= 500 && $dimensi2 < 1000){
                    $field2 = "U_DTP_GC_500";
                }else if($dimensi2 >= 1000){
                    $field2 = "U_DTP_GC_1000";
                }else{
                    // DTD
                }
            }else{

            }
          
        }else if($tipe_pengiriman == 2){
            if($tipe_delivery == 1){
                $dimensi_compare = ($panjang * $lebar * $tinggi) / 5000;
                if($dimensi_compare >= $dimensi){
                    $dimensi =  $dimensi_compare;
                    $dimensi2 =  $dimensi_compare;
                }else{
                    $dimensi2 = $dimensi;
                }
                if($dimensi2 <= 2){
                    $field2 = "L_DTP_GC_LCL_2";
                }else if($dimensi2  == 3){
                    $field2 = "L_DTP_GC_LCL_3";
                }else if($dimensi2 == 4){
                    $field2 = "L_DTP_GC_LCL_4";
                }else if($dimensi2 == 5){
                    $field2 = "L_DTP_GC_LCL_5";
                }else if($dimensi2 == 6){
                    $field2 = "L_DTP_GC_LCL_6";
                }else if($dimensi2 == 7){
                    $field2 = "L_DTP_GC_LCL_7";
                }else if($dimensi2 == 8){
                    $field2 = "L_DTP_GC_LCL_8";
                }else if($dimensi2 == 9){
                    $field2 = "L_DTP_GC_LCL_9";
                }else if($dimensi2 >= 10){
                    $field2 = "L_DTP_GC_LCL_10";
                }else{
                    //kurang dari 2 cbm
                }
            }else{
                 // DTD
            }
            
        }
       
        $harga = KotaModel::select('*')->where('id', $destination)->first();
        if ($tipe_delivery == 1) {
            $fob = FobModel::select('*')->where('tipe_fob', 1)->first();
            if($tipe_pengiriman == 1){
                $fob = $fob->barang_umum;
            }else if($tipe_pengiriman == 2){
                $fob = $fob->agriculture;
            }else if($tipe_pengiriman == 3){
                $fob = $fob->hewan_hidup;
            }else if($tipe_pengiriman == 4){
                $fob = $fob->barang_mudah_terbakar;
            }
        }
        
       
        if ($harga->$field2) {
            $dimensi2 =  $dimensi2* $harga->$field2 + $fob;
        }
    }
    public function cekongkir(Request $request){
        $panjang = $request->panjang;
        $destination = $request->destination;
        $jenis = $request->jenis;
        $tipe_pengiriman = $request->tipe_pengiriman;
        $lebar = $request->lebar;
        $tinggi = $request->tinggi;
        $dimensi = $request->dimensi;
        $dimensi2 = 0;
        $field = "";
        $field2 = "";
        $harga = 0;
        $total = 0;   
        $fob = 0;
        
        if($tipe_pengiriman == 1){
              
        
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
                if($dimensi2 >= 50 && $dimensi2 < 100){
                    $field2 = "U_DTP_GC_50";
                }else if($dimensi2 >= 100 && $dimensi2 < 350){
                    $field2 = "U_DTP_GC_100";
                }else if($dimensi2 >= 350 &&  $dimensi2 < 500){
                    $field2 = "U_DTP_GC_350";
                }else if($dimensi2 >= 500 && $dimensi2 < 1000){
                    $field2 = "U_DTP_GC_500";
                }else if($dimensi2 >= 1000){
                    $field2 = "U_DTP_GC_1000";
                }
                $fob = $dimensi2* 3000;
                $fob = $fob + 4000000;
                $harga = KotaModel::select('*')->where('id', $destination)->first();
                if ($harga->$field) {
                    $dimensi =  $dimensi* $harga->$field;
                }
                if ($harga->$field2) {
                    $dimensi2 =  $dimensi2* $harga->$field2 + $fob;
                }
                if($dimensi != 0 && $dimensi2 != 0){
                    
                    $total = array('door_to_port'=>$dimensi2,'door_to_door'=>$dimensi,'weight'=>$request->dimensi,'volume'=> $dimensi_compare);
                    return response()->json(['paket' => $total], 200);
                }
                     
        
           
        }else if($tipe_pengiriman == 2){
            $dimensi_compare = ($panjang * $lebar * $tinggi) / 1000000;
            $dimensi =  $dimensi_compare;
            $dimensi2 =  $dimensi_compare;
        
       
            if($dimensi < 6){
                $field = "L_DTD_GC_LCL_2";
            }else if($dimensi < 10){
                $field = "L_DTD_GC_LCL_6";
            }else if($dimensi >= 10){
                $field = "L_DTD_GC_LCL_10";
            }

            
            $fob = 3000000;
            if($dimensi <= 2){
                $field2 = "L_DTP_GC_LCL_2";
            }else if($dimensi  == 3){
                $field2 = "L_DTP_GC_LCL_3";
            }else if($dimensi == 4){
                $field2 = "L_DTP_GC_LCL_4";
            }else if($dimensi == 5){
                $field2 = "L_DTP_GC_LCL_5";
            }else if($dimensi == 6){
                $field2 = "L_DTP_GC_LCL_6";
            }else if($dimensi == 7){
                $field2 = "L_DTP_GC_LCL_7";
            }else if($dimensi == 8){
                $field2 = "L_DTP_GC_LCL_8";
            }else if($dimensi == 9){
                $field2 = "L_DTP_GC_LCL_9";
            }else if($dimensi >= 10){
                $field2 = "L_DTP_GC_LCL_10";
            }
            $harga = KotaModel::select('*')->where('id', $destination)->first(); 
            if ($harga->$field) {
                $dimensi =  $dimensi* $harga->$field;
            }
            if ($harga->$field2) {
                $dimensi2 =  $dimensi2* $harga->$field2 + $fob;
            }
            if($dimensi != 0 && $dimensi2 != 0){
                $total = array('door_to_port'=>$dimensi2,'door_to_door'=>$dimensi,'weight'=>$request->dimensi,'volume'=> $dimensi_compare);
                return response()->json(['paket' => $total], 200);
            }     
            
        }
    }
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
               
                if($dimensi >= 50 && $dimensi < 100){
                    $field = "U_DTP_GC_50";
                }else if($dimensi >= 100 && $dimensi < 350){
                    $field = "U_DTP_GC_100";
                }else if($dimensi >= 350 &&  $dimensi < 500){
                    $field = "U_DTP_GC_350";
                }else if($dimensi >= 500 && $dimensi < 1000){
                    $field = "U_DTP_GC_500";
                }else if($dimensi >= 1000){
                    $field = "U_DTP_GC_1000";
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