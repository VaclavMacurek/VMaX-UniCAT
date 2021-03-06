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
	 * @throws UniCAT_Exception if comment was not set
	 * @throws UniCAT_Exception if position setting was set wrong
	 *
	 * @example Set_Comment('example comment');
	 * @example Set_Comment('example comment', UniCAT\UniCAT::UNICAT_OPTION_ABOVE);
	 */
	public function Set_Comment($Text, $Position=UniCAT::UNICAT_OPTION_ABOVE)
	{
		try
		{
			if(!in_array($Position, UniCAT::ShowOptions_CommentsPosition()))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch(UniCAT_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__, 1), UniCAT::ShowOptions_CommentPosition());
		}
	
		static::$Comments[$Position] = $Text;
	}
	
	/**
	 * add comments into final code
	 *
	 * @param string $Code generated code for inserting of comments
	 * @param array $Comments comments for insereting into code
	 *
	 * @example Add_Comments('example text', static::$Comments);
	 */
	public static function Add_Comments(&$Code, $Comments="")
	{
		/*
		 * extracts namespace related to correct class;
		 * prepares interface with correct comments (more or less related to class)
		 */
		$Namespace = explode('\\', get_class())[0];
		$Interface = $Namespace.'\I_'.$Namespace.'_Texts_Comments';
	
		switch(count($Comments))
		{
			/*
			 * one comment was set
			 */
			case 1:
				if(isset($Comments[UniCAT::UNICAT_OPTION_ABOVE]))
				{
					$Form = "\n".ClassScope::Get_ConstantsValues($Interface)[0]."\n\t%s\n";
					$Code = sprintf($Form, $Comments[UniCAT::UNICAT_OPTION_ABOVE], preg_replace('/\n/', "\n\t", $Code));
				}
				elseif(isset($Comments[UniCAT::UNICAT_OPTION_BELOW]))
				{
					$Form = "\n\t%s".ClassScope::Get_ConstantsValues($Interface)[0]."\n";
					$Code = sprintf($Form, preg_replace('/\n/', "\n\t", $Code), $Comments[UniCAT::UNICAT_OPTION_BELOW]);
				}
				break;
			/*
			 * both comments were set
			 */
			case 2:
				$Form = "\n".ClassScope::Get_ConstantsValues($Interface)[0]."\n\t%s\n".ClassScope::Get_ConstantsValues($Interface)[0]."\n";
				$Code = sprintf($Form, $Comments[UniCAT::UNICAT_OPTION_ABOVE], preg_replace('/\n/', "\n\t", $Code), $Comments[UniCAT::UNICAT_OPTION_BELOW]);
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