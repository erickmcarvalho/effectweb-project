	<div class="box-content">
    	<div class="header"><span>{$view_notice['title']}</span></div>
        <div class="setQuote">
            <table width="100%" border="0">
                <tr>
                    <td width="122"><img src="{$view_notice['author']['image']}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" /></td>
                    <td width="1242">
                        <div class="setQuote">{$this->lang->words['ViewNotice']['Header']}</div>
                        <div class="setQuote" style="max-width:563px !important;">{$view_notice['text']}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <if syntax="$view_notice['comments_switch'] == true">
    <div class="separator"><!-- separator line --></div>
    <div class="box-content">
    	<div id="noticeComments"><script>CTM.AjaxLoad("?app=core&module=notices&load=loadComments&id={$view_notice['id']}",'noticeComments');</script></div>
    </div>
    <if syntax="SESSION_USER_LOGGED == true">
    <script type="text/javascript">
	$(function()
	{
		$("#commentNotice").click(function()
		{
			CTM.AjaxLoad("?app=core&module=notices&load=commentNotice&id={$view_notice['id']}",'loadCommentNotice','commentNoticeNow');
		});
	});
	</script>
    </if>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['ViewNotice']['Comment']['Title']}</span></div>
        <if syntax="SESSION_USER_LOGGED == true">
        <form name="commentNoticeNow" id="commentNoticeNow" class="frm">
        	<table width="100%" border="0">
            	<tr>
            		<td class="setQuote">
                		<strong id="text">{$this->lang->words['ViewNotice']['Comment']['Character']}</strong>
                		<select name="Character" id="Character">
                        	<if syntax="count($user_logged_data['characters']) > 0">
                    		<foreach loop="$user_logged_data['characters'] as $character">
                        	<option value="{$character}">{$character}</option>
                        	</foreach>
                            </if>
						</select>
					</td>
                </tr>
                <tr>
                	<td align="center" colspan="41" class="setQuote"><textarea name="Text" id="Text" cols="60" rows="7"></textarea><br />&nbsp;</td>
				</tr>
                <tr>
                	<td align="center" colspan="41"><input type="button" id="commentNotice" value="{$this->lang->words['ViewNotice']['Comment']['Button']}" class="btn" /></td>
            	</tr>
            </table>
		</form>
        <div id="loadCommentNotice"></div>
        <else />
        <div class="info-box"> {$this->lang->words['ViewNotice']['Comment']['NotLogged']}</div>
        </if>
	</div>
    </if>