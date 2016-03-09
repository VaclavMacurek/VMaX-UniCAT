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
 *
 * @method array Show_options_Booleans(); show boolean options, only for special uses
 * @method array Show_Options_Scalars(); show selected scalar types
 * @method array Show_Options_Basics(); show selected basic types
 * @method array Show_Options_CodeExport(); show options how code will be handled (written to screen, saved in static variable, ...)
 * @method array Show_Options_FileWriter(); show selected options for writing of file
 * @method array Show_Options_CommentsPosition(); show options for position of comment
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
	 * prepares lists of options;
	 * reads chosen interfaces and saves values of constants
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
	 * allows to use functions Show_Options_[suffix];
	 * prevents calling of non-public functions from external scope
	 *
	 * @param string $Function name of function
	 * @param array $Parameters function's parameters
	 *
	 * @return array|mixed return is related to real function called by this magic function
	 */
	public static function __callStatic($Method, $Parameters)
	{		
		$Options = array();
		$Error = 0;
		$Result = preg_match('/Show_Options_(?<Option>([[:upper:]][[:lower:]]+)+)/', $Method, $Options);

		try
		{
			if(method_exists(get_called_class(), $Method))
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
			else
			{
				if($Result)
				{
					$Option = preg_split('/((?:^|[A-Z])[a-z]+)/', $Options['Option'], NULL, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
					$Option = strtolower(implode('_', $Option));

					return self::Show_Options($Option);
				}
				else
				{
					throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_SEC_FNC_MISSING1);
				}
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), $Method);
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
	 *
	 * @example Show_options('basics'); to get basic variable types
	 */
	protected static function Show_Options($Option)
	{
		try
		{
			if(!empty(self::$Options[$Option]))
			{
				return self::$Options[$Option];
			}
			else
			{
				throw new UniCAT_Exception(self::UNICAT_XCPT_MAIN_CLS, self::UNICAT_XCPT_MAIN_FNC, self::UNICAT_XCPT_MAIN_VAR, self::UNICAT_XCPT_SEC_VAR_PRHBSTMT);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText(self::$Options), 'empty');
		}
	}
}

?>