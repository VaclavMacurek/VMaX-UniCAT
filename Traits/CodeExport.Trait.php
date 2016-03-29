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
	protected static $ExportWay = UniCAT::UNICAT_OPTION_SKIP;
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
	 * @param string $Way way of export
	 *
	 * @throws UniCAT_Exception if wrong value was used to set way of export
	 *
	 * @example Set_ExportWay(); to set that code will be written to screen
	 * @example Set_ExportWay(UniCAT\UniCAT::UNICAT_OPTION_END); to set that code will be written to screen
	 * @example Set_ExportWay('write'); to set that code will be written to screen
	 */
	public function Set_ExportWay($Way=UniCAT::UNICAT_OPTION_END)
	{
		try
		{
			if(in_array(strtolower($Way), UniCAT::ShowOptions_CodeExport()))
			{
				static::$ExportWay = $Way;
			}
			else
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), UniCAT::ShowOptions_CodeExport());
		}
	}
	
	/**
	 * disables multiple new lines;
	 * two or more multiple new lines will be replaced with only single new line
	 */
	public static function Set_DisableMultipleNewLines()
	{
		static::$Disable_MultipleNewLines = TRUE;
	}
	
	/**
	 * enables multiple new lines;
	 * two or more multiple new lines will not be replaced with only single new line
	 */
	public static function Set_EnableMultipleNewLines()
	{
		static::$Disable_MultipleNewLines = FALSE;
	}
}

?>