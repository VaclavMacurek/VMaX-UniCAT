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
 * utility for access to class ReflectionMethod and its functions
 */
final class MethodScope extends \ReflectionMethod
{
	/**
	 * prevents calling of non-public functions from external scope
	 *
	 * @param string $Method function name
	 * @param array $Parameters parametersa of function
	 *
	 * @throws UniCAT_Exception if function does not exist
	 * @throws UniCAT_Exception if function is not public
	 */
	public static function __callStatic($Method, $Parameters)
	{
		/*
		 * function hmust exist
		 */
		try
		{
			if(!method_exists(__CLASS__, $Method))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_SEC_FNC_MISSING1);
			}
			else
			{
				call_user_func_array($Method, $Parameters);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, $Method);
		}
	}

	/**
	 * gets name of parameter of chosen method
	 *
	 * @param string $Class name of class
	 * @param string $Method name of function
	 * @param integer $Index index of chosen parameter
	 *
	 * @return string
	 *
	 * @example Get_ParameterName(__CLASS__, __FUNCTION__); to get name of the first parameter (name is without $)
	 * @example Get_ParameterName(__CLASS__, __FUNCTION__, 2); to get name of the third parameter (name is without $)
	 */
	public static function Get_ParameterName($Class, $Method, $Index=0)
	{
		$Scope = new MethodScope($Class, $Method);
		$Params = $Scope -> getParameters();
		return $Params[$Index] -> getName();
	}

	/**
	 * gets type of parameter of chosen method
	 *
	 * @param string $Class name of class
	 * @param string $Method name of function
	 * @param integer $Index index of chosen parameter
	 *
	 * @return string
	 *
	 * @example Get_ParameterName(__CLASS__, __FUNCTION__); to get name of the first parameter (name is without $)
	 * @example Get_ParameterName(__CLASS__, __FUNCTION__, 2); to get name of the third parameter (name is without $)
	 */
	public static function Get_ParameterType($Class, $Method, $Index=0)
	{
		$Scope = new MethodScope($Class, $Method);
		$Params = $Scope -> getParameters();
		return $Params[$Index] -> getType();
	}

	public static function Get_ParameterDefaultValue($Class, $Method, $Index=0)
	{
		$Scope = new MethodScope($Class, $Method);
		$Params = $Scope -> getParameters();
		return $Params[$Index] -> getDefaultValue();
	}

	/**
	 * checks if function is public
	 *
	 * @param string $Class name of class
	 * @param string $Method name of function
	 * 
	 * @return bool
	 *
	 * @example Get_ParameterName('ExampleClass', 'ExampleMethod'); to check if is public function called ExampleFunction of class called ExampleClass
	 */
	public static function Check_IsPublic($Class, $Method)
	{
		$Scope = new MethodScope($Class, $Method);
		return $Scope -> isPublic();
	}
}

?>