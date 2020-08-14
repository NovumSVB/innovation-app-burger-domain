<?php
namespace Crud\Custom\NovumBurger\Relatie\Base;

use Crud\Custom\NovumBurger;
use Crud\FormManager;
use Crud\IApiExposable;
use Crud\IConfigurableCrud;
use Exception\LogicException;
use Model\Custom\NovumBurger\Persoonsgegevens\Map\RelatieTableMap;
use Model\Custom\NovumBurger\Persoonsgegevens\Relatie;
use Model\Custom\NovumBurger\Persoonsgegevens\RelatieQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;

/**
 * This class is automatically generated, do not modify manually.
 * Modify Relatie instead if you need to override or add functionality.
 */
abstract class CrudRelatieManager extends FormManager implements IConfigurableCrud, IApiExposable
{
	use NovumBurger\CrudTrait;
	use NovumBurger\CrudApiTrait;

	public function getQueryObject(): ModelCriteria
	{
		return RelatieQuery::create();
	}


	public function getTableMap(): TableMap
	{
		return new \Model\Custom\NovumBurger\Persoonsgegevens\Map\RelatieTableMap();
	}


	public function getShortDescription(): string
	{
		return "Dit endpoint bevat namaak relaties tussen personen.";
	}


	public function getEntityTitle(): string
	{
		return "Relatie";
	}


	public function getOverviewUrl(): string
	{
		return "";
	}


	public function getEditUrl(): string
	{
		return "";
	}


	public function getCreateNewUrl(): string
	{
		return $this->getEditUrl();
	}


	public function getNewFormTitle(): string
	{
		return "Relaties toevoegen";
	}


	public function getEditFormTitle(): string
	{
		return "Relaties aanpassen";
	}


	public function getDefaultOverviewFields(): array
	{
		return ['Relatie_type', 'RelatieStart', 'RelatieEinde'];
	}


	public function getDefaultEditFields(): array
	{
		return ['Relatie_type', 'RelatieStart', 'RelatieEinde'];
	}


	/**
	 * Returns a model object of the type that this CrudManager represents.
	 * @param array $aData
	 * @return Relatie
	 */
	public function getModel(array $aData = null): Relatie
	{
		if (isset($aData['id']) && $aData['id']) {
		     $oRelatieQuery = RelatieQuery::create();
		     $oRelatie = $oRelatieQuery->findOneById($aData['id']);
		     if (!$oRelatie instanceof Relatie) {
		         throw new LogicException("Relatie should be an instance of Relatie but got something else." . __METHOD__);
		     }
		     $oRelatie = $this->fillVo($aData, $oRelatie);
		} else {
		     $oRelatie = new Relatie();
		     if (!empty($aData)) {
		         $oRelatie = $this->fillVo($aData, $oRelatie);
		     }
		}
		return $oRelatie;
	}


	/**
	 * This method is ment to be called by save so any pre and post events are triggered also.
	 * Store form data, please first perform validation by calling validate
	 * @param array $aData an array of fields that belong to this type of data
	 * @return Relatie
	 * @throws \Propel\Runtime\Exception\PropelException
	 */
	public function store(array $aData = null): Relatie
	{
		$oRelatie = $this->getModel($aData);


		 if(!empty($oRelatie))
		 {
		     $oRelatie = $this->fillVo($aData, $oRelatie);
		     $oRelatie->save();
		 }
		return $oRelatie;
	}


	/**
	 * Fills the model object with data comming from a client.
	 * @param array $aData
	 * @param Relatie $oModel
	 * @return Relatie
	 */
	protected function fillVo(array $aData, Relatie $oModel): Relatie
	{
		isset($aData['relatie_type_id']) ? $oModel->setRelatie_type($aData['relatie_type_id']) : null;
		isset($aData['relatie_start']) ? $oModel->setRelatieStart($aData['relatie_start']) : null;
		isset($aData['relatie_einde']) ? $oModel->setRelatieEinde($aData['relatie_einde']) : null;
		return $oModel;
	}
}
