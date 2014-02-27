<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * CTM Mailer : Send E-Mail <use PHPMailer>
 * Author: $CTM['Erick-Master']
 * Last Update: 18/05/2012 - 14:42h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

if(CTM_Framework::CheckValues() == false)
{
	print "<h1>CTM Fatal Error</h1><hr>You do not have permission to use this API.";
	print "<hr><address>Cetemaster Framework - www.cetemaster.com</address>";
	exit();
}

class CTM_Mailer extends CTM_Framework
{
	/**
	 *	From E-Mail (Sender)
	 *
	 *	@access	public
	 *	@var	array
	*/
	public $FromMail	= array(NULL, NULL);
	/**
	 *	Send Method
	 *	Set 1 for SMTP or 2 for PHP mail()
	 *
	 *	@access	public
	 *	@var	integer
	*/
	public $SendMethod	= 1;
	/**
	 *	Debug Mode
	 *
	 *	@access	public
	 *	@var	boolean
	*/
	public $Debug		= FALSE;
	/**
	 *	Log Path
	 *
	 *	@access	public
	 *	@var	string
	*/
	public $LogPath	= "logs/mailer/";
	/**
	 *	Log Extension
	 *
	 *	@access	public
	 *	@var	string
	*/
	public $LogExt		= ".log";
	/**
	 *	SMTP Settings: Host
	 *
	 *	@access	public
	 *	@var	string
	*/
	public $SMTPHost	= "localhost";
	/**
	 *	SMTP Settings: Port
	 *
	 *	@access	public
	 *	@var	integer
	*/
	public $SMTPPort	= 25;
	/**
	 *	SMTP Settings: User
	 *
	 *	@access	public
	 *	@var	string
	*/
	public $SMTPUser	= NULL;
	/**
	 *	SMTP Settings: Password
	 *
	 *	@access	public
	 *	@var	string
	*/
	public $SMTPPass	= NULL;
	/**
	 *	SMTP Settings: Helo
	 *
	 *	@access	public
	 *	@var	integer
	*/
	public $SMTPHelo	= 0;
	/**
	 *	SMTP Settings: Secure
	 *
	 *	@access	public
	 *	@var	integer
	*/
	public $SMTPSecure	= 0;
	/**
	 *	SMTP Settings: Debug
	 *
	 *	@access	public
	 *	@var	boolean
	*/
	public $SMTPDebug	= FALSE;
	/**
	 *	PHPMailer <Instance Class>
	 *
	 *	@access	private
	 *	@var	class
	*/
	private $PHPMailer	= NULL;
	/**
	 *	SMTP Authentication
	 *
	 *	@access	private
	 *	@var	boolean
	*/
	private $SMTPAuth	= FALSE;
	/**
	 *	Command Vars
	 *
	 *	@access	private
	 *	@var	array
	*/
	private $vars		= array();
	/**
	 *	Command Data
	 *
	 *	@access	private
	 *	@var	array
	*/
	private $data		= array();
	/**
	 *	Debug Result
	 *
	 *	@access	private
	 *	@var	string
	*/
	private $debug		= NULL;
	
	/**
	 *	Lib Factory
	 *
	 *	@return	void
	*/
	public function LibFactory()
	{
		if(!$this->PHPMailer)
		{
			require_once(self::LibGetRealPath(self::MAILER_PHPMAILER_PATH)."class.phpmailer.php");
			require_once(self::LibGetRealPath(self::MAILER_PHPMAILER_PATH)."class.smtp.php");
			require_once(self::LibGetRealPath(self::MAILER_PHPMAILER_PATH)."class.pop3.php");
			
			$this->PHPMailer = new PHPMailer(false);
			$this->PHPMailer->XMailer = "Cetemaster PHP Mailer - www.cetemaster.com";
		}		
	}
	/**
	 *	Add Address
	 *
	 *	@param	string	Address E-Mail
	 *	@param	string	Address Name
	 *	@return	void
	*/
	public function AddAddress($email, $name = NULL)
	{
		$this->PHPMailer->AddAddress($email, CTM_Text::UTF8Text($name)); 
		
		$this->data['address'][] = array($email, CTM_Text::UTF8Text($name));
		$this->vars['to'] = TRUE;
	}
	/**
	 *	Set Subject
	 *
	 *	@param	string	Subject
	 *	@return	void
	*/
	public function SetSubject($subject)
	{
		$this->PHPMailer->Subject = CTM_Text::UTF8Text($subject);
		$this->vars['subject'] = TRUE;
	}
	/**
	 *	Set Body
	 *
	 *	@param	string	E-Mail Body
	 *	@param	boolean	HTML Content
	 *	@return	void
	*/
	public function SetBody($body, $html = TRUE)
	{
		if($html == true)
		{
			$this->PHPMailer->IsHTML(true);
			$this->PHPMailer->AltBody = "To view the message, please use an HTML compatible email viewer!";
			$this->PHPMailer->MsgHTML(CTM_Text::UTF8Text($body));
		}
		else
		{
			$this->PHPMailer->IsHTML(false);
			$this->PHPMailer->Body = CTM_Text::UTF8Text($body);
		}
		
		$this->vars['body'] = TRUE;
	}
	/**
	 *	Set Priority
	 *	0 = Normal, 1 = Low, 2 = High
	 *
	 *	@param	integer	Priority
	 *	@return	void
	*/
	public function SetPriority($priority)
	{
		switch($priority)
		{
			default: $this->PHPMailer->Priority = 3; break;
			case 1 : $this->PHPMailer->Priority = 5; break;
			case 2 : $this->PHPMailer->Priority = 1; break;
		}
	}
	/**
	 *	Add Attachment
	 *
	 *	@param	string	File name
	 *	@return	void
	*/
	public function AddAttachment($filename)
	{
		$this->PHPMailer->AddAttachment(CTM_ROOT_PATH.$filename);
		$this->vars['attachment'] = TRUE;
	}
	/**
	 *	Send Mail
	 *
	 *	@return	boolean
	*/
	public function SendMail()
	{
		$this->WriteDebug("Start Mailer");
		
		if($this->loadCheckVars() == false)
		{
			$this->FinishCommand();
			return false;
		}
		
		if($this->SendMethod == 1)
		{
			if($this->loadSMTPData() == false)
			{
				$this->FinishCommand();
				return false;
			}
			
			$this->PHPMailer->IsSMTP();
			$this->PHPMailer->Host = $this->SMTPHost;
			$this->PHPMailer->Port = $this->SMTPPort;
			$this->PHPMailer->Username = $this->SMTPUser;
			$this->PHPMailer->Password = $this->SMTPPass;
			$this->PHPMailer->SMTPKeepAlive = TRUE;
		}
		else
		{
			$this->PHPMailer->IsMail();
		}
		
		$this->PHPMailer->SetFrom($this->FromMail[0], CTM_Text::UTF8Text($this->FromMail[1]));
		$this->WriteDebug("Mailer method: ".($this->SendMethod == 1 ? "SMTP" : "PHP mail()"));
		$this->WriteDebug("E-Mail subject: ".(!$this->vars['subject'] ? "NULL" : $this->PHPMailer->Subject));
		$this->WriteDebug("E-Mail from: ".($this->FromMail[1] ? CTM_Text::UTF8Text($this->FromMail[1])." <".$this->FromMail[0].">" : $this->FromMail[0]));
		
		foreach($this->data['address'] as $value)
			$this->WriteDebug("Send e-mail to: ".($value[1] ? $value[1]." <".$value[0].">" : $value[0]));
			
		if(!$this->PHPMailer->Send())
		{
			$this->WriteDebug($this->PHPMailer->ErrorInfo);
			$this->FinishCommand();
			return false;
		}
		else
		{
			$this->WriteDebug("E-Mail(s) sended with success");
			$this->FinishCommand();
			return true;
		}
	}
	/**
	 *	Private: Finish Command
	 *
	 *	@return	void
	*/
	private function FinishCommand()
	{
		$this->WriteDebug("End Mailer");
		
		$this->PHPMailer->Subject = NULL;
		$this->PHPMailer->ClearAddresses();
		$this->PHPMailer->ClearCCs();
		$this->PHPMailer->ClearBCCs();
		$this->PHPMailer->ClearReplyTos();
		$this->PHPMailer->ClearAllRecipients();
		$this->PHPMailer->ClearAttachments();
		$this->PHPMailer->ClearCustomHeaders();
		$this->PHPMailer->SmtpClose();
		
		if($this->Debug == true && !empty($this->debug))
		{
			if(!file_exists($this->LogPath))
				mkdir($this->LogPath);
			
			if($fp = fopen($this->LogPath.date("d-m-Y").$this->LogExt, "a+"))
			{
				fwrite($fp, $this->debug.(substr($this->debug, strlen($this->debug) - 2) != "\r\n" ? "\r\n" : NULL).str_repeat("=", 90)."\r\n");
				fclose($fp);
			}
		}
		
		$this->data = array();
		$this->vars = array();
		$this->debug = NULL;
	}
	/**
	 *	Private: Write Debug Log
	 *
	 *	@param	string	Log String
	 *	@return	void
	*/
	private function WriteDebug($string)
	{
		$this->debug .= "[".date("H:i:s")."] {$string}\r\n";
	}
	/**
	 *	Private: Check Vars
	 *
	 *	@return	boolean
	*/
	private function loadCheckVars()
	{
		$count = 0;
		
		if(!$this->FromMail[0])
		{
			$this->WriteDebug("No set from address");
			$count++;
		}
		if(!$this->vars['to'])
		{
			$this->WriteDebug("No set to address");
			$count++;
		}
		if(!$this->vars['body'])
		{
			$this->WriteDebug("No set message body");
			$count++;
		}
		if(!$this->vars['subject'])
		{
			$this->WriteDebug("No set subject");
		}
		
		return $count == 0;
	}
	/**
	 *	Private: SMTP Data
	 *
	 *	@return	boolean
	*/
	private function loadSMTPData()
	{
		$count = 0;
		$auth = TRUE;
		
		if(!$this->SMTPHost)
		{
			$this->WriteDebug("No set SMTP host");
			$count++;
		}
		if(!$this->SMTPPort)
		{
			$this->WriteDebug("No set SMTP port");
			$count++;
		}
		if(!$this->SMTPUser)
		{
			$this->WriteDebug("No use authentication");
			$auth = FALSE;
		}
		if(!$this->SMTPPass)
		{
			$this->SMTPPass = NULL;
		}
		
		switch($this->SMTPSecure)
		{
			case 1 : $secure = "ssl"; break;
			case 2 : $secure = "tls"; break;
			default: $secure = NULL; break;
		}
		
		$this->PHPMailer->SMTPAuth = $auth;
		$this->PHPMailer->SMTPSecure = $secure;
		$this->PHPMailer->Helo = ($this->SMTPHelo == 1 ? "EHLO" : "HELO")." ".$this->SMTPHost;
		return $count == 0;
	}
}