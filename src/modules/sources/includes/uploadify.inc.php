<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Extension includes: Uploadify Script
 * Last Update: 06/08/2012 - 17:58h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Uploadify
{
	public static function run()
	{
		if($_GET['run'] == "uploadify")
		{
			$array = array
			(
				"error_no" => 4,
				"max_file_size" => NULL,
				"file_extension" => NULL,
				"parsed_file_name" => NULL,
				"saved_upload_name" => NULL
			);

			if(file_exists(CTM_CACHE_PATH."temp_cache/".md5($_REQUEST['tmp_session']."__key_upload").".tmp"))
			{
				$CACHE = file_get_contents(CTM_CACHE_PATH."temp_cache/".md5($_REQUEST['tmp_session']."__key_upload").".tmp");
				$CACHE = unserialize($CACHE);

				if($CACHE)
				{
					$upload = CTM_FileManage::Lib('Upload');
					$upload->upload_form_field = $CACHE['UPLOADIFY_CACHE_SESSION']['FIELD_NAME'];
					$upload->out_file_name = $CACHE['UPLOADIFY_CACHE_SESSION']['FILE_NAME'];
					$upload->out_file_dir = $CACHE['UPLOADIFY_CACHE_SESSION']['FILE_DIR'];
					$upload->max_file_size = $CACHE['UPLOADIFY_CACHE_SESSION']['MAX_SIZE'];
					$upload->allowed_file_ext = $CACHE['UPLOADIFY_CACHE_SESSION']['EXTENSIONS'];
					$upload->make_make_script_safe = TRUE;
					$upload->check_file_ext = TRUE;
					$upload->upload();
			
					$array = array
					(
						"error_no" => $upload->error_no,
						"max_file_size" => $upload->max_file_size,
						"file_extension" => $upload->file_extension,
						"parsed_file_name" => $upload->parsed_file_name,
						"saved_upload_name" => $upload->saved_upload_name
					);
				}

				self::destroy($_REQUEST['tmp_session']);
			}

			exit(base64_encode(serialize($array)));
		}
	}

	public static function set($field, $size, $extensions, $name, $dir, &$session = NULL)
	{
		if(!is_array($extensions))
			$extensions = explode("|", $extensions);

		$cache['UPLOADIFY_CACHE_SESSION'] = array
		(
			"FIELD_NAME" => $field,
			"MAX_SIZE" => $size,
			"EXTENSIONS" => $extensions,
			"FILE_NAME" => $name,
			"FILE_DIR" => $dir
		);

		$session = md5(sha1(time().rand()."upload_ajax"));
		$fp = fopen(CTM_CACHE_PATH."temp_cache/".md5($session."__key_upload").".tmp", "w");
		fwrite($fp, serialize($cache));
		fclose($fp);

		return $session;
	}

	public static function destroy($session = FALSE)
	{
		if(file_exists(CTM_CACHE_PATH."temp_cache/".md5($session."__key_upload").".tmp"))
			unlink(CTM_CACHE_PATH."temp_cache/".md5($session."__key_upload").".tmp");
	}
}