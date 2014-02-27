<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * File Management: Directory
 * Author: $CTM['Erick-Master']
 * Last Update: 03/09/2012 - 06:03h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class FileManagement_Directory extends CTM_FileManage
{
	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		//self::$settings = $settings;
	}
	/**
	 *	Remove Directory
	 *	Remove al files and the directory from path
	 *
	 *	@param	string	Path
	 *	@return	boolean
	*/
	public function RemoveDirectory($path)
	{
		if(file_exists($path) && is_dir($path))
		{
			$clear_result = $this->ClearDirectory($path);
			$rmdir_result = rmdir($path);
			
			return $clear_result == true && $rmdir_result == true;
		}
	}
	/**
	 *	Clear Directory
	 *	Remove all files and/or directorys from path
	 *
	 *	@param	string	Path
	 *	@return	boolean
	*/
	public function ClearDirectory($path)
	{
		if(file_exists($path) && is_dir($path))
		{
			if(count(($iterator = new DirectoryIterator($path))) > 0)
			{
				foreach($iterator as $fileinfo)
				{
					if($fileinfo->isDot() == false)
					{
						if($fileinfo->isDir() == true)
						{
							$this->ClearDirectory($fileinfo->getPathname());
							
							if(!rmdir($fileinfo->getPathname()))
								return false;
						}
						elseif($fileinfo->isFile() == true || $fileinfo->isLink() == true)
						{
							if(!unlink($fileinfo->getPathname()))
								return false;
						}
					}
				}
			}
			
			return true;
		}
		
		return false;
	}
}