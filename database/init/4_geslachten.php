<?php

use Model\Custom\NovumBurger\Stam\GeslachtQuery;
use Model\Custom\NovumBurger\Stam\Geslacht;

$aGeslachten = [
    'Man' => 'M',
    'Vrouw' => 'V',
    'X' => 'X',
];

foreach($aGeslachten as $sLong => $sShort)
{
   $oGeslacht = GeslachtQuery::create()->findOneByNaam($sLong);

   $sLabel = 'updaten';
   if(!$oGeslacht instanceof Geslacht)
   {
       $sLabel = 'toevoegen';
       $oGeslacht = new Geslacht();
   }

   echo "Geslacht " . $sLong . ' ' . $sLabel . PHP_EOL;
   $oGeslacht->setNaam($sLong);
   $oGeslacht->setNaamKort($sShort);
   $oGeslacht->save();

}
