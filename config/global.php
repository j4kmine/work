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
    ]
];
