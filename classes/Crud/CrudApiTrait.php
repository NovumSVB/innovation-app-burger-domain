<?php
namespace Crud\Custom\NovumBurger;

/**
 * This trait is automatically generated, do not modify manually.
 * Add custom code to the model class or add extra traits if you need to override or add functionality.
 */
trait CrudApiTrait
{
	public function getDocumentationUrl(): string
	{
		return "https://api.burger.demo.novum.nu";
	}


	public function getApiVersion(): string
	{
		return "2";
	}


	public function getApiUrl(): string
	{
		return "https://api.burger.demo.novum.nu";
	}


	public function getApiNamespace(): string
	{
		return "ApiNovumBurger";
	}
}
