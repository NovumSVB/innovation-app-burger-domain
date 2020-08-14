<?php
namespace AdminModules\Custom\NovumBurger\Stamtabellen\Relatie_type\Base;

use AdminModules\GenericOverviewController;
use Core\LogActivity;
use Core\StatusMessage;
use Core\StatusMessageButton;
use Core\StatusModal;
use Core\Translate;
use Crud\Custom\NovumBurger\Relatie_type\CrudRelatie_typeManager;
use Crud\FormManager;
use Model\Custom\NovumBurger\Stam\Relatie_type;
use Model\Custom\NovumBurger\Stam\Relatie_typeQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;

/**
 * This class is automatically generated, do not modify manually.
 * Modify AdminModules\Custom\NovumBurger\Stamtabellen\Relatie_type instead if you need to override or add functionality.
 */
abstract class OverviewController extends GenericOverviewController
{
	public function __construct($aGet, $aPost)
	{
		$this->setEnablePaginate(50);parent::__construct($aGet, $aPost);
	}


	public function getTitle(): string
	{
		return "Relatie vormen";
	}


	public function getModule(): string
	{
		return "Relatie_type";
	}


	public function getManager(): FormManager
	{
		return new CrudRelatie_typeManager();
	}


	public function getQueryObject(): ModelCriteria
	{
		return Relatie_typeQuery::create();
	}


	public function doDelete(): void
	{
		$iId = $this->get('id', null, true, 'numeric');
		$oQueryObject = $this->getQueryObject();
		$oDataObject = $oQueryObject->findOneById($iId);
		if($oDataObject instanceof Relatie_type){
		    LogActivity::register("Stamtabellen", "Relatie vormen verwijderen", $oDataObject->toArray());
		    $oDataObject->delete();
		    StatusMessage::success("Relatie vormen verwijderd.");
		}
		else
		{
		       StatusMessage::warning("Relatie vormen niet gevonden.");
		}
		$this->redirect($this->getManager()->getOverviewUrl());
	}


	final public function doConfirmDelete(): void
	{
		$iId = $this->get('id', null, true, 'numeric');
		$sMessage = Translate::fromCode("Weet je zeker dat je dit Relatie vormen item wilt verwijderen?");
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
