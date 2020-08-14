<?php
namespace AdminModules\Custom\NovumBurger\Stamtabellen\Gemeente\Base;

use AdminModules\GenericOverviewController;
use Core\LogActivity;
use Core\StatusMessage;
use Core\StatusMessageButton;
use Core\StatusModal;
use Core\Translate;
use Crud\Custom\NovumBurger\Gemeente\CrudGemeenteManager;
use Crud\FormManager;
use Model\Custom\NovumBurger\Stam\Gemeente;
use Model\Custom\NovumBurger\Stam\GemeenteQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;

/**
 * This class is automatically generated, do not modify manually.
 * Modify AdminModules\Custom\NovumBurger\Stamtabellen\Gemeente instead if you need to override or add functionality.
 */
abstract class OverviewController extends GenericOverviewController
{
	public function __construct($aGet, $aPost)
	{
		$this->setEnablePaginate(50);parent::__construct($aGet, $aPost);
	}


	public function getTitle(): string
	{
		return "Gemeentes";
	}


	public function getModule(): string
	{
		return "Gemeente";
	}


	public function getManager(): FormManager
	{
		return new CrudGemeenteManager();
	}


	public function getQueryObject(): ModelCriteria
	{
		return GemeenteQuery::create();
	}


	public function doDelete(): void
	{
		$iId = $this->get('id', null, true, 'numeric');
		$oQueryObject = $this->getQueryObject();
		$oDataObject = $oQueryObject->findOneById($iId);
		if($oDataObject instanceof Gemeente){
		    LogActivity::register("Stamtabellen", "Gemeentes verwijderen", $oDataObject->toArray());
		    $oDataObject->delete();
		    StatusMessage::success("Gemeentes verwijderd.");
		}
		else
		{
		       StatusMessage::warning("Gemeentes niet gevonden.");
		}
		$this->redirect($this->getManager()->getOverviewUrl());
	}


	final public function doConfirmDelete(): void
	{
		$iId = $this->get('id', null, true, 'numeric');
		$sMessage = Translate::fromCode("Weet je zeker dat je dit Gemeentes item wilt verwijderen?");
		$sTitle = Translate::fromCode("Zeker weten?");
		$sOkUrl = $this->getManager()->getOverviewUrl() . "?id=" . $iId . "&_do=Delete";
		$sNOUrl = $this->getRequestUri();
		$sYes = Translate::fromCode("Ja");
		$sCancel = Translate::fromCode("Annuleren");
		$aButtons  = [
		   new StatusMessageButton($sYes, $sOkUrl, $sYes, "warning"),
		   new StatusMessageButton($sCancel, $sNOUrl, $sCancel, "info"),
		];
		StatusModal::warning($sMessage, $sTitle, $aButtons);
	}
}
