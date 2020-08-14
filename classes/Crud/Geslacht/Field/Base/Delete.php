<?php 
namespace Crud\Custom\NovumBurger\Geslacht\Field\Base;

use Crud\Generic\Field\GenericDelete;
use Crud\IEventField;
use Model\Custom\NovumBurger\Stam\Geslacht;

abstract class Delete extends GenericDelete implements IEventField
{
	public function getDeleteUrl($oObject = null)
	{
		if($oObject instanceof Geslacht)
		{
		     return "/custom/novumburger/stamtabellen/geslacht/overview?_do=ConfirmDelete&id=" . $oObject->getId();
		}
		return '';
	}


	public function getIcon(): string
	{
		return "trash";
	}


	public function getUnDeleteUrl($oObject = null)
	{
		if($oObject instanceof Geslacht)
		{
		     return "/custom/novumburger/geslacht?_do=UnDelete&id=" . $oObject->getId();
		}
		return '';
	}
}
