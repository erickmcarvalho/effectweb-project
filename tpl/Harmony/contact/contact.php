	<script type="text/javascript">
	$(function()
	{
		var currentSection = "Contact1";
		
		$("td[rel*=SelectContact]").click(function()
		{
			contact = $(this).attr("id");
			
			if($("#View_"+currentSection).is(":visible"))
				$("#View_"+currentSection).slideUp(341);
					
			$("#View_"+contact).slideDown(341);
			$("#"+currentSection).attr("class", "");
			$("#"+contact).attr("class", "current");
			
			currentSection = contact;
		});
	});
	</script>
	<style type="text/css">
    #TopContactSelect {
        text-align:center;
    }
    #TopContactSelect td
    {
        padding:5px;
        margin:10px;
        cursor: pointer;
    }
    </style>

	<div class="box-content">
		<div class="header"><span>{$this->lang->words['Contact']['Title']}</span></div>
        <blockquote>
            {$this->lang->words['Contact']['HeaderText']}<br /><br />
            <table width="50%" border="0" id="TopContactSelect" class="optionSelect" align="center" style="margin-bottom:15px;">
                <tr>
                    <td align="center" rel="SelectContact" class="current"  id="Contact1"><strong>{$this->lang->words['Contact']['Menu']['Mail']}</strong></td>
                    <if syntax="$this->settings['CONTACT']['ENABLE_PHONE'] == true">
                    <td  rel="SelectContact"  id="Contact2"><strong>{$this->lang->words['Contact']['Menu']['Phone']}</strong></td>
                    </if>
                    <td rel="SelectContact" id="Contact3"><strong>{$this->lang->words['Contact']['Menu']['Ticket']}</strong></td>
                </tr>
            </table>
		</blockquote>
    </div>

	<div id="View_Contact1" class="CurrentContact">
		<div class="box-content">
			<div class="header"><span>{$this->lang->words['Contact']['MailContact']['Title']}</span></div>
			<p>
				<strong>{$this->lang->words['Contact']['MailContact']['Text']}</strong><br />
				<if syntax="count($this->settings['CONTACT']['MAIL']) > 0">
                <ul class="info">
				<foreach loop="$this->settings['CONTACT']['MAIL'] as $mail">
					<li>&raquo; {$mail[1]} - <span class="colr">{$mail[0]}</span></li>
				</foreach>
                </ul>
				<else />
				<div class="info-box">{$this->lang->words['Contact']['MailContact']['Disabled']}</div>
				</if>
			</p>
		</div>
	</div>

	<if syntax="$this->settings['CONTACT']['ENABLE_PHONE'] == true">
	<div id="View_Contact2"  style="display:none;" class="CurrentContact">
		<div class="box-content">
			<div class="header"><span>{$this->lang->words['Contact']['PhoneContact']['Title']}</span></div>
			<p>
				<strong>{$this->lang->words['Contact']['PhoneContact']['Text']}</strong><br />
    			<if syntax="count($this->settings['CONTACT']['PHONE']) > 0">
                <ul class="info">
   				<foreach loop="$this->settings['CONTACT']['PHONE'] as $phone">
        			<li>&raquo; {$phone[1]} - <span class="colr">{$phone[0]}</span> - <strong>{$this->lang->words['Contact']['PhoneContact']['Speak']}</strong> {$phone[2]}</li>
   				</foreach>
                </ul>
    			<else />
    			<div class="info-box">{$this->lang->words['Contact']['PhoneContact']['Disabled']}</div>
    			</if>
			</p>
		</div>
	</div>
	</if>
    
	<div id="View_Contact3"  style="display:none;" class="CurrentContact">
		<div class="box-content">
			<div class="header"><span>{$this->lang->words['Contact']['TicketContact']['Title']}</span></div>
			<p>
				{$this->lang->words['Contact']['TicketContact']['Text']}
			</p>
		</div>
	</div>