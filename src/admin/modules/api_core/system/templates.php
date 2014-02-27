<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: System Control - Templates
 * Last Update: 10/09/2012 - 13:13h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_System_Templates extends Core_Admin_System
{
	private $skin_cache_keys	= array();
	private $skin_cache_names	= array();
	private $skin_cache_files	= array();
	
	/**
	 *	Init module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		require_once(CTM_ROOT_PATH."modules/extensions/defaultSkinCache.php");
		
		$this->skin_cache_keys = $defaultSkinCacheKeys;
		$this->skin_cache_names = $defaultSkinCacheNames;
		$this->skin_cache_files = $defaultSkinCacheFiles;
		
		switch($_GET['index'])
		{
			case "importExport" :
				$this->loadImportExportTemplates();
				$this->output->setContent("templates_importExport");
			break;
			default :
				$this->loadManageTemplates();
			break;
		}
	}
	/**
	 *	Private: Manage Templates
	 *	Load and show templates files
	 *
	 *	@return	void
	*/
	public function loadManageTemplates()
	{
		if($_GET['do'] == "load_file" && !empty($_GET['template']) && !empty($_GET['type']) && !empty($_GET['file']))
		{
			require_once(CTM_CACHE_PATH."server_cache/db_php/skin_sources/skin_sources.php");
			
			if(array_key_exists($_GET['template'], $CTM_SKIN_SOURCES) && ($_GET['type'] == "set" || $_GET['type'] == "css"))
			{
				switch($_GET['type'])
				{
					case "set" :
						if(!empty($_GET['category']))
						{
							if(array_key_exists($_GET['category'], $this->skin_cache_names))
							{
								CTM_Template::Lib('Database')->OpenDatabase($_GET['template'], $_GET['category']);
								CTM_Template::Lib('Database')->GetFile($_GET['file'], $file);
								
								if($file != -1)
								{
									if($_GET['write'] == "save")
									{
										CTM_Template::Lib('Database')->SetFile($_GET['file'], $_POST['FileEditor']);
										CTM_Template::Lib('Database')->CompileCache();
										CTM_Template::Lib('Database')->CloseDatabase();
										
										$message = sprintf($this->lang->words['System']['Templates']['ManageTemplates']['SkinEditor']['Messages']['Saved'], $_GET['file']);
										exit(adminShowMessage($message, 3));
									}
									elseif($_GET['write'] == "delete")
									{
										CTM_Template::Lib('General')->RemoveSkinCache($_GET['template'], $_GET['category']);
										CTM_Template::Lib('Database')->RemoveFile($_GET['file']);
										CTM_Template::Lib('Database')->CloseDatabase();
										
										exit("<script>fileEditorDelete('".$_GET['type']."', '".$_GET['category']."', '".$_GET['file']."');</script>");
									}
									else
									{
										$GLOBALS['skin_editor']['template'] = $_GET['template'];
										$GLOBALS['skin_editor']['type'] = "set";
										$GLOBALS['skin_editor']['category'] = $_GET['category'];
										$GLOBALS['skin_editor']['file'] = $_GET['file'];
										$GLOBALS['skin_editor']['content'] = str_replace(array("<", ">"), array("&lt;", "&gt;"), $file);
										
										CTM_Template::Lib('Database')->CloseDatabase();
										return $this->output->setContent("templates_skinEditor");
									}
								}
							}
						}
					break;
					case "css" :
						if(file_exists(CTM_PUBLIC_PATH."style_css/".$_GET['template']."/".urldecode($_GET['file'])))
						{
							if($_GET['write'] == "save")
							{
								$fp = fopen(CTM_PUBLIC_PATH."style_css/".$_GET['template']."/".urldecode($_GET['file']), "w");
								fwrite($fp, $_POST['FileEditor']);
								fclose($fp);
								
								$message = sprintf($this->lang->words['System']['Templates']['ManageTemplates']['SkinEditor']['Messages']['Saved'], urldecode($_GET['file']));
								exit(adminShowMessage($message, 3));
							}
							elseif($_GET['write'] == "delete")
							{
								unlink(CTM_PUBLIC_PATH."style_css/".$_GET['template']."/".urldecode($_GET['file']));
								
								exit("<script>fileEditorDelete('css', 'null', '".$_GET['file']."');</script>");
							}
							else
							{
								$fp = file_get_contents(CTM_PUBLIC_PATH."style_css/".$_GET['template']."/".urldecode($_GET['file']));
								
								$GLOBALS['skin_editor']['template'] = $_GET['template'];
								$GLOBALS['skin_editor']['type'] = "css";
								$GLOBALS['skin_editor']['category'] = "null";
								$GLOBALS['skin_editor']['file'] = urlencode($_GET['file']);
								$GLOBALS['skin_editor']['content'] = str_replace(array("<", ">"), array("&lt;", "&gt;"), $fp);
								
								return $this->output->setContent("templates_skinEditor");
							}
						}
					break;
				}
			}
			
			exit();
		}
		elseif($_GET['do'] == "show_files" && !empty($_GET['template']))
		{
			if(!empty($_GET['list_files']))
			{
				if(file_exists(CTM_CACHE_PATH."server_cache/db_php/skin_sources/".$_GET['template']."/skin_".$_GET['list_files'].".tpl.php"))
				{
					require_once(CTM_CACHE_PATH."server_cache/db_php/skin_sources/".$_GET['template']."/skin_".$_GET['list_files'].".tpl.php");
					
					foreach(array_keys($CTM_TEMPLATE_DATABASE) as $file)
					{
						echo("	<li class=\"tpl_file_".$_GET['list_files']."_".$file."\">");
						echo("<a href=\"javascript: void(0);\" onclick=\"showSkinFile('{$file}', '".$_GET['list_files']."', 'set');\">{$file}</a></li>\r\n");
					}
				}
				exit();
			}
			
			CTM_Template::Lib('Sources')->OpenDatabase();
			
			switch($_GET['add_file'])
			{
				case "set" :
					if(!$skin_data = CTM_Template::Lib('Sources')->GetSkin($_GET['template']))
					{
						CTM_Template::Lib('Sources')->CloseDatabase();
						exit();
					}
						
					if(empty($_POST['SetName']))
						exit(adminShowMessage($this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddSet']['Messages']['NameVoid'], 1));
						
					if(eregi("[^A-Za-z0-9_]", $_POST['SetName']))
						exit(adminShowMessage($this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddSet']['Messages']['NameInvalid'], 2));
						
					if(!array_key_exists($_POST['Category'], $skin_data['SkinSet']))
						exit(adminShowMessage($this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddSet']['Messages']['CategoryInvalid'], 2));
					
					CTM_Template::Lib('Sources')->CloseDatabase();
					CTM_Template::Lib('Database')->OpenDatabase($_GET['template'], $_POST['Category']);
					
					if(CTM_Template::Lib('Database')->GetFile($_POST['SetName']))
					{
						CTM_Template::Lib('Database')->CloseDatabase();
						exit(adminShowMessage($this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddSet']['Messages']['SetExists'], 2));
					}
						
					CTM_Template::Lib('Database')->SetFile($_POST['SetName'], NULL);
					CTM_Template::Lib('Database')->CompileCache();
					CTM_Template::Lib('Database')->CloseDatabase();
					
					exit("<script>addSkinFile('set', '".$_POST['Category']."', '".$_POST['SetName']."');</script>");
				break;
				case "css" :
					if(!$skin_data = CTM_Template::Lib('Sources')->GetSkin($_GET['template']))
					{
						CTM_Template::Lib('Sources')->CloseDatabase();
						exit();
					}
						
					if(empty($_POST['CSSName']))
						exit(adminShowMessage($this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddCSS']['Messages']['NameVoid'], 1));
						
					if(eregi("[^A-Za-z0-9._-]", $_POST['CSSName']))
						exit(adminShowMessage($this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddCSS']['Messages']['NameInvalid'], 2));
						
					$_POST['CSSName'] = trim($_POST['CSSName'], ".css");
						
					if(file_exists(CTM_PUBLIC_PATH."style_css/".$_GET['template']."/".$_POST['CSSName'].".css"))
						exit(adminShowMessage($this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddCSS']['Messages']['CSSExists'], 2));
						
					try
					{
						$fp = fopen(CTM_PUBLIC_PATH."style_css/".$_GET['template']."/".$_POST['CSSName'].".css", "w+");
						fclose($fp);
						
						exit("<script>addSkinFile('css', 'null', '".$_POST['CSSName']."');</script>");
					}
					catch(Exception $e)
					{
						exit(adminShowMessage("Error Unexpected", 2));
					}
				break;
			}
			
			if($skin_data = CTM_Template::Lib('Sources')->GetSkin($_GET['template']))
			{
				$open_dir = opendir(CTM_PUBLIC_PATH."style_css/".$_GET['template']);
				$css = array();
				
				while($content = readdir($open_dir))
				{
					if(is_file(CTM_PUBLIC_PATH."style_css/".$_GET['template']."/".$content))
					{
						$css[] = $content;
					}
				}
				
				$GLOBALS['skin_files']['skin_tpl'] = $_GET['template'];
				$GLOBALS['skin_files']['skin_set'] = $this->skin_cache_names;
				$GLOBALS['skin_files']['skin_css'] = $css;
				
				CTM_Template::Lib('Sources')->CloseDatabase();
				
				$this->lang->setArguments("System,Templates,ManageTemplates,ShowFiles,Title", $skin_data['Name']);
				$this->output->setContent("templates_skinFiles");
			}
		}
		/*elseif($_GET['do'] == "edit_skin" && !empty($_GET['template']))
		{
			CTM_Template::Lib('Sources')->OpenDatabase();
			
			if($skin_data = CTM_Template::Lib('Sources')->GetSkin($_GET['template']))
			{
				if($_GET['write'] == true)
				{
					if(empty($_POST['SkinName']))
					{
						$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['EditTemplate']['Messages']['SkinNameVoid'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
					}
					elseif(empty($_POST['AuthorName']))
					{
						$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['EditTemplate']['Messages']['AuthorNameVoid'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
					}
					elseif(empty($_POST['AuthorSite']))
					{
						$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['EditTemplate']['Messages']['AuthorSiteVoid'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
					}
					else
					{
						$skin_data['Name'] = $_POST['SkinName'];
						$skin_data['Author']['Name'] = $_POST['AuthorName'];
						$skin_data['Author']['Site'] = $_POST['AuthorSite'];
						
						CTM_Template::Lib('Sources')->SetSkin($_GET['template'], $skin_data);
						
						$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['EditTemplate']['Messages']['Success'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
					}
				}
				
				$GLOBALS['skin_name'] = $skin_data['Name'];
				$GLOBALS['skin_author']['name'] = $skin_data['Author']['Name'];
				$GLOBALS['skin_author']['site'] = $skin_data['Author']['Site'];
				
				CTM_Template::Lib('Sources')->CloseDatabase();
				$this->output->setContent("templates_skinSettings");
			}
		}*/
		elseif($_GET['do'] == "create_template")
		{
			if($_GET['write'] == true)
			{
				if(empty($_POST['SkinName']))
				{
					$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['CreateTemplate']['Messages']['SkinNameVoid'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
				}
				elseif(empty($_POST['SkinSet']))
				{
					$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['CreateTemplate']['Messages']['SkinSetVoid'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
				}
				elseif(empty($_POST['AuthorName']))
				{
					$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['CreateTemplate']['Messages']['AuthorNameVoid'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
				}
				else
				{
					CTM_Template::Lib('Sources')->OpenDatabase();
					
					if($skin_data = CTM_Template::Lib('Sources')->GetSkin($_POST['SkinSet']))
					{
						$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['CreateTemplate']['Messages']['SkinSetExists'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
					}
					else
					{
						$skin_info = array
						(
							"Name" => $_POST['SkinName'],
							"Set" => $_POST['SkinSet'],
							"Author" => array
							(
								"Name" => $_POST['AuthorName'],
								"Site" => $_POST['AuthorSite'],
							),
						);
						
						$skin_data = array();
							
						foreach($this->skin_cache_files as $key => $files)
							foreach($files as $file)
								$skin_data[$key][$file] = NULL;
						
						if(CTM_Template::Lib('General')->CreateSkin($_POST['SkinSet'], $skin_info, $skin_data))
						{
							$path = "server_cache/db_php/skin_sources/skin_sources.php";
							CTM_Controller::UpdateWebCache("effectwebkernelhash", "hash_file:".$path, "hash_file:".md5_file(CTM_CACHE_PATH.$path));

							$GLOBALS['result_command'] = sprintf($this->lang->words['System']['Templates']['CreateTemplate']['Messages']['Success'], $_POST['SkinSet']);
							$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
						}
						else
						{
							$GLOBALS['result_command'] = sprintf($this->lang->words['System']['Templates']['CreateTemplate']['Messages']['Error'], 0);
							$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
						}
					}
					
					CTM_Template::Lib('Sources')->CloseDatabase();
				}
			}
			
			$this->output->setContent("templates_createTemplate");
		}
		else
		{
			require_once(CTM_CACHE_PATH."server_cache/db_php/skin_sources/skin_sources.php");
			
			if($_GET['do'] == "remove_skin" && !empty($_GET['template']))
			{
				if($_GET['template'] == "Harmony" && CTM_DEVELOPER_MODE == false)
				{
					$GLOBALS['result_message'] = adminShowMessage($this->lang->words['System']['Templates']['RemoveTemplate']['Messages']['NoRemove'], 2);
				}
				else
				{
					CTM_Template::Lib('General')->RemoveFullSkin($_GET['template']);
					unset($CTM_SKIN_SOURCES[$_GET['template']]);

					$path = "server_cache/db_php/skin_sources/skin_sources.php";
					CTM_Controller::UpdateWebCache("effectwebkernelhash", "hash_file:".$path, "hash_file:".md5_file(CTM_CACHE_PATH.$path));
					
					$GLOBALS['result_message'] = adminShowMessage($this->lang->words['System']['Templates']['RemoveTemplate']['Messages']['Success'], 3);
				}
			}
		
			
			$GLOBALS['core_templates'] = array();
			
			if(count($CTM_SKIN_SOURCES) > 0)
			{
				foreach($CTM_SKIN_SOURCES as $key => $value)
				{
					$GLOBALS['core_templates'][$key] = array
					(
						"name" => $value['Name'],
						"author" => array
						(
							"name" => $value['Author']['Name'],
							"site" => $value['Author']['Site'],
						),
					);
				}
			}
			
			$this->output->setContent("templates_manageTemplates");
		}
	}
	/**
	 *	Private: Import/Export Templates
	 *	Import/Export templates by XML
	 *
	 *	@return	void
	*/
	private function loadImportExportTemplates()
	{
		if($_GET['process'])
		{
			switch($_GET['process'])
			{
				case "import" :
					if(empty($_FILES['FileUpload']['name']) && empty($_POST['FilePath']))
					{
						$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['SelectFile'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
					}
					else
					{
						$break = FALSE;
						$uploaded = FALSE;
						$is_zip = FALSE;
						
						if(!empty($_FILES['FileUpload']['name']))
						{
							$type = $_FILES['FileUpload']['type'];
							$is_zip = ($type == "application/x-gzip" || $type == "application/gzip") ? "gzip" : ($type == "application/zip" ? "zip" : "none");
							
							if($type != "text/xml" && $type != "application/x-gzip" && $type != "application/gzip" && $type != "application/zip")
							{
								$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['InvalidFile'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								
								$break = TRUE;
							}
							else
							{
								$filepath = CTM_CACHE_PATH."temp_cache/".md5(time()."&ew_template_temp_file&".mt_rand()).".tmp";
								
								if(!copy($_FILES['FileUpload']['tmp_name'], $filepath))
								{
									$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['UploadError'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
									
									$break = TRUE;
								}
								else
								{
									$uploaded = TRUE;
								}
							}
						}
						else
						{
							$filepath = CTM_ROOT_PATH.$_POST['FilePath'];
							
							$find_end = strrpos($filepath, ".");
							$file_end = substr($filepath, $find_end + 1);
							
							if(!file_exists($filepath))
							{
								$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['FileNoExists'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								
								$break = TRUE;
							}
							elseif($file_end != "xml" && $file_end != "gz" && $file_end != "zip")
							{
								$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['InvalidFile'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								
								$break = TRUE;
							}
							else
							{
								$is_zip = $file_end == "gz" ? "gzip" : ($file_end == "zip" ? "zip" : NULL);
							}
						}
						
						if($is_zip == "gzip" && $break == false)
						{
							if(!function_exists("gzopen") || !function_exists("gzread") || !function_exists("gzclose"))
							{
								$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['UnZipError'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								
								$break = TRUE;
							}
							else
							{
								if(($gzip = gzopen($filepath, "r")))
								{
									$tmp_path = CTM_CACHE_PATH."temp_cache/".md5(time()."&".EffectWebFiles::TEMPLATE_XML_FILENAME."&".mt_rand()).".tmp";
									$gz_content = gzread($gzip, filesize($filepath) * 2);
									
									gzclose($gzip);
									
									if($uploaded == true)
										unlink($filepath);
									
									$fp = fopen($tmp_path, "w");
									fwrite($fp, $gz_content);
									fclose($fp);
								}
								else
								{
									$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['UnZipError'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
									
									$break = TRUE;
								}
							}
						}
						elseif($is_zip == "zip" && $break == false)
						{
							if(!class_exists("ZipArchive"))
							{
								$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['UnZipError'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								
								$break = TRUE;
							}
							else
							{
								$zip = new ZipArchive();
								
								if($zip->open($filepath))
								{
									$filename = md5(time()."&".EffectWebFiles::TEMPLATE_XML_FILENAME."&".mt_rand()).".tmp";
									$tmp_path = CTM_CACHE_PATH."temp_cache/".$filename;
									
									$zip->renameName(EffectWebFiles::TEMPLATE_XML_FILENAME, $filename);
									$zip->extractTo(CTM_CACHE_PATH."temp_cache/", array($filename));
									$zip->renameName($filename, EffectWebFiles::TEMPLATE_XML_FILENAME);
									$zip->close();
									
									if($uploaded == true)
										unlink($filepath);
								}
								else
								{
									$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['UnZipError'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
									
									$break = TRUE;
								}
							}
						}
						else
						{
							$tmp_path = $filepath;
						}
						
						if($break == false)
						{
							$xml_content = file_get_contents($tmp_path);
							
							if(file_exists($tmp_path) && $tmp_path != $filepath && ($is_zip == "gzip" || $is_zip == "zip"))
								unlink($tmp_path);
								
							if($uploaded == true && $is_zip == "none")
								unlink($filepath);
							
							if(!CTM_FileManage::Lib('XML')->IsXML($xml_content) || !strstr($xml_content, "<skin_xml") || !strstr($xml_content, "<skin_info>"))
							{
								$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['FileCorrupted'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							else
							{
								CTM_Template::Lib('ImportExport')->ImportXML($xml_content, $skin_info);
								
								if($skin_info == "XML_CORRUPTED")
								{
									$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['FileCorrupted'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								}
								elseif($skin_info == "INVALID_CODEKEY")
								{
									$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['InvalidTemplate'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								}
								elseif($skin_info == "VAR_0_ERROR")
								{
									$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['LicenseError'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								}
								else
								{
									$path = "server_cache/db_php/skin_sources/skin_sources.php";
									CTM_Controller::UpdateWebCache("effectwebkernelhash", "hash_file:".$path, "hash_file:".md5_file(CTM_CACHE_PATH.$path));

									$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Import']['Messages']['Success'];
									$GLOBALS['result_command'] = sprintf($GLOBALS['result_command'], $skin_info['Name'], $skin_info['SkinSet']);
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
								}
							}
						}
						else
						{
							if($uploaded == true)
							{
								if(file_exists($filepath))
									unlink($filepath);
									
								if(file_exists($tmp_path))
									unlink($tmp_path);
							}
						}
					}
				break;
				case "export" :
					CTM_Template::Lib('Sources')->OpenDatabase();
					
					if(!CTM_Template::Lib('Sources')->CheckSkin($_POST['Template']))
					{
						CTM_Template::Lib('Sources')->CloseDatabase();
						
						$GLOBALS['result_command'] = $this->lang->words['System']['Templates']['ImportExport']['Export']['Messages']['TemplateInvalid'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
					}
					else
					{
						CTM_Template::Lib('ImportExport')->ExportXML("ew_template", $_POST['Template'], $this->skin_cache_keys, true, CTM_ACP_USE_ZIP);
					}
				break;
			}
		}
		
		CTM_Template::Lib('Sources')->OpenDatabase();
		CTM_Template::Lib('Sources')->GetAllSkins($_templates);
		CTM_Template::Lib('Sources')->CloseDatabase();
		
		if(count($_templates) > 0)
			foreach($_templates as $key => $value)
				$GLOBALS['templates'][$key] = $value['Name'];
				
		$GLOBALS['template_default_xml_file'] = EffectWebFiles::TEMPLATE_XML_FILENAME;
	}
}