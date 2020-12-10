<?php

/***
* This file is generated, please do not modify manually.
*/

if(isset($_SERVER['IS_DEVEL']))
{
    $aConfig = [
        'PROTOCOL' => 'http',
        'ADMIN_PROTOCOL' => 'http',
        'CUSTOM_FOLDER' => 'NovumBurger',
        'ABSOLUTE_ROOT' => $_SERVER['SYSTEM_ROOT'],
        'DOMAIN' => 'burger.demo.novum.nuidev.nl',
        /* Je zoekt waarschijnlijk Config::getDataDir() */
        'DATA_DIR' => '../'
    ];
}
else
{
    $aConfig = [
        'PROTOCOL' => 'https',
        'ADMIN_PROTOCOL' => 'https',
        'CUSTOM_FOLDER' => 'NovumBurger',
        'DOMAIN' => 'burger.demo.novum.nu',
        'ABSOLUTE_ROOT' => '/var/www/1overheid/burger/system/',
        'DATA_DIR' => '/home/novum/data/burger'
    ];
}

$aConfig['CUSTOM_NAMESPACE'] = 'NovumBurger';

return $aConfig;

