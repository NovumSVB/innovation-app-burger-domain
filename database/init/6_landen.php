<?php

use Model\Custom\NovumBurger\Stam\LandQuery;
use Model\Custom\NovumBurger\Stam\Land;

$sCountries = file_get_contents('./countries.json');
$aCountries = json_decode($sCountries, true);


// Got this from here: https://gist.github.com/thomasbandit/261de9cd8419dfc859e454c0d58d33fb

foreach ($aCountries as $aCountry)
{
    $oLandQuery = LandQuery::create();

    $oLand = $oLandQuery->findOneByIso2($aCountry['short_name']);

    $sLbl = "Updating";
    if(!$oLand instanceof Land)
    {
        $sLbl = "Adding";
        $oLand = new Land();
        $oLand->setIso2($aCountry['short_name']);
    }
    echo $sLbl . " " . $aCountry['name'] . PHP_EOL;
    $oLand->setNaam($aCountry['name']);
    $oLand->setCallingCode($aCountry['calling_code']);
    $oLand->save();


}
