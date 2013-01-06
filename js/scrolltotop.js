/**
 * escrolltotop jquery»Øµ½¶¥²¿²å¼þ£¬Æ½»¬·µ»Ø¶¥²¿¡¢
 * 
 * ²ÎÊýÉèÖÃ
 *   startline : ³öÏÖ·µ»Ø¶¥²¿°´Å¥Àë¶¥²¿µÄ¾àÀë
 *   scrollto : ¹ö¶¯µ½¾àÀë¶¥²¿µÄ¾àÀë£¬»òÕßÄ³¸öidÔªËØµÄÎ»ÖÃ
 *   scrollduration : Æ½»¬¹ö¶¯Ê±¼ä
 *   fadeduration : µ­Èëµ­³öÊ±¼ä eg:[ 500, 100 ] [0]µ­Èë¡¢[1]µ­³ö
 *   controlHTML : html´úÂë
 *   className £ºÑùÊ½Ãû³Æ
 *   titleName : »Øµ½¶¥²¿µÄtitleÊôÐÔ
 *   offsetx : »Øµ½¶¥²¿ right Æ«ÒÆÎ»ÖÃ
 *   offsety : »Øµ½¶¥²¿ bottom Æ«ÒÆÎ»ÖÃ
 *   anchorkeyword : Ã¨µãÁ´½Ó
 * eg:
 *   $.scrolltotop({
 *   	scrollduration: 1000 
 *   });
 */
(function($){
	$.scrolltotop = function(options){
		options = jQuery.extend({
			startline : 100,				//³öÏÖ·µ»Ø¶¥²¿°´Å¥Àë¶¥²¿µÄ¾àÀë
			scrollto : 0,					//¹ö¶¯µ½¾àÀë¶¥²¿µÄ¾àÀë£¬»òÕßÄ³¸öidÔªËØµÄÎ»ÖÃ
			scrollduration : 500,			//Æ½»¬¹ö¶¯Ê±¼ä
			fadeduration : [ 500, 100 ],	//µ­Èëµ­³öÊ±¼ä £¬[0]µ­Èë¡¢[1]µ­³ö
			controlHTML : '<a href="javascript:;"><b>»Øµ½¶¥²¿¡ü</b></a>',		//html´úÂë
			className: '',					//ÑùÊ½Ãû³Æ
			titleName: '»Øµ½¶¥²¿',				//»Øµ½¶¥²¿µÄtitleÊôÐÔ
			offsetx : 5,					//»Øµ½¶¥²¿ right Æ«ÒÆÎ»ÖÃ
			offsety : 5,					//»Øµ½¶¥²¿ bottom Æ«ÒÆÎ»ÖÃ
			anchorkeyword : '#top', 		//Ã¨µãÁ´½Ó
		}, options);
		
		var state = {
			isvisible : false,
			shouldvisible : false
		};
		
		var current = this;
		
		var $body,$control,$cssfixedsupport;
		
		var init = function(){
			var iebrws = document.all;
			$cssfixedsupport = !iebrws || iebrws
					&& document.compatMode == "CSS1Compat"
					&& window.XMLHttpRequest
			$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
			$control = $('<div class="'+options.className+'" id="topcontrol">' + options.controlHTML + '</div>').css({
				position : $cssfixedsupport ? 'fixed': 'absolute',
				bottom : options.offsety,
				right : options.offsetx,
				opacity : 0,
				cursor : 'pointer'
			}).attr({
				title : options.titleName
			}).click(function() {
				scrollup();
				return false;
			}).appendTo('body');
			if (document.all && !window.XMLHttpRequest && $control.text() != ''){
				$control.css({
					width : $control.width()
				});
			}
			togglecontrol();
			$('a[href="' + options.anchorkeyword + '"]').click(function() {
				scrollup();
				return false;
			});
			$(window).bind('scroll resize', function(e) {
				togglecontrol();
			})
			
			return current;
		};
		
		var scrollup = function() {
			if (!$cssfixedsupport){
				$control.css( {
					opacity : 0
				});
			}
			var dest = isNaN(options.scrollto) ? parseInt(options.scrollto): options.scrollto;
			if(typeof dest == "string"){
				dest = jQuery('#' + dest).length >= 1 ? jQuery('#' + dest).offset().top : 0;
			}
			$body.animate( {
				scrollTop : dest
			}, options.scrollduration);
		};

		var keepfixed = function() {
			var $window = jQuery(window);
			var controlx = $window.scrollLeft() + $window.width()
					- $control.width() - options.offsetx;
			var controly = $window.scrollTop() + $window.height()
					- $control.height() - options.offsety;
			$control.css( {
				left : controlx + 'px',
				top : controly + 'px'
			});
		};

		var togglecontrol = function() {
			var scrolltop = jQuery(window).scrollTop();
			if (!$cssfixedsupport){
				this.keepfixed()
			}
			state.shouldvisible = (scrolltop >= options.startline) ? true : false;
			if (state.shouldvisible && !state.isvisible) {
				$control.stop().animate( {
					opacity : 1
				}, options.fadeduration[0]);
				state.isvisible = true;
			} else if (state.shouldvisible == false && state.isvisible) {
				$control.stop().animate( {
					opacity : 0
				}, options.fadeduration[1]);
				state.isvisible = false;
			}
		};
		
		return init();
	};
})(jQuery);
