<?php
use Model\Custom\NovumCbs\Stam\GemeenteQuery;
use Model\Custom\NovumCbs\Stam\Gemeente;

require_once '../../../../vendor/autoload.php';
require_once '../../../../config/novum.burger/propel/config.php';
require_once '../../../../config/novum.burger/config.php';

$sGeoData = file_get_contents('https://opendata.cbs.nl/ODataApi/OData/84489NED/TypedDataSet');
$aGeoData = json_decode($sGeoData, true);

$aProvinciesDone = [];
foreach($aGeoData['value'] as $aRow)
{
    $oGemeente = GemeenteQuery::create()->findOneByNaam($aRow['Naam_2']);
    $sLabel = 'updaten';
    if(!$oGemeente instanceof Gemeente)
    {
        $sLabel = 'aanmaken';
        $oGemeente = new Gemeente();
    }
    echo trim($aRow['Naam_2']) . "\t\t" . $sLabel . PHP_EOL;
    $oGemeente->setNaam(trim($aRow['Naam_2']));
    $oGemeente->save();
}

