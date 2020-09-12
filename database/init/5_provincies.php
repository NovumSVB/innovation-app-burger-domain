<?php
require_once '../../../../vendor/autoload.php';
require_once '../../../../config/novum.burger/propel/config.php';
require_once '../../../../config/novum.burger/config.php';

use Model\Custom\NovumCbs\Stam\ProvincieQuery;
use Model\Custom\NovumCbs\Stam\Provincie;

$sGeoData = file_get_contents('https://opendata.cbs.nl/ODataApi/OData/84489NED/TypedDataSet');
$aGeoData = json_decode($sGeoData, true);

$aProvinciesDone = [];
foreach($aGeoData['value'] as $aRow)
{
    if(in_array($aRow['Naam_4'], $aProvinciesDone))
    {
        continue;
    }
    $oProvincie = ProvincieQuery::create()->findOneByNaam($aRow['Naam_4']);
    $aProvinciesDone[] = $aRow['Naam_4'];

    $sLabel = 'updaten';
    if(!$oProvincie instanceof Provincie)
    {
        $sLabel = 'aanmaken';
        $oProvincie = new Provincie();
    }
    $oProvincie->setNaam($aRow['Naam_4']);
    $oProvincie->save();

    echo $aRow['Naam_4'] . $sLabel . PHP_EOL;

}
