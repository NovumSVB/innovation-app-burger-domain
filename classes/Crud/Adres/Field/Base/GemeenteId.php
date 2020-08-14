<?php
namespace Crud\Custom\NovumBurger\Adres\Field\Base;

use Core\Utils;
use Crud\Generic\Field\GenericLookup;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IFilterableLookupField;
use Crud\IRequiredField;
use Model\Custom\NovumBurger\Stam\GemeenteQuery;

/**
 * Base class that represents the 'gemeente_id' crud field from the 'adres' table.
 * This class is auto generated and should not be modified.
 */
abstract class GemeenteId extends GenericLookup implements IFilterableField, IEditableField, IFilterableLookupField, IRequiredField
{
	protected $sFieldName = 'gemeente_id';

	protected $sFieldLabel = 'Gemeente';

	protected $sIcon = 'building';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getGemeenteId';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Adres';


	public function isUniqueKey(): bool
	{
		return false;
	}


	public function getLookups($mSelectedItem = null)
	{
		$aAllRows = \Model\Custom\NovumBurger\Stam\GemeenteQuery::create()->orderByNaam()->find();
		$aOptions = \Core\Utils::makeSelectOptions($aAllRows, "getNaam", $mSelectedItem, "getId");
		return $aOptions;
	}


	public function getVisibleValue($iItemId = null)
	{
		if($iItemId){
		    return \Model\Custom\NovumBurger\Stam\GemeenteQuery::create()->findOneById($iItemId)->getNaam();
		}
		return null;
	}


	public function getDataType(): string
	{
		return 'lookup';
	}


	public function hasValidations()
	{
		return true;
	}


	public function validate($aPostedData)
	{
		$mResponse = false;
		$mParentResponse = parent::validate($aPostedData);


		if(!isset($aPostedData['gemeente_id']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Gemeente" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
