<?php
namespace Crud\Custom\NovumBurger\Relatie_type\Base;

use Crud\Custom\NovumBurger;
use Crud\FormManager;
use Crud\IApiExposable;
use Crud\IConfigurableCrud;
use Exception\LogicException;
use Model\Custom\NovumBurger\Stam\Map\Relatie_typeTableMap;
use Model\Custom\NovumBurger\Stam\Relatie_type;
use Model\Custom\NovumBurger\Stam\Relatie_typeQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;

/**
 * This class is automatically generated, do not modify manually.
 * Modify Relatie_type instead if you need to override or add functionality.
 */
abstract class CrudRelatie_typeManager extends FormManager implements IConfigurableCrud, IApiExposable
{
	use NovumBurger\CrudTrait;
	use NovumBurger\CrudApiTrait;

	public function getQueryObject(): ModelCriteria
	{
		return Relatie_typeQuery::create();
	}


	public function getTableMap(): TableMap
	{
		return new \Model\Custom\NovumBurger\Stam\Map\Relatie_typeTableMap();
	}


	public function getShortDescription(): string
	{
		return "Dit endpoint bevat relatie typen.";
	}


	public function getEntityTitle(): string
	{
		return "Relatie_type";
	}


	public function getOverviewUrl(): string
	{
		return "/custom/novumburger/stamtabellen/relatie_type/overview";
	}


	public function getEditUrl(): string
	{
		return "/custom/novumburger/stamtabellen/relatie_type/edit";
	}


	public function getCreateNewUrl(): string
	{
		return $this->getEditUrl();
	}


	public function getNewFormTitle(): string
	{
		return "Relatie vormen toevoegen";
	}


	public function getEditFormTitle(): string
	{
		return "Relatie vormen aanpassen";
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
	 * @return Relatie_type
	 */
	public function getModel(array $aData = null): Relatie_type
	{
		if (isset($aData['id']) && $aData['id']) {
		     $oRelatie_typeQuery = Relatie_typeQuery::create();
		     $oRelatie_type = $oRelatie_typeQuery->findOneById($aData['id']);
		     if (!$oRelatie_type instanceof Relatie_type) {
		         throw new LogicException("Relatie_type should be an instance of Relatie_type but got something else." . __METHOD__);
		     }
		     $oRelatie_type = $this->fillVo($aData, $oRelatie_type);
		} else {
		     $oRelatie_type = new Relatie_type();
		     if (!empty($aData)) {
		         $oRelatie_type = $this->fillVo($aData, $oRelatie_type);
		     }
		}
		return $oRelatie_type;
	}


	/**
	 * This method is ment to be called by save so any pre and post events are triggered also.
	 * Store form data, please first perform validation by calling validate
	 * @param array $aData an array of fields that belong to this type of data
	 * @return Relatie_type
	 * @throws \Propel\Runtime\Exception\PropelException
	 */
	public function store(array $aData = null): Relatie_type
	{
		$oRelatie_type = $this->getModel($aData);


		 if(!empty($oRelatie_type))
		 {
		     $oRelatie_type = $this->fillVo($aData, $oRelatie_type);
		     $oRelatie_type->save();
		 }
		return $oRelatie_type;
	}


	/**
	 * Fills the model object with data comming from a client.
	 * @param array $aData
	 * @param Relatie_type $oModel
	 * @return Relatie_type
	 */
	protected function fillVo(array $aData, Relatie_type $oModel): Relatie_type
	{
		isset($aData['naam']) ? $oModel->setNaam($aData['naam']) : null;
		return $oModel;
	}
}
