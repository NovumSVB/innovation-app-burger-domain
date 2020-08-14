<?php
namespace Crud\Custom\NovumBurger\Persoon_relatie\Field\Base;

use Crud\Generic\Field\GenericInteger;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IRequiredField;

/**
 * Base class that represents the 'relatie_id' crud field from the 'persoon_relatie' table.
 * This class is auto generated and should not be modified.
 */
abstract class RelatieId extends GenericInteger implements IFilterableField, IEditableField, IRequiredField
{
	protected $sFieldName = 'relatie_id';

	protected $sFieldLabel = 'Relatie';

	protected $sIcon = 'user';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getRelatieId';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie';


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


		if(!isset($aPostedData['relatie_id']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Relatie" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
