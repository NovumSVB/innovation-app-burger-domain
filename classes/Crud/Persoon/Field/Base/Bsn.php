<?php
namespace Crud\Custom\NovumBurger\Persoon\Field\Base;

use Crud\Generic\Field\GenericBsn;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IRequiredField;

/**
 * Base class that represents the 'bsn' crud field from the 'persoon' table.
 * This class is auto generated and should not be modified.
 */
abstract class Bsn extends GenericBsn implements IFilterableField, IEditableField, IRequiredField
{
	protected $sFieldName = 'bsn';

	protected $sFieldLabel = 'Burgerservice nummer';

	protected $sIcon = 'tag';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getBsn';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon';


	public function isUniqueKey(): bool
	{
		return true;
	}


	public function hasValidations()
	{
		return true;
	}


	public function validate($aPostedData)
	{
		$mResponse = false;
		$mParentResponse = parent::validate($aPostedData);


		if(!isset($aPostedData['bsn']))
		{
		     $mResponse = [];
		     $mResponse[] = 'Het veld "Burgerservice nummer" verplicht maar nog niet ingevuld.';
		}
		if(!empty($mParentResponse)){
		     $mResponse = array_merge($mResponse, $mParentResponse);
		}
		return $mResponse;
	}
}
