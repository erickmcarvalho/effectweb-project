<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: Quest
 * Author: $CTM['Erick-Master']
 * Last Update: 29/07/2012 - 04:04h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class MuOnline_Quest extends CTM_MuOnline
{
	private $settings	= array
	(
		"Database" => "MuOnline",
		"QuestNumber" => 7,
		"Files" => array
		(
			"Database" => "QuestData.txt",
		),
		"StatusName" => array
		(
			0 => "Not contain",
			1 => "Not completed",
			2 => "Finished",
			3 => "Not contain"
		),
		"QuestName" => array
		(
			0 => "Scroll of Emperor",
			1 => "Treausures Of Mu",
			2 => "Hero Status",
			3 => "Dark Stone",
			4 => "Proof of Strenght",
			5 => "Kill Balgass's Minions",
			6 => "The Dark Elf General"
		)
	);
										
	private $vars			= array();
	private $database		= array();
										
	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		if(!$settings['Database']) $settings['Database'] = $this->settings['Database'];
		if(!$settings['QuestNumber']) $settings['QuestNumber'] = $this->settings['QuestNumber'];
		if(!$settings['Files']) $settings['Files'] = $this->settings['Files'];
		if(!$settings['StatusName']) $settings['StatusName'] = $this->settings['StatusName'];
		if(!$settings['QuestName']) $settings['QuestName'] = $this->settings['QuestName'];
		
		$this->settings = $settings;
	}
	/**
	 *	Open Quest
	 *	Open quests from Character or Hexadecimal
	 *
	 *	@param	string	Character name
	 *	@param	string	Hexadecimal
	 *	@return	void
	*/
	public function OpenQuest($character = FALSE, $hexadecimal = NULL)
	{
		if(empty($hexadecimal) && strlen($character) > 0)
		{
			$queryString = "DECLARE @quest varbinary(50);\n\n";
			$queryString .= "SELECT @quest = [Quest] FROM [".$this->settings['Database']."]";
			$queryString .= ".dbo.[Character] WHERE [Name] = '%s';\nPRINT @quest;";
			
			self::Driver()->MSSQL()->Arguments($character);
			self::Driver()->MSSQL()->Query($queryString);
			
			$hexadecimal = strtoupper(substr(trim(self::Driver()->MSSQL()->Client()->GetLastMessage()), 2));
			
			$this->vars['character'] = $character;
			$this->vars['questhexa'] = $hexadecimal;
		}
		else
		{
			if(empty($hexadecimal))
				$hexadecimal = str_repeat("FF", 50);
				
			$this->vars['questhexa'] = str_pad(strtoupper(str_replace("0x", NULL, strtolower($hexadecimal))), 100, "F", STR_PAD_RIGHT);
		}
		
		for($i = 0; $i < 50; $i++)
		{
			$byte = substr($this->vars['questhexa'], $i * 2, 2);
			$this->vars['bytes'][$i] = !$byte ? "FF" : $byte;
		}
		
		for($i = 0; $i < $this->settings['QuestNumber']; $i++)
		{
			$real_id = $i > 3 ? (($i - 4) < 0 ? 0 : $i - 4) : $i;
			$byte = $this->vars['bytes'][intval($i / 4)];
			
			$this->vars['quests'][$i]['byte'] = intval($i / 4);
			$this->vars['quests'][$i]['status'] = (hexdec($byte) & (3 * pow(4 , $real_id))) / pow(4 , $real_id);
		}
	}
	/**
	 *	Set Status Quest
	 *	Set the status from quest
	 *
	 *	@param	integer	Quest ID
	 *	@param	integer	Status
	 *	@return	void
	*/
	public function SetQuestStatus($quest, $status = 0)
	{
		$byte = 0;
		$real_id = $quest > 3 ? (($quest - 4) < 0 ? 0 : $quest - 4) : $quest;
		$status = $status < 0 ? 0 : ($status > 3 ? 3 : $status);
		
		if($real_id == 0) $byte += $status * pow(4, 0);
		if($real_id == 1) $byte += $status * pow(4, 1);
		if($real_id == 2) $byte += $status * pow(4, 2);
		if($real_id == 3) $byte += $status * pow(4, 3);
		
		if($real_id != 0) $byte += $this->GetQuestStatus(($quest - $real_id) + 0) * pow(4, 0);
		if($real_id != 1) $byte += $this->GetQuestStatus(($quest - $real_id) + 1) * pow(4, 1);
		if($real_id != 2) $byte += $this->GetQuestStatus(($quest - $real_id) + 2) * pow(4, 2);
		if($real_id != 3) $byte += $this->GetQuestStatus(($quest - $real_id) + 3) * pow(4, 3);
		
		$this->vars['bytes'][intval($quest / 4)] = strtoupper(dechex($byte >= 255 ? 255 : $byte));
		$this->vars['quests'][$quest]['status'] = $status;
	}
	/**
	 *	Get Status Quest
	 *	Get the status from quest
	 *
	 *	@param	integer	Quest ID
	 *	@return	integer
	*/
	public function GetQuestStatus($quest)
	{
		return $this->vars['quests'][$quest]['status'];
	}
	/**
	 *	Set Status All Quests
	 *	Set the status from all quests
	 *
	 *	@param	integer	Status
	 *	@return	void
	*/
	public function SetAllQuestStatus($status = 2)
	{
		for($i = 0; $i < $this->settings['QuestNumber']; $i++)
			$this->SetQuestStatus($i, $status);
	}
	/**
	 *	Get Status All Quests
	 *	Get the status from all quest
	 *
	 *	@param	&array	Return data
	 *	@return	array
	*/
	public function GetAllQuestStatus(&$return = array())
	{
		foreach($this->vars['quests'] as $id => $data)
		{
			$byte = $this->vars['bytes'][$data['byte']];
			
			$real_id = $id > 3 ? (($id - 4) < 0 ? 0 : $id - 4) : $id;
			$real_status = (hexdec($byte) & (3 * pow(4 , $real_id))) / pow(4 , $real_id);
			
			$return[$id] = array
			(
				"Name" => $this->settings['QuestName'][$id],
				"Status" => $real_status,
				"StatusName" => $this->settings['StatusName'][$real_status]
			);
		}
		
		return $return;
	}
	/**
	 *	Compile Quest Hex
	 *	Compile the hex of all quests
	 *
	 *	@param	string	Quest Hex
	 *	@return	string
	*/
	public function CompileQuestHex(&$questHexa = NULL)
	{
		for($i = 0; $i < 50; $i++)
			$questHexa .= strtoupper($this->vars['bytes'][$i]);
			
		return str_pad($questHexa, 100, "F", STR_PAD_RIGHT);
	}
	/**
	 *	Close Quest
	 *	Close quests and update the database
	 *
	 *	@param	boolean	Update Database
	 *	@param	string	Quest Content Hex
	 *	@return	string
	*/
	public function CloseQuest($update_database = FALSE, &$quest_content = NULL)
	{
		$quest_content = $this->CompileQuestHex();
		
		if($update_database == true)
		{
			$queryString = "UPDATE [".$this->settings['Database']."].dbo.[Character]";
			$queryString .= " SET [Quest] = 0x".$quest_content;
			$queryString .= " WHERE [Name] = '%s'";
			
			self::Driver()->MSSQL()->Arguments($this->vars['character']);
			self::Driver()->MSSQL()->Query($queryString);
		}
		
		$this->vars = array();
		return $quest_content;
	}
	/**
	 *	Get Quest Database
	 *	Get the quest database
	 *
	 *	@param	integer	Quest ID
	 *	@param	&array	Quest Database
	 *	@return	array
	*/
	public function GetQuestDatabase($quest = -1, &$quest_database = array())
	{
		$serialize_file = CTM_FileManage::Lib('ReadScript')->CheckSerializeFile("Quest_Data.serialize.dat") == false;
		$structure_file = CTM_FileManage::Lib('ReadScript')->StructureFile($this->settings['Files']['Database'], "Quest_Data.serialize.dat", false);
		$serialize_data = CTM_FileManage::Lib('ReadScript')->ReadScript();
		
		if($serialize_file == true || $structure_file == true)
		{
			foreach($serialize_data as $key => $value)
			{
				if($key == "0-X")
				{
					foreach($value as $v)
					{
						$this->database['Data'][$v[0]]['Id'] = $v[0];
						$this->database['Data'][$v[0]]['Name'] = $v[1];
						$this->database['Data'][$v[0]]['MinLevel'] = $v[2];
						$this->database['Data'][$v[0]]['MaxLevel'] = $v[3];
						$this->database['Data'][$v[0]]['DW/SM/GM'] = $v[4];
						$this->database['Data'][$v[0]]['DK/BK/BM'] = $v[5];
						$this->database['Data'][$v[0]]['FE/ME/HE'] = $v[6];
						$this->database['Data'][$v[0]]['MG/DM'] = $v[7];
						$this->database['Data'][$v[0]]['DL/LE'] = $v[8];
						$this->database['Data'][$v[0]]['SU/BS/DIM'] = $v[9];
						$this->database['Data'][$v[0]]['RF/FE'] = $v[10];
					}
				}
				else
				{
					$id = substr($key, 2);
					
					for($i = 0; $i < $this->settings['QuestNumber']; $i++)
					{
						$this->database['Data'][$id]['RequireQuest']['DW/SM/GM'][$i] = $value[0][$i + 1];
						$this->database['Data'][$id]['RequireQuest']['DK/BK/BM'][$i] = $value[1][$i + 1];
						$this->database['Data'][$id]['RequireQuest']['FE/ME/HE'][$i] = $value[2][$i + 1];
						$this->database['Data'][$id]['RequireQuest']['MG/DM'][$i] = $value[3][$i + 1];
						$this->database['Data'][$id]['RequireQuest']['DL/LE'][$i] = $value[4][$i + 1];
						$this->database['Data'][$id]['RequireQuest']['SU/BS/DIM'][$i] = $value[5][$i + 1];
						$this->database['Data'][$id]['RequireQuest']['RF/FE'][$i] = $value[6][$i + 1];
					}
				}
			}
			
			CTM_FileManage::Lib('ReadScript')->WriteSerializeData("Quest_Data.serialize.dat", $this->database['Data'], md5_file($this->settings['Files']['Database']));
		}
		elseif(!$this->database['Data'])
			$this->database['Data'] = $serialize_data;
			
		return $quest_database = $quest == -1 ? $this->database['Data'] : $this->database['Data'][$quest];
	}
}