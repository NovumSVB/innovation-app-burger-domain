<?php
namespace Crud\Custom\NovumBurger\Adres\Field\Base;

use Core\Utils;
use Crud\Generic\Field\GenericLookup;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IFilterableLookupField;
use Crud\IRequiredField;
use Model\Custom\NovumBurger\PersoonQuery;

/**
 * Base class that represents the 'persoon_id' crud field from the 'adres' table.
 * This class is auto generated and should not be modified.
 */
abstract class PersoonId extends GenericLookup implements IFilterableField, IEditableField, IFilterableLookupField, IRequiredField
{
	protected $sFieldName = 'persoon_id';

	protected $sFieldLabel = 'Persoon';

	protected $sIcon = 'user';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getPersoonId';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Adres';


	public function isUniqueKey(): bool
	{
		return false;
	}


	public function getLookups($mSelectedItem = null)
	{
		$aAllRows = \Model\Custom\NovumBurger\PersoonQuery::create()->orderByBsn()->find();
		$aOptions = \Core\Utils::makeSelectOptions($aAllRows, "getBsn", $mSelectedItem, "getId");
		return $aOptions;
	}


	public function getVisibleValue($iItemId = null)
	{
		if($iItemId){
		    return \Model\Custom\NovumBurger\PersoonQuery::create()->findOneById($iItemId)->getBsn();
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


		if(!isset($aPostedData['persoon_id']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Persoon" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
