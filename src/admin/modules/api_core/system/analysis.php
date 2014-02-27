<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: System Control - Analysis
 * Last Update: 09/06/2013 - 18:29h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_System_Analysis extends Core_Admin_System
{
	private $logs_folders	= array
	(
		"cronjob" => array("CronJob", "CronJob Logs"),
		"debug" => array("Debug", "Debug Logs"),
		"phperror" => array("ServerError", "Server Error Logs"),
		"mssql" => array("MSSQL", "MSSQL Error Logs"), 
		"mysql" => array("MySQL", "MySQL Error Logs"),
		"mailer" => array("Mailer", "Mailer Debug Logs"),
		"userpanel" => array("UserPanel", "User Panel Logs")
	);
	private $logs_zip_file	= array
	(
		"name" => "effectweb_logs_%s",
		"date" => "d_m_Y"
	);
	
	/**
	 *	Init module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		switch($_GET['index'])
		{
			default :
				$this->loadSystemLogs();
			break;
		}
	}
	/**
	 *	Private: System Logs
	 *	View and manage the system's logs
	 *
	 *	@return	void
	*/
	private function loadSystemLogs()
	{
		if(!empty($_GET['load_file']) && !empty($_GET['folder']))
		{
			if(array_key_exists($_GET['folder'], $this->logs_folders))
			{
				$folder = $this->logs_folders[$_GET['folder']][0];
				$file = $folder."-(".str_replace(EW_LOG_EXT, NULL, $_GET['load_file']).")".EW_LOG_EXT;
				
				$_GET['load_file'] = urldecode($_GET['load_file']);
				$GLOBALS['file_exists'] = file_exists(EW_LOG_PATH.$folder."/".$_GET['load_file']);
				
				if($GLOBALS['file_exists'] == true)
					$GLOBALS['log_file_content'] = file_get_contents(EW_LOG_PATH.$folder."/".$_GET['load_file']);
				
				if($_GET['do'] == "download")
				{
					if($GLOBALS['file_exists'] == true)
					{
						if(CTM_ACP_USE_ZIP == "gzip")
						{
							showFileDownload($file.".gz", gzencode($GLOBALS['log_file_content'], 9));
						}
						elseif(CTM_ACP_USE_ZIP == "zip")
						{
							if(class_exists("ZipArchive"))
							{
								$zip = new ZipArchive();
								$zip->open(($filepath = CTM_CACHE_PATH."temp_cache/".md5(mt_rand()."log__::".time()."__zip").".tmp"), ZipArchive::CREATE);
								$zip->addFile(EW_LOG_PATH.$folder."/".$_GET['load_file'], $_GET['load_file']);
								$zip->close();
								
								$content = file_get_contents($filepath);
								unlink($filepath);
							}
							else
							{
								$zip = new ZipFile();
								$zip->addFile($GLOBALS['log_file_content'], $_GET['load_file'], filemtime(EW_LOG_PATH.$log."/".$filename));
								$content = $zip->file();
							}
							
							showFileDownload($file.".zip", $content);
						}
						else
						{
							showFileDownload($file, $GLOBALS['log_file_content']);
						}
					}
				}
				elseif($_GET['do'] == "delete")
				{
					if($GLOBALS['file_exists'] == true)
					{
						if(!unlink(EW_LOG_PATH.$folder."/".$_GET['load_file']))
						{
							$GLOBALS['result_command'] = $this->lang->words['System']['Analysis']['SystemLogs']['ShowLogs']['Messages']['DeleteError'];
							$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
						}
						else
						{
							$url = "?app=core&module=system&section=analysis&index=logs&load_folder=".$_GET['folder']."&message=file_deleted";
							header("Location: ".CTM_URLEngine::URLBase().$url);
							exit();
						}
					}
				}
					
				$this->lang->setArguments("System,Analysis,SystemLogs,ShowLogs,Title", $_GET['load_file']);
				return $this->output->setContent("analysis_logsShowFile");
			}
			else
			{
				header("Location: ".CTM_URLEngine::URLBase()."?app=core&module=system&section=analysis&index=logs");
			}
		}
		elseif(!empty($_GET['load_folder']))
		{
			if(array_key_exists($_GET['load_folder'], $this->logs_folders))
			{
				$log = $this->logs_folders[$_GET['load_folder']][0];
				
				if(!file_exists(EW_LOG_PATH.$log))
				{
					mkdir(EW_LOG_PATH.$log);
					$GLOBALS['logs_files'] = array();
				}
				else
				{
					if($_GET['do'] == true)
					{
						if($_POST['DoCommand'] == "deleteFiles")
						{
							$count = 0;
							
							if(count($_POST) > 0)
							{
								foreach($_POST as $key => $value)
								{
									if(substr($key, 0, 6) == "file__" && $value == 1)
									{
										$file = substr($key, 6);
										$file = str_replace("_".substr(EW_LOG_EXT, 1), EW_LOG_EXT, $file);
										
										if(file_exists(EW_LOG_PATH.$log."/".$file))
										{
											unlink(EW_LOG_PATH.$log."/".$file);
											$count++;
										}
									}
								}
							}
							
							$GLOBALS['result_command'] = sprintf($this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Messages']['FilesDeleted'], $count);
							$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
						}
						elseif($_POST['DoCommand'] == "downloadFiles")
						{
							$files_to_download = array();
							
							if(count($_POST) > 0)
							{
								foreach($_POST as $key => $value)
								{
									if(substr($key, 0, 6) == "file__" && $value == 1)
									{
										$file = substr($key, 6);
										$file = str_replace("_".substr(EW_LOG_EXT, 1), EW_LOG_EXT, $file);
										
										if(file_exists(EW_LOG_PATH.$log."/".$file))
										{
											$files_to_download[] = $file;
										}
									}
								}
							}
							
							if(count($files_to_download) == 0)
							{
								$GLOBALS['result_command'] = $this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Messages']['SelectFiles'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
							}
							else
							{
								if(class_exists("ZipArchive"))
								{
									$filepath = CTM_CACHE_PATH."temp_cache/".md5(mt_rand()."log__::".time()."__zip").".tmp";
									
									$zip = new ZipArchive();
									$zip->open($filepath, ZipArchive::CREATE);
								}
								else
								{
									$zip = new ZipFile();
								}
								
								foreach($files_to_download as $filename)
								{
									if(class_exists("ZipArchive"))
									{
										$zip->addFile(EW_LOG_PATH.$log."/".$filename, $filename);
									}
									else
									{
										$content = file_get_contents(EW_LOG_PATH.$log."/".$filename);
										$time = filemtime(EW_LOG_PATH.$log."/".$filename);
									
										$zip->addFile($content, $filename, $time);
									}
								}
								
								if(class_exists("ZipArchive"))
								{
									$zip->close();
									
									$content = file_get_contents($filepath);
									unlink($filepath);
								}
								else
								{
									$content = $zip->file();
								}
								
								showFileDownload($log."_Logs.zip", $content);
							}
						}
						else
						{
							$GLOBALS['result_command'] = $this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Messages']['SelectAction'];
							$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
						}
					}
					
					$GLOBALS['logs_files'] = array();
					
					if(count(($iterator = new DirectoryIterator(EW_LOG_PATH.$log))) > 0)
					{
						foreach($iterator as $fileinfo)
						{
							if($fileinfo->isDot() == false && $fileinfo->isDir() == false)
							{
								$extension = strrpos($fileinfo->getFilename(), ".");
								$extension = substr($fileinfo->getFilename(), $extension);
											
								if(($fileinfo->isFile() == true || $fileinfo->isLink() == true) && $extension == EW_LOG_EXT)
								{
									$GLOBALS['logs_files'][$fileinfo->getFilename()] = array
									(
										"change_data" => date("d/m/Y - H:i:s", $fileinfo->getMTime()),
										"file_size" => realFormatBytes($fileinfo->getSize())
									);
								}
							}
						}
					}
				}
				
				$this->lang->setArguments("System,Analysis,SystemLogs,CategoryLogs,Title", $this->logs_folders[$_GET['load_folder']][1]);
				return $this->output->setContent("analysis_logsFiles");
			}
			else
			{
				header("Location: ".CTM_URLEngine::URLBase()."?app=core&module=system&section=analysis&index=logs");
			}
		}
		else
		{
			if($_GET['do_folder'] == true)
			{
				if($_POST['DoCommand'] != "clearFolders" && $_POST['DoCommand'] != "downloadFolders")
				{
					$GLOBALS['result_command'] = $this->lang->words['System']['Analysis']['SystemLogs']['DoCommand']['Messages']['SelectAction'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
				}
				elseif($_POST['DoCommand'] == "clearFolders")
				{
					$folders_count = 0;
					$files_count = 0;
					$select_count = 0;
					
					foreach($_POST as $key => $value)
					{
						if(substr($key, 0, 8) == "folder__" && $value == 1)
						{
							$folder = substr($key, 8);
							$tmp_count = 0;
							$select_count++;
							
							if(array_key_exists($folder, $this->logs_folders))
							{
								$folder = $this->logs_folders[substr($key, 8)][0];
								
								if(!file_exists(EW_LOG_PATH.$folder))
									mkdir(EW_LOG_PATH.$folder);
									
								if(count(($iterator = new DirectoryIterator(EW_LOG_PATH.$folder))) > 0)
								{
									foreach($iterator as $fileinfo)
									{
										if($fileinfo->isDot() == false && $fileinfo->isDir() == false)
										{
											$extension = strrpos($fileinfo->getFilename(), ".");
											$extension = substr($fileinfo->getFilename(), $extension);
											
											if(($fileinfo->isFile() == true || $fileinfo->isLink() == true) && $extension == EW_LOG_EXT)
											{
												unlink(EW_LOG_PATH.$folder."/".$fileinfo->getFilename());
												$files_count++;
												$tmp_count++;
											}
										}
									}
								}
								
								if($tmp_count > 0)
									$folders_count++;
							}
						}
					}
					
					if($select_count == 0)
					{
						$GLOBALS['result_command'] = $this->lang->words['System']['Analysis']['SystemLogs']['DoCommand']['Messages']['SelectFolders'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
					}
					else
					{
						$this->lang->setTags("System,Analysis,SystemLogs,DoCommand,Messages,FoldersCleaned", $files_count, $folders_count);
						
						$GLOBALS['result_command'] = $this->lang->words['System']['Analysis']['SystemLogs']['DoCommand']['Messages']['FoldersCleaned'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
					}
				}
				elseif($_POST['DoCommand'] == "downloadFolders")
				{
					$folders_to_download = array();
					$select_count = 0;
					
					foreach($_POST as $key => $value)
					{
						if(substr($key, 0, 8) == "folder__" && $value == 1)
						{
							$folder = substr($key, 8);
							$select_count++;
							
							if(array_key_exists($folder, $this->logs_folders))
							{
								$folder = $this->logs_folders[substr($key, 8)][0];
								$folders_to_download[$folder] = array();
								
								if(!file_exists(EW_LOG_PATH.$folder))
									mkdir(EW_LOG_PATH.$folder);
									
								if(count(($iterator = new DirectoryIterator(EW_LOG_PATH.$folder))) > 0)
								{
									foreach($iterator as $fileinfo)
									{
										if($fileinfo->isDot() == false && $fileinfo->isDir() == false)
										{
											$extension = strrpos($fileinfo->getFilename(), ".");
											$extension = substr($fileinfo->getFilename(), $extension);
											
											if(($fileinfo->isFile() == true || $fileinfo->isLink() == true) && $extension == EW_LOG_EXT)
											{
												$folders_to_download[$folder][$fileinfo->getFilename()] = $fileinfo->getMTime();
											}
										}
									}
								}
							}
						}
					}
					
					if($select_count == 0)
					{
						$GLOBALS['result_command'] = $this->lang->words['System']['Analysis']['SystemLogs']['DoCommand']['Messages']['SelectFolders'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
					}
					else
					{
						if(class_exists("ZipArchive"))
						{
							$filepath = CTM_CACHE_PATH."temp_cache/".md5(mt_rand()."log__::".time()."__zip").".tmp";
							
							$zip = new ZipArchive();
							$zip->open($filepath, ZipArchive::CREATE);
						}
						else
						{
							$zip = new ZipFile();
						}
						
						foreach($folders_to_download as $folder => $files)
						{
							if(class_exists("ZipArchive"))
								$zip->addEmptyDir($folder);
							else
								$zip->addFile(NULL, $folder."/");
							
							if(count($files) > 0)
							{
								foreach($files as $filename => $filetime)
								{
									if(class_exists("ZipArchive"))
									{
										$zip->addFile(EW_LOG_PATH.$folder."/".$filename, $folder."/".$filename);
									}
									else
									{
										$content = file_get_contents(EW_LOG_PATH.$folder."/".$filename);
										$zip->addFile($content, $folder."/".$filename, $filetime);
									}
								}
							}
						}
						
						if(class_exists("ZipArchive"))
						{
							$zip->close();
							
							$content = file_get_contents($filepath);
							unlink($filepath);
						}
						else
						{
							$content = $zip->file();
						}
						
						showFileDownload(sprintf($this->logs_zip_file['name'], date($this->logs_zip_file['date'])).".zip", $content);
					}
				}
			}
			
			foreach($this->logs_folders as $key => $value)
			{
				$GLOBALS['logs_folders'][$key] = array
				(
					"name" => $value[1],
					"count_files" => number_format(intval(count(glob(EW_LOG_PATH.$value[0]."/*".EW_LOG_EXT))), 0, false, ".")
				);
			}
			
			$this->output->setContent("analysis_logs");
		
			if(loadIsAjax() == true)
				$this->output->setVariable("no_set_tmp", true);
		}
	}
}