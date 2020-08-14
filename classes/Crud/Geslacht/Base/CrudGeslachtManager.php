<?php
namespace Crud\Custom\NovumBurger\Geslacht\Base;

use Crud\Custom\NovumBurger;
use Crud\FormManager;
use Crud\IApiExposable;
use Crud\IConfigurableCrud;
use Exception\LogicException;
use Model\Custom\NovumBurger\Stam\Geslacht;
use Model\Custom\NovumBurger\Stam\GeslachtQuery;
use Model\Custom\NovumBurger\Stam\Map\GeslachtTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;

/**
 * This class is automatically generated, do not modify manually.
 * Modify Geslacht instead if you need to override or add functionality.
 */
abstract class CrudGeslachtManager extends FormManager implements IConfigurableCrud, IApiExposable
{
	use NovumBurger\CrudTrait;
	use NovumBurger\CrudApiTrait;

	public function getQueryObject(): ModelCriteria
	{
		return GeslachtQuery::create();
	}


	public function getTableMap(): TableMap
	{
		return new \Model\Custom\NovumBurger\Stam\Map\GeslachtTableMap();
	}


	public function getShortDescription(): string
	{
		return "Dit endpoint bevat geslachten.";
	}


	public function getEntityTitle(): string
	{
		return "Geslacht";
	}


	public function getOverviewUrl(): string
	{
		return "/custom/novumburger/stamtabellen/geslacht/overview";
	}


	public function getEditUrl(): string
	{
		return "/custom/novumburger/stamtabellen/geslacht/edit";
	}


	public function getCreateNewUrl(): string
	{
		return $this->getEditUrl();
	}


	public function getNewFormTitle(): string
	{
		return "Geslachten toevoegen";
	}


	public function getEditFormTitle(): string
	{
		return "Geslachten aanpassen";
	}


	public function getDefaultOverviewFields(): array
	{
		return ['Naam', 'NaamKort', 'Delete', 'Edit'];
	}


	public function getDefaultEditFields(): array
	{
		return ['Naam', 'NaamKort'];
	}


	/**
	 * Returns a model object of the type that this CrudManager represents.
	 * @param array $aData
	 * @return Geslacht
	 */
	public function getModel(array $aData = null): Geslacht
	{
		if (isset($aData['id']) && $aData['id']) {
		     $oGeslachtQuery = GeslachtQuery::create();
		     $oGeslacht = $oGeslachtQuery->findOneById($aData['id']);
		     if (!$oGeslacht instanceof Geslacht) {
		         throw new LogicException("Geslacht should be an instance of Geslacht but got something else." . __METHOD__);
		     }
		     $oGeslacht = $this->fillVo($aData, $oGeslacht);
		} else {
		     $oGeslacht = new Geslacht();
		     if (!empty($aData)) {
		         $oGeslacht = $this->fillVo($aData, $oGeslacht);
		     }
		}
		return $oGeslacht;
	}


	/**
	 * This method is ment to be called by save so any pre and post events are triggered also.
	 * Store form data, please first perform validation by calling validate
	 * @param array $aData an array of fields that belong to this type of data
	 * @return Geslacht
	 * @throws \Propel\Runtime\Exception\PropelException
	 */
	public function store(array $aData = null): Geslacht
	{
		$oGeslacht = $this->getModel($aData);


		 if(!empty($oGeslacht))
		 {
		     $oGeslacht = $this->fillVo($aData, $oGeslacht);
		     $oGeslacht->save();
		 }
		return $oGeslacht;
	}


	/**
	 * Fills the model object with data comming from a client.
	 * @param array $aData
	 * @param Geslacht $oModel
	 * @return Geslacht
	 */
	protected function fillVo(array $aData, Geslacht $oModel): Geslacht
	{
		isset($aData['naam']) ? $oModel->setNaam($aData['naam']) : null;
		isset($aData['naam_kort']) ? $oModel->setNaamKort($aData['naam_kort']) : null;
		return $oModel;
	}
}
