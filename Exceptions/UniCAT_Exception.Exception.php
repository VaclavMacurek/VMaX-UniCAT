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
 * exception class
 */
class UniCAT_Exception extends \Exception
{
	use ErrorOptions;
	
	/**
	 * allows to set message per parts
	 *
	 * @param string $Message
	 *
	 * @throws UniCAT_Exception if message was not set
	 *
	 * @example UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_MISSING); to tell that parameter value (argument) was not set
	 */
	public function __construct($Message)
	{
		$Message = func_get_args();

		try
		{
			if(empty($Message))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_MISSING);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__));
		}
		
		/*
		 * array of message is converted into text that may be passed to core exception class
		 */
		parent::__construct($this -> Convert_AssembleExceptionText($Message));
	}
	
	/**
	 * prepares final exception text
	 *
	 * @param string $Warning
	 *
	 * @throws UniCAT_Exception if warning placeholders do not match message given to exception constructor
	 *
	 * @example ExceptionWarning(get_called_class(), __FUNCTION__, $this -> Get_ParameterName(__CLASS__, __FUNCTION__), $Warning);
	 */
	public function ExceptionWarning($Warning)
	{
		$Warning = func_get_args();
		$Message = $this -> getMessage();
		
		/*
		 * converts accidentally used arrays into text;
		 * replaces chosen signs into entities
		 */
		for($Index = 0; $Index < count($Warning); $Index++)
		{
			if(is_array($Warning[$Index]))
			{
				$Warning[$Index] = implode(",\n\t", $Warning[$Index]);
				$Length = strlen($Warning[$Index])+4;
				$Warning[$Index] = htmlspecialchars(str_pad($Warning[$Index], $Length, "\n\t", STR_PAD_BOTH));
			}
			else
			{
				$Warning[$Index] = htmlspecialchars($Warning[$Index]);
			}
		}
		
		try
		{
			if(substr_count($Message, '%') != count($Warning))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_WRONGFORM);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), $Message);
		}
		
		/*
		 * prepares base of final exception message
		 */
		$Message = vsprintf($Message, $Warning);
		
		/*
		 * prepares additional informations for final exception messages
		 */
		$Extension = debug_backtrace();

		$Extension = array(	sprintf(UniCAT::UNICAT_XCPT_MAIN_FILE, (isset($Extension[1]['file']) ? $Extension[1]['file'] : $Extension[2]['file'])),
						sprintf(UniCAT::UNICAT_XCPT_MAIN_LINE, (isset($Extension[1]['line']) ? $Extension[1]['line'] : $Extension[2]['line']) )
						);
		
		/*
		 * converts additional informations into text
		 */
		$Extension = $this -> Convert_AddNewLineSign($Extension);
		$Extension = implode('', $Extension);

		/*
		 * implodes base exception message with additional informations
		 */
		echo get_called_class().":\n".$Message."\n\nPlace of exception:".$Extension;
		exit();
	}
	
	/**
	 * adds new line breaks into exception message - for easier reading (after displaying of code)
	 *
	 * @param string $Message
	 *
	 * @return array
	 */
	private function Convert_AddNewLineSign($Message)
	{
		/*
		 * inserts new line sign to the front of each part of exception messages;
		 * additional new line in the front of the first part separates from previous code
		 */
		for($Index = 0; $Index < count($Message); $Index++)
		{
			$Message[$Index] = "\n".$Message[$Index];
		}
		
		return $Message;
	}
	
	/**
	 * adds quotes around text inserted into exception calling - for easier reading
	 *
	 * @param string $Message
	 *
	 * @return array
	 *
	 * @throws UniCAT_Exception if message was not set
	 */
	private function Convert_AddQuotes($Message)
	{
		/*
		 * inserts quotes around texts inserted into WARNING part
		 */
		for($Index = 0; $Index < count($Message); $Index++)
		{
			if(preg_match('/WARNING\:/', $Message[$Index]))
			{
				$Message[$Index] = preg_replace('/(\%s|\%d)/', '&ldquo; $1 &rdquo;', $Message[$Index]);
			}
		}
		
		return $Message;
	}
	
	/**
	 * assembles parts of exception message into one final
	 *
	 * @param array $Message
	 *
	 * @return string
	 */
	private function Convert_AssembleExceptionText($Message)
	{
		$Message = $this -> Convert_AddQuotes($Message);
		$Message = $this -> Convert_AddNewLineSign($Message);
		
		return implode('', $Message);
	}
}

?>