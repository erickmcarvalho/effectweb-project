    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Auth']['Login']['Form']['Title']}</span></div>
        <form name="LoginMember" id="LoginMember" class="loginForm">
        	<if syntax="!empty($referer)">
            <input type="hidden" name="referer" value="{$referer}" />
            <else />
            <input type="hidden" name="referer" value="?app=core&amp;module=userpanel" />
            </if>
        	<table width="100%" border="0">
            	<tr>
                	<td><label>{$this->lang->words['Auth']['Login']['Form']['Login']}</label></td>
                    <td><input type="text" name="username" id="username" onkeyup="this.value = this.value.toLowerCase();" maxlength="10" size="32" /></td>
        		</tr>
                <tr>
                	<td><label>{$this->lang->words['Auth']['Login']['Form']['Password']}</label></td>
                    <td><input type="password" name="password" id="assword" maxlength="10" size="32" /></td>
        		</tr>
                <tr>
                	<td></td>
                    <td><a href="javascript: void(0);" onclick="CTM.Load('?/recovery/', 'content');">{$this->lang->words['Auth']['Login']['Form']['Recovery']}</a></td>
        		</tr>
            </table>
            <br />
            <input type="button" value="{$this->lang->words['Auth']['Login']['Form']['Button']}" onclick="CTM.AjaxLoad('?app=core&amp;module=global&amp;section=login&amp;do=process','Command','LoginMember');" class="btn" />
        </form>
    </div>
    <div id="Command"><if syntax="!empty($write_result)">{$write_result}</if></div>