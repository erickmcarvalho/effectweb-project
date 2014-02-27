<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Recovery Page
 * Last Update: 23/05/2012 - 12:53h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Recovery extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->lang->loadLanguageFile("recovery");
		
		if($_GET['do'] == "process" || $this->URLData[1] == "process")
		{
			require_once(THIS_APPLICATION_PATH."modules/recovery/process.php");
			
			$processRecover = new Recovery_Process();
			$processRecover->registry();
			$processRecover->initSection();
		}
		else
		{
			$this->loadRecoverMember();
			$this->output->loadSkinCache("recovery", "recoverMember");
		}
	}
	/**
	 *	Recover Member Data
	 *	Recover member and send e-mail
	 *
	 *	@return	void
	*/
	private function loadRecoverMember()
	{
		if($_GET['write'] == true)
		{
			if(empty($_POST['Login']) && empty($_POST['Mail']))
				return setResult(showMessage($this->lang->words['Recovery']['Recover']['Messages']['Void'], 1));
			
			if(!empty($_POST['Login']))
				$source = "login";
			else
				$source = "mail";
				
			$member = $this->MuLib('Member')->Load($source == "login" ? $_POST['Login'] : $_POST['Mail'], array("info" => "memb_name,fpas_ques,fpas_answ"));
			
			if(!$member)
				return setResult(showMessage($this->lang->words['Recovery']['Recover']['Messages']['Invalid'], 2));
				
			$currentId = $this->DB->GetCurrentId("CTM_RecoverData") + 1;
			$dechex = create_function("\$integer", "return str_pad(dechex(\$integer >= 255 ? 255 : \$integer), 2, 0, STR_PAD_LEFT);");
						
			$confirmCode = $dechex($currentId);
			$confirmCode .= ":".$dechex(0xAA - strlen($member['memb___id']) + mt_rand(0, 50));
			$confirmCode .= ":".$dechex(strlen($member['mail_addr']) + mt_rand(0, 50));
			$confirmCode .= ":".$dechex(mt_rand(0, 70));
			$confirmCode .= ":".$dechex(mt_rand(71, 170));
			$confirmCode .= ":".$dechex(0xAA / intval(date("d")) + intval(date("H")) + intval(date("m")) + intval(date("s")) + mt_rand(0, 50));
			$confirmCode .= ":".$dechex(0xAA / intval(date("m")) + intval(date("H")) + intval(date("m")) + intval(date("s")) + mt_rand(0, 50));
			$confirmCode .= ":".$dechex(intval(date("Y")) / 0xAA + intval(date("H")) + intval(date("m")) + intval(date("s")) + mt_rand(0, 50));
					
			$confirmCode = strtoupper($confirmCode);
			$link = gerateFullLink("?/recovery/process");
			
			$this->DB->Insert("CTM_RecoverData", array
			(
				"Account" => $member['info']['memb___id'],
				"RedefineCode" => $confirmCode,
				"Expiration" => strtotime("+ 24 hours")
			));
				
			$this->email->arguments = array
			(
				"NAME" => htmlEncode($member['info']['memb_name']),
				"LOGIN" => $member['info']['memb___id'],
				"EMAIL" => $member['info']['mail_addr'],
				"SECURE_QUESTION" => htmlEncode($member['info']['fpas_ques']),
				"SECURE_ANSWER" => htmlEncode($member['info']['fpas_answ']),
				"VALIDATION_LINK" => $currentId,
				"VALIDATION_CODE" => $confirmCode,
				"SYSTEM_LINK" => $link
			);
			$this->email->LoadTemplate("RecoverMemberData");
			$this->email->GetMailContent($mail);
			
			$this->mailer->AddAddress($member['info']['mail_addr'], $member['info']['memb_name']);
			$this->mailer->SetSubject($mail['subject']);
			$this->mailer->SetBody($mail['content']);
			
			if($this->mailer->SendMail() == true)
			{
				return setResult(showMessage($this->lang->words['Recovery']['Recover']['Messages']['Success'], 3));
			}
			else
			{
				$this->lang->setArguments("Recovery,Recover,Messages,Error_SendMail", CoreVariables::ErrorsCode()->SendMailError);
				return setResult(showMessage($this->lang->words['Recovery']['Recover']['Messages']['Error_SendMail'], 2));
			}
		}
	} 
}