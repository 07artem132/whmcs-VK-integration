<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vendor\ServiceVoice;

use Illuminate\Database\Capsule\Manager as Capsule;

class database {

    public static function GetSystemURL() {
        $data = (array) Capsule::table('tblconfiguration')->select('value')->where('setting', '=', 'SystemURL')->first();
        return $data['value'];
    }

}
