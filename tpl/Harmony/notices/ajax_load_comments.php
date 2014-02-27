	<if syntax="count($ajax_notice_comments) > 0">
	<foreach loop="$ajax_notice_comments as $comment">
    <php>$header = str_replace(array("$1", "$2"), array($comment['author'], $comment['date']), $this->lang->words['NoticeAjax']['LoadComments']['Header']);</php>
    <div class="setQuote">
        <table width="100%" border="0">
        	<tr>
            	<td width="122"><img src="{$comment['image']}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" /></td>
                <td width="1242">
                	<div class="setQuote">{$header}</div>
                	<div class="setQuote" style="max-width:563px !important;">{$comment['text']}</div>
    			</td>
    		</tr>
    	</table>
	</div>
	</foreach>
	</if>