<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Template Engine: Import/Export Skin XML
 * Author: $CTM['Erick-Master']
 * Last Update: 08/09/2012 - 00:52h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class TemplateEngine_ImportExport extends CTM_Template
{
	private $settings		= array();
	
	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		if(!$settings['SystemName'])
			$settings['SystemName'] = "CTM Board";
			
		$this->settings = $settings;
	}
	/**
	 *	Import Skin XML
	 *	Import the skin files from XML
	 *
	 *	XML_CORRUPTED : Erro - XML corrupted
	 *
	 *	@param	string	XML content
	 *	@param	array	XML info returned
	 *	@return	array|string
	*/
	public function ImportXML($xml_content, &$xml_info_return = array())
	{
		set_time_limit(0);
		ini_set("memory_limit", 128000000);
		
		$xml_general = CTM_FileManage::Lib('XML')->ParseXML($xml_content);
		
		if(!CTM_FileManage::Lib('XML')->IsXML(($xml_info = $this->loadXMLDecode($xml_general->skin_info, "skin_info"))))
			return $xml_info_return = "XML_CORRUPTED";
		
		if(!CTM_FileManage::Lib('XML')->IsXML(($xml_templates = $this->loadXMLDecode($xml_general->skin_templates, "skin_set"))))
			return $xml_info_return = "XML_CORRUPTED";
			
		if(!CTM_FileManage::Lib('XML')->IsXML(($xml_css = $this->loadXMLDecode($xml_general->skin_css, "skin_css"))))
			return $xml_info_return = "XML_CORRUPTED";
			
		if(!CTM_FileManage::Lib('XML')->IsXML(($xml_images = $this->loadXMLDecode($xml_general->skin_images, "skin_images"))))
			return $xml_info_return = "XML_CORRUPTED";
			
		if(!CTM_FileManage::Lib('XML')->IsXML(($xml_resources = $this->loadXMLDecode($xml_general->skin_resources, "skin_resources"))))
			return $xml_info_return = "XML_CORRUPTED";

		$xml_info = CTM_FileManage::Lib('XML')->ParseXML($xml_info);
		$xml_templates = CTM_FileManage::Lib('XML')->ParseXML($xml_templates);
		$xml_css = CTM_FileManage::Lib('XML')->ParseXML($xml_css);
		$xml_images = CTM_FileManage::Lib('XML')->ParseXML($xml_images);
		$xml_resources = CTM_FileManage::Lib('XML')->ParseXML($xml_resources);

		$check_codekey = $this->loadCheckCodeKey($xml_info->skin_info->skin_key, $xml_info->skin_info->skin_name, $xml_info->skin_info->skin_codekey);

		if($check_codekey != "ALL_OK")
			return $xml_info_return = $check_codekey;
		
		$skin_info = array
		(
			"Name" => strval($xml_info->skin_info->skin_name),
			"CodeKey" => strval($xml_info->skin_info->skin_codekey),
			"SkinSet" => strval($xml_info->skin_info->skin_key),
			"Author" => array
			(
				"Name" => strval($xml_info->skin_info->skin_author->name),
				"Site" => strval($xml_info->skin_info->skin_author->site)
			)
		);
		$skin_set = array();
		
		$skin_key = strval($xml_info->skin_info->skin_key);
		$set_exists = file_exists(CTM_CACHE_PATH."server_cache/db_php/skin_sources/".$skin_key);
		
		if(count($xml_templates->skin_templates->skin_set) > 0)
		{
			foreach($xml_templates->skin_templates->skin_set as $xml)
			{
				$skin_set[strval($xml->name)] = array();
				
				if($set_exists == true)
				{
					parent::Lib('Database')->OpenDatabase($skin_key, strval($xml->name));
				}
				
				if(count($xml->files->template) > 0)
				{
					foreach($xml->files->template as $c_file)
					{
						if($set_exists == true)
						{
							if(parent::Lib('Database')->CheckFile(strval($c_file->name)))
							{
								if(md5(parent::Lib('Database')->GetFile(strval($c_file->name))) == $c_file['checksum'])
								{
									continue;
								}
							}
						}
						
						//$skin_set[strval($xml->name)][strval($c_file->filename)] = base64_decode(str_replace("	", NULL, trim($c_file->content)));
						$_content = str_replace(array("<![CDATA[", "]]>"), NULL, $c_file->content);
						$_content = str_replace(array("<!#^#|CDATA|", "|#^#]>"), array("<![CDATA[", "]]>"), $_content);
						$skin_set[strval($xml->name)][strval($c_file->filename)] = $_content;
					}
				}
				
				if($set_exists == true)
				{
					parent::Lib('Database')->CloseDatabase();
				}
			}
		}
		
		parent::Lib('Sources')->OpenDatabase();
		
		if(!parent::Lib('Sources')->CheckSkin($skin_key))
			parent::Lib('General')->CreateSkin($skin_key, $skin_info, $skin_set);
		else
			parent::Lib('General')->UpdateSkinCache($skin_key, $skin_set);
			
		parent::Lib('Sources')->CloseDatabase();
		
		if(count($xml_css) > 0)
		{
			foreach($xml_css->style_css->css_file as $xml)
			{
				if(!file_exists(CTM_PUBLIC_PATH."style_css/".$skin_key))
					mkdir(CTM_PUBLIC_PATH."style_css/".$skin_key);
				
				if(file_exists(CTM_PUBLIC_PATH."style_css/".$skin_key."/".$xml->name))
				{
					if(md5_file(CTM_PUBLIC_PATH."style_css/".$skin_key."/".$xml->name) == $xml['checksum'])
					{
						continue;
					}
				}
				
				$fp = fopen(CTM_PUBLIC_PATH."style_css/".$skin_key."/".$xml->name, "w");
				fwrite($fp, base64_decode(str_replace("	", NULL, trim($xml->content))));
				fclose($fp);
			}
		}
		
		if(count($xml_images) > 0)
		{
			foreach($xml_images->style_images as $key => $xml)
			{
				if(!file_exists(CTM_PUBLIC_PATH."style_images/".$skin_key))
					mkdir(CTM_PUBLIC_PATH."style_images/".$skin_key);
					
				if(count($xml->images_folder) > 0)
				{
					foreach($xml->images_folder as $folder)
					{
						if(!file_exists(($path = CTM_PUBLIC_PATH."style_images/".$skin_key."/".$folder['name'])))
							mkdir($path);
							
						$this->loadImporterSetDirectory($xml->images_folder, "images_folder", "image_file", $path);
					}
				}
				
				if(count($xml->image_file) > 0)
				{
					foreach($xml->image_file as $image)
					{
						if(file_exists(CTM_PUBLIC_PATH."style_images/".$skin_key."/".$image->name))
						{
							if(md5_file(CTM_PUBLIC_PATH."style_images/".$skin_key."/".$image->name) == $image['checksum'])
							{
								continue;
							}
						}
						
						$fp = fopen(CTM_PUBLIC_PATH."style_images/".$skin_key."/".$image->name, "w");
						fwrite($fp, base64_decode(str_replace(array("\n", "\r", "	", " "), NULL, trim($image->content))));
						fclose($fp);
					}
				}
			}
		}
		
		if(count($xml_resources) > 0)
		{
			foreach($xml_resources->style_resources as $key => $xml)
			{
				if(!file_exists(CTM_PUBLIC_PATH."style_resources/".$skin_key))
					mkdir(CTM_PUBLIC_PATH."style_resources/".$skin_key);
					
				if(count($xml->resources_folder) > 0)
				{
					foreach($xml->resources_folder as $folder)
					{
						if(!file_exists(($path = CTM_PUBLIC_PATH."style_resources/".$skin_key."/".$folder['name'])))
							mkdir($path);
							
						$this->loadImporterSetDirectory($xml->resources_folder, "resources_folder", "resource_file", $path);
					}
				}
				
				if(count($xml->resource_file) > 0)
				{
					foreach($xml->resource_file as $resource)
					{
						if(file_exists(CTM_PUBLIC_PATH."style_resources/".$skin_key."/".$resource->name))
						{
							if(md5_file(CTM_PUBLIC_PATH."style_resources/".$skin_key."/".$resource->name) == $image['checksum'])
							{
								continue;
							}
						}
						
						$fp = fopen(CTM_PUBLIC_PATH."style_resources/".$skin_key."/".$resource->name, "w");
						fwrite($fp, base64_decode(str_replace(array("\n", "\r", "	", " "), NULL, trim($resource->content))));
						fclose($fp);
					}
				}
			}
		}
		
		return $xml_info_return = $skin_info;
	}
	/**
	 *	Export Skin XML
	 *	Export the skin files in XML
	 *
	 *	@param	string	XML File name
	 *	@param	array	Skin key
	 *	@param	array	Skin set
	 *	@param	boolean	Download file
	 *	@param	string	File compress (default -> gzip)
	 *	@param	array	Force codekey
	 *	@return	string	XML content
	*/
	public function ExportXML($xml_file, $skin_key, $skin_set, $download = FALSE, $compress = "gzip", $force_codekey = array())
	{
		set_time_limit(0);
		ini_set("memory_limit", 128000000);
		
		$set_files = array();
		$css_files = array();
		$img_files = array();
		$rsc_files = array();
		$count_set = 0;
		$count_css = 0;
		$count_img = 0;
		$count_rsc = 0;
		
		parent::Lib('Sources')->OpenDatabase();
		parent::Lib('Sources')->GetSkin($skin_key, $skin_info);
		parent::Lib('Sources')->CloseDatabase();
		
		foreach($skin_set as $key)
		{
			$all_files = array();

			parent::Lib('Database')->OpenDatabase($skin_key, $key);
			parent::Lib('Database')->GetAllFiles($all_files);
			parent::Lib('Database')->CloseDatabase();
			
			$_files = array(); 
			$_count = 0;
			
			foreach($all_files as $name => $content)
			{
				$spaces = chr(9).chr(9).chr(9).chr(9).chr(9).chr(9);
				
				$_files['template#:'.$_count++] = array
				(
					"a:hash" => md5($content),
					"filename" => $name,
					//"content" => "\r\n".$spaces.rtrim(chunk_split(base64_encode($content), 80, "\r\n".$spaces), "\r\n".$spaces)."\r\n".substr($spaces, 1)
					"content" => "<![CDATA[".str_replace(array("<![CDATA[", "]]>"), array("<!#^#|CDATA|", "|#^#]>"), $content)."]]>"
				);
			}
			
			$set_files['skin_set#:'.$count_set++] = array
			(
				"name" => $key,
				"files" => $_files
			);
		}
		
		if(file_exists(CTM_PUBLIC_PATH."style_css/".$skin_key))
		{
			if(count(($iterator = new DirectoryIterator(CTM_PUBLIC_PATH."style_css/".$skin_key))) > 0)
			{
				$spaces = chr(9).chr(9).chr(9).chr(9).chr(9);
				
				foreach($iterator as $fileinfo)
				{
					if($fileinfo->isDot() == false && $fileinfo->isDir() == false)
					{
						if($fileinfo->isFile() == true || $fileinfo->isLink() == true)
						{
							$file_name = $fileinfo->getFilename();
							$file_data = file_get_contents($fileinfo->getPathname());
							
							$css_files['css_file#:'.$count_css++] = array
							(
								"a:checksum" => md5_file($fileinfo->getPathname()),
								"name" => $file_name,
								"content" => "\r\n".$spaces.rtrim(chunk_split(base64_encode($file_data), 80, "\r\n".$spaces), "\r\n".$spaces)."\r\n".substr($spaces, 1)
							);
						}
					}
				}
			}
		}
		
		if(file_exists(CTM_PUBLIC_PATH."style_images/".$skin_key))
		{
			$spaces = chr(9).chr(9).chr(9).chr(9).chr(9);
			
			if(count(($iterator = new DirectoryIterator(CTM_PUBLIC_PATH."style_images/".$skin_key))) > 0)
			{
				foreach($iterator as $fileinfo)
				{
					if($fileinfo->isDot() == false)
					{
						if($fileinfo->isDir() == true)
						{
							$my_array = $this->loadExporterSetDirectory("images_folder", "image_file", $fileinfo->getPathname());
							$key_array = array("a:name" => $fileinfo->getFilename());
							$img_files['images_folder#:'.$count_img++] = array_merge($key_array, $my_array);
						}
						elseif($fileinfo->isFile() == true || $fileinfo->isLink() == true)
						{
							$file_name = $fileinfo->getFilename();
							$file_data = file_get_contents($fileinfo->getPathname());
							
							$img_files['image_file#:'.$count_img++] = array
							(
								"a:checksum" => md5_file($fileinfo->getPathname()),
								"name" => $file_name,
								"content" => "\r\n".$spaces.rtrim(chunk_split(base64_encode($file_data), 80, "\r\n".$spaces), "\r\n".$spaces)."\r\n".substr($spaces, 1)
							);
						}
					}
				}
			}
		}
		
		if(file_exists(CTM_PUBLIC_PATH."style_resources/".$skin_key))
		{
			$spaces = chr(9).chr(9).chr(9).chr(9).chr(9);
			
			if(count(($iterator = new DirectoryIterator(CTM_PUBLIC_PATH."style_resources/".$skin_key))) > 0)
			{
				foreach($iterator as $fileinfo)
				{
					if($fileinfo->isDot() == false)
					{
						if($fileinfo->isDir() == true)
						{
							$my_array = $this->loadExporterSetDirectory("resources_folder", "resource_file", $fileinfo->getPathname(), 1);
							$key_array = array("a:name" => $fileinfo->getFilename());
							$rsc_files['resources_folder#:'.$count_rsc++] = array_merge($key_array, $my_array);
						}
						elseif($fileinfo->isFile() == true || $fileinfo->isLink() == true)
						{
							$file_name = $fileinfo->getFilename();
							$file_data = file_get_contents($fileinfo->getPathname());
							
							$rsc_files['resource_file#:'.$count_rsc++] = array
							(
								"a:checksum" => md5_file($fileinfo->getPathname()),
								"name" => $file_name,
								"content" => "\r\n".$spaces.rtrim(chunk_split(base64_encode($file_data), 80, "\r\n".$spaces), "\r\n".$spaces)."\r\n".substr($spaces, 1)
							);
						}
					}
				}
			}
		}
		
		$_xml_inf = array
		(
			"Header" => array("1.0", "UTF-8"),
			"Attributes" => array
			(
				"creator" => "(CTM) Cetemaster Services",
				"system" => $this->settings['SystemName'],
				"version" => $this->settings['Version']
			),
			"Elements" => array
			(
				"skin_info" => array
				(
					"skin_name" => $skin_info['Name'],
					"skin_key" => $skin_key,
					"skin_codekey" => $this->loadGenerateCodeKey($skin_key, $skin_info['Name'], $skin_info['CodeKey'], $force_codekey),
					"skin_author" => array
					(
						"name" => $skin_info['Author']['Name'],
						"site" => $skin_info['Author']['Site'],
					),
				)
			)
		);
		
		$_xml_set = array
		(
			"Header" => array("1.0", "UTF-8"),
			"Attributes" => array
			(
				"creator" => "(CTM) Cetemaster Services",
				"system" => $this->settings['SystemName'],
				"version" => $this->settings['Version']
			),
			"Elements" => array
			(
				"skin_templates" => $set_files
			)
		);
		
		$_xml_css = array
		(
			"Header" => array("1.0", "UTF-8"),
			"Attributes" => array
			(
				"creator" => "(CTM) Cetemaster Services",
				"system" => $this->settings['SystemName'],
				"version" => $this->settings['Version']
			),
			"Elements" => array
			(
				"style_css" => $css_files,
			),
		);
		
		$_xml_img = array
		(
			"Header" => array("1.0", "UTF-8"),
			"Attributes" => array
			(
				"creator" => "(CTM) Cetemaster Services",
				"system" => $this->settings['SystemName'],
				"version" => $this->settings['Version']
			),
			"Elements" => array
			(
				"style_images" => $img_files
			)
		);
		
		$_xml_rsc = array
		(
			"Header" => array("1.0", "UTF-8"),
			"Attributes" => array
			(
				"creator" => "(CTM) Cetemaster Services",
				"system" => $this->settings['SystemName'],
				"version" => $this->settings['Version']
			),
			"Elements" => array
			(
				"style_resources" => $rsc_files
			)
		);
		
		CTM_FileManage::Lib('XML')->CreateXML("skin_xml", $_xml_inf, false, $xml_inf);
		CTM_FileManage::Lib('XML')->CreateXML("skin_xml", $_xml_set, false, $xml_set);
		CTM_FileManage::Lib('XML')->CreateXML("skin_xml", $_xml_css, false, $xml_css);
		CTM_FileManage::Lib('XML')->CreateXML("skin_xml", $_xml_img, false, $xml_img);
		CTM_FileManage::Lib('XML')->CreateXML("skin_xml", $_xml_rsc, false, $xml_rsc);
		
		$spaces = chr(9).chr(9);
		
		$skin_info = $spaces.rtrim(chunk_split($this->loadXMLEncode($xml_inf, "skin_info"), 80, "\n".$spaces), "\n".$spaces);
		$skin_templates = $spaces.rtrim(chunk_split($this->loadXMLEncode($xml_set, "skin_set"), 80, "\n".$spaces), "\n".$spaces);
		$skin_css = $spaces.rtrim(chunk_split($this->loadXMLEncode($xml_css, "skin_css"), 80, "\n".$spaces), "\n".$spaces);
		$skin_images = $spaces.rtrim(chunk_split($this->loadXMLEncode($xml_img, "skin_images"), 80, "\n".$spaces), "\n".$spaces);
		$skin_resources = $spaces.rtrim(chunk_split($this->loadXMLEncode($xml_rsc, "skin_resources"), 80, "\n".$spaces), "\n".$spaces);
		
		$xml = array
		(
			"Header" => array("1.0", "UTF-8"),
			"Attributes" => array
			(
				"creator" => "(CTM) Cetemaster Services",
				"system" => $this->settings['SystemName'],
				"version" => $this->settings['Version']
			),
			"Elements" => array
			(
				"skin_info" => "\n".$skin_info."\n".substr($spaces, 1),
				"skin_templates" => "\n".$skin_templates."\n".substr($spaces, 1),
				"skin_css" => "\n".$skin_css."\n".substr($spaces, 1),
				"skin_images" => "\n".$skin_images."\n".substr($spaces, 1),
				"skin_resources" => "\n".$skin_resources."\n".substr($spaces, 1),
			)
		);
		
		CTM_FileManage::Lib('XML')->CreateXML("skin_xml", $xml, false, $xml_source);
		
		if($download == true)
		{
			if($compress == "gzip" && function_exists("gzencode"))
			{
				$down_source = gzencode($xml_source, 9);
				$down_suffix = ".gz";
			}
			elseif($compress == "zip" && (class_exists("ZipArchive") || class_exists("ZipFile")))
			{
				if(!class_exists("ZipArchive"))
				{
					$zip = new ZipArchive();
					$zip->open(($filepath = CTM_CACHE_PATH."temp_cache/".md5(mt_rand()."template__kernel::".time()."__zip").".tmp"), ZipArchive::CREATE);
					$zip->addFromString(self::TEMPLATE_ENGINE_EXPORT_FILE, $xml_source);
					$zip->close();
					
					$down_source = file_get_contents($filepath);
					unlink($filepath);
				}
				else
				{
					$zip = new ZipFile();
					$zip->addFile($xml_source, self::TEMPLATE_ENGINE_EXPORT_FILE);
					
					$down_source = $zip->file();
				}
				
				$down_suffix = ".zip";
			}
			else
			{
				$down_source = $xml_source;
				$down_suffix = NULL;
			}

			$length = strlen($down_source) + 3;
			
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"".$xml_file.".xml".$down_suffix."\"");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".$length);
			
			ob_end_flush();
			ob_end_clean();
			
			exit($down_source);
		}
		
		return $xml_source;
	}
	/**
	 *	Private: XML Encode
	 *
	 *	@param	string	Input
	 *	@param	string	Key
	 *	@return	string
	*/
	private function loadXMLEncode($string, $key)
	{
		if(substr($string, 0, 1) != "<")
			$string = "<".$string;

		if(substr($string, -1, 1) != ">")
			$string .= ">";

		$encode = CTM_Crypt::Lib('MaxEncoder');

		$encode->AddPassword(md5($this->settings['XMLCryptKey'].":::".$key));
		$encode->SetText($string);
		$encode->Encode(true);
		
		return $encode->newString;
	}
	/**
	 *	Private: XML Decode
	 *
	 *	@param	string	Input
	 *	@param	string	Key
	 *	@return	string
	*/
	private function loadXMLDecode($string, $key)
	{
		$decode = CTM_Crypt::Lib('MaxEncoder');

		$decode->AddPassword(md5($this->settings['XMLCryptKey'].":::".$key));
		$decode->SetText(str_replace(array("\n", "\r", "	", " "), NULL, trim($string)));
		$decode->Decode(true);

		$string = $decode->newString;

		if(substr($string, 0, 1) != "<")
			$string = "<".$string;

		if(substr($string, -1, 1) != ">")
			$string .= ">";
		
		return $string;
	}
	/**
	 *	Private: Check Skin Code Key
	 *
	 *	@param	string	Skin key
	 *	@param	string	Skin name
	 *	@param	string	Skin code key
	 *	@return	string
	*/
	private function loadCheckCodeKey($skin_key, $skin_name, $codekey)
	{
		/*if(!$codekey)
			return "INVALID_CODEKEY";

		$encode = CTM_Crypt::Lib('MaxEncoder');
		$encode->SetText($codekey);
		$encode->AddPassword(md5($this->settings['CodeKeyCryptKey']));
		$encode->Decode(true);

		list($hash, $row_type, $row_value) = explode("--", str_replace(array("{", "}"), NULL, $encode->newString));

		$checksum = strtoupper(dechex(crc32("{key::".md5($skin_key."::".$skin_name)."::template_ctm::".$row_type."::".$row_value."}")));

		if($checksum != $hash)
			return "INVALID_CODEKEY";

		if(substr($row_type, 0, 7) == "IN_VAR_")
		{
			$var = str_replace("IN_VAR_", NULL, $row_type);

			if(!in_array($row_value, $this->settings['CodeKeyVars'][$var]))
				return "VAR_{$var}_ERROR";
		}*/
		
		return "ALL_OK";
	}
	/**
	 *	Private: Generate Skin Code Key
	 *
	 *	@param	string	Skin key
	 *	@param	string	Skin name
	 *	@param	string	Skin code key
	 *	@param	array	Force code key
	 *	@return	string
	*/
	private function loadGenerateCodeKey($skin_key, $skin_name, $current_codekey = NULL, $force_codekey = array())
	{
		if(count($force_codekey) > 0)
		{
			$row_type = strtoupper($force_codekey[0]);
			$row_value = $force_codekey[1];

			$checksum = strtoupper(dechex(crc32("{key::".md5($skin_key."::".$skin_name)."::template_ctm::".$row_type."::".$row_value."}")));
		}
		else
		{
			$encode = CTM_Crypt::Lib('MaxEncoder');
			$encode->SetText($current_codekey);
			$encode->AddPassword(md5($this->settings['CodeKeyCryptKey']));
			$encode->Decode(true);

			list($checksum, $row_type, $row_value) = explode("--", str_replace(array("{", "}"), NULL, $encode->newString));
		}

		
		$new_key = "{".strtoupper($checksum)."--".strtoupper($row_type)."--".$row_value."}";

		$encode = CTM_Crypt::Lib('MaxEncoder');
		$encode->SetText($new_key);
		$encode->AddPassword(md5($this->settings['CodeKeyCryptKey']));
		$encode->Encode(true);

		return $encode->newString;
	}
	/**
	 *	Private: Importer Set Directory
	 *
	 *	@param	string	XML content
	 *	@param	string	Key file
	 *	@param	string	Key folder
	 *	@param	string	Directory path
	 *	@return	void
	*/
	private function loadImporterSetDirectory($xml_content, $key_folder, $key_file, $dir_path)
	{
		if(count($xml_content) > 0)
		{
			foreach($xml_content as $xml)
			{
				if(count($xml->{$key_folder}) > 0)
				{
					foreach($xml->{$key_folder} as $folder)
					{
						if(!file_exists($dir_path.$folder['name']))
							mkdir($dir_path.$folder['name']);
							
						$this->loadImporterSetDirectory($xml->{$key_folder}, $key_folder, $key_file, $dir_path.$folder['name']);
					}
				}
				
				if(count($xml->{$key_file}) > 0)
				{
					foreach($xml->{$key_file} as $file)
					{
						if(file_exists($dir_path."/".$file->name))
						{
							if(md5_file($dir_path."/".$file->name) == $file['checksum'])
							{
								continue;
							}
						}
						
						$fp = fopen($dir_path."/".$file->name, "w");
						fwrite($fp, base64_decode(str_replace(array("\n", "\r", "	", " "), NULL, trim($file->content))));
						fclose($fp);
					}
				}
			}
		}
	}
	/**
	 *	Private: Exporter Set Directory
	 *
	 *	@param	string	Key folder
	 *	@param	string	Key file
	 *	@param	string	Directory path
	 *	@param	integer	Folder count
	 *	@return	array
	*/
	private function loadExporterSetDirectory($key_dir, $key_file, $dir, $folders = 0)
	{
		$spaces = chr(9).chr(9).chr(9).chr(9).chr(9);
		$array = array();
		$count = 0;
		
		if(count(($iterator = new DirectoryIterator($dir))) > 0)
		{
			foreach($iterator as $fileinfo)
			{
				if($fileinfo->isDot() == false)
				{
					if($fileinfo->isDir() == true)
					{
						$folders++;
						$my_array = $this->loadExporterSetDirectory($key_dir, $key_file, $fileinfo->getPathname(), $folders + 1);
						$key_array = array("a:name" => $fileinfo->getFilename());
						$array[$key_dir."#:".$count++] = array_merge($key_array, $my_array);
					}
					elseif($fileinfo->isFile() == true || $fileinfo->isLink() == true)
					{
						$file_name = $fileinfo->getFilename();
						$file_data = file_get_contents($fileinfo->getPathname());
						$spaces = str_repeat("	", 5 + $folders);
						
						$array[$key_file."#:".$count++] = array
						(
							"a:checksum" => md5_file($fileinfo->getPathname()),
							"name" => $file_name,
							"content" => "\r\n".$spaces.rtrim(chunk_split(base64_encode($file_data), 80, "\r\n".$spaces), "\r\n".$spaces)."\r\n".substr($spaces, 1)
						);
					}
				}
			}
		}
		
		return $array;
	}
}