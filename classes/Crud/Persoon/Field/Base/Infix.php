<?php
namespace Crud\Custom\NovumBurger\Persoon\Field\Base;

use Crud\Generic\Field\GenericString;
use Crud\IEditableField;
use Crud\IFilterableField;

/**
 * Base class that represents the 'infix' crud field from the 'persoon' table.
 * This class is auto generated and should not be modified.
 */
abstract class Infix extends GenericString implements IFilterableField, IEditableField
{
	protected $sFieldName = 'infix';

	protected $sFieldLabel = 'Tussenvoegsel';

	protected $sIcon = 'user';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getInfix';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon';


	public function isUniqueKey(): bool
	{
		return false;
	}
}
