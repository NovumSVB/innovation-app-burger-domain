<?php
namespace Crud\Custom\NovumBurger\Land\Base;

use Crud\Custom\NovumBurger;
use Crud\FormManager;
use Crud\IApiExposable;
use Crud\IConfigurableCrud;
use Exception\LogicException;
use Model\Custom\NovumBurger\Stam\Land;
use Model\Custom\NovumBurger\Stam\LandQuery;
use Model\Custom\NovumBurger\Stam\Map\LandTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;

/**
 * This class is automatically generated, do not modify manually.
 * Modify Land instead if you need to override or add functionality.
 */
abstract class CrudLandManager extends FormManager implements IConfigurableCrud, IApiExposable
{
	use NovumBurger\CrudTrait;
	use NovumBurger\CrudApiTrait;

	public function getQueryObject(): ModelCriteria
	{
		return LandQuery::create();
	}


	public function getTableMap(): TableMap
	{
		return new \Model\Custom\NovumBurger\Stam\Map\LandTableMap();
	}


	public function getShortDescription(): string
	{
		return "Dit endpoint bevat landen.";
	}


	public function getEntityTitle(): string
	{
		return "Land";
	}


	public function getOverviewUrl(): string
	{
		return "/custom/novumburger/stamtabellen/land/overview";
	}


	public function getEditUrl(): string
	{
		return "/custom/novumburger/stamtabellen/land/edit";
	}


	public function getCreateNewUrl(): string
	{
		return $this->getEditUrl();
	}


	public function getNewFormTitle(): string
	{
		return "Landen toevoegen";
	}


	public function getEditFormTitle(): string
	{
		return "Landen aanpassen";
	}


	public function getDefaultOverviewFields(): array
	{
		return ['Naam', 'Iso2', 'CallingCode', 'Delete', 'Edit'];
	}


	public function getDefaultEditFields(): array
	{
		return ['Naam', 'Iso2', 'CallingCode'];
	}


	/**
	 * Returns a model object of the type that this CrudManager represents.
	 * @param array $aData
	 * @return Land
	 */
	public function getModel(array $aData = null): Land
	{
		if (isset($aData['id']) && $aData['id']) {
		     $oLandQuery = LandQuery::create();
		     $oLand = $oLandQuery->findOneById($aData['id']);
		     if (!$oLand instanceof Land) {
		         throw new LogicException("Land should be an instance of Land but got something else." . __METHOD__);
		     }
		     $oLand = $this->fillVo($aData, $oLand);
		} else {
		     $oLand = new Land();
		     if (!empty($aData)) {
		         $oLand = $this->fillVo($aData, $oLand);
		     }
		}
		return $oLand;
	}


	/**
	 * This method is ment to be called by save so any pre and post events are triggered also.
	 * Store form data, please first perform validation by calling validate
	 * @param array $aData an array of fields that belong to this type of data
	 * @return Land
	 * @throws \Propel\Runtime\Exception\PropelException
	 */
	public function store(array $aData = null): Land
	{
		$oLand = $this->getModel($aData);


		 if(!empty($oLand))
		 {
		     $oLand = $this->fillVo($aData, $oLand);
		     $oLand->save();
		 }
		return $oLand;
	}


	/**
	 * Fills the model object with data comming from a client.
	 * @param array $aData
	 * @param Land $oModel
	 * @return Land
	 */
	protected function fillVo(array $aData, Land $oModel): Land
	{
		isset($aData['naam']) ? $oModel->setNaam($aData['naam']) : null;
		isset($aData['iso_2']) ? $oModel->setIso2($aData['iso_2']) : null;
		isset($aData['calling_code']) ? $oModel->setCallingCode($aData['calling_code']) : null;
		return $oModel;
	}
}
