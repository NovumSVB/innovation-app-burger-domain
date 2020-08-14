<?php
namespace Crud\Custom\NovumBurger\Relatie\Field\Base;

use Core\Utils;
use Crud\Generic\Field\GenericLookup;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IFilterableLookupField;
use Crud\IRequiredField;
use Model\Custom\NovumBurger\Stam\RelatieTypeQuery;

/**
 * Base class that represents the 'relatie_type_id' crud field from the 'relatie' table.
 * This class is auto generated and should not be modified.
 */
abstract class Relatie_type extends GenericLookup implements IFilterableField, IEditableField, IFilterableLookupField, IRequiredField
{
	protected $sFieldName = 'relatie_type_id';

	protected $sFieldLabel = 'Relatie type';

	protected $sIcon = 'group';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getRelatie_type';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Relatie';


	public function isUniqueKey(): bool
	{
		return false;
	}


	public function getLookups($mSelectedItem = null)
	{
		$aAllRows = \Model\Custom\NovumBurger\Stam\RelatieTypeQuery::create()->orderByNaam()->find();
		$aOptions = \Core\Utils::makeSelectOptions($aAllRows, "getNaam", $mSelectedItem, "getId");
		return $aOptions;
	}


	public function getVisibleValue($iItemId = null)
	{
		if($iItemId){
		    return \Model\Custom\NovumBurger\Stam\RelatieTypeQuery::create()->findOneById($iItemId)->getNaam();
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


		if(!isset($aPostedData['relatie_type_id']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Relatie type" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
