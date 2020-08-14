<?php
namespace Crud\Custom\NovumBurger\Persoon\Field\Base;

use Core\Utils;
use Crud\Generic\Field\GenericLookup;
use Crud\IEditableField;
use Crud\IFilterableField;
use Crud\IFilterableLookupField;
use Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery;

/**
 * Base class that represents the 'moeder_id' crud field from the 'persoon' table.
 * This class is auto generated and should not be modified.
 */
abstract class Moeder extends GenericLookup implements IFilterableField, IEditableField, IFilterableLookupField
{
	protected $sFieldName = 'moeder_id';

	protected $sFieldLabel = 'Moeder';

	protected $sIcon = 'group';

	protected $sPlaceHolder = '';

	protected $sGetter = 'getMoeder';

	protected $sFqModelClassname = '\Model\Custom\NovumBurger\Persoonsgegevens\Persoon';


	public function isUniqueKey(): bool
	{
		return false;
	}


	public function getLookups($mSelectedItem = null)
	{
		$aAllRows = \Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery::create()->orderByBsn()->find();
		$aOptions = \Core\Utils::makeSelectOptions($aAllRows, "getBsn", $mSelectedItem, "getId");
		return $aOptions;
	}


	public function getVisibleValue($iItemId = null)
	{
		if($iItemId){
		    return \Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery::create()->findOneById($iItemId)->getBsn();
		}
		return null;
	}


	public function getDataType(): string
	{
		return 'lookup';
	}
}
