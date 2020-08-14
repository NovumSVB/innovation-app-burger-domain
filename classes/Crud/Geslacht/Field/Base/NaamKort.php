<?php
namespace Crud\Custom\NovumBurger\Geslacht\Field\Base;

use Crud\Generic\Field\GenericString;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IRequiredField;

/**
 * Base class that represents the 'naam_kort' crud field from the 'geslacht' table.
 * This class is auto generated and should not be modified.
 */
abstract class NaamKort extends GenericString implements IFilterableField, IEditableField, IRequiredField
{
	protected $sFieldName = 'naam_kort';

	protected $sFieldLabel = 'Geslacht kort';

	protected $sIcon = 'tag';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getNaamKort';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Stam\Geslacht';


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


		if(!isset($aPostedData['naam_kort']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Geslacht kort" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
