<?php
namespace AdminModules\Custom\NovumBurger\Stamtabellen\Current_time\Base;

use AdminModules\GenericEditController;
use Crud\Custom\NovumBurger\Currenttime\CrudCurrenttimeManager;
use Crud\FormManager;

/**
 * This class is automatically generated, do not modify manually.
 * Modify AdminModules\Custom\NovumBurger\Stamtabellen\Current_time instead if you need to override or add functionality.
 */
abstract class EditController extends GenericEditController
{
	public function getCrudManager(): FormManager
	{
		return new CrudCurrenttimeManager();
	}


	public function getPageTitle(): string
	{
		return "Simuleert de huidige tijd, gebruikt voor datageneratoe";
	}
}
