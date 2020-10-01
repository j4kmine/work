<?php
 
 namespace App\Http\Controllers\API;
 
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
 use App\Models\TrackingModel;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 class OrderController extends Controller
{
      /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAllOrder()
    {   
        $order = OrderModel::paginate(10);
        return response()->json([$order], 200);
    }

    public function getOrderById(Request $request)
    {   
        // $this->validate($request, [
        //     'id' => 'required'      
        // ]);

        $id = $request->id;

        $where = array('id' => $id);
        $data['order'] = OrderModel::where($where)->first();
        $where2 = array('id_order' => $id);
        $data['rel_item'] = RelitemModel::where($where2)->get();
        $where3 = array('id_order' => $id);
        $data['rel_addons'] = ReladdonsModel::where($where3)->get();

        return response()->json([$data], 200);
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'kota_tujuan' => 'required'
        //     ,'qty_container' => 'required'
        //     ,'pengirim_nama' => 'required'
        //     ,'pengirim_negara' => 'required'
        //     ,'pengirim_kodepos' => 'required'
        //     ,'pengirim_kota' => 'required'
        //     ,'pengirim_alamat' => 'required'
        //     ,'pengirim_perusahaan' => 'required'
        //     ,'pengirim_telepon' => 'required'
        //     ,'pengirim_email' => 'required'
        //     ,'pengirim_koleksi_intruksi' => 'required'
        //     ,'penerima_nama' => 'required'
        //     ,'penerima_negara' => 'required'
        //     ,'penerima_kodepos' => 'required'
        //     ,'penerima_kota' => 'required'
        //     ,'penerima_alamat' => 'required'
        //     ,'penerima_perusahaan' => 'required'
        //     ,'penerima_telepon' => 'required'
        //     ,'penerima_email' => 'required'
        //     ,'referensi_customer' => 'required'
        //     ,'layanan_tambahan' => 'required'
        //     ,'total_harga' => 'required'
        //     ,'total_approved' => 'required'
        //     ,'status' => 'required'
        //     ,'tanggal_order' => 'required'
        //     ,'tanggal_kirim' => 'required'
        // ]);

        $deskripsi = $request->input('deskripsi');
        $harga = $request->input('harga');
        $panjang = $request->input('panjang');
        $lebar = $request->input('lebar');
        $tinggi = $request->input('tinggi');
        $berat = $request->input('berat');
        $qty_barang = $request->input('qty_barang');
        $barang_package = $request->input('barang_package');
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
        $id_item = $request->input('id_item');
        $title = $request->input('title');
        $jumlah = $request->input('jumlah');
        $satuan = $request->input('satuan');
        $harga_satuan = $request->input('harga_satuan');
        $harga_total = $request->input('harga_total');
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
            'id_user' => $request->input('id_user')
            ,'kota_asal' => $request->input('kota_asal')
            ,'kota_tujuan' => $request->input('kota_tujuan')

            ,'id_via_pengiriman' => $request->input('id_via_pengiriman')
            ,'id_jenis_pengiriman' => $request->input('id_jenis_pengiriman')
            ,'id_tipe_pengiriman' => $request->input('id_tipe_pengiriman')

            ,'id_barang_kategori' => $request->input('id_barang_kategori')
            ,'id_barang_jenis' => $request->input('id_barang_jenis')
            
            ,'qty_container' => $request->input('qty_container')
            ,'id_asuransi' => $request->input('id_asuransi')

            ,'pengirim_nama' => $request->input('pengirim_nama')
            ,'pengirim_negara' => $request->input('pengirim_negara')
            ,'pengirim_kodepos' => $request->input('pengirim_kodepos')
            ,'pengirim_kota' => $request->input('pengirim_kota')
            ,'pengirim_alamat' => $request->input('pengirim_alamat')
            ,'pengirim_perusahaan' => $request->input('pengirim_perusahaan')
            ,'pengirim_telepon' => $request->input('pengirim_telepon')
            ,'pengirim_email' => $request->input('pengirim_email')
            ,'pengirim_koleksi_intruksi' => $request->input('pengirim_koleksi_intruksi')

            ,'penerima_nama' => $request->input('penerima_nama')
            ,'penerima_negara' => $request->input('penerima_negara')
            ,'penerima_kodepos' => $request->input('penerima_kodepos')
            ,'penerima_kota' => $request->input('penerima_kota')
            ,'penerima_alamat' => $request->input('penerima_alamat')
            ,'penerima_perusahaan' => $request->input('penerima_perusahaan')
            ,'penerima_telepon' => $request->input('penerima_telepon')
            ,'penerima_email' => $request->input('penerima_email')
            ,'referensi_customer' => $request->input('referensi_customer')

            ,'layanan_tambahan' => $request->input('layanan_tambahan')
            ,'total_harga' => $request->input('total_harga')
            ,'total_approved' => $request->input('total_approved')
            ,'status' => $request->input('status')
            ,'tanggal_order' => date('Y-m-d H:i:s',strtotime($request->input('tanggal_order')))
            ,'tanggal_kirim' => date('Y-m-d H:i:s',strtotime($request->input('tanggal_kirim')))

            ,'created_at' => date('Y-m-d H:i:s')
            ,'created_by' => $request->input('created_by')
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
                        ,'created_by' => $request->input('created_by')
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
                        ,'created_by' => $request->input('created_by')
                    ]);
                    $datareladdons = $reladdons->save();
                }
            }

            return response()->json(['response' => $data,'message' => 'INSERT SUKSES'], 200);
        } else {
            return response()->json(['response' => $data,'message' => 'INSERT GAGAL'], 200);
        }
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'kota_tujuan' => 'required'
        //     ,'qty_container' => 'required'
        //     ,'pengirim_nama' => 'required'
        //     ,'pengirim_negara' => 'required'
        //     ,'pengirim_kodepos' => 'required'
        //     ,'pengirim_kota' => 'required'
        //     ,'pengirim_alamat' => 'required'
        //     ,'pengirim_perusahaan' => 'required'
        //     ,'pengirim_telepon' => 'required'
        //     ,'pengirim_email' => 'required'
        //     ,'pengirim_koleksi_intruksi' => 'required'
        //     ,'penerima_nama' => 'required'
        //     ,'penerima_negara' => 'required'
        //     ,'penerima_kodepos' => 'required'
        //     ,'penerima_kota' => 'required'
        //     ,'penerima_alamat' => 'required'
        //     ,'penerima_perusahaan' => 'required'
        //     ,'penerima_telepon' => 'required'
        //     ,'penerima_email' => 'required'
        //     ,'referensi_customer' => 'required'
        //     ,'layanan_tambahan' => 'required'
        //     ,'total_harga' => 'required'
        //     ,'total_approved' => 'required'
        //     ,'status' => 'required'
        //     ,'tanggal_order' => 'required'
        //     ,'tanggal_kirim' => 'required'
        // ]);

        $deskripsi = $request->input('deskripsi');
        $harga = $request->input('harga');
        $panjang = $request->input('panjang');
        $lebar = $request->input('lebar');
        $tinggi = $request->input('tinggi');
        $berat = $request->input('berat');
        $qty_barang = $request->input('qty_barang');
        $barang_package = $request->input('barang_package');
        $id_rel_item = $request->input('id_rel_item');
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
        $id_item = $request->input('id_item');
        $title = $request->input('title');
        $jumlah = $request->input('jumlah');
        $satuan = $request->input('satuan');
        $harga_satuan = $request->input('harga_satuan');
        $harga_total = $request->input('harga_total');
        $id_rel_addons = $request->input('id_rel_addons');
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
        
        ## cari id rel addons yang dihapus
        $id_rel_addons1 = $id_rel_addons;
        $where2 = array('id_order' => $id);
        $id_rel_addons2 = ReladdonsModel::where($where2)->pluck('id')->toArray();

        $list_id_reladdons_diff = array_diff($id_rel_addons1, $id_rel_addons2);
        if (empty($list_id_reladdons_diff)) {
            $list_id_reladdons_diff = array_diff($id_rel_addons2, $id_rel_addons1);
        }

        $update = [
            'id_user' => $request->input('id_user')
            ,'kota_asal' => $request->input('kota_asal')
            ,'kota_tujuan' => $request->input('kota_tujuan')

            ,'id_via_pengiriman' => $request->input('id_via_pengiriman')
            ,'id_jenis_pengiriman' => $request->input('id_jenis_pengiriman')
            ,'id_tipe_pengiriman' => $request->input('id_tipe_pengiriman')

            ,'id_barang_kategori' => $request->input('id_barang_kategori')
            ,'id_barang_jenis' => $request->input('id_barang_jenis')
            
            ,'qty_container' => $request->input('qty_container')
            ,'id_asuransi' => $request->input('id_asuransi')

            ,'pengirim_nama' => $request->input('pengirim_nama')
            ,'pengirim_negara' => $request->input('pengirim_negara')
            ,'pengirim_kodepos' => $request->input('pengirim_kodepos')
            ,'pengirim_kota' => $request->input('pengirim_kota')
            ,'pengirim_alamat' => $request->input('pengirim_alamat')
            ,'pengirim_perusahaan' => $request->input('pengirim_perusahaan')
            ,'pengirim_telepon' => $request->input('pengirim_telepon')
            ,'pengirim_email' => $request->input('pengirim_email')
            ,'pengirim_koleksi_intruksi' => $request->input('pengirim_koleksi_intruksi')

            ,'penerima_nama' => $request->input('penerima_nama')
            ,'penerima_negara' => $request->input('penerima_negara')
            ,'penerima_kodepos' => $request->input('penerima_kodepos')
            ,'penerima_kota' => $request->input('penerima_kota')
            ,'penerima_alamat' => $request->input('penerima_alamat')
            ,'penerima_perusahaan' => $request->input('penerima_perusahaan')
            ,'penerima_telepon' => $request->input('penerima_telepon')
            ,'penerima_email' => $request->input('penerima_email')
            ,'referensi_customer' => $request->input('referensi_customer')

            ,'layanan_tambahan' => $request->input('layanan_tambahan')
            ,'total_harga' => $request->input('total_harga')
            ,'total_approved' => $request->input('total_approved')
            ,'status' => $request->input('status')
            ,'tanggal_order' => date('Y-m-d H:i:s',strtotime($request->input('tanggal_order')))
            ,'tanggal_kirim' => date('Y-m-d H:i:s',strtotime($request->input('tanggal_kirim')))

            ,'updated_at' => date('Y-m-d H:i:s')
            ,'updated_by' => $request->input('updated_by')
        ];
        $query = OrderModel::where('id',$id)->update($update);

        if($query){
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
                        ,'created_by' => $request->input('updated_by')
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
                        ,'modified_by' => $request->input('updated_by')
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
                        ,'created_by' => $request->input('updated_by')
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
                        ,'modified_by' => $request->input('updated_by')
                    ];
                    ReladdonsModel::where('id',$value['id'])->update($update_reladdons);
                }
            }

            return response()->json(['response' => $query,'message' => 'UPDATE SUKSES'], 200);
        } else {
            return response()->json(['response' => $query,'message' => 'UPDATE GAGAL'], 200);
        }
    }

    public function destroy($id)
    {  
        $query = OrderModel::where('id',$id)->delete();
        if($query){
            RelitemModel::where('id_order',$id)->delete();
            ReladdonsModel::where('id_order',$id)->delete();
            TrackingModel::where('id_order',$id)->delete();
    
            return response()->json(['response' => $query,'message' => 'DELETE SUKSES'], 200);
        } else {
            return response()->json(['response' => $query,'message' => 'DELETE GAGAL'], 200);
        }
    }
}