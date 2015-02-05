<?php

namespace UniCAT;

/**
 * @package VMaX-UniCAT
 *
 * @author V�clav Mac�rek <VaclavMacurek@seznam.cz>
 * @copyright 2014, V�clav Mac�rek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * trait of functions for getting informations used in exceptions
 */
trait ErrorOptions
{
	/**
	 * gets parameters of chosen function of chosen class
	 *
	 * @param string $Class
	 * @param string $Method
	 *
	 * @return mixed array|string
	 */
	public function Get_Parameters($Class="", $Method="")
	{
		$Scope = new MethodScope($Class, $Method);
		$Params = $Scope -> getParameters();
		
		/*
		 * conversion of result given by core function getParameters into array
		 */
		for($Order = 0; $Order < count($Params); $Order++)
		{
			$Params[$Order] = (array) $Params[$Order];
		}
		
		/*
		 * extracts names of parameters
		 */
		for($Order = 0; $Order < count($Params); $Order++)
		{
			$Params[$Order] = $Params[$Order]['name'];
		}
		
		/*
		 * returns only parameter name, if function has only one parameter
		 */
		if(count($Params) == 1)
		{
			return $Params[0];
		}
		else
		{
			return $Params;
		}
	}
	
	/**
	 * gets name of function that is using current function
	 *
	 * @return string
	 */
	public function Get_CallerFunctionName()
	{
		$Function = debug_backtrace();
		$Level = count($Function)-1;
		return $Function[$Level]['function'];
	}
	
	/**
	 * gets name of variable
	 *
	 * @param string $Variable
	 * @param integer $Index
	 *
	 * @return string
	 *
	 * @throws UniCAT_Exception if $Index was not set as integer
	 */
	public function Get_VariableNameAsText($Variable="", $Index="")
	{
		/*
		 * gets name of file where function was called
		 */
		$File = file(debug_backtrace()[0]['file']);
		
		try
		{
			if(!empty($Index) && !is_integer($Index))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_WRONGVALTYPE);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $this -> Get_Parameters(__CLASS__, __FUNCTION__)[1], gettype($Index), 'integer');
		}
		
		/*
		 * searches for line of calling of function
		 */
		for($Line = 1; $Line < count($File); $Line++)
		{
			if($Line == debug_backtrace()[0]['line']-1)
			{
				/*
				 * searching for calling of function;
				 * used expression allows all three types of variable (static, member non-static, non-static);
				 * allows different kinds of writing of member non-static ($this->var, $this -> var, $this-> var, $this ->var)
				 */
				preg_match_all('/'.__FUNCTION__.'\((?<type>[a-z]{1,}\:{2}\${1}|\$this\x20{0,1}\-\>{1}\x20{0,1}|\${1})(?<variable>[A-Za-z0-9_]{1,})\x20{0,1}\,{0,1}\x20{0,1}(?<index>[0-9]{0,})\x20{0,}\)/', $File[$Line], $VariableName, PREG_SET_ORDER);
				
				/*
				 * using of index allows more callings of function per line
				 */
				if(empty($Index))
				{
					return $VariableName[0]['type'].$VariableName[0]['variable'];
				}
				else
				{
					return $VariableName[$Index]['type'].$VariableName[$Index]['variable'];
				}
			}
		}
	}
}

?>