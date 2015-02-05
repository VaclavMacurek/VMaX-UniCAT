<?php

namespace UniCAT;

/**
 * @package VMaX-UniCAT
 *
 * @author Václav Macùrek <VaclavMacurek@seznam.cz>
 * @copyright 2014, Václav Macùrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * trait of functions for getting of various options
 */
trait BasicOptions
{
	/**
	 * options
	 *
	 * @static
	 * @var array
	 */
	protected static $Options = array();
	
	/**
	 * gets options written in constants
	 *
	 * @param string $Source
	 *
	 * @return array
	 */
	protected function Get_Options($Source="")
	{
		return array_values($this -> Get_Constants($Source));
	}
	
	/**
	 * gets class constants
	 *
	 * @param string $Source
	 *
	 * @return array
	 *
	 * @throws UniCAT_Exception if source of constants is not interface
	 */
	protected function Get_Constants($Source="")
	{
		try
		{
			if($this -> Check_IsInterface($Source))
			{
				$Scope = new ClassScope($Source);
				return $Scope -> getConstants();
			}
			else
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_SRC_WRONGTYPE);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_Parameters(__CLASS__, __FUNCTION__), 'interface');
		}
	}
	
	/**
	 * checks if "source" is interface;
	 * class or trait as alternative source of constants is not allowed - because it can contain unwanted constants
	 *
	 * @param string $Source
	 *
	 * @return boolean
	 */
	protected function Check_IsInterface($Source="")
	{
		$Scope = new ClassScope($Source);
		return $Scope -> isInterface();
	}
}

?>