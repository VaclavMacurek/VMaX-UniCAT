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
 * utility for access to class ReflectionClass and its functions
 */
final class ClassScope extends \ReflectionClass
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
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, $Method);
		}

		try
		{
			if(MethodScope::Check_IsPublic(__CLASS__, $Method))
			{
				call_user_func_array($Method, $Parameters);
			}
			else
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_SEC_FNC_PRHBUSE1);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__);
		}
	}

	/**
	 * gets values of constants saved in interface
	 *
	 * @param string $Source name of interface
	 *
	 * @return array values of constants given by interface
	 * 
	 * @throws UniCAT_Exception if source of constants is not interface
	 */
	public static function Get_ConstantsValues($Source)
	{
		try
		{
			if(self::Check_IsInterface($Source))
			{
				$Scope = new ClassScope($Source);
				return array_values($Scope -> getConstants());
			}
			else
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_SRC_WRONGTYPE);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), 'interface');
		}
	}

	/**
	 * gets names of constants saved in interface
	 *
	 * @param string $Source name of interface
	 * 
	 * @return array names of constants given by interface
	 *
	 * @throws UniCAT_Exception if source of constants is not interface
	 */
	public static function Get_ConstantsNames($Source)
	{
		$Namespace = explode('\\', get_class())[0];

		try
		{
			if(self::Check_IsInterface($Source))
			{
				$Scope = new ClassScope($Source);
				return array_keys($Scope -> getConstants());
			}
			else
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_SRC_WRONGTYPE);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), 'interface');
		}
	}

	/**
	 * checks if source is interface
	 *
	 * @param string $Source name of interface
	 * 
	 * @return bool TRUE if source of constants is really interface
	 */
	private static function Check_IsInterface($Source)
	{
		$Scope = new ClassScope($Source);
		return $Scope -> isInterface();
	}

}

?>