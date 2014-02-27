<script type="text/javascript">
$(function()
{
	$("#recordGeneral").click(function()
	{
		Sexy.info("{$this->lang->words['Sidebar']['Infos']['RecordOnline']['Messages']['General']}");
	});
	$("#recordToday").click(function()
	{
		Sexy.info("{$this->lang->words['Sidebar']['Infos']['RecordOnline']['Messages']['Today']}");
	});
	
	CTM.EW.VARS['WEB_VERSION'] = "{$this->vars['web_version']}";
	CTM.EW.VARS['FRIEND_URL'] = "{$this->vars['friend_url']}";
	CTM.EW.VARS['LOADING_PAGE_AJAX'] = "{$this->vars['loading_page_ajax']}";
	CTM.EW.VARS['SHOW_MESSAGE_TYPE'] = "{$this->vars['show_message_type']}";
	CTM.EW.VARS['BOARD_HOST'] = "{$this->vars['board_host']}";
	CTM.EW.VARS['BOARD_URL'] = "{$this->vars['board_url']}";
	CTM.EW.VARS['PATH_URL'] = "{$this->vars['path_url']}";
	CTM.EW.VARS['PUBLIC_IMAGES'] = "{$this->vars['board_url']}{$this->vars['public_directory']}images/"
	CTM.EW.VARS['CAPTCHA_IMAGE'] = "{$this->vars['board_url']}{$this->vars['captcha_image']}";
	CTM.EW.VARS['AJAX_LOADING_IMG'] = "{$this->vars['board_url']}{$this->vars['style_dirs']['skin_images']}loader.gif";
	CTM.EW.init();
	
	$("a[rel*=tooltip]").each(function()
	{
		var Text = $(this).attr("title");
		var Sub = $(this).attr("sub");
		$(this).tooltip (Text);
	});
	
	$("a[rel*=facebox]").facebox();
});
</script>