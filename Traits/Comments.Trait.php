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
 * trait of functions for getting of various options
 */
trait Comments
{
	/**
	 * options
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
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_Parameters(__CLASS__, __FUNCTION__)[0]);
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
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_Parameters(__CLASS__, __FUNCTION__)[1], UniCAT::Show_Options_CommentPosition());
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
	 */
	public static function Add_Comments(&$Code="", $Comments="")
	{
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