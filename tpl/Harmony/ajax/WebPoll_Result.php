<ul class="info">
	<li><span>{$this->lang->words['Ajax']['Poll']['Status']} </span>{$ajax_poll_result['status']}</li>
    <li><span>{$this->lang->words['Ajax']['Poll']['Total']} </span>{$ajax_poll_result['total_votes']}</li>
    <li><span>{$this->lang->words['Ajax']['Poll']['BeginDate']} </span>{$ajax_poll_result['begin_date']}</li>
    <li><span>{$this->lang->words['Ajax']['Poll']['EndDate']} </span>{$ajax_poll_result['end_date']}</li>
    <li class="line"><!-- Separator line --></li>
    <foreach loop="$ajax_poll_result['answers'] as $id => $data">
    <li>
    	<span>{$data['answer']} - </span>
        {$this->lang->words['Ajax']['Poll']['Votes']} <strong>{$data['votes']}</strong> (<strong>{$data['result']}%</strong>)<br />
        <div class="border-bar">
        	<div class="green-gauge" style="width: {$data['result']}%"><!-- Bar --></div>
		</div>
    </li>
    </foreach>
</ul>
<if syntax="!empty($ajax_poll_result['message'])">
<div style="clear: both;"></div>
{$ajax_poll_result['message']}
</if>