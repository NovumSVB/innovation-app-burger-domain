<?php
namespace Crud\Custom\NovumBurger\Provincie\Base;

use Crud\Custom\NovumBurger;
use Crud\FormManager;
use Crud\IApiExposable;
use Crud\IConfigurableCrud;
use Exception\LogicException;
use Model\Custom\NovumBurger\Stam\Map\ProvincieTableMap;
use Model\Custom\NovumBurger\Stam\Provincie;
use Model\Custom\NovumBurger\Stam\ProvincieQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;

/**
 * This class is automatically generated, do not modify manually.
 * Modify Provincie instead if you need to override or add functionality.
 */
abstract class CrudProvincieManager extends FormManager implements IConfigurableCrud, IApiExposable
{
	use NovumBurger\CrudTrait;
	use NovumBurger\CrudApiTrait;

	public function getQueryObject(): ModelCriteria
	{
		return ProvincieQuery::create();
	}


	public function getTableMap(): TableMap
	{
		return new \Model\Custom\NovumBurger\Stam\Map\ProvincieTableMap();
	}


	public function getShortDescription(): string
	{
		return "Dit endpoint provincies.";
	}


	public function getEntityTitle(): string
	{
		return "Provincie";
	}


	public function getOverviewUrl(): string
	{
		return "/custom/novumburger/stamtabellen/provincie/overview";
	}


	public function getEditUrl(): string
	{
		return "/custom/novumburger/stamtabellen/provincie/edit";
	}


	public function getCreateNewUrl(): string
	{
		return $this->getEditUrl();
	}


	public function getNewFormTitle(): string
	{
		return "Provincies toevoegen";
	}


	public function getEditFormTitle(): string
	{
		return "Provincies aanpassen";
	}


	public function getDefaultOverviewFields(): array
	{
		return ['Naam', 'Delete', 'Edit'];
	}


	public function getDefaultEditFields(): array
	{
		return ['Naam'];
	}


	/**
	 * Returns a model object of the type that this CrudManager represents.
	 * @param array $aData
	 * @return Provincie
	 */
	public function getModel(array $aData = null): Provincie
	{
		if (isset($aData['id']) && $aData['id']) {
		     $oProvincieQuery = ProvincieQuery::create();
		     $oProvincie = $oProvincieQuery->findOneById($aData['id']);
		     if (!$oProvincie instanceof Provincie) {
		         throw new LogicException("Provincie should be an instance of Provincie but got something else." . __METHOD__);
		     }
		     $oProvincie = $this->fillVo($aData, $oProvincie);
		} else {
		     $oProvincie = new Provincie();
		     if (!empty($aData)) {
		         $oProvincie = $this->fillVo($aData, $oProvincie);
		     }
		}
		return $oProvincie;
	}


	/**
	 * This method is ment to be called by save so any pre and post events are triggered also.
	 * Store form data, please first perform validation by calling validate
	 * @param array $aData an array of fields that belong to this type of data
	 * @return Provincie
	 * @throws \Propel\Runtime\Exception\PropelException
	 */
	public function store(array $aData = null): Provincie
	{
		$oProvincie = $this->getModel($aData);


		 if(!empty($oProvincie))
		 {
		     $oProvincie = $this->fillVo($aData, $oProvincie);
		     $oProvincie->save();
		 }
		return $oProvincie;
	}


	/**
	 * Fills the model object with data comming from a client.
	 * @param array $aData
	 * @param Provincie $oModel
	 * @return Provincie
	 */
	protected function fillVo(array $aData, Provincie $oModel): Provincie
	{
		isset($aData['naam']) ? $oModel->setNaam($aData['naam']) : null;
		return $oModel;
	}
}
