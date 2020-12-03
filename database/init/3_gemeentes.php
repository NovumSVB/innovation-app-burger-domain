<?php
use Model\Custom\NovumBurger\Stam\GemeenteQuery;
use Model\Custom\NovumBurger\Stam\Gemeente;

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

