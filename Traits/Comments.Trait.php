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
 * trait of functions for getting of various options
 */
trait Comments
{
	/**
	 * text of comment and where it will be placed
	 *
	 * @static
	 * @var array
	 */
	protected static $Comments = array();
	
	/**
	 * sets comment's text and position
	 *
	 * @param string $Text
	 * @param string $Position
	 *
	 * @return void
	 *
	 * @throws UniCAT_Exception if comment was not set
	 * @throws UniCAT_Exception if position setting was set wrong
	 *
	 * @example Set_Comment('example comment');
	 * @example Set_Comment('example comment', UniCAT\UniCAT::UNICAT_OPTION_ABOVE);
	 */
	public function Set_Comment($Text="", $Position=UniCAT::UNICAT_OPTION_ABOVE)
	{
		try
		{
			if(empty($Text))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_MISSING);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__)[0]);
		}
	
		try
		{
			if(!in_array($Position, UniCAT::Show_Options_CommentsPosition()))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_DMDOPTION);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__)[1], UniCAT::Show_Options_CommentPosition());
		}
	
		static::$Comments[$Position] = $Text;
	}
	
	/**
	 * add comments into final code
	 *
	 * @param string $Code
	 * @param string $Comments
	 *
	 * @return void
	 *
	 * @example Add_Comments('example text', static::$Comments);
	 */
	public static function Add_Comments(&$Code="", $Comments="")
	{
		/*
		 * extracts namespace related to correct class;
		 * prepares interface with correct comments (more or less related to class)
		 */
		$Namespace = explode('\\', get_class())[0];
		$Interface = $Namespace.'\I_'.$Namespace.'_Texts_Comments';
	
		$Scope = new ClassScope($Interface);
		$Constructions = $Scope -> getConstants();
	
		switch(count($Comments))
		{
			/*
			 * one comment was set
			 */
			case 1:
				if(isset($Comments[UniCAT::UNICAT_OPTION_ABOVE]))
				{
					$Code = sprintf($Constructions[array_keys($Constructions)[0]], $Comments[UniCAT::UNICAT_OPTION_ABOVE]).$Code;
				}
				else
				{
					$Code = $Code.sprintf($Constructions[array_keys($Constructions)[0]], $Comments[UniCAT::UNICAT_OPTION_BELOW]);
				}
				break;
			/*
			 * both comments were set
			 */
			case 2:
				$Code = sprintf($Constructions[array_keys($Constructions)[0]], $Comments[UniCAT::UNICAT_OPTION_ABOVE]).$Code.sprintf($Constructions[array_keys($Constructions)[0]], $Comments[UniCAT::UNICAT_OPTION_BELOW]);
				break;
			/*
			 * no comment was set;
			 * a bit useless code - only for doing something
			 */
			default:
				$Code = $Code;
				break;
		}
	}
}

?>