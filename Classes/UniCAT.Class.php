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
 * class for easy access to class constants of chosen interfaces
 */
class UniCAT implements I_UniCAT_Options_CodeExport, I_UniCAT_Options_FileWriter, I_UniCAT_Texts_Exceptions, I_UniCAT_Options_CommentsPosition
{
	/**
	 * options
	 *
	 * @static
	 * @var array
	 */
	protected static $Options = array();

	use InstanceOptions
	{
		Set_Instance as public;
	}
	
	/**
	 * prepares lists of options
	 *
	 * @return void
	 */
	public function __construct()
	{
		/**
		 * sets basic options
		 */
		self::$Options['booleans'] = ClassScope::Get_ConstantsValues('UniCAT\I_UniCAT_Options_Booleans');
		self::$Options['scalars'] = ClassScope::Get_ConstantsValues("UniCAT\I_UniCAT_Options_Scalars");
		self::$Options['basics'] = ClassScope::Get_ConstantsValues("UniCAT\I__UniCAT_Options_Basics");
		self::$Options['code_export'] = ClassScope::Get_ConstantsValues("UniCAT\I_UniCAT_Options_CodeExport");
		self::$Options['file_writer'] = ClassScope::Get_ConstantsValues("UniCAT\I_UniCAT_Options_FileWriter");
		self::$Options['comments_position'] = ClassScope::Get_ConstantsValues("UniCAT\I_UniCAT_Options_CommentsPosition");
	}
	
	/**
	 * 
	 */
	public function __call($Function, array $Parameters)
	{
		try
		{
			if(method_exists($this, $Function))
			{
				call_user_func_array(array($this, $Function), $Parameters);
			}
			else
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_SEC_FNC_MISSING1);
			}
		}
		catch(MarC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Function);
		}
	}
	
	/**
	 * allows to use functions Show_Options_[suffix]
	 *
	 * @param string $Function name of function
	 * @param array $Parameters function's parameters
	 *
	 * @return array|mixed return is related to real function called by this magic function
	 */
	public static function __callStatic($Function, array $Parameters)
	{
		$Options = array();
		$Result = preg_match('/Show_Options_(?<Option>([[:upper:]][[:lower:]]+)+)/', $Function, $Options);

		try
		{
			if(method_exists(static::Show_Instance(), $Function))
			{
				call_user_func_array($Function, $Parameters);
			}
			elseif($Result)
			{
				$Option = preg_split('/((?:^|[A-Z])[a-z]+)/', $Options['Option'], NULL, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
				$Option = strtolower(implode('_', $Option));

				return self::Show_Options($Option);
			}
			else
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_SEC_FNC_MISSING1);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), $this -> Get_CallerFunctionName(), $Function);
		}
	}

	/**
	 * shows options for various cases;
	 * used via magic function __callStatic with CamelCased suffix according to key in array self::$Options;
	 * full name of functions derived from this is Show_Options_Basics or Show_Options_CodeExport (or else)
	 *
	 * @param string CamelCased name of key in array self::$Options
	 *
	 * @return array values attached to key given by parameter
	 *
	 * @throws UniCAT_Exception if array self::$Options is not ready
	 */
	protected static function Show_Options($Option)
	{
		/*
		 * class instance cannot be set wherever
		 */
		try
		{
			if(!empty(self::$Options[$Option]))
			{
				return self::$Options[$Option];
			}
			else
			{
				throw new UniCAT_Exception(self::UNICAT_EXCEPTIONS_MAIN_CLS, self::UNICAT_EXCEPTIONS_MAIN_FNC, self::UNICAT_EXCEPTIONS_MAIN_VAR, self::UNICAT_EXCEPTIONS_SEC_VAR_PRHBSTMT);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText(self::$Options), 'empty');
		}
	}
}

?>