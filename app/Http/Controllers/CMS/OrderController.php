<?php


namespace App\Http\Controllers\CMS;

use Excel;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

use App\Models\OrderModel;
use App\Models\NegaraModel;
use App\Models\KotaModel;
use App\Models\UserModel;
use App\Models\ItemModel;
use App\Models\RelitemModel;
use App\Models\ReladdonsModel;
use App\Models\BarangKategoriModel;
use App\Models\BarangPackageModel;
use App\Models\AsuransiModel;
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

        $jenis_pengiriman = config('global.jenis_pengiriman');
        $status_order = config('global.status_order');

        return view('cms.pages.order.index', compact(['order','negara','jenis_pengiriman','status_order']));
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
        $data['item'] = ItemModel::select()->get();
        $data['barangkategori'] = BarangKategoriModel::select()->get();
        $data['barangpackage'] = BarangPackageModel::select()->get();
        $data['asuransi'] = AsuransiModel::select()->get();

        $data['via_pengiriman'] = config('global.via_pengiriman');

        $data['jenis_pengiriman'] = config('global.jenis_pengiriman');

        $data['tipe_pengiriman'] = config('global.tipe_pengiriman');

        $data['status_order'] = config('global.status_order');

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
            'kota_tujuan' => 'required'
            ,'qty_container' => 'required'
            ,'pengirim_nama' => 'required'
            ,'pengirim_negara' => 'required'
            ,'pengirim_kodepos' => 'required'
            ,'pengirim_kota' => 'required'
            ,'pengirim_alamat' => 'required'
            ,'pengirim_perusahaan' => 'required'
            ,'pengirim_telepon' => 'required'
            ,'pengirim_email' => 'required'
            ,'pengirim_koleksi_intruksi' => 'required'
            ,'penerima_nama' => 'required'
            ,'penerima_negara' => 'required'
            ,'penerima_kodepos' => 'required'
            ,'penerima_kota' => 'required'
            ,'penerima_alamat' => 'required'
            ,'penerima_perusahaan' => 'required'
            ,'penerima_telepon' => 'required'
            ,'penerima_email' => 'required'
            ,'referensi_customer' => 'required'
            ,'layanan_tambahan' => 'required'
            ,'total_harga' => 'required'
            ,'total_approved' => 'required'
            ,'status' => 'required'
            ,'tanggal_order' => 'required'
            ,'tanggal_kirim' => 'required'
        ]);

        $deskripsi = $request->get('deskripsi');
        $harga = $request->get('harga');
        $panjang = $request->get('panjang');
        $lebar = $request->get('lebar');
        $tinggi = $request->get('tinggi');
        $berat = $request->get('berat');
        $qty_barang = $request->get('qty_barang');
        $barang_package = $request->get('barang_package');
        $data_rel_item = array();

        if (count($harga) > 0) {
            for ($i=0; $i < count($harga); $i++) { 
                $data_rel_item[$i]['deskripsi'] = $deskripsi[$i];
                $data_rel_item[$i]['harga'] = $harga[$i];
                $data_rel_item[$i]['panjang'] = $panjang[$i];
                $data_rel_item[$i]['lebar'] = $lebar[$i];
                $data_rel_item[$i]['tinggi'] = $tinggi[$i];
                $data_rel_item[$i]['berat'] = $berat[$i];
                $data_rel_item[$i]['qty_barang'] = $qty_barang[$i];
                $data_rel_item[$i]['barang_package'] = $barang_package[$i];
            }
        }

        ## add ons
        $id_item = $request->get('id_item');
        $title = $request->get('title');
        $jumlah = $request->get('jumlah');
        $satuan = $request->get('satuan');
        $harga_satuan = $request->get('harga_satuan');
        $harga_total = $request->get('harga_total');
        $data_rel_addons = array();

        if (count($harga_total) > 0) {
            for ($i=0; $i < count($harga_total); $i++) { 
                $data_rel_addons[$i]['id_item'] = $id_item[$i];
                $data_rel_addons[$i]['title'] = $title[$i];
                $data_rel_addons[$i]['jumlah'] = $jumlah[$i];
                $data_rel_addons[$i]['satuan'] = $satuan[$i];
                $data_rel_addons[$i]['harga_satuan'] = $harga_satuan[$i];
                $data_rel_addons[$i]['harga_total'] = $harga_total[$i];
            }
        }

        $order = new OrderModel([
            'id_user' => $request->get('id_user')
            ,'kota_asal' => '16417'
            ,'kota_tujuan' => $request->get('kota_tujuan')

            ,'id_via_pengiriman' => $request->get('via_pengiriman')
            ,'id_jenis_pengiriman' => $request->get('jenis_pengiriman')
            ,'id_tipe_pengiriman' => $request->get('tipe_pengiriman')

            ,'id_barang_kategori' => $request->get('barang_kategori')
            ,'id_barang_jenis' => $request->get('barang_jenis')
            
            ,'qty_container' => $request->get('qty_container')
            ,'id_asuransi' => $request->get('asuransi')

            ,'pengirim_nama' => $request->get('pengirim_nama')
            ,'pengirim_negara' => $request->get('pengirim_negara')
            ,'pengirim_kodepos' => $request->get('pengirim_kodepos')
            ,'pengirim_kota' => $request->get('pengirim_kota')
            ,'pengirim_alamat' => $request->get('pengirim_alamat')
            ,'pengirim_perusahaan' => $request->get('pengirim_perusahaan')
            ,'pengirim_telepon' => $request->get('pengirim_telepon')
            ,'pengirim_email' => $request->get('pengirim_email')
            ,'pengirim_koleksi_intruksi' => $request->get('pengirim_koleksi_intruksi')

            ,'penerima_nama' => $request->get('penerima_nama')
            ,'penerima_negara' => $request->get('penerima_negara')
            ,'penerima_kodepos' => $request->get('penerima_kodepos')
            ,'penerima_kota' => $request->get('penerima_kota')
            ,'penerima_alamat' => $request->get('penerima_alamat')
            ,'penerima_perusahaan' => $request->get('penerima_perusahaan')
            ,'penerima_telepon' => $request->get('penerima_telepon')
            ,'penerima_email' => $request->get('penerima_email')
            ,'referensi_customer' => $request->get('referensi_customer')

            ,'layanan_tambahan' => $request->get('layanan_tambahan')
            ,'total_harga' => $request->get('total_harga_semua')
            ,'total_approved' => $request->get('total_approved')
            ,'status' => $request->get('status')
            ,'tanggal_order' => date('Y-m-d H:i:s',strtotime($request->get('tanggal_order')))
            ,'tanggal_kirim' => date('Y-m-d H:i:s',strtotime($request->get('tanggal_kirim')))

            ,'created_at' => date('Y-m-d H:i:s')
            ,'created_by' => Auth::user()->name
        ]);
        $data = $order->save();

        if ($data) {
            if (count($data_rel_item) > 0) {
                foreach ($data_rel_item as $key => $value) {
                    $relitem = new RelitemModel([
                        'id_order' => $order->id
                        ,'harga' => $value['harga']
                        ,'deskripsi' => $value['deskripsi']
                        ,'panjang' => $value['panjang']
                        ,'lebar' => $value['lebar']
                        ,'tinggi' => $value['tinggi']
                        ,'berat' => $value['berat']
                        ,'created_at' => date('Y-m-d H:i:s')
                        ,'created_by' => Auth::user()->name
                        ,'qty_barang' => $value['qty_barang']
                        ,'id_package_barang' => $value['barang_package']
                    ]);
                    $datarelitem = $relitem->save();
                }
            }

            if (count($data_rel_addons) > 0) {
                foreach ($data_rel_addons as $key => $value) {
                    $reladdons = new ReladdonsModel([
                        'id_order' => $order->id
                        ,'id_item' => $value['id_item']
                        ,'title' => $value['title']
                        ,'jumlah' => $value['jumlah']
                        ,'satuan' => $value['satuan']
                        ,'harga_satuan' => $value['harga_satuan']
                        ,'harga_total' => $value['harga_total']
                        ,'created_at' => date('Y-m-d H:i:s')
                        ,'created_by' => Auth::user()->name
                    ]);
                    $datareladdons = $reladdons->save();
                }
            }
        }
        return redirect('/order/create')->with('success', 'Success Input Data');
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
        $where = array('id' => $id);
        $data['order'] = OrderModel::where($where)->first();
        $where2 = array('id_order' => $id);
        $data['rel_item'] = RelitemModel::where($where2)->get();
        $where3 = array('id_order' => $id);
        $data['rel_addons'] = ReladdonsModel::where($where3)->get();
        
        $data['negara'] = NegaraModel::select()->get();
        $data['user'] = UserModel::select()->get();
        $data['item'] = ItemModel::select()->get();
        $data['barangkategori'] = BarangKategoriModel::select()->get();
        $data['barangpackage'] = BarangPackageModel::select()->get();
        $data['asuransi'] = AsuransiModel::select()->get();
        
        $data['via_pengiriman'] = config('global.via_pengiriman');

        $data['jenis_pengiriman'] = config('global.jenis_pengiriman');

        $data['tipe_pengiriman'] = config('global.tipe_pengiriman');

        $data['status_order'] = config('global.status_order');

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
            'kota_tujuan' => 'required'
            ,'qty_container' => 'required'
            ,'pengirim_nama' => 'required'
            ,'pengirim_negara' => 'required'
            ,'pengirim_kodepos' => 'required'
            ,'pengirim_kota' => 'required'
            ,'pengirim_alamat' => 'required'
            ,'pengirim_perusahaan' => 'required'
            ,'pengirim_telepon' => 'required'
            ,'pengirim_email' => 'required'
            ,'pengirim_koleksi_intruksi' => 'required'
            ,'penerima_nama' => 'required'
            ,'penerima_negara' => 'required'
            ,'penerima_kodepos' => 'required'
            ,'penerima_kota' => 'required'
            ,'penerima_alamat' => 'required'
            ,'penerima_perusahaan' => 'required'
            ,'penerima_telepon' => 'required'
            ,'penerima_email' => 'required'
            ,'referensi_customer' => 'required'
            ,'layanan_tambahan' => 'required'
            ,'total_harga' => 'required'
            ,'total_approved' => 'required'
            ,'status' => 'required'
            ,'tanggal_order' => 'required'
            ,'tanggal_kirim' => 'required'
        ]);

        $deskripsi = $request->deskripsi;
        $harga = $request->harga;
        $panjang = $request->panjang;
        $lebar = $request->lebar;
        $tinggi = $request->tinggi;
        $berat = $request->berat;
        $qty_barang = $request->qty_barang;
        $barang_package = $request->barang_package;
        $id_rel_item = $request->id_rel_item;
        $data_rel_item = array();

        if (count($harga) > 0) {
            for ($i=0; $i < count($harga); $i++) { 
                $data_rel_item[$i]['id'] = $id_rel_item[$i];
                $data_rel_item[$i]['deskripsi'] = $deskripsi[$i];
                $data_rel_item[$i]['harga'] = $harga[$i];
                $data_rel_item[$i]['panjang'] = $panjang[$i];
                $data_rel_item[$i]['lebar'] = $lebar[$i];
                $data_rel_item[$i]['tinggi'] = $tinggi[$i];
                $data_rel_item[$i]['berat'] = $berat[$i];
                $data_rel_item[$i]['qty_barang'] = $qty_barang[$i];
                $data_rel_item[$i]['id_package_barang'] = $barang_package[$i];
            }
        }

        ## cari id rel item yang dihapus
        $id_rel_item1 = $id_rel_item;
        $where2 = array('id_order' => $id);
        $id_rel_item2 = RelitemModel::where($where2)->pluck('id')->toArray();

        $list_id_relitem_diff = array_diff($id_rel_item1, $id_rel_item2);
        if (empty($list_id_relitem_diff)) {
            $list_id_relitem_diff = array_diff($id_rel_item2, $id_rel_item1);
        }

        ## add ons
        $id_item = $request->id_item;
        $title = $request->title;
        $jumlah = $request->jumlah;
        $satuan = $request->satuan;
        $harga_satuan = $request->harga_satuan;
        $harga_total = $request->harga_total;
        $id_rel_addons = $request->id_rel_addons;
        $data_rel_addons = array();

        if (count($harga_total) > 0) {
            for ($i=0; $i < count($harga_total); $i++) { 
                $data_rel_addons[$i]['id'] = $id_rel_addons[$i];
                $data_rel_addons[$i]['id_item'] = $id_item[$i];
                $data_rel_addons[$i]['title'] = $title[$i];
                $data_rel_addons[$i]['jumlah'] = $jumlah[$i];
                $data_rel_addons[$i]['satuan'] = $satuan[$i];
                $data_rel_addons[$i]['harga_satuan'] = $harga_satuan[$i];
                $data_rel_addons[$i]['harga_total'] = $harga_total[$i];
            }
        }
        // echo "<pre>";var_dump($data_rel_addons);exit();
        ## cari id rel addons yang dihapus
        $id_rel_addons1 = $id_rel_addons;
        $where2 = array('id_order' => $id);
        $id_rel_addons2 = ReladdonsModel::where($where2)->pluck('id')->toArray();

        $list_id_reladdons_diff = array_diff($id_rel_addons1, $id_rel_addons2);
        if (empty($list_id_reladdons_diff)) {
            $list_id_reladdons_diff = array_diff($id_rel_addons2, $id_rel_addons1);
        }

        $update = [
            'id_user' => $request->id_user
            ,'kota_asal' => '16417'
            ,'kota_tujuan' => $request->kota_tujuan

            ,'id_via_pengiriman' => $request->via_pengiriman
            ,'id_jenis_pengiriman' => $request->jenis_pengiriman
            ,'id_tipe_pengiriman' => $request->tipe_pengiriman

            ,'id_barang_kategori' => $request->barang_kategori
            ,'id_barang_jenis' => $request->barang_jenis

            ,'qty_container' => $request->qty_container
            ,'id_asuransi' => $request->asuransi

            ,'pengirim_nama' => $request->pengirim_nama
            ,'pengirim_negara' => $request->pengirim_negara
            ,'pengirim_kodepos' => $request->pengirim_kodepos
            ,'pengirim_kota' => $request->pengirim_kota
            ,'pengirim_alamat' => $request->pengirim_alamat
            ,'pengirim_perusahaan' => $request->pengirim_perusahaan
            ,'pengirim_telepon' => $request->pengirim_telepon
            ,'pengirim_email' => $request->pengirim_email
            ,'pengirim_koleksi_intruksi' => $request->pengirim_koleksi_intruksi

            ,'penerima_nama' => $request->penerima_nama
            ,'penerima_negara' => $request->penerima_negara
            ,'penerima_kodepos' => $request->penerima_kodepos
            ,'penerima_kota' => $request->penerima_kota
            ,'penerima_alamat' => $request->penerima_alamat
            ,'penerima_perusahaan' => $request->penerima_perusahaan
            ,'penerima_telepon' => $request->penerima_telepon
            ,'penerima_email' => $request->penerima_email
            ,'referensi_customer' => $request->referensi_customer

            ,'layanan_tambahan' => $request->layanan_tambahan
            ,'total_harga' => $request->total_harga_semua
            ,'total_approved' => $request->total_approved
            ,'status' => $request->status
            ,'tanggal_order' => date('Y-m-d H:i:s',strtotime($request->tanggal_order))
            ,'tanggal_kirim' => date('Y-m-d H:i:s',strtotime($request->tanggal_kirim))
            ,'updated_at' => date('Y-m-d H:i:s')
            ,'updated_by' => Auth::user()->name
        ];
        OrderModel::where('id',$id)->update($update);

        # hapus rel item dari id yang didapat
        if (!empty($list_id_relitem_diff)) {
            foreach ($list_id_relitem_diff as $key => $value) {
                if ($value != NULL) {
                    RelitemModel::where('id',$value)->delete();
                }
            }
        }

        ## pisahkan list_artikel untuk diinsert dan diupdate
        $list_relitem_insert = array();
        $list_relitem_update = array();
        // echo "<pre>";var_dump($data_rel_item);exit();
        foreach ($data_rel_item as $key => $value) {
            if ($value['id'] == NULL) {
                $list_relitem_insert[] = $value;
            } else {
                $list_relitem_update[] = $value;
            }
        }
        
        ## insert rel item jika new item
        if (!empty($list_relitem_insert)) {
            foreach ($list_relitem_insert as $key => $value) {
                $relitem = new RelitemModel([
                    'id' => $value['id']
                    ,'id_order' => $id
                    ,'harga' => $value['harga']
                    ,'deskripsi' => $value['deskripsi']
                    ,'panjang' => $value['panjang']
                    ,'lebar' => $value['lebar']
                    ,'tinggi' => $value['tinggi']
                    ,'berat' => $value['berat']
                    ,'created_at' => date('Y-m-d H:i:s')
                    ,'created_by' => Auth::user()->name
                ]);
                $insert_relitem = $relitem->save();
            }
        }

        ## update rel item jika no new item
        if (!empty($list_relitem_update)) {
            foreach ($list_relitem_update as $key => $value) {
                $update_relitem = array();
                $update_relitem = [
                    'harga' => $value['harga']
                    ,'deskripsi' => $value['deskripsi']
                    ,'panjang' => $value['panjang']
                    ,'lebar' => $value['lebar']
                    ,'tinggi' => $value['tinggi']
                    ,'berat' => $value['berat']
                    ,'updated_at' => date('Y-m-d H:i:s')
                    ,'modified_by' => Auth::user()->name
                ];
                RelitemModel::where('id',$value['id'])->update($update_relitem);
            }
        }

        # hapus rel addons dari id yang didapat
        if (!empty($list_id_reladdons_diff)) {
            foreach ($list_id_reladdons_diff as $key => $value) {
                if ($value != NULL) {
                    ReladdonsModel::where('id',$value)->delete();
                }
            }
        }

        ## pisahkan list_artikel untuk diinsert dan diupdate
        $list_reladdons_insert = array();
        $list_reladdons_update = array();
        // echo "<pre>";var_dump($data_rel_addons);exit();
        foreach ($data_rel_addons as $key => $value) {
            if ($value['id'] == NULL) {
                $list_reladdons_insert[] = $value;
            } else {
                $list_reladdons_update[] = $value;
            }
        }
        
        ## insert rel addons jika new addons
        if (!empty($list_reladdons_insert)) {
            foreach ($list_reladdons_insert as $key => $value) {
                $reladdons = new ReladdonsModel([
                    'id' => $value['id']
                    ,'id_order' => $id
                    ,'id_item' => $value['id_item']
                    ,'title' => $value['title']
                    ,'jumlah' => $value['jumlah']
                    ,'satuan' => $value['satuan']
                    ,'harga_satuan' => $value['harga_satuan']
                    ,'harga_total' => $value['harga_total']
                    ,'created_at' => date('Y-m-d H:i:s')
                    ,'created_by' => Auth::user()->name
                ]);
                $insert_reladdons = $reladdons->save();
            }
        }

        ## update rel addons jika no new addons
        if (!empty($list_reladdons_update)) {
            foreach ($list_reladdons_update as $key => $value) {
                $update_reladdons = array();
                $update_reladdons = [
                    'id_item' => $value['id_item']
                    ,'title' => $value['title']
                    ,'jumlah' => $value['jumlah']
                    ,'satuan' => $value['satuan']
                    ,'harga_satuan' => $value['harga_satuan']
                    ,'harga_total' => $value['harga_total']
                    ,'updated_at' => date('Y-m-d H:i:s')
                    ,'modified_by' => Auth::user()->name
                ];
                ReladdonsModel::where('id',$value['id'])->update($update_reladdons);
            }
        }

        return redirect('/order/'.$id.'/edit')->with('success', 'Success Input Data');      
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
        RelitemModel::where('id_order',$id)->delete();
        ReladdonsModel::where('id_order',$id)->delete();
        return redirect('/order')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
        OrderModel::where('id',$id)->delete();
        RelitemModel::where('id_order',$id)->delete();
        ReladdonsModel::where('id_order',$id)->delete();
        return redirect('/order')->with('success', 'Deleted Successfully');
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

    public function cetak_pdf($id="")
    {   
        if ($id == "") {
            $order = OrderModel::all();   
        } else {
            $where = array('id' => $id);
            $order['order'] = OrderModel::where($where)->first();
            $where2 = array('id_order' => $id);
            $order['rel_item'] = RelitemModel::where($where2)->get();
            $where3 = array('id_order' => $id);
            $order['rel_addons'] = ReladdonsModel::where($where3)->get();
            $where4 = array('id' => $order['order']['pengirim_negara']);
            $order['pengirim_negara'] = NegaraModel::where($where4)->first();
            $where5 = array('id' => $order['order']['penerima_negara']);
            $order['penerima_negara'] = NegaraModel::where($where5)->first();
        }
        // echo "<pre>";var_dump($order);exit();
        $pdf = PDF::loadview('cms.pages.order.pdf',['order'=>$order]);
        // return $pdf->download('laporan-order.pdf');
        return $pdf->stream();
    }
}