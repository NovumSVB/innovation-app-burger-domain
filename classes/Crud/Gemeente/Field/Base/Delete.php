<?php 
namespace Crud\Custom\NovumBurger\Gemeente\Field\Base;

use Crud\Generic\Field\GenericDelete;
use Crud\IEventField;
use Model\Custom\NovumBurger\Stam\Gemeente;

abstract class Delete extends GenericDelete implements IEventField
{
	public function getDeleteUrl($oObject = null)
	{
		if($oObject instanceof Gemeente)
		{
		     return "/custom/novumburger/stamtabellen/gemeente/overview?_do=ConfirmDelete&id=" . $oObject->getId();
		}
		return '';
	}


	public function getIcon(): string
	{
		return "trash";
	}


	public function getUnDeleteUrl($oObject = null)
	{
		if($oObject instanceof Gemeente)
		{
		     return "/custom/novumburger/gemeente?_do=UnDelete&id=" . $oObject->getId();
		}
		return '';
	}
}
