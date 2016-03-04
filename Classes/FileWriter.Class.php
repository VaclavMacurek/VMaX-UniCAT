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
 * generation of file
 */
final class FileWriter
{
	/**
	 * file name
	 *
	 * @var string
	 */
	private $File = FALSE;
	/**
	 * write/read mode
	 *
	 * @var string
	 */
	private $Mode = FALSE;
	/**
	 * file content
	 *
	 * @var string
	 */
	private $Content = FALSE;
	
	/**
	 * sets file name;
	 *
	 * @param string $File
	 *
	 * @return void
	 *
	 * @throws UniCAT_Exception if file name was not set
	 *
	 * @example FileWriter('Example.txt');
	 */
	public function __construct($File="")
	{
		try
		{
			if(empty($File))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_MISSING);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__));
		}
		
		$this -> File = $File;
	}
	
	/**
	 * sets mode for file writing
	 *
	 * @param string $Mode
	 *
	 * @return void
	 *
	 * @throws UniCAT_Exception if mode was set by wrong option
	 *
	 * @example Set_Mode('a');
	 * @example Set_Mode(UniCAT\UniCAT::UNICAT_OPTION_ADD);
	 */
	public function Set_Mode($Mode=NULL)
	{
		try
		{
			if(!in_array($Mode, UniCAT::Show_Options_FileWriter()))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__), UniCAT::Show_Options_FileWriter());
		}
		
		$this -> Mode = $Mode;
	}
	
	/**
	 * sets content of file
	 *
	 * @param string $Content
	 *
	 * @throws UniCAT_Exception if content was not set as string
	 *
	 * @example Set_Content('example');
	 */
	public function Set_Content($Content=NULL)
	{
		try
		{
			if(!in_array(gettype($Content), UniCAT::Show_Options_Scalars()))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__), gettype($Content), UniCAT::Show_Options_Scalars());
		}
		
		$this -> Content = $Content;
	}
		
	/**
	 * writing of file
	 *
	 * @return void
	 *
	 * @throws UniCAT_Exception if file name was not set
	 * @throws UniCAT_Exception if mode was not set
	 * @throws UniCAT_Exception if file content was not set
	 */
	public function Execute()
	{
		try
		{
			if($this -> File == FALSE)
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_VAR, UniCAT::UNICAT_XCPT_SEC_VAR_PRHBSTMT);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> File), 'FALSE');
		}
		
		try
		{
			if($this -> Mode == FALSE)
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_VAR, UniCAT::UNICAT_XCPT_SEC_VAR_PRHBSTMT);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Mode), 'FALSE');
		}
		
		try
		{
			if($this -> Content == FALSE)
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_VAR, UniCAT::UNICAT_XCPT_SEC_VAR_PRHBSTMT);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Content), 'FALSE');
		}
		
		/*
		 * prepares file
		 */
		$File = fopen($this -> File, $this -> Mode);
		
		try
		{
			/*
			 * writes content into file;
			 * closes file
			 */
			$this -> Content = fwrite($File, $this -> Content);
			fclose($File);
			
			/*
			 * checks if file content was written correctly
			 */
			if($this -> Content === FALSE)
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_SEC_SRC_FWFAIL);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $this -> File);
		}
	}
}

?>