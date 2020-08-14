<?php
namespace Crud\Custom\NovumBurger\Persoon_relatie\Base;

use Crud\Custom\NovumBurger;
use Crud\FormManager;
use Crud\IApiExposable;
use Crud\IConfigurableCrud;
use Exception\LogicException;
use Model\Custom\NovumBurger\Persoonsgegevens\Map\Persoon_relatieTableMap;
use Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatie;
use Model\Custom\NovumBurger\Persoonsgegevens\Persoon_relatieQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;

/**
 * This class is automatically generated, do not modify manually.
 * Modify Persoon_relatie instead if you need to override or add functionality.
 */
abstract class CrudPersoon_relatieManager extends FormManager implements IConfigurableCrud, IApiExposable
{
	use NovumBurger\CrudTrait;
	use NovumBurger\CrudApiTrait;

	public function getQueryObject(): ModelCriteria
	{
		return Persoon_relatieQuery::create();
	}


	public function getTableMap(): TableMap
	{
		return new \Model\Custom\NovumBurger\Persoonsgegevens\Map\Persoon_relatieTableMap();
	}


	public function getShortDescription(): string
	{
		return "In dit endpoint zijn relaties tussen personen opgenomen.";
	}


	public function getEntityTitle(): string
	{
		return "Persoon_relatie";
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
		return " toevoegen";
	}


	public function getEditFormTitle(): string
	{
		return " aanpassen";
	}


	public function getDefaultOverviewFields(): array
	{
		return ['RelatieId', 'PersoonId'];
	}


	public function getDefaultEditFields(): array
	{
		return ['RelatieId', 'PersoonId'];
	}


	/**
	 * Returns a model object of the type that this CrudManager represents.
	 * @param array $aData
	 * @return Persoon_relatie
	 */
	public function getModel(array $aData = null): Persoon_relatie
	{
		if (isset($aData['id']) && $aData['id']) {
		     $oPersoon_relatieQuery = Persoon_relatieQuery::create();
		     $oPersoon_relatie = $oPersoon_relatieQuery->findOneById($aData['id']);
		     if (!$oPersoon_relatie instanceof Persoon_relatie) {
		         throw new LogicException("Persoon_relatie should be an instance of Persoon_relatie but got something else." . __METHOD__);
		     }
		     $oPersoon_relatie = $this->fillVo($aData, $oPersoon_relatie);
		} else {
		     $oPersoon_relatie = new Persoon_relatie();
		     if (!empty($aData)) {
		         $oPersoon_relatie = $this->fillVo($aData, $oPersoon_relatie);
		     }
		}
		return $oPersoon_relatie;
	}


	/**
	 * This method is ment to be called by save so any pre and post events are triggered also.
	 * Store form data, please first perform validation by calling validate
	 * @param array $aData an array of fields that belong to this type of data
	 * @return Persoon_relatie
	 * @throws \Propel\Runtime\Exception\PropelException
	 */
	public function store(array $aData = null): Persoon_relatie
	{
		$oPersoon_relatie = $this->getModel($aData);


		 if(!empty($oPersoon_relatie))
		 {
		     $oPersoon_relatie = $this->fillVo($aData, $oPersoon_relatie);
		     $oPersoon_relatie->save();
		 }
		return $oPersoon_relatie;
	}


	/**
	 * Fills the model object with data comming from a client.
	 * @param array $aData
	 * @param Persoon_relatie $oModel
	 * @return Persoon_relatie
	 */
	protected function fillVo(array $aData, Persoon_relatie $oModel): Persoon_relatie
	{
		isset($aData['relatie_id']) ? $oModel->setRelatieId($aData['relatie_id']) : null;
		isset($aData['persoon_id']) ? $oModel->setPersoonId($aData['persoon_id']) : null;
		return $oModel;
	}
}
