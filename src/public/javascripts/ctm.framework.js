/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * JavaScript: Application Library
 * Author: $CTM['Erick-Master']
 * Last Update: 07/06/2012 - 23:21h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

(function($)
{
	CTM  =
	{
		VARS : new Array(),
		
		Load : function(pageLocation, idShow, loadForm)
		{
			if(this.VARS['FRIEND_URL'] == true)
				if(pageLocation.substr(0, 2) == "?/")
					pageLocation = pageLocation.substr(2);
			
			pageLocation = this.VARS['BOARD_URL']+pageLocation;
			
			if(this.VARS['LOAD_AJAX'] == true)
				this.AjaxLoad(pageLocation, idShow, loadForm);
			else
				window.location = pageLocation;
		},
		NumbersOnly : function(Send)
		{
			if(window.event) Key = Send.keyCode;
			else if(Send.which) Key = Send.which;

			if((Key >= 48 && Key <= 57) || (Key == 8)) return true;
			else return false;
		},
		CheckMail : function(string)
		{
			string = string.replace(" ", "");
			
			if(substr_count(string, "@") > 1)
				return false;
			if(string.match(/[\;\#\n\r\*\'\"<>&\%\!\(\)\{\}\[\]\?\/\s]/))
				return false;
			if(string.match(/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,4})(\]?)$/))
				return true;
				
			return false;
		},
		Message : function(message, type, div)
		{
			function showNormalMessage(setClass)
			{
				//this.Scroll(div);
				$("#"+div).fadeOut("fast", function()
				{
					$("#"+div).html("<div class=\""+setClass+"-box\"> "+message+"</div>");
				});
				$("#"+div).fadeIn("slow");
		
				return null;
			}
			switch(this.VARS['SHOW_MESSAGE_TYPE'])
			{
				case "1" :
				switch(type)
				{
					case 1 : return Sexy.alert(message.replace("\n", "\ \n")); break;
					case 2 : return Sexy.error(message.replace("\n", "\ \n")); break;
					default : return Sexy.info(message.replace("\n", "\ \n")); break;
				}
				break;
				default :
				switch(type)
				{
					case 1 : return showNormalMessage('warning'); break;
					case 2 : return showNormalMessage('error'); break;
					case 3 : return showNormalMessage('success'); break;
					default : return showNormalMessage('info'); break;
				}
				break;
			}
		},
		setFieldHover : function(div, divResult, Message, Color, ImageName)
		{
			$("#"+div).css("border", "1px solid "+Color);
			$("#"+div).css("color", Color);
			$("#"+divResult).html('<img src="'+CTM.VARS['PUBLIC_IMAGES']+'icons/'+ImageName+'.png" align="absmiddle">&nbsp;<span style="color: '+Color+';">'+Message+'</font>');
		},
		PasswordLevel : function(Field, Result)
		{
			var Password = $("#"+Field).val();
			var Command = 0;

			if(Password.length < 4) Command = Command - 1;
			if(!Password.match(/[a-z_]/i) || !Password.match(/[0-9]/)) Command = Command - 1;
			if(!Password.match(/\W/)) Command = Command - 1;

			if(Password == '') this.setFieldHover(Field, Result, CTM.LANG['JSLibrary[PasswordLevel][Void]'], '#efdc75', 'exclamation');
			else if(Command == 0) this.setFieldHover(Field, Result, CTM.LANG['JSLibrary[PasswordLevel][Strong]'], 'green', 'success');
			else if(Command == -1) this.setFieldHover(Field, Result, CTM.LANG['JSLibrary[PasswordLevel][Average]'], 'green', 'tick');
			else if(Command == -2) this.setFieldHover(Field, Result, CTM.LANG['JSLibrary[PasswordLevel][Weak]'], '#FF0000', 'cross');
			else if(Command == -3) this.setFieldHover(Field, Result, CTM.LANG['JSLibrary[PasswordLevel][VeryWeak]'], '#FF0000', 'cross');
		},
		clearField : function(field)
		{
			if(field.defaultValue == field.value) field.value = "";
			else if(field.value == "") field.value = field.defaultValue; 
		},
		RefreshCaptcha : function(imageId)
		{
			$("#"+imageId).attr("src", CTM.VARS['CAPTCHA_IMAGE']+"&"+Math.random());
		},
		RedirectCount : function(redirect, seconds, timeId)
		{
			currentTime = $("#"+timeId).html();
			
			if(currentTime != 0)
			{
				$("#"+timeId).html(currentTime - 1)
				setTimeout("CTM.RedirectCount('"+redirect+"', "+seconds+", '"+timeId+"');", 700 + (seconds * 100));
			}
			else
			{
				window.location = redirect;
			}
		},
		AjaxLoad : function(requestURL, idShow, loadForm)
		{
			if(typeof(requestURL) != "undefined" && typeof(idShow) != "undefined")
			{
				var showLoading = true;
				var showLoadingImage = false;
				var ajaxOptions = {0 : false, 1 : false, 2 : false};
				var cache = new Date().getTime();
				requestURL = requestURL+"&ajaxLoadSet=true&ajaxLoadCache="+cache;
		
				if(idShow.substr(0, 3).match(/@/gi)) ajaxOptions[0] = true;
				if(idShow.substr(0, 3).match(/\*/gi)) ajaxOptions[1] = true;
				if(idShow.substr(0, 3).match(/\./gi)) ajaxOptions[2] = true;
		
				idShow = idShow.replace("@", "").replace("*", "").replace(".", "");
		
				if(ajaxOptions[0] == true) showLoading = false;
				if(ajaxOptions[1] == true) this.Scroll(idShow);
				if(ajaxOptions[2] == true) showLoadingImage = true;
				
				function changeContent(newContent)
				{
					$("#"+idShow).fadeOut("fast", function()
					{
						$("#"+idShow).html(newContent);
					});
					
					$("#"+idShow).fadeIn("slow", function()
					{
						if(showLoading == true) 
							$("#ajaxLoading").fadeOut("slow");
					});
				}
				
				if(showLoadingImage == true)
					changeContent("<div align=\"center\" style=\"display-none\"><img src=\""+this.VARS['AJAX_LOADING_IMG']+"\" /></div>");
				
				$(document).each(function()
				{
					if(showLoading == true)
						$("#ajaxLoading").fadeIn("slow");
						
					if(typeof(loadForm) != "undefined" && loadForm != "GET" && loadForm != "POST")
					{
						$.post(requestURL, jQuery("#"+loadForm).serialize(), function(data)
						{
							changeContent(data);
						});
					}
					else
					{
						$.get(requestURL, function(data)
						{
							changeContent(data);
						});
					}
				});
			}
		},
		AjaxShowBox : function(requestURL, loadForm)
		{
			var cache = new Date().getTime();
			requestURL = requestURL+"&ajaxLoadSet=true&ajaxLoadCache="+cache;
				
			$.facebox(function()
			{
				if(typeof(loadForm) != "undefined" && loadForm != "GET" && loadForm != "POST")
				{
					$.post(requestURL, jQuery("#"+loadForm).serialize(), function(data)
					{
						$.facebox(data);
					});
				}
				else
				{
					$.get(requestURL, function(data)
					{
						$.facebox(data);
					});
				}
			});
		},
		OptionSelect : function(SelectButton, CurrentOption, ViewId, Scroll)
		{
			$(SelectButton).click(function()
			{
				option = $(this).attr("id");

				$(CurrentOption).hide().ready(function()
				{
					$("#"+ViewId+option).show("slow"); 
					$(SelectButton).attr("class", "");
					$("#"+option).attr("class", "current");
					
					if(Scroll == true) CTM.Scroll(ViewId+option);
				});
			});
		},
		Scroll : function(idLocation, time)
		{
			if(time == null) time = 500;
			if(idLocation == null) idLocation = "body";
			else idLocation = "#"+idLocation;
	
			$("html").animate({scrollTop: $(idLocation).offset().top}, time);
		}
	}
})(jQuery);