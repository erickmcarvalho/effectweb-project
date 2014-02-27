<if syntax="count($ajax_gamemasters) > 0">
<ul class="info">
	<foreach loop="$ajax_gamemasters as $gm">
	<li>
    	<span>{$gm['name']} - </span>
        <if syntax="$gm['status'] == 1"><span class="green">Online</span><else /><span class="red">Offline</span></if>
	</li>
    </foreach>
</ul>
<else />
<div class="info-min">{$this->lang->words['Ajax']['GameMasters']['Message']}</div>
</if>