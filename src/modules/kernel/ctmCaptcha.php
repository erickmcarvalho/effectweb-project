<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Captcha Secure Image (PHP GD)
 * Author: $CTM['Erick-Master']
 * Last Update: 18/05/2012 - 14:42h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

final class CTM_Captcha
{
	/**
	 *	Text size
	 *
	 *	@var	integer
	 *	@access	public
	*/
	public static $size		= 22;
	/**
	 *	Text letters number
	 *
	 *	@var	integer
	 *	@access	public
	*/
	public static $number	= 10;
	/**
	 *	Text words
	 *
	 *	@var	string
	 *	@access	public
	*/
	public static $words	= "ABCDEFGHJKLMNPRSTUVWXYZ123456789";
	/**
	 *	Background directory
	 *
	 *	@var	string
	 *	@access	public
	*/
	public static $bg		= "bg-captcha.jpg";
	/**
	 *	Fonts folder
	 *
	 *	@var	string
	 *	@access	public
	*/
	public static $fontDir	= "public/fonts/";
	/**
	 *	Fonts file
	 *
	 *	x => array
	 *	(
	 *		0 => file name,
	 *		1 => number letters
	 *	)
	 *
	 *	@var	array
	 *	@access	public
	*/
	public static $fonts	= array(0 => array("myriadprocond.ttf", 27));
	/**
	 *	Text colors
	 *
	 *	x => array
	 *	(
	 *		0 => red,
	 *		1 => green,
	 *		2 => blue
	 *	)
	 *
	 *	@var	array
	 *	@access	public
	*/
	public static $colors	= array(0 => array(131,7,124), 1 => array(70, 138, 239));
	/**
	 *	Border
	 *
	 *	x => array
	 *	(
	 *		0 => enable
	 *		1 => array (color)
	 *		(
	 *			0 => red,
	 *			1 => green,
	 *			2 => blue
	 *		)
	 *	)
	 *
	 *	@var	array
	 *	@access	public
	*/
	public static $border	= array(TRUE, array(0,0,0));
	/**
	 *	Lines
	 *
	 *	x => array
	 *	(
	 *		0 => enable
	 *		1 => array (lines)
	 *		(
	 *			0 => array (line 1)
	 *			(
	 *				0 => red,
	 *				1 => green,
	 *				2 => blue
	 *			),
	 *			1 => array (line 2)
	 *			(
	 *				0 => red,
	 *				1 => green,
	 *				2 => blue
	 *			),
	 *			2 => array (line 3)
	 *			(
	 *				0 => red,
	 *				1 => green,
	 *				2 => blue
	 *			)
	 *		)
	 *	)
	 *
	 *	@var	array
	 *	@access	public
	*/
	public static $setLines	= TRUE;
	/**
	 *	Captcha text
	 *
	 *	@var	string
	 *	@access	private
	*/
	private static $captcha = NULL;
	
	/**
	 *	Captcha Image
	 *	Generate the captcha image and text
	 *
	 *	@param	integer	Width (default->186)
	 *	@param	integer	Height (default->27)
	 *	@return	void
	*/
	public static function CaptchaImage($Width = 186, $Height = 27)
	{
		$real = self::$fonts[array_rand(self::$fonts)];
		$font = self::$fontDir.$real[0];
		$number = $real[1];
		
		self::GerateCaptchaText($number);
		$back = substr(self::$bg, strrpos(self::$bg, "/") + 1);
		$back = substr($back, 0, strrpos($back, "."));
		
		if($back == "{rand}")
		{
			$files = glob(str_replace("{rand}", "*", self::$bg));
			$background = $files[array_rand($files)];
		}
		else 
		{
			$background = self::$bg;
		}
		
		$size = getimagesize($background);
		$image = imagecreatetruecolor($Width, $Height);

		switch(substr(self::$bg, strrpos(self::$bg, ".") + 1))
		{
			case "png" : $load = imagecreatefrompng($background); break;
			case "gif" : $load = imagecreatefromgif($background); break;
			default : $load = imagecreatefromjpeg($background); break;
		}
		
		imagecopyresampled($image, $load, 0, 0, 0, 0, $Width + 1, $Height + 1, $size[0], $size[1]);
		
		if(self::$border[0] == TRUE)
		{
			$borderColor = imagecolorallocate($image, self::$border[1][0], self::$border[1][1], self::$border[1][2]);
			imagerectangle($image, 0, 0, $Width - 1, $Height - 1, $borderColor);
		}
		
		$box = imageftbbox(22, 0, $font, self::$captcha);
		$x = $box[0] + (imagesx($image) / 2) - ($box[4] / 2);
		$y = $box[1] + (imagesy($image) / 2) - ($box[5] / 2);

		for($i = 0; $i < $number; $i++)
		{
			$iAngle = mt_rand(0, 1);
			$angle = $iAngle == 1 ? -10 : 5;
			$angle = mt_rand((($iAngle == 1 ? $i >= $angle : $i >= $angle) ? $angle : $i), $angle);
			$set = self::$colors[array_rand(self::$colors)];
			$color = imagecolorallocate($image, $set[0], $set[1], $set[2]);
			$setX = ($x + ($i > 0 ? ($i * 18) : 0)) - (($number - $i) + 4);
			imagefttext($image, self::$size, $angle, $setX, $Height - 5, $color, $font, self::$captcha{$i});
		}
		
		if(self::$setLines[0] == TRUE)
		{
			$color = self::$setLines[1];
			imageline($image, 1, 1, $Width, $Height, imagecolorallocate($image, $color[0][0], $color[0][1], $color[0][2]));
			imageline($image, 1, 27, 186, 1, imagecolorallocate($image, $color[1][0], $color[1][1], $color[1][2]));
			imageline($image, 1, 27, 100, 1, imagecolorallocate($image, $color[2][0], $color[2][1], $color[2][2]));
		}
		
		header("Content-type: image/png");
		imagepng($image, FALSE, 9);
		imagedestroy($image); 
		imagedestroy($load);
	}
	/**
	 *	Generate Captcha Text
	 *	Generate the new captcha text
	 *
	 *	@param	integer	Letters number
	 *	@return	void
	*/
	public static function GerateCaptchaText($number = -1)
	{
		self::$captcha = NULL;
		$number = $number == -1 ? self::$number : $number;
		$length = strlen(self::$words);

		for($i = 0; $i < $number; $i++)
			if($length > 0)
				self::$captcha .= self::$words{mt_rand(0, $length - 1)};
			else
				self::$captch .= chr(mt_rand(65, 90));

		$_SESSION['CTM_SECURE_CAPTCHA'] = md5(sha1(self::$captcha));
	}
	/**
	 *	Check
	 *	Check if text is valid on captcha
	 *
	 *	@param	string	Captcha text
	 *	@return	boolean
	*/
	public static function Check($Check)
	{
		return md5(sha1($Check)) == $_SESSION['CTM_SECURE_CAPTCHA'];
	}
}