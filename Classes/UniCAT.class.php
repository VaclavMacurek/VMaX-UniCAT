<?php

namespace UniCAT;

/**
 * @package VMaX-UniCAT
 *
 * @author Václav Macùrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2015 Václav Macùrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * class for easy access to class constants of chosen interfaces
 */
class UniCAT implements I_UniCAT_Options_CodeExport, I_UniCAT_Options_FileWriter, I_UniCAT_Texts_Exceptions, I_UniCAT_Options_CommentsPosition
{
	use BasicOptions,
	InstanceOptions
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
		self::$Options['booleans'] = $this -> Get_Options("UniCAT\I_UniCAT_Options_Booleans");
		self::$Options['scalars'] = $this -> Get_Options("UniCAT\I_UniCAT_Options_Scalars");
		self::$Options['code_export'] = $this -> Get_Options("UniCAT\I_UniCAT_Options_CodeExport");
		self::$Options['file_writer'] = $this -> Get_Options("UniCAT\I_UniCAT_Options_FileWriter");
		self::$Options['comments_position'] = $this -> Get_Options("UniCAT\I_UniCAT_Options_CommentsPosition");
	}
	
	/**
	 * shows available options of boolean values (as text)
	 *
	 * @return array
	 *
	 * @throws UniCAT_Exception if self::$Options was not set
	 */
	public static function Show_Options_Booleans()
	{
		/*
		 * class instance cannot be set wherever
		 */
		try
		{
			if(!empty(self::$Options['booleans']))
			{
				return self::$Options['booleans'];
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
	
	/**
	 * shows available options of scalar types
	 *
	 * @return array
	 *
	 * @throws UniCAT_Exception if self::$Options was not set (throws fatal error if instance was not set)
	 */
	public static function Show_Options_Scalars()
	{
		/*
		 * class instance cannot be set wherever
		*/
		try
		{
			if(!empty(self::$Options['scalars']))
			{
				return self::$Options['scalars'];
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
	
	/**
	 * shows available options for exporting of code
	 *
	 * @return array
	 *
	 * @throws UniCAT_Exception if self::$Options was not set
	 */
	public static function Show_Options_CodeExport()
	{
		/*
		 * class instance cannot be set wherever
		*/
		try
		{
			if(!empty(self::$Options['code_export']))
			{
				return self::$Options['code_export'];
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
	
	/**
	 * shows available options for file writing
	 *
	 * @return array
	 *
	 * @throws UniCAT_Exception if self::$Options was not set
	 */
	public static function Show_Options_FileWriter()
	{
		/*
		 * class instance cannot be set wherever
		*/
		try
		{
			if(!empty(self::$Options['file_writer']))
			{
				return self::$Options['file_writer'];
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
	
	/**
	 * shows available options for positions of comments
	 *
	 * @return array
	 *
	 * @throws UniCAT_Exception if self::$Options was not set
	 */
	public static function Show_Options_CommentsPosition()
	{
		/*
		 * class instance cannot be set wherever
			*/
		try
		{
			if(!empty(self::$Options['comments_position']))
			{
				return self::$Options['comments_position'];
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
	
	/**
	 *
	 */
	public static function function_name($param)
	{
		;
	}
}

?>