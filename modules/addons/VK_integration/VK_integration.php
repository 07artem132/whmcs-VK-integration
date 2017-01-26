<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/vendor/autoload.php';

VK_integrationVendorAutoload::register();

define('ROOT_DIR', __DIR__);

use vendor\ServiceVoice\database as db;
use vendor\VK\VK as VK;
use vendor\ServiceVoice\MultiLanguage;

MultiLanguage::load();

function VK_integration_config() {
    global $_ADDONLANG;

    $configarray = array(
        "name" => $_ADDONLANG['name'],
        "description" => $_ADDONLANG['description'],
        "version" => "1.0",
        "author" => "Service-Voice",
        "fields" => array(
            "APP_ID" => array(
                "FriendlyName" => $_ADDONLANG['app_id'],
                "Type" => "text",
                "Size" => "25",
                "Description" => "",
                "Default" => ""
            ),
            "API_SECRET" => array(
                "FriendlyName" => $_ADDONLANG['app_secret'],
                "Type" => "password",
                "Size" => "25",
                "Description" => ""
            ),
    ));
    return $configarray;
}

function VK_integration_clientarea($vars) {
    global $autoauthkey;
    $SystemURL = db::GetSystemURL();
    $timestamp = time();

    $vk = new VK($vars['APP_ID'], $vars['API_SECRET']);

    if (empty($_GET['code'])) {
        header('Location:' . $vk->getAuthorizeURL('email', $SystemURL . 'index.php?m=VK_integration'));
    }

    $res = $vk->getAccessToken($_GET['code'], $SystemURL . 'index.php?m=VK_integration');

    if (!isset($res['email']) and empty($res['email'])) {
        header('Location:' . $SystemURL . 'clientarea.php?incorrect=true');
        die();
    }

    header("Location:" . $SystemURL . 'dologin.php?email=' . $res['email'] . '&timestamp=' . $timestamp . '&hash=' . sha1($res['email'] . $timestamp . $autoauthkey) . '&goto=' . urlencode('clientarea.php'));

    return array(
        'pagetitle' => 'Авторизация через социальную сеть VK',
        'breadcrumb' => array('index.php?m = VK_integration' => 'Авторизация через социальную сеть'),
        'templatefile' => 'clientarea',
        'requirelogin' => FALSE, # accepts true/false
        'forcessl' => FALSE, # accepts true/false
    );
}
