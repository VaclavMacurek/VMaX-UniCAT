<?php

namespace UniCAT;

/**
 * @package VMaX-UniCAT
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2015 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * trait of functions for getting informations used in exceptions
 */
trait ErrorOptions
{	
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
	 *
	 * @example Get_VariableNameAsText($Variable, '0')
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
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__)[1], gettype($Index), 'integer');
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