<?php

return [
    'via_pengiriman' => [
        '1'=>'Udara'
        ,'2'=>'Laut'
    ],
    'jenis_pengiriman' => [
        '1'=>array('nama'=>'Udara - Paket','via_pengiriman'=>'1'),
        '2'=>array('nama'=>'Udara - Dokumen','via_pengiriman'=>'1'),
        '3'=>array('nama'=>'Laut - LCL','via_pengiriman'=>'2'),
        '4'=>array('nama'=>'Laut - FCL 20','via_pengiriman'=>'2'),
        '5'=>array('nama'=>'Laut - FCL 40','via_pengiriman'=>'2'),
        '6'=>array('nama'=>'Laut - BULK','via_pengiriman'=>'2')
    ],
    'tipe_pengiriman' => [
        '1'=>'DTD(Door To Door)'
        ,'2'=>'DTP(Door To Port)'
    ],
    'status_order' => [
        '1'=>'Menunggu Verifikasi'
        ,'2'=>'Menunggu pembayaran'
        ,'3'=>'Pesanan diproses (document handling)'
        ,'4'=>'Siap di pickup (collected)'
        ,'5'=>'Dikirim'
        ,'6'=>'Selesai'
    ],
    'barang_kategori' => [
        array('id'=>'U_DTD_GC_50','nama'=>'Udara DTD General Cargo 50'),
        array('id'=>'U_DTD_GC_100','nama'=>'Udara DTD General Cargo 100'),
        array('id'=>'U_DTD_GC_350','nama'=>'Udara DTD General Cargo 350'),
        array('id'=>'U_DTD_GC_500','nama'=>'Udara DTD General Cargo 500'),
        array('id'=>'U_DTD_GC_1000','nama'=>'Udara DTD General Cargo 1000'),
        array('id'=>'L_DTD_GC_LCL_2','nama'=>'Laut DTD General Cargo LCL 2'),
        array('id'=>'L_DTD_GC_LCL_6','nama'=>'Laut DTD General Cargo LCL 6'),
        array('id'=>'L_DTD_GC_LCL_10','nama'=>'Laut DTD General Cargo LCL 10'),
        array('id'=>'L_DTD_GC_FCL_20ft','nama'=>'Laut DTD General Cargo FCL 20ft'),
        array('id'=>'L_DTD_GC_FCL_40ft','nama'=>'Laut DTD General Cargo FCL 40ft'),
        array('id'=>'U_DTP_GC_50','nama'=>'Udara DTP General Cargo 50'),
        array('id'=>'U_DTP_GC_100','nama'=>'Udara DTP General Cargo 100'),
        array('id'=>'U_DTP_GC_350','nama'=>'Udara DTP General Cargo 350'),
        array('id'=>'U_DTP_GC_500','nama'=>'Udara DTP General Cargo 500'),
        array('id'=>'U_DTP_GC_1000','nama'=>'Udara DTP General Cargo 1000'),
        array('id'=>'L_DTP_GC_LCL_2','nama'=>'Laut DTP General Cargo LCL 2'),
        array('id'=>'L_DTP_GC_LCL_3','nama'=>'Laut DTP General Cargo LCL 3'),
        array('id'=>'L_DTP_GC_LCL_4','nama'=>'Laut DTP General Cargo LCL 4'),
        array('id'=>'L_DTP_GC_LCL_5','nama'=>'Laut DTP General Cargo LCL 5'),
        array('id'=>'L_DTP_GC_LCL_6','nama'=>'Laut DTP General Cargo LCL 6'),
        array('id'=>'L_DTP_GC_LCL_7','nama'=>'Laut DTP General Cargo LCL 7'),
        array('id'=>'L_DTP_GC_LCL_8','nama'=>'Laut DTP General Cargo LCL 8'),
        array('id'=>'L_DTP_GC_LCL_9','nama'=>'Laut DTP General Cargo LCL 9'),
        array('id'=>'L_DTP_GC_LCL_10','nama'=>'Laut DTP General Cargo LCL 10'),
        array('id'=>'L_DTP_GC_FCL_20ft','nama'=>'Laut DTP General Cargo FCL 20ft'),
        array('id'=>'L_DTP_GC_FCL_40ft','nama'=>'Laut DTP General Cargo FCL 40ft')
    ],
];