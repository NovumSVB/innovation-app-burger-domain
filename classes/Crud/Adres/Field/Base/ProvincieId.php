<?php
namespace Crud\Custom\NovumBurger\Adres\Field\Base;

use Core\Utils;
use Crud\Generic\Field\GenericLookup;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IFilterableLookupField;
use Crud\IRequiredField;
use Model\Custom\NovumBurger\Stam\ProvincieQuery;

/**
 * Base class that represents the 'provincie_id' crud field from the 'adres' table.
 * This class is auto generated and should not be modified.
 */
abstract class ProvincieId extends GenericLookup implements IFilterableField, IEditableField, IFilterableLookupField, IRequiredField
{
	protected $sFieldName = 'provincie_id';

	protected $sFieldLabel = 'Provincie';

	protected $sIcon = 'map-marker';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getProvincieId';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Adres';


	public function isUniqueKey(): bool
	{
		return false;
	}


	public function getLookups($mSelectedItem = null)
	{
		$aAllRows = \Model\Custom\NovumBurger\Stam\ProvincieQuery::create()->orderByNaam()->find();
		$aOptions = \Core\Utils::makeSelectOptions($aAllRows, "getNaam", $mSelectedItem, "getId");
		return $aOptions;
	}


	public function getVisibleValue($iItemId = null)
	{
		if($iItemId){
		    return \Model\Custom\NovumBurger\Stam\ProvincieQuery::create()->findOneById($iItemId)->getNaam();
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


		if(!isset($aPostedData['provincie_id']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Provincie" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
