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
 * trait of code memory
 */
trait CodeMemory
{
	/**
	 * fragments of generated global code
	 *
	 * @static
	 * @var array
	 */
	private static $Code = array();
	
	/**
	 * converts or saves generated code
	 *
	 * @return string|void
	 *
	 * @throws UniCAT_Exception if code was not set
	 * @throws UniCAT_Exception if code was not set as string
	 * @throws UniCAT_Exception if class name was not set
	 * @throws UniCAT_Exception if class name was not found
	 *
	 * @example Convert_Code($String, __CLASS__);
	 */
	public static function Convert_Code($Code="", $Class="")
	{
		try
		{
			if(empty($Code))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_MISSING);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__)[0]);
		}
		
		try
		{
			if(!is_string($Code))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_WRONGVALTYPE);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__)[0], gettype($Code), 'string');
		}
				
		try
		{
			if(empty($Class))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_MISSING);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__)[1]);
		}
		
		try
		{
			if(!class_exists($Class))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_SRC_MISSING);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__)[1], 'class '.$Class);
		}

		/*
		 * closes code into many levels defined by name of classes;
		 * prevents meeting of unrelated code
		 */
		switch(self::$ExportWay)
		{
			/*
			 * writes all stored code
			 */
			case UniCAT::UNICAT_OPTION_END:
				self::$Code[$Class][] = $Code;
				$Text = (static::$Disable_MultipleNewLines == TRUE) ? preg_replace('/([\n]+)/', "\n", implode('', self::$Code[$Class])) : implode('', self::$Code[$Class]);
				self::$Code = array();
				echo $Text;
				break;
			/*
			 * exports code (paired with any class) without writing
			 */
			case UniCAT::UNICAT_OPTION_STEP:
				self::$Code[$Class][] = $Code;
				$Text = (static::$Disable_MultipleNewLines == TRUE) ? preg_replace('/([\n]+)/', "\n", implode('', self::$Code[$Class])) : implode('', self::$Code[$Class]);
				self::$Code[$Class] = array();
				return $Text;
				break;
			/*
			 * exports code without writing - and without imploding with previously stored code
			 */
			case UniCAT::UNICAT_OPTION_SKIP:
				return $Code;
				break;
			/*
			 * saves part of code
			 */
			default:
				self::$Code[$Class][] = $Code;
				for($Order = 0; $Order < count(self::$Code[$Class]); $Order++)
				{
					self::$Code[$Class][$Order] = (static::$Disable_MultipleNewLines == TRUE) ? preg_replace('/([\n]+)/', "\n", self::$Code[$Class][$Order]) : self::$Code[$Class][$Order];
				}
		}
	}
}

?>