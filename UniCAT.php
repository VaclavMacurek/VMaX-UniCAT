<?php

/**
 * @package VMaX-UniCAT
 *
 * universal classes and traits
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2015 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 */

define("UNICAT_ADR", __DIR__.'/');

/*
 * VMaX-UniCAT needs PHP of version 5.4.0 or greater
 */
if(PHP_VERSION < '5.4.0')
{
	die('VMaX-UniCAT needs PHP of version 5.4.0');
}

/*
 * Interfaces
 */
require_once (UNICAT_ADR."Interfaces/Options.Interfaces.php");
require_once (UNICAT_ADR."Interfaces/ExceptionsTexts.Interfaces.php");
/*
 * Traits
 */
require_once (UNICAT_ADR."Traits/InstanceOptions.Trait.php");
require_once (UNICAT_ADR."Traits/ErrorOptions.Trait.php");
require_once (UNICAT_ADR."Traits/CodeMemory.Trait.php");
require_once (UNICAT_ADR."Traits/CodeExport.Trait.php");
require_once (UNICAT_ADR."Traits/Comments.Trait.php");
/*
 * Exceptions
 */
require_once (UNICAT_ADR."Exceptions/UniCAT_Exception.Exception.php");
/*
 * Classes
 */
require_once (UNICAT_ADR."Classes/ClassScope.Class.php");
require_once (UNICAT_ADR."Classes/MethodScope.Class.php");
require_once (UNICAT_ADR."Classes/FileWriter.Class.php");
require_once (UNICAT_ADR."Classes/UniCAT.class.php");

?>