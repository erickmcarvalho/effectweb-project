/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * JavaScript: Sets up globals
 * Last Update: 19/04/2012 - 04:15h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

window.CTM.EW = 
{
	VARS : new Array(),
	LANG : new Array(),
	
	init : function()
	{
		CTM.VARS['LOAD_AJAX'] = this.VARS['LOADING_PAGE_AJAX'] == 1 ? true : false;
		CTM.VARS['FRIEND_URL'] = this.VARS['FRIEND_URL'] == 1 ? true : false;
		CTM.VARS['SHOW_MESSAGE_TYPE'] = this.VARS['SHOW_MESSAGE_TYPE'];
		CTM.VARS['PUBLIC_IMAGES'] = this.VARS['PUBLIC_IMAGES'];
		CTM.VARS['CAPTCHA_IMAGE'] = this.VARS['CAPTCHA_IMAGE'];
		CTM.VARS['AJAX_LOADING_IMG'] = this.VARS['AJAX_LOADING_IMG'];
		CTM.VARS['BOARD_URL'] = this.VARS['BOARD_URL'];
		
		$.facebox.set_img_dir(CTM.VARS['PUBLIC_IMAGES']);
	},
	AutoLoad : function()
	{
		if(this.VARS['METHOD_TYPE'] == 0)
		{
			CTM.AjaxLoad('?ajax=panel','loadPanel');
			CTM.AjaxLoad('?ajax=servers&cmd=refresh', 'ServerRefresh');
			CTM.AjaxLoad('?ajax=poll','Web_AjaxPoll');
		}
	},
}