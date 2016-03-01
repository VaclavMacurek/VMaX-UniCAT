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
 * utility for access to class ReflectionClass and its functions
 */
final class ClassScope extends \ReflectionClass
{
	public static function Get_ConstantsValues(string $Source="")
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
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_SRC_WRONGTYPE);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__), 'interface');
		}
	}

	public static function Get_ConstantsNames(string $Source="")
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
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_SRC_WRONGTYPE);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__), 'interface');
		}
	}

	private static function Check_IsInterface(string $Source="")
	{
		$Scope = new ClassScope($Source);
		return $Scope -> isInterface();
	}

}

?>