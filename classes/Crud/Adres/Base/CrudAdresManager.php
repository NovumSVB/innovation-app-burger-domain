<?php
namespace Crud\Custom\NovumBurger\Adres\Base;

use Crud\Custom\NovumBurger;
use Crud\FormManager;
use Crud\IApiExposable;
use Crud\IConfigurableCrud;
use Exception\LogicException;
use Model\Custom\NovumBurger\Persoonsgegevens\Adres;
use Model\Custom\NovumBurger\Persoonsgegevens\AdresQuery;
use Model\Custom\NovumBurger\Persoonsgegevens\Map\AdresTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;

/**
 * This class is automatically generated, do not modify manually.
 * Modify Adres instead if you need to override or add functionality.
 */
abstract class CrudAdresManager extends FormManager implements IConfigurableCrud, IApiExposable
{
	use NovumBurger\CrudTrait;
	use NovumBurger\CrudApiTrait;

	public function getQueryObject(): ModelCriteria
	{
		return AdresQuery::create();
	}


	public function getTableMap(): TableMap
	{
		return new \Model\Custom\NovumBurger\Persoonsgegevens\Map\AdresTableMap();
	}


	public function getShortDescription(): string
	{
		return "Dit endpoint bevat namaak adres gegevens.";
	}


	public function getEntityTitle(): string
	{
		return "Adres";
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
		return "Adressen toevoegen";
	}


	public function getEditFormTitle(): string
	{
		return "Adressen aanpassen";
	}


	public function getDefaultOverviewFields(): array
	{
		return ['PersoonId', 'ProvincieId', 'GemeenteId', 'Straat', 'Huisnummer', 'Postcode'];
	}


	public function getDefaultEditFields(): array
	{
		return ['PersoonId', 'ProvincieId', 'GemeenteId', 'Straat', 'Huisnummer', 'Postcode'];
	}


	/**
	 * Returns a model object of the type that this CrudManager represents.
	 * @param array $aData
	 * @return Adres
	 */
	public function getModel(array $aData = null): Adres
	{
		if (isset($aData['id']) && $aData['id']) {
		     $oAdresQuery = AdresQuery::create();
		     $oAdres = $oAdresQuery->findOneById($aData['id']);
		     if (!$oAdres instanceof Adres) {
		         throw new LogicException("Adres should be an instance of Adres but got something else." . __METHOD__);
		     }
		     $oAdres = $this->fillVo($aData, $oAdres);
		} else {
		     $oAdres = new Adres();
		     if (!empty($aData)) {
		         $oAdres = $this->fillVo($aData, $oAdres);
		     }
		}
		return $oAdres;
	}


	/**
	 * This method is ment to be called by save so any pre and post events are triggered also.
	 * Store form data, please first perform validation by calling validate
	 * @param array $aData an array of fields that belong to this type of data
	 * @return Adres
	 * @throws \Propel\Runtime\Exception\PropelException
	 */
	public function store(array $aData = null): Adres
	{
		$oAdres = $this->getModel($aData);


		 if(!empty($oAdres))
		 {
		     $oAdres = $this->fillVo($aData, $oAdres);
		     $oAdres->save();
		 }
		return $oAdres;
	}


	/**
	 * Fills the model object with data comming from a client.
	 * @param array $aData
	 * @param Adres $oModel
	 * @return Adres
	 */
	protected function fillVo(array $aData, Adres $oModel): Adres
	{
		isset($aData['persoon_id']) ? $oModel->setPersoonId($aData['persoon_id']) : null;
		isset($aData['provincie_id']) ? $oModel->setProvincieId($aData['provincie_id']) : null;
		isset($aData['gemeente_id']) ? $oModel->setGemeenteId($aData['gemeente_id']) : null;
		isset($aData['straat']) ? $oModel->setStraat($aData['straat']) : null;
		isset($aData['huisnummer']) ? $oModel->setHuisnummer($aData['huisnummer']) : null;
		isset($aData['postcode']) ? $oModel->setPostcode($aData['postcode']) : null;
		return $oModel;
	}
}
