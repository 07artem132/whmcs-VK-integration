<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of autoload
 *
 * @author A_Ivanko
 */
class VK_integrationVendorAutoload {

    public static function register() {
        spl_autoload_register(array('VK_integrationVendorAutoload', 'autoload'));
    }

    protected static function autoload($class) {
        $filePath = ROOT_DIR . '/' . str_replace('\\', '/', $class) . '.php';

        if (file_exists($filePath)) {
            require_once $filePath;
        }

        return true;
    }

}
