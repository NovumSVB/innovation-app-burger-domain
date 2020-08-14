<?php
namespace Crud\Custom\NovumBurger\Land\Field\Base;

use Crud\Generic\Field\GenericString;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IRequiredField;

/**
 * Base class that represents the 'calling_code' crud field from the 'land' table.
 * This class is auto generated and should not be modified.
 */
abstract class CallingCode extends GenericString implements IFilterableField, IEditableField, IRequiredField
{
	protected $sFieldName = 'calling_code';

	protected $sFieldLabel = 'Landnummer';

	protected $sIcon = 'phone';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getCallingCode';

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


		if(!isset($aPostedData['calling_code']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Landnummer" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
