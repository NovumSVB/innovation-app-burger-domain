<?php 
namespace Crud\Custom\NovumBurger\Provincie\Field\Base;

use Crud\Generic\Field\GenericDelete;
use Crud\IEventField;
use Model\Custom\NovumBurger\Stam\Provincie;

abstract class Delete extends GenericDelete implements IEventField
{
	public function getDeleteUrl($oObject = null)
	{
		if($oObject instanceof Provincie)
		{
		     return "/custom/novumburger/stamtabellen/provincie/overview?_do=ConfirmDelete&id=" . $oObject->getId();
		}
		return '';
	}


	public function getIcon(): string
	{
		return "trash";
	}


	public function getUnDeleteUrl($oObject = null)
	{
		if($oObject instanceof Provincie)
		{
		     return "/custom/novumburger/provincie?_do=UnDelete&id=" . $oObject->getId();
		}
		return '';
	}
}
