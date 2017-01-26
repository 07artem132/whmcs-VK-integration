<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

add_hook('ClientAreaPage', 1, function($vars) {
    return ['VKautnCode' => '<a href="/index.php?m=VK_integration"><img src="/modules/addons/VK_integration/icon/Vk-icon.png"></a>'];
});
