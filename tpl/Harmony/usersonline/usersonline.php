	<div class="box-content">
		<div class="header"><span>{$this->lang->words['UsersOnline']['Title']}</span></div>
        <if syntax="count($users_online['users']) > 0">
        <table width="100%" border="0" align="center" cellpadding="7" class="tableBackColumn" style="text-align:center;">
        	<thead>
            	<tr width="100%">
                	<th>{$this->lang->words['UsersOnline']['Table']['Name']}</th>
                    <th>{$this->lang->words['UsersOnline']['Table']['Level']}</th>
                    <th>{$this->lang->words['UsersOnline']['Table']['Resets']}</th>
                    <th>{$this->lang->words['UsersOnline']['Table']['Class']}</th>
                    <th>{$this->lang->words['UsersOnline']['Table']['Map']}</th>
                    <if syntax="$users_online['is_room'] == false">
                    <th>{$this->lang->words['UsersOnline']['Table']['Room']}</th>
                    </if>
				</tr>
			</thead>
            <tbody>
            	<foreach loop="$users_online['users'] as $name => $info">
            	<tr>
                	<td>{$name}</td>
                    <td>{$info['level']}</td>
                    <td>{$info['resets']}</td>
                    <td>{$info['class']}</td>
                    <td>{$info['map_name']}</td>
                    <if syntax="$users_online['is_room'] == false">
                    <td>{$info['room']}</td>
                    </if>
                </tr>
                </foreach>
    		</tbody>
    	</table>
        <else />
        <if syntax="$users_online['is_room'] == true">
        <div class="info-box">{$this->lang->words['UsersOnline']['Messages']['Room']}</div>
        <else />
        <div class="info-box">{$this->lang->words['UsersOnline']['Messages']['All']}</div>
        </if>
        </if>
    </div>