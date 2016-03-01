<?php

namespace UniCAT;

/**
 * @package VMaX-UniCAT
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2016 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * interfaces of options
 */

/**
 * options for boolean switching;
 * do not erase strings;
 * values of constants are displayed as text
 */
interface I_UniCAT_Options_Booleans
{
	const UNICAT_OPTION_FALSE = 'FALSE';
	const UNICAT_OPTION_TRUE = 'TRUE';
}

/**
 * options for scalar (text) variables
 */
interface I_UniCAT_Options_Scalars
{
	const UNICAT_OPTION_STRING = 'string';
	const UNICAT_OPTION_INTEGER = 'integer';
	const UNICAT_OPTION_DOUBLE = 'double';
}

/**
 * options for basic variables (scalars extended of array)
 */
interface I__UniCAT_Options_Basics extends I_UniCAT_Options_Scalars
{
	const UNICAT_OPTION_ARRAY = 'array';
}

/**
 * options for position of comments
 */
interface I_UniCAT_Options_CommentsPosition
{
	/**
	 * use to say that comment will be placed above other code
	 */
	const UNICAT_OPTION_ABOVE = 'ABOVE';
	/**
	 * use to say that comment will be placed below other code
	 */
	const UNICAT_OPTION_BELOW = 'BELOW';
}

/**
 * options for trait CodeExport
 */
interface I_UniCAT_Options_CodeExport
{
	/**
	 * go on (continue) - save generated code to static variable
	 */
	const UNICAT_OPTION_GOON = 'save';
	/**
	 * step - export generated code without writing
	 */
	const UNICAT_OPTION_STEP = 'export';
	/**
	 * end - write generated code as is - final option
	 */
	const UNICAT_OPTION_END = 'write';
	/**
	 * skip - do not save code into static variable
	 */
	const UNICAT_OPTION_SKIP = 'ignore';
}

/**
 * options for class FileWriter
 */
interface I_UniCAT_Options_FileWriter
{
	/**
	 * write - fully rewrites file
	 */
	const UNICAT_OPTION_WRITE = 'w';
	/**
	 * add - adds content into file
	 */
	const UNICAT_OPTION_ADD = 'a';
}

?>