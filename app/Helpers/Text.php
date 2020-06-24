<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Text {
    public static function generateLink($array) {
        $day = isset($array['created_at'])?date('d', strtotime($array['created_at'])):0;
        $month = isset($array['created_at'])?date('m', strtotime($array['created_at'])):0;
        $year = isset($array['created_at'])?date('Y', strtotime($array['created_at'])):0;
        $id = isset($array['id'])?$array['id']:0;
        $slug = isset($array['slug'])?addslashes($array['slug']):'-';
    
        return 'http://'.$_ENV['APP_URL'].'/'.'read/'.$year.'/'.$month.'/'.$day.'/'.$slug;
    }
}