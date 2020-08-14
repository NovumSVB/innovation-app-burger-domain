<?php
namespace AdminModules\Custom\NovumBurger\Stamtabellen\Geslacht\Base;

use AdminModules\GenericOverviewController;
use Core\LogActivity;
use Core\StatusMessage;
use Core\StatusMessageButton;
use Core\StatusModal;
use Core\Translate;
use Crud\Custom\NovumBurger\Geslacht\CrudGeslachtManager;
use Crud\FormManager;
use Model\Custom\NovumBurger\Stam\Geslacht;
use Model\Custom\NovumBurger\Stam\GeslachtQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;

/**
 * This class is automatically generated, do not modify manually.
 * Modify AdminModules\Custom\NovumBurger\Stamtabellen\Geslacht instead if you need to override or add functionality.
 */
abstract class OverviewController extends GenericOverviewController
{
	public function __construct($aGet, $aPost)
	{
		$this->setEnablePaginate(50);parent::__construct($aGet, $aPost);
	}


	public function getTitle(): string
	{
		return "Geslachten";
	}


	public function getModule(): string
	{
		return "Geslacht";
	}


	public function getManager(): FormManager
	{
		return new CrudGeslachtManager();
	}


	public function getQueryObject(): ModelCriteria
	{
		return GeslachtQuery::create();
	}


	public function doDelete(): void
	{
		$iId = $this->get('id', null, true, 'numeric');
		$oQueryObject = $this->getQueryObject();
		$oDataObject = $oQueryObject->findOneById($iId);
		if($oDataObject instanceof Geslacht){
		    LogActivity::register("Stamtabellen", "Geslachten verwijderen", $oDataObject->toArray());
		    $oDataObject->delete();
		    StatusMessage::success("Geslachten verwijderd.");
		}
		else
		{
		       StatusMessage::warning("Geslachten niet gevonden.");
		}
		$this->redirect($this->getManager()->getOverviewUrl());
	}


	final public function doConfirmDelete(): void
	{
		$iId = $this->get('id', null, true, 'numeric');
		$sMessage = Translate::fromCode("Weet je zeker dat je dit Geslachten item wilt verwijderen?");
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
