<?php
namespace Crud\Custom\NovumBurger\Persoon\Field\Base;

use Crud\Generic\Field\GenericString;
use Crud\IEditableField;
use Crud\IFilterableField;

/**
 * Base class that represents the 'sterf_plaats' crud field from the 'persoon' table.
 * This class is auto generated and should not be modified.
 */
abstract class SterfPlaats extends GenericString implements IFilterableField, IEditableField
{
	protected $sFieldName = 'sterf_plaats';

	protected $sFieldLabel = 'Sterf plaats';

	protected $sIcon = 'map-marker';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getSterfPlaats';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon';


	public function isUniqueKey(): bool
	{
		return false;
	}
}
