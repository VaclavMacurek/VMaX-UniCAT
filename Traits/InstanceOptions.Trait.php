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
trait InstanceOptions
{
	/**
	 * for singleton-like setting of instance
	 *
	 * @static
	 * @var mixed
	 */
	private static $Instance = NULL;
	
	/**
	 * finds if instance is ready or not
	 *
	 * @return bool
	 */
	private static function Check_IsInstanced()
	{
		if(static::$Instance === NULL)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	/**
	 * sets instance, if it is not ready
	 *
	 * @return resource
	 */
	private static function Set_Instance()
	{
		$Class = get_class();

		if(self::Check_IsInstanced() == FALSE)
		{
			static::$Instance = new $Class();
			return static::$Instance;
		}
	}
	
	protected function Show_Instance()
	{
		return static::$Instance;
	}
}

?>