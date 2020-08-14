<?php 
namespace Crud\Custom\NovumBurger\Land\Field\Base;

use Crud\Generic\Field\GenericDelete;
use Crud\IEventField;
use Model\Custom\NovumBurger\Stam\Land;

abstract class Delete extends GenericDelete implements IEventField
{
	public function getDeleteUrl($oObject = null)
	{
		if($oObject instanceof Land)
		{
		     return "/custom/novumburger/stamtabellen/land/overview?_do=ConfirmDelete&id=" . $oObject->getId();
		}
		return '';
	}


	public function getIcon(): string
	{
		return "trash";
	}


	public function getUnDeleteUrl($oObject = null)
	{
		if($oObject instanceof Land)
		{
		     return "/custom/novumburger/land?_do=UnDelete&id=" . $oObject->getId();
		}
		return '';
	}
}
