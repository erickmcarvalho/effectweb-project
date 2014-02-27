<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Template Engine: Sources Manage
 * Author: $CTM['Erick-Master']
 * Last Update: 31/08/2012 - 04:13h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class TemplateEngine_General extends CTM_Template
{
	private $settings	= array();
	
	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		$this->settings = $settings;
	}
	/**
	 *	Create Skin
	 *	Create the skin files
	 *
	 *	@return	void
	*/
	public function CreateSkin($skin_set, $skin_info, $skin_data = array())
	{
		try
		{
			mkdir(CTM_CACHE_PATH."skin_cache/templates/".$skin_set);
			mkdir(CTM_CACHE_PATH."server_cache/db_php/skin_sources/".$skin_set);
			mkdir(CTM_PUBLIC_PATH."style_css/".$skin_set);
			mkdir(CTM_PUBLIC_PATH."style_images/".$skin_set);
			mkdir(CTM_PUBLIC_PATH."style_resources/".$skin_set);
			
			foreach($skin_data as $key => $files)
			{
				$full_path = CTM_CACHE_PATH."skin_cache/templates/".$skin_set."/skin_".$key.".php";
				
				parent::Lib('Logic')->PrepareToBuild();
				parent::Lib('Database')->OpenDatabase($skin_set, $key);
				
				if(count($files) > 0)
				{
					foreach($files as $k => $content)
					{
						parent::Lib('Logic')->ConvertHTMLToPHP($content, $k, NULL);
						parent::Lib('Database')->SetFile($k, $content);
					}
				}
				
				parent::Lib('Database')->CloseDatabase();
				parent::Lib('Logic')->CompileSkinFile("skin_".$key, "skin_".$key, $full_path);
			}
			
			parent::Lib('Sources')->OpenDatabase();
			parent::Lib('Sources')->SetSkin($skin_set, $skin_info);
			parent::Lib('Sources')->CloseDatabase();
			
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	/**
	 *	Update Skin Cache
	 *	Update the cache files
	 *
	 *	@param	string	Skin set
	 *	@param	array	Cache files
	 *	@return	void
	*/
	public function UpdateSkinCache($skin_set, $skin_data)
	{
		if(count($skin_data) > 0)
		{
			foreach($skin_data as $key => $files)
			{
				$full_path = CTM_CACHE_PATH."skin_cache/templates/".$skin_set."/skin_".$key.".php";
				
				parent::Lib('Logic')->PrepareToBuild();
				parent::Lib('Database')->OpenDatabase($skin_set, $key);
				
				if(count($files) > 0)
				{
					foreach($files as $k => $content)
					{
						parent::Lib('Logic')->ConvertHTMLToPHP($content, $k, NULL);
						parent::Lib('Database')->SetFile($k, $content);
					}
				}
				
				parent::Lib('Database')->CloseDatabase();
				parent::Lib('Logic')->CompileSkinFile("skin_".$key, "skin_".$key, $full_path);
			}
		}
	}
	/**
	 *	Remove Full Skin
	 *	Delete all cache files from skin
	 *
	 *	@param	string	Skin set
	 *	@return	void
	*/
	public function RemoveFullSkin($template)
	{
		if(file_exists(CTM_CACHE_PATH."skin_cache/templates/".$template))
			CTM_FileManage::Lib('Directory')->RemoveDirectory(CTM_CACHE_PATH."skin_cache/templates/".$template);
		
		if(file_exists(CTM_CACHE_PATH."server_cache/db_php/skin_sources/".$template))
			CTM_FileManage::Lib('Directory')->RemoveDirectory(CTM_CACHE_PATH."server_cache/db_php/skin_sources/".$template);
			
		if(file_exists(CTM_PUBLIC_PATH."style_css/".$template))
			CTM_FileManage::Lib('Directory')->RemoveDirectory(CTM_PUBLIC_PATH."style_css/".$template);
			
		if(file_exists(CTM_PUBLIC_PATH."style_images/".$template))
			CTM_FileManage::Lib('Directory')->RemoveDirectory(CTM_PUBLIC_PATH."style_images/".$template);
			
		if(file_exists(CTM_PUBLIC_PATH."style_resources/".$template))
			CTM_FileManage::Lib('Directory')->RemoveDirectory(CTM_PUBLIC_PATH."style_resources/".$template);
			
		CTM_Template::Lib('Sources')->OpenDatabase();
		CTM_Template::Lib('Sources')->RemoveSkin($template);
		CTM_Template::Lib('Sources')->CloseDatabase();
	}
	/**
	 *	Remove Skin Cache
	 *	Remove the cache file
	 *
	 *	@param	string	Category name
	 *	@return	void
	*/
	public function RemoveSkinCache($template, $category)
	{
		if(file_exists(CTM_CACHE_PATH."skin_cache/".$template."/skin_".$category.".php"))
			return unlink(CTM_CACHE_PATH."skin_cache/".$template."/skin_".$category.".php") == true;
			
		return false;
	}
}