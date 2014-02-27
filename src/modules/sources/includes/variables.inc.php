<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Extension includes: Core Variables
 * Last Update: 04/05/2013 - 20:14h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CoreVariables
{
	private static $ErrorsCode			= array();
	
	/**
	 *	Errors Code
	 *
	 *	@return	object
	*/
	public static function ErrorsCode()
	{
		if(!self::$ErrorsCode)
		{
			self::$ErrorsCode = array
			(
				"SendMailError" => 10,
				"JoinServerFail" => 11,
				"CharGameIDFail" => 12,
				"TicketNotFound" => 13,
				"PaymentNotFound" => 14
			);
			
			return (object)self::$ErrorsCode;
		}
	}
}