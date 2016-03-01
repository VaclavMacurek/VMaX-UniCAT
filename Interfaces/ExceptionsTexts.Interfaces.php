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
 * interface of exceptions texts
 */
interface I_UniCAT_Texts_Exceptions
{
	/**
	 * main part of exception text;
	 * class name;
	 */
	const UNICAT_EXCEPTIONS_MAIN_CLS = 'CLASS: %s';
	/**
	 * main part of exception text;
	 * function name;
	 */
	const UNICAT_EXCEPTIONS_MAIN_FNC = 'FUNCTION: %s';
	/**
	 * main part of exception text;
	 * parameter name;
	 */
	const UNICAT_EXCEPTIONS_MAIN_PRM = 'PARAMETER: %s';
	/**
	 * main part of exception text;
	 * parameter names;
	 */
	const UNICAT_EXCEPTIONS_MAIN_PRMS = 'PARAMETERS: %s';
	/**
	 * main part of exception text;
	 * variable name;
	 */
	const UNICAT_EXCEPTIONS_MAIN_VAR = 'VARIABLE: %s';
	/**
	 * main part of exception text;
	 * variable names;
	 */
	const UNICAT_EXCEPTIONS_MAIN_VARS = 'VARIABLES: %s';
	/**
	 * main part of exception text;
	 * line number;
	 */
	const UNICAT_EXCEPTIONS_MAIN_LINE = 'LINE: %d';
	/**
	 * main part of exception text;
	 * file name;
	 */
	const UNICAT_EXCEPTIONS_MAIN_FILE = 'FILE: %s';
	
	/**
	 * secondary part of exception text;
	 * missing param;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_MISSING = 'WARNING: Value was not set';
	/**
	 * secondary part of exception text;
	 * wrong type of param;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_WRONGVALTYPE = 'WARNING: Value was set as %s instead %s';
	/**
	 * secondary part of exception text;
	 * wrong match of regex;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_WRONGREGEX = 'WARNING: Value %s does not match pattern %s';
	/**
	 * secondary part of exception text;
	 * wrong match of printf form;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_WRONGFORM = 'WARNING: Count of arguments does not match form %s';
	/**
	 * secondary part of exception text;
	 * wrong count of arguments;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_DMDEQARGS = 'WARNING: Count of arguments has to be %d';
	/**
	 * secondary part of exception text;
	 * wrong count of arguments;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_DMDGTRARGS = 'WARNING: Count of arguments has to be higher than %d';
	/**
	 * secondary part of exception text;
	 * wrong count of arguments;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_DMDLWRARGS = 'WARNING: Count of arguments has to be lesser than %d';
	/**
	 * secondary part of exception text;
	 * wrong count of arguments;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_PRHBEQARGS = 'WARNING: Count of arguments cannot be %d';
	/**
	 * secondary part of exception text;
	 * wrong count of arguments;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_PRHBGTRARGS = 'WARNING: Count of arguments cannot be higher than %d';
	/**
	 * secondary part of exception text;
	 * wrong count of arguments;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_PRHBLWRARGS = 'WARNING: Count of arguments cannot be lesser than %d';
	/**
	 * secondary part of exception text;
	 * wrong number;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_LOWNUMBER1 = 'WARNING: Value cannot be lesser than %d';
	/**
	 * secondary part of exception text;
	 * wrong number;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_LOWNUMBER2 = 'WARNING: Value cannot be lesser than of equal to %d';
	/**
	 * secondary part of exception text;
	 * wrong number;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_GREATNUMBER1 = 'WARNING: Value cannot be greater than %d';
	/**
	 * secondary part of exception text;
	 * wrong number;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_GREATNUMBER2 = 'WARNING: Value cannot greater than or equal to %d';
	/**
	 * secondary part of exception text;
	 * wrong number;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_PRHBEQUAL = 'WARNING: Value cannot be equal to %d';
	/**
	 * secondary part of exception text;
	 * wrong number;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_DMDEQUAL = 'WARNING: Value has to be equal to %d';
	/**
	 * secondary part of exception text;
	 * wrong number;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRMS_PRHBVALEQUAL = 'WARNING: Values cannot be equal';
	/**
	 * secondary part of exception text;
	 * wrong number;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRMS_DMDVALEQUAL = 'WARNING: Values have to be equal';
	/**
	 * secondary part of exception text;
	 * wrong type;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRMS_PRHBTYPEEQUAL = 'WARNING: Types cannot be equal';
	/**
	 * secondary part of exception text;
	 * wrong type;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRMS_DMDTYPEEQUAL = 'WARNING: Types have to be equal';
	/**
	 * secondary part of exception text;
	 * wrong option;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_PRHBOPTION = 'WARNING: Value %s cannot be used';
	/**
	 * secondary part of exception text;
	 * wrong option;
	 */
	const UNICAT_EXCEPTIONS_SEC_PRM_DMDOPTION = 'WARNING: Allowed options are %s';
	/**
	 * secondary part of exception text;
	 * wrong option;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_PRHBFUNCTION1 = 'WARNING: Value %s prohibits using of this function';
	/**
	 * secondary part of exception text;
	 * wrong option;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_PRHBFUNCTION2 = 'WARNING: Value %s prohibits using of function %s';
	/**
	 * secondary part of exception text;
	 * wrong option;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_DMDFUNCTION1 = 'WARNING: Value %s demands using of this function';
	/**
	 * secondary part of exception text;
	 * wrong option;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_DMDFUNCTION2 = 'WARNING: Value %s demands using of function %s';
	/**
	 * secondary part of exception text;
	 * wrong option;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_ARRKPRHBFUNCTION1 = 'WARNING: Array dimension %s prohibits using of this function';
	/**
	 * secondary part of exception text;
	 * wrong option;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_ARRKPRHBFUNCTION2 = 'WARNING: Array dimension %s prohibits using of function %s';
	/**
	 * secondary part of exception text;
	 * wrong option;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_ARRKDMDFUNCTION1 = 'WARNING: Array dimension %s demands using of this function';
	/**
	 * secondary part of exception text;
	 * wrong option;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_ARRKDMDFUNCTION2 = 'WARNING: Array dimension %s demands using of function %s';
	/**
	 * secondary part of exception text;
	 * wrong value;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_PRHBSTMT = 'WARNING: Value cannot be %s.';
	/**
	 * secondary part of exception text;
	 * wrong value;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_DMDSTMT = 'WARNING: Value has to be %s.';
	/**
	 * secondary part of exception text;
	 * wrong value;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_DMDUNQARR = "WARNING: Array items have to be unique.";
	/**
	 * secondary part of exception text;
	 * wrong value;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_PRHBUNQARR = "WARNING: Array items have to equal.";
	/**
	 * secondary part of exception text;
	 * wrong value;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_PRHBEQARRSIZE = 'WARNING: Array cannot have %d values.';
	/**
	 * secondary part of exception text;
	 * wrong value;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_PRHBGTRARRSIZE = 'WARNING: Array cannot have more than %d values.';
	/**
	 * secondary part of exception text;
	 * wrong value;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_PRHBLWRARRSIZE = 'WARNING: Array cannot have lesser than %d values.';
	/**
	 * secondary part of exception text;
	 * wrong value;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_DMDEQARRSIZE = 'WARNING: Array has to have %d values.';
	/**
	 * secondary part of exception text;
	 * wrong value;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_DMDGTRARRSIZE = 'WARNING: Array has to have more than %d values.';
	/**
	 * secondary part of exception text;
	 * wrong value;
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_DMDLWRARRSIZE = 'WARNING: Array has to have lesser than %d values.';
	/**
	 * secondary part of exception text;
	 * wrong type
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_WRONGVALTYPE = 'WARNING: Value cannot be set as %s.';
	/**
	 * secondary part of exception text;
	 * wrong type
	 */
	const UNICAT_EXCEPTIONS_SEC_VAR_WRONGARRDMN = 'WARNING: Array cannot have more than %d dimension(s).';
	/**
	 * secondary part of exception text;
	 * wrong usage order
	 */
	const UNICAT_EXCEPTIONS_SEC_FNC_PRHBORDER = 'WARNING: This function prohibits using of function %s';
	/**
	 * secondary part of exception text;
	 * wrong usage order
	 */
	const UNICAT_EXCEPTIONS_SEC_FNC_DMDORDER = 'WARNING: This function demands using of function %s';
	/**
	 * secondary part of exception text;
	 * missing function
	 */
	const UNICAT_EXCEPTIONS_SEC_FNC_MISSING1 = 'WARNING: Function %s does not exists';
	/**
	 * secondary part of exception text;
	 * missing function
	 */
	const UNICAT_EXCEPTIONS_SEC_FNC_MISSING2 = 'WARNING: This function does not exists';
	/**
	 * secondary part of exception text;
	 * wrong type of source;
	 */
	const UNICAT_EXCEPTIONS_SEC_SRC_WRONGTYPE = 'WARNING: Source was not set as %s';
	/**
	 * secondary part of exception text;
	 * missing source;
	 */
	const UNICAT_EXCEPTIONS_SEC_SRC_MISSING = 'WARNING: Source %s does not exist';
	/**
	 * secondary part of exception text;
	 * failure of file writing;
	 */
	const UNICAT_EXCEPTIONS_SEC_SRC_FWFAIL = 'WARNING: File %s was not created';
}


?>