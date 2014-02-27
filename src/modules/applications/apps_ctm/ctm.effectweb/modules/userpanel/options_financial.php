<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application User Control Panel - Account Options
 * Last Update: 07/02/2013 - 19:41h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class UserPanel_Financial extends CTM_EffectWeb_UserPanel
{
	/**
	 *	Init Class
	 *
	 *	@return	void
	*/
	public function initClass()
	{
		$this->registry();
		$this->FactoryCP();
	}
	/**
	 *	Option: Invoices
	 *	Invoices of payments
	 *
	 *	@return	void
	*/
	public function Invoices()
	{
		switch($_GET['section'] ? $_GET['section'] : $this->URLData[2])
		{
			case "list" :
				$this->DB->Arguments(USER_ACCOUNT);
				$this->DB->Query("SELECT Id, Document, Status, StartDate, [Value], CoinQuantity FROM dbo.CTM_Invoices WHERE Account = '%s' ORDER BY Id DESC", $all_invoices_q);
				
				$invoices_opened = array();
				$invoices_finalized = array();
				$invoices_canceled = array();
				
				if($this->DB->CountRows($all_invoices_q) > 0)
				{
					while($all_invoices = $this->DB->FetchObject($all_invoices_q))
					{
						switch($all_invoices->Status)
						{
							case 0 : 
								$var_name = "invoices_opened"; 
								$status = "<span style='color: #C00;'>".$this->lang->words['UserPanel']['Invoices']['Status']['Pending']."</span>";
							break;
							case 1 : 
								$var_name = "invoices_opened"; 
								$status = "<span style='color: blue;'>".$this->lang->words['UserPanel']['Invoices']['Status']['InProgress']."</span>";
							break;
							case 2 : 
								$var_name = "invoices_finalized"; 
								$status = "<span style='color: green;'>".$this->lang->words['UserPanel']['Invoices']['Status']['Paid']."</span>";
							break;
							case 3: 
								$var_name = "invoices_finalized"; 
								$status = "<span style='color: red;'>".$this->lang->words['UserPanel']['Invoices']['Status']['Rejected']."</span>";
							break;
							case 4 : 
								$var_name = "invoices_canceled"; 
								$status = "<span style='color: #CCC;'>".$this->lang->words['UserPanel']['Invoices']['Status']['Canceled']."</span>";
							break;
						}
						
						${$var_name}[$all_invoices->Id] = array
						(
							"document" => $all_invoices->Document,
							"quantity" => number_format($all_invoices->CoinQuantity, 0, false, ".")." ".COIN_NAME_1,
							"value" => CTM_Text::MoneyFormat(MONEY_SYMBOL, $all_invoices->Value),
							"date" => date("d/m/Y - h:i a", $all_invoices->StartDate),
							"status" => $status
						);
					}
				}
				
				$GLOBALS['userpanel']['invoices']['auto_load_invoice'] = $_GET['showinvoice'] ? $_GET['showinvoice'] : $this->URLData[3];
				$GLOBALS['userpanel']['invoices']['list_invoices'] = array
				(
					"opened" => $invoices_opened,
					"finalized" => $invoices_finalized,
					"canceled" => $invoices_canceled
				);
				
				unset($invoices_opened);
				unset($invoices_finalized);
				unset($invoices_canceled);
				
				return $this->LoadPage("option_invoices_list", true);
			break;
			case "show" :
				$invoice_id = intval($_GET['id'] ? $_GET['id'] : $this->URLData[3]);
				$section = $_GET['do'] ? $_GET['do'] : $this->URLData[4];
				
				$this->DB->Arguments($invoice_id, USER_ACCOUNT);
				$this->DB->Query("SELECT * FROM dbo.CTM_Invoices WHERE Id = %d AND Account = '%s'", $get_invoice);
				
				if($this->DB->CountRows($get_invoice) < 1)
					return exit(showMessage(sprintf($this->lang->words['UserPanel']['Invoices']['ErrorMessage'], CoreVariables::ErrorsCode()->PaymentNotFound), 2));

				$invoice = $this->DB->FetchObject($get_invoice);

				if($section)
				{
					switch($section)
					{
						case "payment" :
							$this->DB->Arguments($invoice_id, USER_ACCOUNT);
							$this->DB->Query("SELECT * FROM dbo.CTM_Payments WHERE InvoiceId = %d AND Account = '%s'", $get_payment);

							if($this->DB->CountRows($get_payment) < 1)
							{
								if($invoice->Status != 0 && $invoice->Status != 3)
									exit(showMessage($this->lang->words['UserPanel']['Invoices']['ShowInvoice']['Messages']['InvoiceInProgress'], 0));

								$method = strlen($_GET['method']) > 0 ? $_GET['method'] : $this->URLData[5];
								
								if(strlen($method) < 1 || !array_key_exists($method, $this->settings['PAYMENTMETHOD']['FORM']))
								{
									$GLOBALS['userpanel']['payments']['confirm_payment']['invoice_id'] = $invoice_id;

									if($_GET['write'] == true)
										exit(showMessage($this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['SelectMethod'], 2));
										
									return $this->LoadPage("option_payments_confirm", true);
								}
								else
								{
									$error = $this->LoadClass("Error", "class_sources");
									$method = intval($method);
									
									if($_GET['write'] == true)
									{
										if(empty($_POST['Date']))
											$error->addError($this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['DateVoid'], 0);
										if(empty($_POST['Hour']))
											$error->addError($this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['HourVoid'], 0);
										if(empty($_POST['Value']))
											$error->addError($this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['ValueVoid'], 0);
										if(empty($_POST['Local']))
											$error->addError($this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['LocalVoid'], 0);
										
										foreach($this->settings['PAYMENTMETHOD']['FORM'][$method][1] as $key => $value)
											if(empty($_POST[$key]))
												$error->addError(htmlEncode($value), 0);
										
										if($error->count[0] > 0)
										{
											$_error = "<strong>".$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['VoidMessage']."<strong><br />";
											exit(showMessage($_error."<br />".$error->showError(0), 1));
										}
										else
										{
											if($_POST['u_sendFile'] == 1)
											{
												if($_POST['u_ready'] == 1)
												{
													$name = str_pad($this->DB->GetCurrentId("CTM_Payments") + 1, 10, 0, STR_PAD_LEFT);
													$size = $this->settings['WEBDATA']['UPLOADS']['FILESIZE']['PAYMENT_ANNEX'];
													$dir = CTM_ROOT_PATH.$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['PAYMENT_ANNEX'];

													Uploadify::set("Filedata", $size, array("gif", "jpg", "jpeg", "png"), $name, $dir, $session);
													exit("<script>startUpload('{$name}', '{$session}');</script>");
												}
												else
												{
													$data = unserialize(base64_decode($_POST['u_fileUploaded']));
													$annex = $data['parsed_file_name'];
													
													if(!$data)
													{
														exit(showMessage($this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['AnnexError'], 2));
													}
													elseif($data['error_no'] == 2)
													{
														$this->lang->setArguments("UserPanel,Payments,ConfirmPayment,Messages,ErrorFormat", "<b>JPEG</b>, <b>GIF</b>, <b>PNG</b>");
														exit(showMessage($this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['ErrorFormat'], 2));
													}
													elseif($data['error_no'] == 3)
													{
														$this->lang->setArguments("UserPanel,Payments,ConfirmPayment,Messages,ErrorSize", "<b>".$data['max_file_size']."</b>");
														exit(showMessage($this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['ErrorSize'], 2));
													}
													elseif($data['error_no'] != 0)
													{
														exit(showMessage($this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['AnnexError'], 2));
													}
												}
											}
											
											$payment_data = array();
											
											foreach($this->settings['PAYMENTMETHOD']['FORM'][$method][1] as $key => $value)
												$payment_data[$key] = utf8_encode($_POST[$key]);
												
											$columns_insert = array
											(
												"Account" => USER_ACCOUNT,
												"InvoiceId" => $invoice_id,
												"Status" => 0,
												"ConfirmDate" => time(),
												"Method" => $method,
												"Date" => $_POST['Date'],
												"Hour" => $_POST['Hour'],
												"Value" => $_POST['Value'],
												"Local" => utf8_encode($_POST['Local']),
												"ConfirmData" => serialize($payment_data),
												"Message" => htmlEncode(nl2br(strip_tags($_POST['Message']))),
												"Annex" => $annex
											);
											
											$this->DB->ForceDataType("InvoiceId", "integer");
											$this->DB->ForceDataType("Status", "integer");
											$this->DB->ForceDataType("ConfirmDate", "integer");
											$this->DB->ForceDataType("Method", "integer");
											$this->DB->ForceDataType("Message", empty($_POST['Message']) ? "null" : "string");
											$this->DB->ForceDataType("Annex", empty($annex) ? "null" : "string");
											$this->DB->Insert("CTM_Payments", $columns_insert);

											$this->DB->Arguments($invoice_id);
											$this->DB->ForceDataType("Status", "integer");
											$this->DB->Update("CTM_Invoices", array("Status" => 1, "PaymentMethod" => "bank"), "Id = %d");
											
											return exit(showMessage($this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['Success'], 3));
										}
									}
									
									$inputs = array();
									foreach($this->settings['PAYMENTMETHOD']['FORM'][$method][1] as $key => $value)
										$inputs[$key] = htmlEncode($value);
									
									$GLOBALS['userpanel']['payments']['confirm_payment'] = array
									(
										"invoice_id" => $invoice_id,
										"method_name" => htmlEncode($this->settings['PAYMENTMETHOD']['FORM'][$method][0]),
										"method_id" => $method,
										"method_fields" => $inputs
									);
									
									return $this->LoadPage("option_payments_confirm_form", true);
								}
							}
							else
							{
								$payment = $this->DB->FetchObject($get_payment);

								switch($payment->Status)
								{
									case 0 : 
										$status = "<span style='color: blue;'>".$this->lang->words['UserPanel']['Payments']['Status']['Opened']."</span>";
									break;
									case 1 : 
										$status = "<span style='color: green;'>".$this->lang->words['UserPanel']['Payments']['Status']['Confirmed']."</span>";
									break;
									case 2 : 
										$status = "<span style='color: red;'>".$this->lang->words['UserPanel']['Payments']['Status']['Rejected']."</span>";
									break;
								}
								
								if(!$payment_data = unserialize($payment->ConfirmData))
									$payment_data = array();
								
								$GLOBALS['userpanel']['payments']['show_payment'] = array
								(
									"id" => $payment_id,
									"method" => htmlEncode($this->settings['PAYMENTMETHOD']['FORM'][$payment->Method][0]),
									"confirm_date" => date("d/m/Y - h:i a", $payment->ConfirmDate),
									"status" => $status,
									"quantity" => number_format($payment->Quantity, 0, false, ".")." ".COIN_NAME_1,
									"date" => $payment->Date,
									"hour" => $payment->Hour,
									"value" => $payment->Value,
									"local" => utf8_decode($payment->Local),
									"message" => htmlDecode($payment->Message),
									"payment_data" => $payment_data
								);
								
								if(strlen($payment->Annex) > 1)
								{
									$GLOBALS['userpanel']['payments']['show_payment']['annex'] = array
									(
										"link" => $this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['PAYMENT_ANNEX'].$payment->Annex,
										"name" => $payment->Annex
									);
								}
								
								return $this->LoadPage("option_payments_show", true);
							}
						break;
					}
				}

				switch($invoice->Status)
				{
					case 0 : 
						$status = "<span style='color: #C00;'>".$this->lang->words['UserPanel']['Invoices']['Status']['Pending']."</span>";
					break;
					case 1 :  
						$status = "<span style='color: blue;'>".$this->lang->words['UserPanel']['Invoices']['Status']['InProgress']."</span>";
					break;
					case 2 : 
						$status = "<span style='color: green;'>".$this->lang->words['UserPanel']['Invoices']['Status']['Paid']."</span>";
					break;
					case 3: 
						$status = "<span style='color: red;'>".$this->lang->words['UserPanel']['Invoices']['Status']['Rejected']."</span>";
					break;
					case 4 : 
						$status = "<span style='color: #CCC;'>".$this->lang->words['UserPanel']['Invoices']['Status']['Canceled']."</span>";
					break;
				}
				
				$GLOBALS['userpanel']['invoices']['show_invoice'] = array
				(
					"id" => $invoice_id,
					"document" => $invoice->Document,
					"start_date" => date("d/m/Y - h:i a", $invoice->StartDate),
					"quantity" => number_format($invoice->CoinQuantity, 0, false, "."),
					"value" => CTM_Text::MoneyFormat(MONEY_SYMBOL, $invoice->Value),
					"status" => $status,
					"canceled" => $invoice->Status == 4
				);

				if($invoice->Status > 0 && $invoice->PaymentMethod != "none")
				{
					if(!$payment_data = unserialize($invoice->PaymentData))
						$payment_data = array();

					switch($invoice->PaymentMethod)
					{
						case "bank" :
							$method_name = $this->lang->words['UserPanel']['Invoices']['Methods']['Bank'];
						break;
					}

					$GLOBALS['userpanel']['invoices']['show_invoice']['payment_method'] = array
					(
						"method" => $method_name,
						"data" => $payment_data,
						"key" => $invoice->PaymentMethod
					);
				}
				
				$this->lang->setArguments("UserPanel,Invoices,ShowInvoice,Title", $invoice_id);
				return $this->LoadPage("option_invoices_show", true);
			break;
			case "open" :
				if($this->settings['USERPANEL']['FINANCIAL']['INVOICES']['LIMIT_OPENED'] > 0)
				{
					$this->DB->Arguments(USER_ACCOUNT);
					$this->DB->Query("SELECT 1 FROM dbo.CTM_Invoices WHERE Account = '%s' AND Status < 2", $count_invoices);
					
					if($this->DB->CountRows($count_invoices) >= $this->settings['USERPANEL']['FINANCIAL']['INVOICES']['LIMIT_OPENED'])
					{
						$limit = $this->settings['USERPANEL']['FINANCIAL']['INVOICES']['LIMIT_OPENED'];
						exit(showMessage(sprintf($this->lang->words['UserPanel']['Invoices']['OpenInvoice']['Messages']['LimitReached'], $limit), 2));
					}
				}

				if($_GET['write'] == true)
				{
					if(empty($_POST['Quantity']))
						exit(showMessage($this->lang->words['UserPanel']['Invoices']['OpenInvoice']['Messages']['QuantityVoid'], 1));

					if(!is_numeric($_POST['Quantity']))
						exit(showMessage($this->lang->words['UserPanel']['Invoices']['OpenInvoice']['Messages']['QuantitySyntax'], 2));

					$_POST['Quantity'] = ltrim($_POST['Quantity'], 0);
					$money_value = COIN_PRICE * $_POST['Quantity'];

					if(strstr($money_value, "."))
					{
						list($note, $coin) = explode(".", $money_value);

						if(strlen($coin) > 2)
							$coin = substr($coin, 0, 2);

						while(($coin % 5) != 0 && $coin > 0)
						{
							if($coin < 5 && $coin > 0)
								$coin = 5;
							else
								$coin++;
						}

						if(strlen($coin) == 1)
							$coin = "0".$coin;

						$final_money = $note.".".$coin;
					}
					else
					{
						$final_money = $money_value.".00";
					}

					if($_GET['confirm'] == true)
					{
						$insert_columns = array
						(
							"Account" => USER_ACCOUNT,
							"StartDate" => time(),
							"EndDate" => 0,
							"Value" => $final_money,
							"CoinQuantity" => $_POST['Quantity'],
							"Status" => 0
						);

						$this->DB->Insert("CTM_Invoices", $insert_columns);
						$last_id = $this->DB->GetLastedId();

						$this->DB->Update("CTM_Invoices", array("Document" => INVOICE_PREFIX.$last_id), "Id = ".$last_id);
						exit("<script>runOpenInvoice({$last_id});</script>");
					}
					else
					{
						exit("<script>showConfirmMessage('".CTM_Text::MoneyFormat(MONEY_SYMBOL, $final_money)."');</script>");
					}
				}
					
				$GLOBALS['default_value'] = str_replace(MONEY_SYMBOL." ", NULL, CTM_Text::MoneyFormat(MONEY_SYMBOL, COIN_PRICE));
				return $this->LoadPage("option_invoices_open", true);
			break;
			default :
				if($_GET['showinvoice'])
					$GLOBALS['userpanel']['invoices']['auto_load_invoice'] = $_GET['showinvoice'];
				elseif(strstr($this->URLData[2], "showinvoice-"))
					$GLOBALS['userpanel']['invoices']['auto_load_invoice'] = str_replace("showinvoice-", NULL, $this->URLData[2]);
			break;
		}
	}
	/**
	 *	Option: Convert Coin
	 *	Convert the coins of account
	 *
	 *	@return	void
	*/
	public function ConvertCoin()
	{
		$GLOBALS['userpanel']['convertcoin']['balance_coin'][1] = number_format($this->userData['coin'][COIN_COLUMN_1], 0, false, ".");
		$GLOBALS['userpanel']['convertcoin']['balance_coin'][2] = number_format($this->userData['coin'][COIN_COLUMN_2], 0, false, ".");
		$GLOBALS['userpanel']['convertcoin']['balance_coin'][3] = number_format($this->userData['coin'][COIN_COLUMN_3], 0, false, ".");
		
		if($_GET['write'] == true)
		{
			if(empty($_POST['ConvertOption']))
				return setResult(showMessage($this->lang->words['UserPanel']['ConvertCoin']['Messages']['Select'], 1));
				
			$loadOption = explode("#", $_POST['ConvertOption']);
				
			switch($loadOption[0])
			{
				case 0 : if(COIN_NUMBER >= 1) { $option = "2_TO_1"; $from = 2; $to = 1; } break;
				case 1 : if(COIN_NUMBER >= 2) { $option = "3_TO_1"; $from = 3; $to = 1; } break;
				case 2 : if(COIN_NUMBER >= 3) { $option = "3_TO_2"; $from = 3; $to = 2; } break;
			}
			
			if($option)
			{
				if(array_key_exists($loadOption[1], $this->settings['USERPANEL']['FINANCIAL']['CONVERT_COIN']['OPTIONS'][$option]))
				{
					$price = $this->settings['USERPANEL']['FINANCIAL']['CONVERT_COIN']['OPTIONS'][$option][$loadOption[1]];
					$is_valid = TRUE;
				}
			}
			
			if($is_valid == false)
				return setResult(showMessage($this->lang->words['UserPanel']['ConvertCoin']['Messages']['Select'], 1));
			
			if($this->userData['coin'][constant("COIN_COLUMN_".$from)] < $loadOption[1])
			{
				$this->lang->setArguments("UserPanel,ConvertCoin,Messages,Error_Balance", constant("COIN_NAME_".$from));
				return setResult(showMessage($this->lang->words['UserPanel']['ConvertCoin']['Messages']['Error_Balance'], 2));
			}
			else
			{
				$columns = array
				(
					constant("COIN_COLUMN_".$from) => "minus:".$price, 
					constant("COIN_COLUMN_".$to) => "plus:".$loadOption[1]
				);
				
				$this->DB->Arguments(USER_ACCOUNT);
				$this->DB->ForceDataType(constant("COIN_COLUMN_".$from), "integer");
				$this->DB->ForceDataType(constant("COIN_COLUMN_".$to), "integer");
				$this->DB->Update(COIN_CORE."@".COIN_TABLE, $columns, COIN_LOGIN." = '%s'");
				
				$this->WriteLog(array
				(
					"option" => "Convert Coin",
					"data" => array
					(
						"[General] Option: ".constant("COIN_NAME_".$from)." to ".constant("COIN_NAME_".$to),
						"[General] Quantity: ".number_format($loadOption[1], 0, false, "."),
						"[Before] ".constant("COIN_NAME_".$from).": ".number_format($this->userData['coin'][constant("COIN_COLUMN_".$from)], 0, false, "."),
						"[Before] ".constant("COIN_NAME_".$to).": ".number_format($this->userData['coin'][constant("COIN_COLUMN_".$to)], 0, false, "."),
						"[After] ".constant("COIN_NAME_".$from).": ".number_format($this->userData['coin'][constant("COIN_COLUMN_".$from)] - $price, 0, false, "."),
						"[After] ".constant("COIN_NAME_".$to).": ".number_format($this->userData['coin'][constant("COIN_COLUMN_".$to)] + $loadOption[1], 0, false, ".")
					),
				));
					
				$message = "<script type=\"text/javascript\">\n";
				$message .= "$('#Balance_".$from."').text(".number_format($this->userData['coin'][constant("COIN_COLUMN_".$from)] - $price, 0, false, ".").");\n";
				$message .= "$('#Balance_".$to."').text(".number_format($this->userData['coin'][constant("COIN_COLUMN_".$to)] + $loadOption[1], 0, false, ".").");\n";
				$message .= "</script>";
				$message .= showMessage($this->lang->words['UserPanel']['ConvertCoin']['Messages']['Success'], 3);
				
				Authentication::ReloadSession();
				return setResult($message);
			}
		}
	}
	/**
	 *	Option: Buy VIP
	 *	Buy VIP plan using Coin 1
	 *
	 *	@return	void
	*/
	public function BuyVIP()
	{
		if(empty($_GET['vip']))
			return NULL;
		
		if(!($_GET['vip'] >= 1 && $_GET['vip'] <= 5))
			exit(showMessage($this->lang->words['UserPanel']['BuyVIP']['Messages']['Error_Type'], 2));
		
		if($_GET['write'] == true)
		{
			if(!array_key_exists($_POST['Plan'], $this->settings['USERPANEL']['FINANCIAL']['BUY_VIP']['PLANS'][$_GET['vip']]))
				exit(showMessage($this->lang->words['UserPanel']['BuyVIP']['Messages']['Error_Plan'], 2));
			
			if($this->userData['coin'][COIN_COLUMN_1] < ($price = $this->settings['USERPANEL']['FINANCIAL']['BUY_VIP']['PLANS'][$_GET['vip']][$_POST['Plan']]))
				exit(showMessage($this->lang->words['UserPanel']['BuyVIP']['Messages']['Error_Balance'], 2));
				
			if($this->userData['vip'][VIP_COLUMN] > 0 && $this->userData['vip'][VIP_COLUMN] <> $_GET['vip'] && !$_GET['changePlan'])
			{
				$this->lang->setArguments("UserPanel,BuyVIP,Messages,ChangePlan", constant("VIP_NAME_".$this->userData['vip'][VIP_COLUMN]));
				exit("<script>confirmChangePlan('".$this->lang->words['UserPanel']['BuyVIP']['Messages']['ChangePlan']."');</script>");
			}
			
			$level = $this->userData['vip'][VIP_COLUMN] > 0 ? $this->userData['vip'][VIP_COLUMN] : $_GET['vip'];
			$begin = strlen($this->userData['vip'][VIP_BEGIN]) < 10 ? time() : $this->userData['vip'][VIP_BEGIN];
			$time = $this->userData['vip'][VIP_TIME] + $_POST['Plan'];
			
			if($_GET['changePlan'] == true && $_POST['vip'] != $this->userData['vip'][VIP_COLUMN])
			{
				$time = $_POST['Plan'];
				$level = $_GET['vip'];
				
				if(strlen($this->userData['vip'][VIP_TIME]) == 10)
					$time = strtotime("+ ".$_POST['Plan']." days");
			}
			else
			{
				if(strlen($this->userData['vip'][VIP_TIME]) == 10)
					$time = strtotime("+ ".$_POST['Plan']." days", $this->userData['vip'][VIP_TIME]);
			}
			
			$time = strlen($time) == 10 ? $time : strtotime("+ ".$time." days");
			$expiration = date("d/m/Y", $time);
			$type = constant("VIP_NAME_".$level);
			
			$this->MuLib('Member')->UpdateAccount(USER_ACCOUNT, array
			(
				"vip" => array
				(
					VIP_COLUMN => $level,
					VIP_BEGIN => $begin,
					VIP_TIME => $time	
				),
				"coin" => array
				(
					COIN_COLUMN_1 => ($this->userData['coin'][COIN_COLUMN_1] -= $price)
				),
			));
			
			$this->WriteLog(array
			(
				"option" => "Convert Coin",
				"data" => array
				(
					"[General] VIP Type: ".$type,
					"[General] VIP Plan: ".$_POST['Plan']." days",
					"[Before] Account Level: ".$this->functions->AccountLevel($this->userData['vip'][VIP_COLUMN]),
					"[Before] ".COIN_NAME_1.": ".number_format($this->userData['coin'][COIN_COLUMN_1], 0, false, "."),
					"[After] Account Level: ".$type,
					"[After] ".COIN_NAME_1.": ".number_format($this->userData['coin'][COIN_COLUMN_1] - $price, 0, false, "."),
					"[After] Expiration: ".$expiration,
				),
			));
				
			Authentication::ReloadSession();
			$this->lang->setArguments("UserPanel,BuyVIP,Messages,Success", $type, $expiration);
			
			echo(showMessage($this->lang->words['UserPanel']['BuyVIP']['Messages']['Success'], 3));
			exit("<script>completeBuyVIP('{$type}', '{$expiration}', '".number_format($this->userData['coin'][COIN_COLUMN_1], 0, false, ".")."');</script>");
		}
		
		$GLOBALS['userpanel']['buy_vip']['plans'] = $this->settings['USERPANEL']['FINANCIAL']['BUY_VIP']['PLANS'][$_GET['vip']];
		$GLOBALS['userpanel']['buy_vip']['current_coin_balance'] = number_format($this->userData['coin'][COIN_COLUMN_1], 0, false, ".");
		$GLOBALS['userpanel']['buy_vip']['current_account_level'] = $this->functions->AccountLevel($this->userData['vip'][VIP_COLUMN]);
		$GLOBALS['userpanel']['buy_vip']['current_account_expiration'] = $this->functions->MakeVIPTime($this->userData['vip'][VIP_TIME]);
		$GLOBALS['userpanel']['buy_vip']['current_type_selected'] = $this->functions->AccountLevel($_GET['vip']);
		$GLOBALS['userpanel']['buy_vip']['current_type_selected_id'] = $_GET['vip'];
	}
}