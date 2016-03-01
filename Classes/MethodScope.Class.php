<?php

namespace UniCAT;

/**
 * @package VMaX-UniCAT
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2015 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * utility for access to class ReflectionMethod and its functions
 */
final class MethodScope extends \ReflectionMethod
{
	/**
	 * gets parameters of chosen function of chosen class
	 *
	 * @param string $Class
	 * @param string $Method
	 *
	 * @return mixed array|string
	 *
	 * @example Get_Parameters(__CLASS__, __FUNCTION__);
	 */
	public static function Get_Parameters($Class="", $Method="")
	{
		

		$Scope = new MethodScope($Class, $Method);
		$Params = $Scope -> getParameters();

		/*
		 * conversion of result given by core function getParameters into array
		 */
		for($Index = 0; $Index < count($Params); $Index++)
		{
			$Params[$Index] = (array) $Params[$Index];
		}

		/*
		 * extracts names of parameters
		 */
		for($Index = 0; $Index < count($Params); $Index++)
		{
			$Params[$Index] = $Params[$Index]['name'];
		}

		/*
		 * returns only parameter name, if function has only one parameter
		 */
		if(count($Params) == 1)
		{
			return $Params[0];
		}
		else
		{
			return $Params;
		}
	}
}

?>