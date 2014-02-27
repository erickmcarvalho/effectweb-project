<ul class="info">
	<li><span>{$ajax_poll['question']}</span></li>
	<li class="line"><!-- Separator line --></li>
    <form name="AjaxPoll" id="AjaxPoll">
    <foreach loop="$ajax_poll['answers'] as $id => $answer">
	<li><input type="radio" name="PollAnswer" id="PollAnswer" value="{$id}">&nbsp; {$answer}</li>
    </foreach>
	<li class="line"><!-- Separator line --></li>
		<input type="button" class="btn" value="{$this->lang->words['Ajax']['Poll']['Vote']}" onclick="CTM.AjaxLoad('?app=core&amp;ajax=poll&amp;cmd=vote&amp;id={$ajax_poll['id']}', 'PollResult', 'AjaxPoll');" />
		<input type="button" class="btn" value="{$this->lang->words['Ajax']['Poll']['Result']}" onclick="CTM.AjaxLoad('?app=core&amp;ajax=poll&amp;cmd=result&amp;id={$ajax_poll['id']}', 'PollResult');" />
	</form>
    <li><span><a href="javascript: void(0);" onclick="CTM.AjaxLoad('?app=core&ajax=poll&cmd=loadPolls', 'WebAjaxPoll');">{$this->lang->words['Ajax']['Poll']['All']}</a></span></li>
</ul>
<div id="PollResult"></div>