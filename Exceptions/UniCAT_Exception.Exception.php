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
 * exception class
 */
class UniCAT_Exception extends \Exception implements I_UniCAT_Texts_Exceptions
{
	use ErrorOptions;
	
	/**
	 * allows to set message per parts
	 *
	 * @param string $Message
	 *
	 * @return void
	 *
	 * @throws UniCAT_Exception if message was not set
	 */
	public function __construct($Message="")
	{
		$Message = func_get_args();
		
		try
		{
			if(count($Message) == 0)
			{
				throw new UniCAT_Exception(self::UNICAT_EXCEPTIONS_MAIN_CLS, self::UNICAT_EXCEPTIONS_MAIN_FNC, self::UNICAT_EXCEPTIONS_MAIN_PRM, self::UNICAT_EXCEPTIONS_SEC_PRM_MISSING);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $this -> Get_Parameters(__CLASS__, __FUNCTION__));
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
	 * @return void
	 *
	 * @throws UniCAT_Exception if warning placeholders were not set
	 */
	public function ExceptionWarning($Warning="")
	{
		$Warning = func_get_args();
		$Message = $this -> getMessage();
		
		try
		{
			if(empty($Warning))
			{
				throw new UniCAT_Exception(self::UNICAT_EXCEPTIONS_MAIN_CLS, self::UNICAT_EXCEPTIONS_MAIN_FNC, self::UNICAT_EXCEPTIONS_MAIN_PRM, self::UNICAT_EXCEPTIONS_SEC_PRM_MISSING);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $this -> Get_Parameters(__CLASS__, __FUNCTION__), $Warning);
		}
		
		/*
		 * converts accidentally used arrays into text;
		 * replaces chosen signs into entities
		 */
		for($Order = 0; $Order < count($Warning); $Order++)
		{
			if(is_array($Warning[$Order]))
			{
				$Warning[$Order] = htmlspecialchars(implode(", ", $Warning[$Order]));
			}
			else
			{
				$Warning[$Order] = htmlspecialchars($Warning[$Order]);
			}
		}
		
		try
		{
			if(substr_count($Message, '%') != count($Warning))
			{
				throw new UniCAT_Exception(self::UNICAT_EXCEPTIONS_MAIN_CLS, self::UNICAT_EXCEPTIONS_MAIN_FNC, self::UNICAT_EXCEPTIONS_MAIN_PRM, self::UNICAT_EXCEPTIONS_SEC_PRM_WRONGFORM);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $this -> Get_Parameters(__CLASS__, __FUNCTION__), $Message);
		}
		
		/*
		 * prepares base of final exception message
		 */
		$Message = vsprintf($Message, $Warning);
		
		/*
		 * prepares additional informations for final exception messages
		 */
		$Extension = debug_backtrace();
		$Extension = array(	sprintf(self::UNICAT_EXCEPTIONS_MAIN_FILE, $Extension[1]['file']),
							sprintf(self::UNICAT_EXCEPTIONS_MAIN_LINE, $Extension[1]['line'])
							);
		
		/*
		 * converts additional informations into text
		 */
		$Extension = $this -> Convert_AddNewLineSign($Extension);
		$Extension = implode('', $Extension);

		/*
		 * implodes base exception message with additional informations
		 */
		echo $Message."\n\nPlace of exception:".$Extension;
		exit();
	}
	
	/**
	 * adds new line breaks into exception message - for easier reading (only after displaying of code)
	 *
	 * @param string $Message
	 *
	 * @return array
	 *
	 * @throws UniCAT_Exception if message was not set
	 */
	private function Convert_AddNewLineSign($Message="")
	{
		try
		{
			if(empty($Message))
			{
				throw new UniCAT_Exception(self::UNICAT_EXCEPTIONS_MAIN_CLS, self::UNICAT_EXCEPTIONS_MAIN_FNC, self::UNICAT_EXCEPTIONS_MAIN_PRM, self::UNICAT_EXCEPTIONS_SEC_PRM_MISSING);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $this -> Get_Parameters(__CLASS__, __FUNCTION__));
		}
		
		/*
		 * inserts new line sign to the front of each part of exception messages;
		 * additional new line in the front of the first part separates from previous code
		 */
		for($Order = 0; $Order < count($Message); $Order++)
		{
			$Message[$Order] = "\n".$Message[$Order];
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
	private function Convert_AddQuotes($Message="")
	{
		try
		{
			if(empty($Message))
			{
				throw new UniCAT_Exception(self::UNICAT_EXCEPTIONS_MAIN_CLS, self::UNICAT_EXCEPTIONS_MAIN_FNC, self::UNICAT_EXCEPTIONS_MAIN_PRM, self::UNICAT_EXCEPTIONS_SEC_PRM_MISSING);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $this -> Get_Parameters(__CLASS__, __FUNCTION__));
		}
		
		/*
		 * inserts quotes around texts inserted into WARNING part
		 */
		for($Order = 0; $Order < count($Message); $Order++)
		{
			if(preg_match('/WARNING\:/', $Message[$Order]))
			{
				$Message[$Order] = preg_replace('/(\%s|\%d)/', '&ldquo; $1 &rdquo;', $Message[$Order]);
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
	private function Convert_AssembleExceptionText($Message="")
	{
		$Message = $this -> Convert_AddQuotes($Message);
		$Message = $this -> Convert_AddNewLineSign($Message);
		
		return implode('', $Message);
	}
}

?>