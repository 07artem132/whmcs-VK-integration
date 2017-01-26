<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vendor\ServiceVoice;

class MultiLanguage {

    const LANG_PATH = ROOT_DIR . '/lang';
    const LANG_DEFAULT = 'russian';

    public static function load() {
        global $CONFIG, $_ADDONLANG;

        $Language = isset($_SESSION['Language']) ? $_SESSION['Language'] : $CONFIG['Language'];

        $LanguageFile = $Language . '.php';
        $LanguageFileDefault = self::LANG_DEFAULT . '.php';

        if (file_exists(self::LANG_PATH . '/' . $LanguageFileDefault)) {
            include self::LANG_PATH . '/' . $LanguageFileDefault;
        }

        if (file_exists(self::LANG_PATH . '/' . $LanguageFile)) {
            include self::LANG_PATH . '/' . $LanguageFile;
        }
    }

}
