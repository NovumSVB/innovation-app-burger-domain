<?php
namespace AdminModules\Custom\NovumBurger\Stamtabellen\Current_time\Base;

use AdminModules\GenericOverviewController;
use Core\LogActivity;
use Core\StatusMessage;
use Core\StatusMessageButton;
use Core\StatusModal;
use Core\Translate;
use Crud\Custom\NovumBurger\Currenttime\CrudCurrenttimeManager;
use Crud\FormManager;
use Model\Custom\NovumBurger\DataGeneratie\Currenttime;
use Model\Custom\NovumBurger\DataGeneratie\CurrenttimeQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;

/**
 * This class is automatically generated, do not modify manually.
 * Modify AdminModules\Custom\NovumBurger\Stamtabellen\Current_time instead if you need to override or add functionality.
 */
abstract class OverviewController extends GenericOverviewController
{
	public function __construct($aGet, $aPost)
	{
		$this->setEnablePaginate(50);parent::__construct($aGet, $aPost);
	}


	public function getTitle(): string
	{
		return "Simuleert de huidige tijd, gebruikt voor datageneratoe";
	}


	public function getModule(): string
	{
		return "Currenttime";
	}


	public function getManager(): FormManager
	{
		return new CrudCurrenttimeManager();
	}


	public function getQueryObject(): ModelCriteria
	{
		return CurrenttimeQuery::create();
	}


	public function doDelete(): void
	{
		$iId = $this->get('id', null, true, 'numeric');
		$oQueryObject = $this->getQueryObject();
		$oDataObject = $oQueryObject->findOneById($iId);
		if($oDataObject instanceof Currenttime){
		    LogActivity::register("Stamtabellen", "Simuleert de huidige tijd, gebruikt voor datageneratoe verwijderen", $oDataObject->toArray());
		    $oDataObject->delete();
		    StatusMessage::success("Simuleert de huidige tijd, gebruikt voor datageneratoe verwijderd.");
		}
		else
		{
		       StatusMessage::warning("Simuleert de huidige tijd, gebruikt voor datageneratoe niet gevonden.");
		}
		$this->redirect($this->getManager()->getOverviewUrl());
	}


	final public function doConfirmDelete(): void
	{
		$iId = $this->get('id', null, true, 'numeric');
		$sMessage = Translate::fromCode("Weet je zeker dat je dit Simuleert de huidige tijd, gebruikt voor datageneratoe item wilt verwijderen?");
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
