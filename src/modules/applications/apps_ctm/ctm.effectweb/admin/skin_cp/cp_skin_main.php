<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web ACP: Application Skin
 * Last Update: 14/09/2012 - 12:25h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_ACPSkin_Main extends CTM_ACPCommand
{
	/**
	 *	Global Sidebar
	 *
	 *	@return	string	HTML String
	*/
	public function core_global_sidebar()
	{
		$CTM_HTML = NULL;
		if($this->checkPermission("modules", "effectweb_main_notices") == true)
		{
			$CTM_HTML .= <<<HTML
<div class="box info">
                <h2>{$this->lang->words['EWMain']['Sidebar']['Notices']['Title']}</h2>
				<section>
					<ul>
						<li><a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=main&amp;section=notices&amp;index=addNotice">{$this->lang->words['EWMain']['Sidebar']['Notices']['AddNotice']}</a></li>
                        <li><a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=main&amp;section=notices&amp;index=manageNotices">{$this->lang->words['EWMain']['Sidebar']['Notices']['ManageNotices']}</a></li>
					</ul>
				</section>
			</div>
HTML;
		}
		
		if($this->checkPermission("modules", "effectweb_main_polls") == true)
		{
			$CTM_HTML .= <<<HTML
<div class="box menu">
                <h2>{$this->lang->words['EWMain']['Sidebar']['Polls']['Title']}</h2>
				<section>
					<ul>
						<li><a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls&amp;index=addPoll">{$this->lang->words['EWMain']['Sidebar']['Polls']['AddPoll']}</a></li>
                        <li><a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls&amp;index=managePolls">{$this->lang->words['EWMain']['Sidebar']['Polls']['ManagePolls']}</a></li>
					</ul>
				</section>
			</div>
HTML;
		}

		return $CTM_HTML;
	}
	/**
	 *	Main: Home
	 *
	 *	@return	string	HTML String
	*/
	public function main_home()
	{
		$CTM_HTML = <<<HTML
<article id="dashboard">
				<h1>{$this->lang->words['EWMain']['Home']['Title']}</h1>
				
				<h2>{$this->lang->words['EWMain']['Home']['Links']['Title']}</h2>
				<section class="icons">
					<ul>
						<li>
							<a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=main&amp;section=notices">
								<img src="{$this->acp_vars['acp_url']}skin_cp/images/eleganticons/Paper.png" />
								<span>{$this->lang->words['EWMain']['Home']['Links']['Notices']}</span>
							</a>
						</li>
						<li>
							<a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls">
								<img src="{$this->acp_vars['acp_url']}skin_cp/images/eleganticons/Piechart.png" />
								<span>{$this->lang->words['EWMain']['Home']['Links']['Polls']}</span>
							</a>
						</li>
					</ul>
				</section>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Notices: Add Notice
	 *
	 *	@return	string	HTML String
	*/
	public function notices_addNotice()
	{
		global $result_command;
		
		$_POST['fieldText'] = str_replace(array("<", ">"), array("&lt;", "&gt;"), $_POST['fieldText']);
		
		$CTM_HTML = <<<HTML
<article>
				<h1>{$this->lang->words['EWMain']['Notices']['AddNotice']['Title']}</h1>
                {$result_command}
				
                <form name="addNotice" id="addNotice" action="{$this->vars['acp_url']}?app=effectweb&amp;module=main&amp;section=notices&amp;index=addNotice&amp;write=true" method="post" class="uniform">
					<dl>
						<dt><label for="fieldTitle">{$this->lang->words['EWMain']['Notices']['AddNotice']['FieldTitle']}</label></dt>
						<dd><input type="text" id="fieldTitle" name="fieldTitle" value="{$_POST['fieldTitle']}"  class="big" /></dd>

						<dt><label for="enableComments">{$this->lang->words['EWMain']['Notices']['AddNotice']['FieldComments']}</label>&nbsp;
							<input type="checkbox" id="enableComments" name="enableComments" checked="checked" />
						</dt>

						<dt><label for="fieldText">{$this->lang->words['EWMain']['Notices']['AddNotice']['FieldText']}</label></dt>
						<dd>
							<textarea id="fieldText" name="fieldText" set="htmlEditor" class="big" rows="15">{$_POST['fieldText']}</textarea>
						</dd>
					</dl>
					<p>
						<button type="submit" class="button">{$this->lang->words['EWMain']['Notices']['AddNotice']['Buttons']['Process']}</button>
                        <button type="reset" class="button">{$this->lang->words['EWMain']['Notices']['AddNotice']['Buttons']['Reset']}</button>
					</p>
				</form>
			</article>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Notices: Manage Notice
	 *
	 *	@return	string	HTML String
	*/
	public function notices_manageNotices()
	{
		global $notice_list, $manage_all_notices, $result_command;
		
		$CTM_HTML = NULL;
		
		if(count($notice_list) > 0)
        {
			$CTM_HTML .= <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("#DeleteNoticesButton").click(function()
				{
					Sexy.confirm("{$this->lang->words['EWMain']['Notices']['ManageNotices']['Messages']['ConfirmDelete']}", { onComplete : function(result)
					{
						if(result)
						{
							$("#DeleteNoticesForm").submit();
						}
					}});
				});
				$("#AddNewNotice").click(function()
				{
					window.location = "{$this->vars['acp_url']}?app=effectweb&module=main&section=notices&index=addNotice";
				});
				$('#datatable').dataTable(
				{
					"aaSorting": [[ 0, "desc" ]],
					'bJQueryUI': true,
					
					"bScrollCollapse": true,
					'sPaginationType': 'full_numbers',
					"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
					"oLanguage": 
					{
						"sLengthMenu": "{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['TableDisplay']}".replace("{_MENU_}", "_MENU_"),
						"sZeroRecords": "{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['TableNotResult']}",
						"sInfo": "{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['TableShow']}".replace("{_START_}","_START_").replace("{_END_}","_END_").replace("{_TOTAL_}","_TOTAL_"),
						"sInfoEmpty": "{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['TableShow']}".replace("{_START_}",0).replace("{_END_}",0).replace("{_TOTAL_}",0),
						"sInfoFiltered": "{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['TableFilter']}".replace("{_MAX_}", "_MAX_")
					}
				});
			});
			</script>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
			<article>
				<h1>{$this->lang->words['EWMain']['Notices']['ManageNotices']['Title']}</h1>
                {$result_command}
HTML;
		if(count($notice_list) > 0)
        {
        	$CTM_HTML .= <<<HTML
                <form name="DeleteNoticesForm" id="DeleteNoticesForm" method="post" action="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=main&amp;section=notices&amp;index=manageNotices&amp;do=deleteNotices" class="uniform">
                	<table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
						<thead>
							<tr>
								<th>{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['NoticeId']}</th>
								<th>{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['NoticeTitle']}</th>
								<th>{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['NoticeDate']}</th>
HTML;

			if($manage_all_notices == true)
            {
            	$CTM_HTML .= <<<HTML
								<th>{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['NoticeAccount']}</th>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
                                <th>{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['NoticeComments']}</th>
							</tr>
						</thead>
						<tbody>
HTML;

			$count = 0;
			foreach($notice_list as $id => $notice)
            {
            	if($notice['comments_enabled'] == false)
                	$grade = "gradeX";
                else
                	$grade = "gradeC";
                    
                $grade_type = ($count % 2) == 0 ? "odd" : "even";
                    
				$CTM_HTML .= <<<HTML
							<tr class="{$grade_type} {$grade}">
								<td>
                                	<input type="checkbox" name="notice__{$id}" id="notice__{$id}" value="1" />
                                	<a href="{$this->vars['acp_url']}?app=effectweb&amp;module=main&amp;section=notices&amp;index=editNotice&amp;id={$id}">#{$id}</a>
								</td>
								<td><a href="{$this->vars['acp_url']}?app=effectweb&amp;module=main&amp;section=notices&amp;index=editNotice&amp;id={$id}">{$notice['title']}</a></td>
								<td>{$notice['post_date']}</td>
HTML;

				if($manage_all_notices == true)
            	{
                	$CTM_HTML .= <<<HTML
                                <td>{$notice['account']}</td>
HTML;
				}
                
                $CTM_HTML .= <<<HTML
                                <td>{$notice['comments_count']}</td>
							</tr>
                            
HTML;

				$count++;
			}
            
            $CTM_HTML .= <<<HTML
						</tbody>
					</table>
                    <p>
                    	<button type="button" id="DeleteNoticesButton" class="button small">{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['DeleteNotices']}</button>
                        <button type="button" id="AddNewNotice" class="button small">{$this->lang->words['EWMain']['Notices']['ManageNotices']['Table']['AddNewNotice']}</button>
					</p>
                </form>
HTML;
        }
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['EWMain']['Notices']['ManageNotices']['Messages']['NoNotices']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;

		return $CTM_HTML;
	}
    /**
	 *	Notices: Edit Notice
	 *
	 *	@return	string	HTML String
	*/
	public function notices_editNotice()
	{
		global $notice_exists, $notice_data, $result_command;
		
        $CTM_HTML = <<<HTML
<article>
				<h1>{$this->lang->words['EWMain']['Notices']['EditNotice']['Title']}</h1>
                {$result_command}
                
HTML;

		if($notice_exists == true)
        {
            $_POST['fieldText'] = str_replace(array("<", ">"), array("&lt;", "&gt;"), $_POST['fieldText']);
            
            $field_title = $_GET['write'] == true ? $_POST['fieldTitle'] : $notice_data['title'];
            $field_text = $_GET['write'] == true ? $_POST['fieldText'] : $notice_data['text'];
            
            $comments_switch = ($_GET['write'] == true ? $_POST['enableComments'] == true : $notice_data['comments_enabled'] == true) ? " checked=\"checked\"" : NULL;
            $refresh_date = ($_GET['write'] == true ? $_POST['refeshData'] == true : false) ? " checked=\"checked\"" : NULL;
			
            $CTM_HTML .= <<<HTML
                <form name="editNotice" id="editNotice" action="{$this->vars['acp_url']}?app=effectweb&amp;module=main&amp;section=notices&amp;index=editNotice&amp;id={$notice_data['id']}&amp;write=true" method="post" class="uniform">
					<dl>
						<dt><label for="fieldTitle">{$this->lang->words['EWMain']['Notices']['EditNotice']['FieldTitle']}</label></dt>
						<dd><input type="text" id="fieldTitle" name="fieldTitle" value="{$field_title}"  class="big" /></dd>

						<dt><label for="enableComments">{$this->lang->words['EWMain']['Notices']['EditNotice']['FieldComments']}</label>&nbsp;
							<input type="checkbox" id="enableComments" name="enableComments"{$comments_switch} />
						</dt>
                        
                        <dt><label for="refreshDate">{$this->lang->words['EWMain']['Notices']['EditNotice']['FieldDate']}</label>&nbsp;
							<input type="checkbox" id="refreshDate" name="refreshDate"{$refresh_date} />
						</dt>

						<dt><label for="fieldText">{$this->lang->words['EWMain']['Notices']['EditNotice']['FieldText']}</label></dt>
						<dd>
							<textarea id="fieldText" name="fieldText" set="htmlEditor" class="big" rows="15">{$field_text}</textarea>
						</dd>
					</dl>
					<p>
						<button type="submit" class="button">{$this->lang->words['EWMain']['Notices']['EditNotice']['Buttons']['Process']}</button>
                        <button type="reset" class="button">{$this->lang->words['EWMain']['Notices']['EditNotice']['Buttons']['Reset']}</button>
					</p>
				</form>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['EWMain']['Notices']['EditNotice']['Messages']['NoExists']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;

		return $CTM_HTML;
	}
    /**
     *	Polls: Add Poll
     *
     *	@return	string	HTML String
    */
    public function polls_addPoll()
    {
    	global $result_command;
        
        $answer_count = $_POST['answerCount'] >= 2 ? $_POST['answerCount'] : 2;
        
        $CTM_HTML .= <<<HTML
			<script type="text/javascript">
			var answerInput = "<div style=\"display: none;\" id=\"AnswerFade_{answerNumber}\">\
											<dt><label for=\"Answer_{answerNumber}\">{$this->lang->words['EWMain']['Polls']['AddPoll']['FieldAnswer']} {answerNumber}</label></dt>\
											<dd><input type=\"text\" id=\"Answer_{answerNumber}\" name=\"Answer_{answerNumber}\" class=\"medium\" /></dd>\
										</div>";
			$(function()
			{
				answerCount = {$answer_count};
				$("#addAnswers").click(function()
				{
					Sexy.prompt("{$this->lang->words['EWMain']['Polls']['AddPoll']['Messages']['AddAnswer']}", {}, { "input" : 1, "textBoxBtnOk" : "{$this->lang->words['EWMain']['Polls']['AddPoll']['Buttons']['AddAnswer']['Add']}", "textBoxBtnCancel" : "{$this->lang->words['EWMain']['Polls']['AddPoll']['Buttons']['AddAnswer']['Cancel']}", "onComplete" : 
					function(returnvalue)
					{
						if(returnvalue)
						{
							if(!isNaN(returnvalue) && returnvalue > 0)
							{
								for(i = 1; i <= returnvalue; i++)
								{
									send = answerInput.replace(/{answerNumber}/gi, answerCount + 1);
									$("#pollAnswers").append(send);
									$("#AnswerFade_"+(answerCount + 1)).show("slow");
									$("#answerCount").val(++answerCount);
								}
							}
						}
					}});
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['EWMain']['Polls']['AddPoll']['Title']}</h1>
                {$result_command}
				
				<form name="addPoll" id="addPoll" action="{$this->vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls&amp;index=addPoll&amp;write=true" method="post">
                    <input type="hidden" name="answerCount" id="answerCount" value="{$answer_count}" />
                    <fieldset>
                    	<legend>{$this->lang->words['EWMain']['Polls']['AddPoll']['Settings']}</legend>
                    	<dl>
							<dt><label for="fieldQuestion">{$this->lang->words['EWMain']['Polls']['AddPoll']['FieldQuestion']}</label></dt>
							<dd><input type="text" id="fieldQuestion" name="fieldQuestion" value="{$_POST['fieldQuestion']}" class="medium" /></dd>
                        
                        	<dt><label for="expiration">{$this->lang->words['EWMain']['Polls']['AddPoll']['FieldDate']}</label></dt>
							<dd><input type="text" id="expiration" name="expiration" readonly="readonly" value="{$_POST['expiration']}" maxlength="10" class="small" set="dateSet" /></dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['EWMain']['Polls']['AddPoll']['Answers']} <a href="javascript: void(0);" id="addAnswers">[ {$this->lang->words['EWMain']['Polls']['AddPoll']['AddAnswers']} ]</a></legend>
                    	<dl id="pollAnswers">
HTML;
		for($i = 1; $i <= $answer_count; $i++)
        {
        	$value = $_POST['Answer_'.$i];
        	$CTM_HTML .= <<<HTML
                        	<dt><label for="Answer_{$i}">{$this->lang->words['EWMain']['Polls']['AddPoll']['FieldAnswer']} {$i}</label></dt>
							<dd><input type="text" id="Answer_{$i}" name="Answer_{$i}" value="{$value}" class="medium" /></dd>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
						</dl>
                    </fieldset>
					<p>
						<button type="submit" class="button">{$this->lang->words['EWMain']['Polls']['AddPoll']['Buttons']['Submit']}</button>
					</p>
				</form>
			</article>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Polls: Manage Poll
	 *
	 *	@return	string	HTML String
	*/
	public function polls_managePolls()
	{
		global $poll_list, $result_command;
		
		$CTM_HTML = NULL;
		
		if(count($poll_list) > 0)
        {
			$CTM_HTML .= <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("#DeletePollsButton").click(function()
				{
					Sexy.confirm("{$this->lang->words['EWMain']['Polls']['ManagePolls']['Messages']['ConfirmDelete']}", { onComplete : function(result)
					{
						if(result)
						{
							$("#DeletePollsForm").submit();
						}
					}});
				});
				$("#AddNewPoll").click(function()
				{
					window.location = "{$this->vars['acp_url']}?app=effectweb&module=main&section=polls&index=addPoll";
				});
			});
            </script>
HTML;
		}
        
		$CTM_HTML .= <<<HTML
			<article>
				<h1>{$this->lang->words['EWMain']['Polls']['ManagePolls']['Title']}</h1>
                {$result_command}
HTML;
		if(count($poll_list) > 0)
        {
        	$CTM_HTML .= <<<HTML
                <form name="DeletePollsForm" id="DeletePollsForm" method="post" action="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls&amp;index=managePolls&amp;do=deletePolls">
					<table id="table1" class="gtable sortable">
						<thead>
							<tr>
								<th><input type="checkbox" class="checkall" /></th>
								<th>{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['Question']}</th>
								<th>{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['BeginDate']}</th>
								<th>{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['EndDate']}</th>
                                <th>{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['Status']}</th>
							</tr>
						</thead>
						<tbody>
HTML;
			foreach($poll_list as $id => $poll)
            {
            	$CTM_HTML .= <<<HTML
							<tr>
								<td><input type="checkbox" name="poll__{$id}" id="poll__{$id}" value="1" /></td>
								<td><a href="{$this->vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls&amp;index=editPoll&amp;id={$id}">{$poll['question']}</a></td>
								<td>{$poll['begin_date']}</td>
								<td>{$poll['end_date']}</td>
                                <td>{$poll['status']}</td>
							</tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
						</tbody>
					</table>
					<div class="tablefooter clearfix">
						<div class="actions">
                        	<p>
                                <button type="button" id="DeletePollsButton" class="button small">{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['DeletePolls']}</button>
                                <button type="button" id="AddNewPoll" class="button small">{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['AddNewPoll']}</button>
							</p>
                        </div>
					</div>
				</form>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['EWMain']['Polls']['ManagePolls']['Messages']['NoPolls']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;
	
    	return $CTM_HTML;
    }
    /**
     *	Polls: Edit Poll
     *
     *	@return	string	HTML String
    */
    public function polls_editPoll()
    {
    	global $edit_poll, $poll_exists, $result_command;
        
        $CTM_HTML = NULL;
        
        if($poll_exists == true)
        {
        	$poll_question = $_GET['write'] == true ? $_POST['fieldQuestion'] : $edit_poll['question'];
        	$poll_expiration = $_GET['write'] == true ? $_POST['expiration'] : $edit_poll['end_date'];
        
        	$status_yes = ($_GET['write'] == true ? $_POST['PollStatus'] == 0 : $edit_poll['status'] == 0) ? " checked=\"checked\"" : NULL;
        	$status_no = ($_GET['write'] == true ? $_POST['PollStatus'] == 1 : $edit_poll['status'] == 1) ? " checked=\"checked\"" : NULL;
        
        	$answer_count = $_POST['answerCount'] >= $edit_poll['answer_after_count'] ? $_POST['answerCount'] : $edit_poll['answer_after_count'];
            
        	$CTM_HTML .= <<<HTML
			<script type="text/javascript">
			var answerInput = "<div style=\"display: none;\" id=\"AnswerFade_{answerNumber}\">\
											<dt><label for=\"Answer_{answerNumber}\">{$this->lang->words['EWMain']['Polls']['AddPoll']['FieldAnswer']} {answerNumber}</label></dt>\
											<dd>\
												<input type=\"text\" id=\"Answer_{answerNumber}\" name=\"Answer_{answerNumber}\" class=\"medium\" />\
												<input type=\"text\" id=\"VotesAnswers_{answerNumber}\" name=\"VotesAnswers_{answerNumber}\" value=\"0\" size=\"5\" onkeypress=\"return CTM.NumbersOnly(event);\" />\
											</dd>\
										</div>";
			$(function()
			{
				answerCount = {$answer_count};
				$("#addAnswers").click(function()
				{
					Sexy.prompt("{$this->lang->words['EWMain']['Polls']['EditPoll']['Messages']['AddAnswer']}", {}, { "input" : 1, "textBoxBtnOk" : "{$this->lang->words['EWMain']['Polls']['AddPoll']['Buttons']['AddAnswer']['Add']}", "textBoxBtnCancel" : "{$this->lang->words['EWMain']['Polls']['EditPoll']['Buttons']['AddAnswer']['Cancel']}", "onComplete" : 
					function(returnvalue)
					{
						if(returnvalue)
						{
							if(!isNaN(returnvalue) && returnvalue > 0)
							{
								for(i = 1; i <= returnvalue; i++)
								{
									send = answerInput.replace(/{answerNumber}/gi, answerCount + 1);
									$("#pollAnswers").append(send);
									$("#AnswerFade_"+(answerCount + 1)).show("slow");
									$("#answerCount").val(++answerCount);
								}
							}
						}
					}});
				});
			});
			</script>
HTML;
		}

		$CTM_HTML .= <<<HTML
			<article>
				<h1>{$this->lang->words['EWMain']['Polls']['EditPoll']['Title']}</h1>
                {$result_command}

HTML;

		if($poll_exists == true)
        {
        	$CTM_HTML .= <<<HTML
				<form name="editPoll" id="editPoll" action="{$this->vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls&amp;index=editPoll&amp;id={$_GET['id']}&amp;write=true" method="post">
                    <input type="hidden" name="answerCount" id="answerCount" value="{$answer_count}" />
                    <input type="hidden" name="answerAfterCount" id="answerAfterCount" value="{$edit_poll['answer_after_count']}" />
                    <fieldset>
                    	<legend>{$this->lang->words['EWMain']['Polls']['EditPoll']['Settings']}</legend>
                    	<dl>
							<dt><label for="fieldQuestion">{$this->lang->words['EWMain']['Polls']['EditPoll']['FieldQuestion']}</label></dt>
							<dd><input type="text" id="fieldQuestion" name="fieldQuestion" value="{$poll_question}" class="medium" /></dd>
                        
                        	<dt><label for="expiration">{$this->lang->words['EWMain']['Polls']['EditPoll']['FieldDate']}</label></dt>
							<dd><input type="text" id="expiration" name="expiration" readonly="readonly" value="{$poll_expiration}" maxlength="10" class="small" set="dateSet" /></dd>
                            
                            <dt><label for="PollStatus">{$this->lang->words['EWMain']['Polls']['EditPoll']['FieldStatus']}</label></dt>
							<dd>
                        		<span class="yesno_yes"><input type="radio" name="PollStatus" id="PollStatus_YES" value="0"{$status_yes} />
									<label for="PollStatus_YES">{$this->lang->words['Words']['Opened']}</label></span><span class="yesno_no">
									<input type="radio" name="PollStatus" id="PollStatus_NO" value="1"{$status_no} />
									<label for="PollStatus_NO">{$this->lang->words['Words']['Closed']}</label>
								</span>
							</dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['EWMain']['Polls']['EditPoll']['Answers']} <a href="javascript: void(0);" id="addAnswers">[ {$this->lang->words['EWMain']['Polls']['EditPoll']['AddAnswers']} ]</a></legend>
                    	<dl id="pollAnswers">
HTML;

		for($i = 1; $i <= $answer_count; $i++)
        {
        	$value = $_GET['write'] == true ? $_POST['Answer_'.$i] : $edit_poll['answers'][$i]['answer'];
            $votes = $_GET['write'] == true ? $_POST['VotesAnswers_'.$i] : $edit_poll['answers'][$i]['votes'];
           
        	$CTM_HTML .= <<<HTML
            				<input type="hidden" id="IdAnswer_{$i}" name="IdAnswer_{$i}" value="{$edit_poll['answers'][$i]['id']}" />
                        	<dt><label for="Answer_{$i}">{$this->lang->words['EWMain']['Polls']['EditPoll']['FieldAnswer']} {$i}</label></dt>
							<dd>
                            	<input type="text" id="Answer_{$i}" name="Answer_{$i}" value="{$value}" class="medium" />
                                <input type="text" id="VotesAnswers_{$i}" name="VotesAnswers_{$i}" value="{$votes}" size="5" onkeypress="return CTM.NumbersOnly(event);" />
                            </dd>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
						</dl>
                    </fieldset>
					<p>
						<button type="submit" class="button">{$this->lang->words['EWMain']['Polls']['EditPoll']['Buttons']['Submit']}</button>
					</p>
				</form>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['EWMain']['Polls']['EditPoll']['Messages']['NoExists']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;

		return $CTM_HTML;
    }
}

$callSkinCache = new CTM_ACPSkin_Main();
$callSkinCache->registry();