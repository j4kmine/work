<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Config;
class Text {
    public static function generateLink($array) {
        $id = isset($array['id'])?$array['id']:0;
        $slug = isset($array['slug'])?addslashes($array['slug']):'-';
        
        return Config::get('app.APP_URL').'/'.'read/'.$slug.'/'.$id;
    }
}