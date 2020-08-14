<?php
namespace Crud\Custom\NovumBurger\Geslacht\Field\Base;

use Crud\Generic\Field\GenericString;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IRequiredField;

/**
 * Base class that represents the 'naam' crud field from the 'geslacht' table.
 * This class is auto generated and should not be modified.
 */
abstract class Naam extends GenericString implements IFilterableField, IEditableField, IRequiredField
{
	protected $sFieldName = 'naam';

	protected $sFieldLabel = 'Geslacht';

	protected $sIcon = 'tag';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getNaam';

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


		if(!isset($aPostedData['naam']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Geslacht" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
