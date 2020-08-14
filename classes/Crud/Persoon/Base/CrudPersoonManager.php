<?php
namespace Crud\Custom\NovumBurger\Persoon\Base;

use Crud\Custom\NovumBurger;
use Crud\FormManager;
use Crud\IApiExposable;
use Crud\IConfigurableCrud;
use Exception\LogicException;
use Model\Custom\NovumBurger\Persoonsgegevens\Map\PersoonTableMap;
use Model\Custom\NovumBurger\Persoonsgegevens\Persoon;
use Model\Custom\NovumBurger\Persoonsgegevens\PersoonQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;

/**
 * This class is automatically generated, do not modify manually.
 * Modify Persoon instead if you need to override or add functionality.
 */
abstract class CrudPersoonManager extends FormManager implements IConfigurableCrud, IApiExposable
{
	use NovumBurger\CrudTrait;
	use NovumBurger\CrudApiTrait;

	public function getQueryObject(): ModelCriteria
	{
		return PersoonQuery::create();
	}


	public function getTableMap(): TableMap
	{
		return new \Model\Custom\NovumBurger\Persoonsgegevens\Map\PersoonTableMap();
	}


	public function getShortDescription(): string
	{
		return "Dit namaak persoonsgegevens.";
	}


	public function getEntityTitle(): string
	{
		return "Persoon";
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
		return "Personen toevoegen";
	}


	public function getEditFormTitle(): string
	{
		return "Personen aanpassen";
	}


	public function getDefaultOverviewFields(): array
	{
		return ['Bsn', 'Infix', 'Voornaam', 'Achternaam', 'Vader', 'Moeder', 'GeslachtId', 'GeboorteDatum', 'GeboortePlaats', 'GeboorteLand', 'Immigratiedatum', 'HeeftNederlandsPaspoort', 'SterfDatum', 'SterfPlaats'];
	}


	public function getDefaultEditFields(): array
	{
		return ['Bsn', 'Infix', 'Voornaam', 'Achternaam', 'Vader', 'Moeder', 'GeslachtId', 'GeboorteDatum', 'GeboortePlaats', 'GeboorteLand', 'Immigratiedatum', 'HeeftNederlandsPaspoort', 'SterfDatum', 'SterfPlaats'];
	}


	/**
	 * Returns a model object of the type that this CrudManager represents.
	 * @param array $aData
	 * @return Persoon
	 */
	public function getModel(array $aData = null): Persoon
	{
		if (isset($aData['id']) && $aData['id']) {
		     $oPersoonQuery = PersoonQuery::create();
		     $oPersoon = $oPersoonQuery->findOneById($aData['id']);
		     if (!$oPersoon instanceof Persoon) {
		         throw new LogicException("Persoon should be an instance of Persoon but got something else." . __METHOD__);
		     }
		     $oPersoon = $this->fillVo($aData, $oPersoon);
		} else {
		     $oPersoon = new Persoon();
		     if (!empty($aData)) {
		         $oPersoon = $this->fillVo($aData, $oPersoon);
		     }
		}
		return $oPersoon;
	}


	/**
	 * This method is ment to be called by save so any pre and post events are triggered also.
	 * Store form data, please first perform validation by calling validate
	 * @param array $aData an array of fields that belong to this type of data
	 * @return Persoon
	 * @throws \Propel\Runtime\Exception\PropelException
	 */
	public function store(array $aData = null): Persoon
	{
		$oPersoon = $this->getModel($aData);


		 if(!empty($oPersoon))
		 {
		     $oPersoon = $this->fillVo($aData, $oPersoon);
		     $oPersoon->save();
		 }
		return $oPersoon;
	}


	/**
	 * Fills the model object with data comming from a client.
	 * @param array $aData
	 * @param Persoon $oModel
	 * @return Persoon
	 */
	protected function fillVo(array $aData, Persoon $oModel): Persoon
	{
		isset($aData['bsn']) ? $oModel->setBsn($aData['bsn']) : null;
		isset($aData['infix']) ? $oModel->setInfix($aData['infix']) : null;
		isset($aData['voornaam']) ? $oModel->setVoornaam($aData['voornaam']) : null;
		isset($aData['achternaam']) ? $oModel->setAchternaam($aData['achternaam']) : null;
		isset($aData['vader_id']) ? $oModel->setVader($aData['vader_id']) : null;
		isset($aData['moeder_id']) ? $oModel->setMoeder($aData['moeder_id']) : null;
		isset($aData['geslacht_id']) ? $oModel->setGeslachtId($aData['geslacht_id']) : null;
		isset($aData['geboorte_datum']) ? $oModel->setGeboorteDatum($aData['geboorte_datum']) : null;
		isset($aData['geboorte_plaats']) ? $oModel->setGeboortePlaats($aData['geboorte_plaats']) : null;
		isset($aData['geboorte_land_id']) ? $oModel->setGeboorteLand($aData['geboorte_land_id']) : null;
		isset($aData['immigratie_datum']) ? $oModel->setImmigratiedatum($aData['immigratie_datum']) : null;
		isset($aData['heeft_nl_paspoort']) ? $oModel->setHeeftNederlandsPaspoort($aData['heeft_nl_paspoort']) : null;
		isset($aData['sterf_datum']) ? $oModel->setSterfDatum($aData['sterf_datum']) : null;
		isset($aData['sterf_plaats']) ? $oModel->setSterfPlaats($aData['sterf_plaats']) : null;
		return $oModel;
	}
}
