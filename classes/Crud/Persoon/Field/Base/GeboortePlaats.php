<?php
namespace Crud\Custom\NovumBurger\Persoon\Field\Base;

use Crud\Generic\Field\GenericString;
use Crud\IEditableField;
use Crud\IFilterableField;

/**
 * Base class that represents the 'geboorte_plaats' crud field from the 'persoon' table.
 * This class is auto generated and should not be modified.
 */
abstract class GeboortePlaats extends GenericString implements IFilterableField, IEditableField
{
	protected $sFieldName = 'geboorte_plaats';

	protected $sFieldLabel = 'Geboorteplaats';

	protected $sIcon = 'map-marker';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getGeboortePlaats';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon';


	public function isUniqueKey(): bool
	{
		return false;
	}
}
