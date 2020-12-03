<?php
$servicename = 'burger';
$password = 'Mkwhwm!2020'; // Makkelijker kunnen we het wel maken!

$aScripts = glob('../../_default/novum/*');

foreach ($aScripts as $sScript)
{
    echo "Importing $sScript" . PHP_EOL;
    require_once $sScript;
}

/**/
// require '1_convert_db.php';

require '3_gemeentes.php';
require '4_geslachten.php';
require '5_provincies.php';
require '6_landen.php';


