<?php
namespace AdminModules\Custom\NovumBurger\Stamtabellen\Gemeente\Base;

use AdminModules\GenericEditController;
use Crud\Custom\NovumBurger\Gemeente\CrudGemeenteManager;
use Crud\FormManager;

/**
 * This class is automatically generated, do not modify manually.
 * Modify AdminModules\Custom\NovumBurger\Stamtabellen\Gemeente instead if you need to override or add functionality.
 */
abstract class EditController extends GenericEditController
{
	public function getCrudManager(): FormManager
	{
		return new CrudGemeenteManager();
	}


	public function getPageTitle(): string
	{
		return "Gemeentes";
	}
}
