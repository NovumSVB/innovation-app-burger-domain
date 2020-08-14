<?php
namespace AdminModules\Custom\NovumBurger\Stamtabellen\Relatie_type\Base;

use AdminModules\GenericEditController;
use Crud\Custom\NovumBurger\Relatie_type\CrudRelatie_typeManager;
use Crud\FormManager;

/**
 * This class is automatically generated, do not modify manually.
 * Modify AdminModules\Custom\NovumBurger\Stamtabellen\Relatie_type instead if you need to override or add functionality.
 */
abstract class EditController extends GenericEditController
{
	public function getCrudManager(): FormManager
	{
		return new CrudRelatie_typeManager();
	}


	public function getPageTitle(): string
	{
		return "Relatie vormen";
	}
}
