<?php
namespace Crud\Custom\NovumBurger\Land\Field\Base;

use Crud\Generic\Field\GenericString;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IRequiredField;

/**
 * Base class that represents the 'iso_2' crud field from the 'land' table.
 * This class is auto generated and should not be modified.
 */
abstract class Iso2 extends GenericString implements IFilterableField, IEditableField, IRequiredField
{
	protected $sFieldName = 'iso_2';

	protected $sFieldLabel = 'Iso 2';

	protected $sIcon = 'flag';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getIso2';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Stam\Land';


	public function isUniqueKey(): bool
	{
		return false;
	}


	public function hasValidations()
	{
		return true;
	}


	public function validate($aPostedData)
	{
		$mResponse = false;
		$mParentResponse = parent::validate($aPostedData);


		if(!isset($aPostedData['iso_2']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Iso 2" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
