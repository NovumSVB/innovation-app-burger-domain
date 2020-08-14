<?php
namespace Crud\Custom\NovumBurger\Persoon\Field\Base;

use Crud\Generic\Field\GenericDateTime;
use Crud\IEditableField;
use Crud\IFilterableField;

/**
 * Base class that represents the 'immigratie_datum' crud field from the 'persoon' table.
 * This class is auto generated and should not be modified.
 */
abstract class Immigratiedatum extends GenericDateTime implements IFilterableField, IEditableField
{
	protected $sFieldName = 'immigratie_datum';

	protected $sFieldLabel = 'Immigratie datum';

	protected $sIcon = 'calendar';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getImmigratiedatum';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon';


	public function isUniqueKey(): bool
	{
		return false;
	}
}
