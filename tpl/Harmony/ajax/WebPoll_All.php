<ul class="info">
	<foreach loop="$ajax_all_polls as $id => $question">
	<li><span><a href="javascript: void(0);" onclick="CTM.AjaxLoad('?ajax=poll&id={$id}','WebAjaxPoll');">{$question}</a></span></li>
    </foreach>
</ul>