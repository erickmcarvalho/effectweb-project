	<div class="box-content">
    	<div class="header"><span>{$this->lang->words['Team']['Title']}</span></div>
        <p>
        	{$this->lang->words['Team']['Text']}
        </p>
	</div>
    <div class="box-content">
        <if syntax="count($team_members) > 0">
        <script type="text/javascript">
		$(function()
		{
			<foreach loop="$team_members as $key => $value">
			$("#showServer_{$key}").tooltip("{$this->lang->words['Team']['Members']['Server']} <strong>{$value['server']}</strong>", { hook: false, width: 200 });
			</foreach>
		});
		</script>
        <foreach loop="$team_members as $key => $value">
        <div class="setQuote">
        	<table width="100%" border="0" cellpadding="7" class="tableBackLine">
            	<tr>
                	<td width="20%" align="center">
                    	<img src="{$value['image']}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" />
                        <br />{$value['format_prefix']}{$value['title']}{$value['format_suffix']}
					</td>
                    <td>
                    	<table width="100%" border="0" align="center" cellpadding="7" style="text-align:center;" class="tableBackColumn">
                        	<tr>
                            	<td width="44%">{$this->lang->words['Team']['Members']['Name']}</td>
                                <td width="56%">{$value['format_prefix']}{$value['name']}{$value['format_suffix']}</td>
                            </tr>
                            <tr>
                            	<td>{$this->lang->words['Team']['Members']['Group']}</td>
                                <td>{$value['group']}</td>
                            </tr>
                            <tr>
                            	<td>{$this->lang->words['Team']['Members']['Contact']}</td>
                                <td>{$value['contact']}</td>
                            </tr>
                            <tr>
                            	<td>{$this->lang->words['Team']['Members']['Class']}</td>
                                <td>{$value['class']}</td>
                            </tr>
                            <tr>
                            	<td>{$this->lang->words['Team']['Members']['Status']}</td>
                                <td id="showServer_{$key}">{$value['status']}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
    		</table>
    	</div>
        </foreach>
        <else />
        <div class="info-box">{$this->lang->words['Team']['Message']}</div>
        </if>
    </div>