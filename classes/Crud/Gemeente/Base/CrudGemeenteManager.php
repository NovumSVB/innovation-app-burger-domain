<?php
namespace Crud\Custom\NovumBurger\Gemeente\Base;

use Crud\Custom\NovumBurger;
use Crud\FormManager;
use Crud\IApiExposable;
use Crud\IConfigurableCrud;
use Exception\LogicException;
use Model\Custom\NovumBurger\Stam\Gemeente;
use Model\Custom\NovumBurger\Stam\GemeenteQuery;
use Model\Custom\NovumBurger\Stam\Map\GemeenteTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;

/**
 * This class is automatically generated, do not modify manually.
 * Modify Gemeente instead if you need to override or add functionality.
 */
abstract class CrudGemeenteManager extends FormManager implements IConfigurableCrud, IApiExposable
{
	use NovumBurger\CrudTrait;
	use NovumBurger\CrudApiTrait;

	public function getQueryObject(): ModelCriteria
	{
		return GemeenteQuery::create();
	}


	public function getTableMap(): TableMap
	{
		return new \Model\Custom\NovumBurger\Stam\Map\GemeenteTableMap();
	}


	public function getShortDescription(): string
	{
		return "Dit endpoint bevat gemeentes.";
	}


	public function getEntityTitle(): string
	{
		return "Gemeente";
	}


	public function getOverviewUrl(): string
	{
		return "/custom/novumburger/stamtabellen/gemeente/overview";
	}


	public function getEditUrl(): string
	{
		return "/custom/novumburger/stamtabellen/gemeente/edit";
	}


	public function getCreateNewUrl(): string
	{
		return $this->getEditUrl();
	}


	public function getNewFormTitle(): string
	{
		return "Gemeentes toevoegen";
	}


	public function getEditFormTitle(): string
	{
		return "Gemeentes aanpassen";
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
	 * @return Gemeente
	 */
	public function getModel(array $aData = null): Gemeente
	{
		if (isset($aData['id']) && $aData['id']) {
		     $oGemeenteQuery = GemeenteQuery::create();
		     $oGemeente = $oGemeenteQuery->findOneById($aData['id']);
		     if (!$oGemeente instanceof Gemeente) {
		         throw new LogicException("Gemeente should be an instance of Gemeente but got something else." . __METHOD__);
		     }
		     $oGemeente = $this->fillVo($aData, $oGemeente);
		} else {
		     $oGemeente = new Gemeente();
		     if (!empty($aData)) {
		         $oGemeente = $this->fillVo($aData, $oGemeente);
		     }
		}
		return $oGemeente;
	}


	/**
	 * This method is ment to be called by save so any pre and post events are triggered also.
	 * Store form data, please first perform validation by calling validate
	 * @param array $aData an array of fields that belong to this type of data
	 * @return Gemeente
	 * @throws \Propel\Runtime\Exception\PropelException
	 */
	public function store(array $aData = null): Gemeente
	{
		$oGemeente = $this->getModel($aData);


		 if(!empty($oGemeente))
		 {
		     $oGemeente = $this->fillVo($aData, $oGemeente);
		     $oGemeente->save();
		 }
		return $oGemeente;
	}


	/**
	 * Fills the model object with data comming from a client.
	 * @param array $aData
	 * @param Gemeente $oModel
	 * @return Gemeente
	 */
	protected function fillVo(array $aData, Gemeente $oModel): Gemeente
	{
		isset($aData['naam']) ? $oModel->setNaam($aData['naam']) : null;
		return $oModel;
	}
}
