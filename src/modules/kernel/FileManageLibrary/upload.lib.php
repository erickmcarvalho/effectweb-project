<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * File Management: File Upload [Based in IP.Board 3]
 * Author: $CTM['Erick-Master']
 * Last Update: 21/12/2012 - 01:31h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class FileManagement_Upload extends CTM_FileManage
{
	/**
	 *	Name of upload form field
	 *
	 *	@access	public
	 *	@var	string	Field name
	*/
	public $upload_form_field	= "file_data";
	/**
	 *	Out filename *without* extension
	 *	(Leave blank to retain user filename)
	 *
	 *	@access	public
	 *	@var	string	Out file name
	*/
	public $out_file_name		= NULL;
	/**
	 *	Out dir (./upload) - no trailing slash
	 *
	 *	@access	public
	 *	@var	string	Out file directory
	*/
	public $out_file_dir		= "./uploads/";
	/**
	 *	Maximum file size of this upload
	 *
	 *	@access	public
	 *	@var	integer Max file size
	*/
	public $max_file_size		= 1000000;
	/**
	 *	Upload check file extension
	 *
	 *	@access	public
	 *	@var	boolean	Check file extension in $allowed_file_ext
	*/
	public $check_file_ext		= TRUE;
	/**
	 *	Forces PHP, CGI, etc to text
	 *
	 *	@access	public
	 *	@var	boolean	Make script safe
	*/
	public $make_script_safe	= TRUE;
	/**
	 *	Force non-img file extenstion (leave blank if not) (ex: 'ibf' makes upload.doc => upload.ibf)
	 *
	 *	@access	public
	 *	@var	string	Force data extension
	*/
	public $force_data_ext		= NULL;
	/**
	 *	Allowed file extensions array( 'gif', 'jpg', 'jpeg'..)
	 *
	 *	@access	public
	 *	@var	array	Allowed fuke extension
	*/
	public $allowed_file_ext	= array();
	/**
	 *	Array of IMAGE file extensions
	 *
	 *	@access	public
	 *	@var	array	Allowed fuke extension
	*/
	public $image_ext			= array("gif", "png", "jpg", "jpeg");
	/**
	 *	Current file extension
	 *
	 *	@access	public
	 *	@var	string	File extension
	*/
	public $file_extension		= NULL;
	/**
	 *	If force_data_ext == 1, this will return the 'real' extension	
	 *
	 *	@access	public
	 *	@var	string	Real file extension
	*/
	public $real_file_extension	= NULL;
	/**
	 *	Error number [1-5]
	 *
	 *	0 => None
	 *	1 => No upload
	 *	2 => Not valid upload type
	 *	3 => Upload exceeds size
	 *	4 => Could not move uploaded file, upload deleted
	 *	5 => File pretending to be an image but isn't (poss XSS attack)
	 *
	 *	@access	public
	 *	@var	integer	Error number
	*/
	public $error_no			= 0;
	/**
	 *	If upload is img or not
	 *
	 *	@access	public
	 *	@var	boolean	Is image
	*/
	public $is_image			= FALSE;
	/**
	 *	File name as was uploaded by user
	 *
	 *	@access	public
	 *	@var	string	Original file name
	*/
	public $original_file_name	= NULL;
	/**
	 *	Final file name as is saved on disk. (no path info)
	 *
	 *	@access	public
	 *	@var	string	Parsed file name
	*/
	public $parsed_file_name	= NULL;
	/**
	 *	Final file name with path info
	 *
	 *	@access	public
	 *	@var	string	Parsed file name
	*/
	public $saved_upload_name	= NULL;

	private $settings			= array();
	private $file				= array();
	
	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		//$this->settings = $settings;
	}
	/**
	 *	Process Upload
	 *	Process the command of upload
	 *
	 *	@return	boolean
	*/
	public function upload()
	{
		$this->out_file_dir = rtrim($this->out_file_dir, "/");
		$this->file = $_FILES[$this->upload_form_field];

		$file_name = str_replace(array("<", ">"), "-", isset($this->file['name']) ? $this->file['name'] : NULL);
		$file_size = isset($this->file['size']) ? $this->file['size'] : NULL;

		if(!isset($_FILES[$this->upload_form_field]) || $this->file['name'] == NULL || $this->file['name'] == "none" || !$this->file['name'] || !$this->file['size'])
		{
			if($this->file['error'] == 2)
			{
				$this->error_no = 3;
			}
			elseif($this->file['error'] == 1)
			{
				$this->error_no = 3;
			}
			else
			{
				$this->error_no = 1;
			}

			return false;
		}

		if(!is_uploaded_file($this->file['tmp_name']))
		{
			$this->error_no = 1;
			return false;
		}

		if($this->check_file_ext == true)
		{
			if(!is_array($this->allowed_file_ext) || count($this->allowed_file_ext) < 1)
			{
				$this->error_no = 2;
				return false;
			}
		}

		$this->allowed_file_ext = array_map("strtolower", $this->allowed_file_ext);
		$this->file_extension = strtolower(str_replace(".", NULL, substr($file_name, strrpos($file_name, "."))));

		if(!$this->file_extension)
		{
			$this->error_no = 2;
			return false;
		}

		$this->real_file_extension = $this->file_extension;
		$this->original_file_name = $file_name;

		if($this->check_file_ext == true && !in_array($this->file_extension, $this->allowed_file_ext))
		{
			$this->error_no = 2;
			return false;
		}

		if($this->max_file_size && ($file_size > $this->max_file_size))
		{
			$this->error_no = 3;
			return false;
		}

		$file_name = preg_replace("/[^\w\.]/", "_", $file_name);

		if($this->out_file_name)
		{
			$this->parsed_file_name = $this->out_file_name;
		}
		else
		{
			$this->parsed_file_name = str_replace(".".$this->file_extension, NULL, $file_name);
		}

		$renamed = FALSE;

		if($this->make_script_safe == true)
		{
			if(preg_match("/\.(cgi|pl|js|asp|php|html|htm|jsp|jar)(\.|$)/i", $file_name))
			{
				$this->file_extension = "txt";
				$this->parsed_file_name = preg_replace("/\.(cgi|pl|js|asp|php|html|htm|jsp|jar)(\.|$)/i", "$2", $this->parsed_file_name);

				$renamed = TRUE;
			}
		}

		if(is_array($this->image_ext) && count($this->image_ext) > 0)
		{
			if(in_array($this->real_file_extension, $this->image_ext))
			{
				$this->is_image = TRUE;
			}
		}

		if($this->force_data_ext && $this->is_image == false)
		{
			$this->file_extension = str_replace(".", NULL, $this->force_data_ext);
		}

		$this->parsed_file_name .= ".".$this->file_extension;
		$this->saved_upload_name = $this->out_file_dir."/".$this->parsed_file_name;

		if(!copy($this->file['tmp_name'], $this->saved_upload_name))
		{
			$this->error_no = 4;
			return false;
		}

		if($renamed == true && $this->file_extension != "txt")
		{
			$this->checkXSSInfile();

			if($this->error_no > 0)
			{
				return false;
			}
		}

		if($this->is_image == true)
		{
			$img_attributes = getimagesize($this->saved_upload_name);

			if(!is_array($img_attributes) || count($img_attributes) < 1)
			{
				unlink($this->saved_upload_name);

				$this->error_no = 5;
				return false;
			}
			elseif(!$img_attributes[2])
			{
				unlink($this->saved_upload_name);

				$this->error_no = 5;
				return false;
			}
			elseif($img_attributes[2] == 1 && ($this->file_extension == "jpg" || $this->file_extension == "jpeg"))
			{
				unlink($this->saved_upload_name);

				$this->error_no = 5;
				return false;
			}
		}

		if(filesize($this->saved_upload_name) != $this->file['size'])
		{
			unlink($this->saved_upload_name);

			$this->error_no = 1;
			return false;
		}

		return true;
	}
	/**
	 *	Check XSS In File
	 *	Checks for XSS inside file.  If found, deletes file, sets error_no to 5 and returns
	 *
	 *	@return	boolean
	*/
	protected function checkXSSInfile()
	{
		$fp = fopen($this->saved_upload_name, "rb");
		$file_check = fread($fp, 512);

		fclose($fp);

		if(!$file_check)
		{
			unlink($this->saved_upload_name);

			$this->error_no = 5;
			return false;
		}
		elseif( preg_match("#<script|<html|<head|<title|<body|<pre|<table|<a\s+href|<img|<plaintext|<cross\-domain\-policy#si", $file_check))
		{
			# Thanks to Nicolas Grekas from comments at www.splitbrain.org for helping to identify all vulnerable HTML tags

			unlink($this->saved_upload_name);

			$this->error_no = 5;
			return false;
		}

		return true;
	}
}