<?php
namespace Crud\Custom\NovumBurger\Relatie\Field\Base;

use Crud\Generic\Field\GenericDate;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IRequiredField;

/**
 * Base class that represents the 'relatie_einde' crud field from the 'relatie' table.
 * This class is auto generated and should not be modified.
 */
abstract class RelatieEinde extends GenericDate implements IFilterableField, IEditableField, IRequiredField
{
	protected $sFieldName = 'relatie_einde';

	protected $sFieldLabel = 'Einde relatie';

	protected $sIcon = 'calendar';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getRelatieEinde';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Relatie';


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


		if(!isset($aPostedData['relatie_einde']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Einde relatie" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
