<?php
namespace Crud\Custom\NovumBurger\Persoon\Field\Base;

use Crud\Generic\Field\GenericDate;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IRequiredField;

/**
 * Base class that represents the 'geboorte_datum' crud field from the 'persoon' table.
 * This class is auto generated and should not be modified.
 */
abstract class GeboorteDatum extends GenericDate implements IFilterableField, IEditableField, IRequiredField
{
	protected $sFieldName = 'geboorte_datum';

	protected $sFieldLabel = 'Geboortedatum';

	protected $sIcon = 'calendar';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getGeboorteDatum';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon';


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


		if(!isset($aPostedData['geboorte_datum']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Geboortedatum" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
