	<div class="box-content">
    	<div class="header"><span>{$this->lang->words['All_Notices']['Title']}</span></div>
        <if syntax="count($all_notices) > 0">
		<ul class="news">
        	<foreach loop="$all_notices as $id => $notice">
        	<li>&raquo; <a href="javascript: void(0);" onclick="CTM.Load('?/notices/view/{$id}','content');">{$notice['title']}</a> - [ {$notice['date']} ]</li>
            </foreach>
        </ul>
        <else />
		<div class="info-box">{$this->lang->words['All_Notices']['Message']}</div>
		</if>
    </div>