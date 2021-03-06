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

class TemplateEngine_Sources extends CTM_Template
{
	private $settings	= array();
	private $database	= array();
	private $opened		= FALSE;
	private $update		= FALSE;
	
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
	 *	Open Database
	 *	Open the sources database
	 *
	 *	@return	boolean
	*/
	public function OpenDatabase()
	{
		if($this->opened == false)
		{
			require($this->settings['DatabaseDir']);
			
			$this->database = is_array($CTM_SKIN_SOURCES) ? $CTM_SKIN_SOURCES : array();
			return $this->opened = true;
		}
	}
	/**
	 *	Check template
	 *	Check if the template exists
	 *
	 *	@param	string	Template name
	 *	@return	boolean
	*/
	public function CheckSkin($name)
	{
		if($this->opened == true)
			if(!empty($this->database))
				return array_key_exists($name, $this->database);
				
		return false;
	}
	/**
	 *	Get template
	 *	Get the template data
	 *
	 *	@param	string		Template name
	 *	@param	&array|bool	Template content
	 *	@return	array|bool
	*/
	public function GetSkin($name, &$return = NULL)
	{
		if($this->opened == true)
			return $return = $this->database[$name] ? $this->database[$name] : false;
			
		return false;
	}
	/**
	 *	Add/Edit template
	 *	Add/Edit template source
	 *
	 *	@param	string	Template name
	 *	@param	array	Template data
	 *	@return	void
	*/
	public function SetSkin($name, $data)
	{
		if($this->opened == true)
		{
			$this->database[$name] = $data;
			$this->update = TRUE;
		}
	}
	/**
	 *	Get All Skins
	 *	Get all templates data
	 *
	 *	@param	&array	Template datas
	 *	@return	array
	*/
	public function GetAllSkins(&$return = array())
	{
		if($this->opened == true)
			return $return = $this->database;
	}
	/**
	 *	Remove template
	 *	Remove template from sources
	 *
	 *	@param	string	Template name
	 *	@return	void
	*/
	public function RemoveSkin($name)
	{
		if($this->opened == true)
		{
			unset($this->database[$name]);
			$this->update = TRUE;
		}
	}
	/**
	 *	Close Database
	 *	Close and extract the database
	 *
	 *	@return	void
	*/
	public function CloseDatabase()
	{
		if($this->opened == true)
		{
			if($this->update == true)
			{
				$date = date("d/m/Y - H:i");
				$yy = date("Y");
				
				$dbFile = "<?php\n";
				$dbFile .= "/***********************************************************/\n";
				$dbFile .= "/* Cetemaster Services, Limited                            */\n";
				$dbFile .= "/* Copyright (c) 2010-$yy. All Rights Reserved,           */\n";
				$dbFile .= "/* www.cetemaster.com.br / www.cetemaster.com              */\n";
				$dbFile .= "/***********************************************************/\n";
				$dbFile .= "/* File generated by Cetemaster PHP Template Engine        */\n";
				$dbFile .= "/* Skin sources - skin_sources.php                         */\n";
				$dbFile .= "/* DB generated in ".  str_pad($date."h", 40, " ").       "*/\n";
				$dbFile .= "/***********************************************************/\n";
				$dbFile .= "/* This is a cache file generated by ".str_pad($this->settings['SystemName'], 22, " ")."*/\n";
				$dbFile .= "/* DO NOT EDIT DIRECTLY                                    */\n";
				$dbFile .= "/* The changes are not saved to the cache automatically    */\n";
				$dbFile .= "/***********************************************************/";
				
				foreach($this->database as $key => $data)
				{
					if(!$data['CodeKey'])
					{
						$checksum = strtoupper(dechex(crc32("{key::".md5($key."::".$data['Name'])."::template_ctm::NONE::none}")));
						$new_key = "{".strtoupper($checksum)."--NONE--none}";

						$encode = CTM_Crypt::Lib('MaxEncoder');
						$encode->SetText($new_key);
						$encode->AddPassword(md5($this->settings['CodeKeyCryptKey']));
						$encode->Encode(true);

						$data['CodeKey'] = $encode->newString;
					}

					$dbFile .= "\n\n/********** Begin: {$key} **********/\n";
					$dbFile .= "\$CTM_SKIN_SOURCES['".$key."'] = array\n(\n	";
					$dbFile .= "\"Name\" => ".(!empty($data['Name']) ? '"'.$data['Name'].'"' : "NULL").",\n	";
					$dbFile .= "\"CodeKey\" => ".(!empty($data['CodeKey']) ? '"'.$data['CodeKey'].'"' : "NULL").",\n	";
					$dbFile .= "\"Author\" => array\n	(\n		";
					$dbFile .= "\"Name\" => ".(!empty($data['Author']['Name']) ? '"'.$data['Author']['Name'].'"' : "NULL").",\n		";
					$dbFile .= "\"Site\" => ".(!empty($data['Author']['Site']) ? '"'.$data['Author']['Site'].'"' : "NULL").",\n	),\n";
					/*$dbFile .= "	\"SkinSet\" => array\r\n	(\r\n		";
					
					if(count($data['SkinSet']) > 0)
						foreach($data['SkinSet'] as $k => $v)
							$dbFile .= "		\"".$k."\" => \"".$v."\",\r\n";*/
							
					//$dbFile .= "	),\r\n);";
					$dbFile .= ");";
					$dbFile .= "\n/********** End: {$key} **********/";
				}
					
				$fp = fopen($this->settings['DatabaseDir'], "wb");
				fwrite($fp, $dbFile);
				fclose($fp);
			}
			
			$this->database = array();
			$this->opened = FALSE;
			$this->update = FALSE;
		}
	}
}