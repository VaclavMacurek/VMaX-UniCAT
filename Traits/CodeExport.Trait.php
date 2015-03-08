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
 * trait of function for setting of exporting of code
 */
trait CodeExport
{
	/**
	 * chosen way of export
	 *
	 * @static
	 * @var string
	 */
	protected static $ExportWay;
	/**
	 * disables multiple new lines
	 *
	 * @static
	 * @var boolean
	 */
	protected static $Disable_MultipleNewLines = FALSE;
	/**
	 * variable for in-class memory of generated code
	 *
	 * @var string
	 */
	private $LocalCode;
	
	/**
	 * setting of type of code export;
	 * default option is "write"
	 *
	 * @param string $Type
	 *
	 * @return void
	 * @throws UniCAT_Exception
	 */
	public static function Set_ExportWay($Way="")
	{
		try
		{
			if(empty($Way))
			{
				static::$ExportWay = UniCAT::UNICAT_OPTION_END;
			}
			else
			{
				if(in_array(strtolower($Way), UniCAT::Show_Options_CodeExport()))
				{
					static::$ExportWay = $Way;
				}
				else
				{
					throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_DMDOPTION);
				}
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_Parameters(get_called_class(), __FUNCTION__), UniCAT::Show_Options_CodeExport());
		}
	}
	
	/**
	 * disables multiple new lines;
	 * two or more multiple new lines will be replaced with only single new line
	 *
	 * @return void
	 */
	public static function Set_DisableMultipleNewLines()
	{
		static::$Disable_MultipleNewLines = TRUE;
	}
	
	/**
	 * enables multiple new lines;
	 * two or more multiple new lines will not be replaced with only single new line
	 *
	 * @return void
	 */
	public static function Set_EnableMultipleNewLines()
	{
		static::$Disable_MultipleNewLines = FALSE;
	}
}

?>