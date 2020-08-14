<?php
namespace AdminModules\Custom\NovumBurger\Stamtabellen\Provincie\Base;

use AdminModules\GenericEditController;
use Crud\Custom\NovumBurger\Provincie\CrudProvincieManager;
use Crud\FormManager;

/**
 * This class is automatically generated, do not modify manually.
 * Modify AdminModules\Custom\NovumBurger\Stamtabellen\Provincie instead if you need to override or add functionality.
 */
abstract class EditController extends GenericEditController
{
	public function getCrudManager(): FormManager
	{
		return new CrudProvincieManager();
	}


	public function getPageTitle(): string
	{
		return "Provincies";
	}
}
