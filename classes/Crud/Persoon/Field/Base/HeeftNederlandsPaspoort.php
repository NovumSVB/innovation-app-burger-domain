<?php
namespace Crud\Custom\NovumBurger\Persoon\Field\Base;

use Crud\Generic\Field\GenericBoolean;
use Crud\IEditableField;
use Crud\IFilterableField;

/**
 * Base class that represents the 'heeft_nl_paspoort' crud field from the 'persoon' table.
 * This class is auto generated and should not be modified.
 */
abstract class HeeftNederlandsPaspoort extends GenericBoolean implements IFilterableField, IEditableField
{
	protected $sFieldName = 'heeft_nl_paspoort';

	protected $sFieldLabel = 'Nederlands paspoort';

	protected $sIcon = 'tag';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getHeeftNederlandsPaspoort';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon';


	public function isUniqueKey(): bool
	{
		return false;
	}
}
