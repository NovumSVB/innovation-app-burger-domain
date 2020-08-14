<?php
namespace Crud\Custom\NovumBurger\Adres\Field\Base;

use Crud\Generic\Field\GenericString;
use Crud\IEditableField;
use Crud\IFilterableField;

/**
 * Base class that represents the 'huisnummer' crud field from the 'adres' table.
 * This class is auto generated and should not be modified.
 */
abstract class Huisnummer extends GenericString implements IFilterableField, IEditableField
{
	protected $sFieldName = 'huisnummer';

	protected $sFieldLabel = 'Huisnummer';

	protected $sIcon = 'home';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getHuisnummer';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Adres';


	public function isUniqueKey(): bool
	{
		return false;
	}
}
