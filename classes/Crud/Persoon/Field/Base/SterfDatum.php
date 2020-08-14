<?php
namespace Crud\Custom\NovumBurger\Persoon\Field\Base;

use Crud\Generic\Field\GenericDate;
use Crud\IEditableField;
use Crud\IFilterableField;

/**
 * Base class that represents the 'sterf_datum' crud field from the 'persoon' table.
 * This class is auto generated and should not be modified.
 */
abstract class SterfDatum extends GenericDate implements IFilterableField, IEditableField
{
	protected $sFieldName = 'sterf_datum';

	protected $sFieldLabel = 'Sterf datum';

	protected $sIcon = 'calendar';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getSterfDatum';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon';


	public function isUniqueKey(): bool
	{
		return false;
	}
}
