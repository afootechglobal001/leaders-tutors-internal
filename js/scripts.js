function _call_carousel(cnt){
	// INIT CAROUSEL
	 window['carousel_' +cnt] = new CgCarousel('#js-carousel_'+cnt,  window['carousel_options_' +cnt], {});
	// Navigation
	window['next_' +cnt] = document.getElementById('js-carousel_next'+cnt);
	window['next_' +cnt].addEventListener('click', () => window['carousel_' +cnt].next());
	window['prev_' +cnt] = document.getElementById('js-carousel_prev'+cnt);
	window['prev_' +cnt].addEventListener('click', () => window['carousel_' +cnt].prev());
}

$(window).scroll(function () {
	var scrollheight = $(window).scrollTop();
	if (scrollheight >= 100) {
	  $("#back2Top").fadeIn(1000);
	} else {
	  $("#back2Top").fadeOut(1000);
	}
	if (scrollheight >= 400) {
	  $("header").css("position", "fixed");
	} else {
	  $("header").css("position", "absolute");
	}
  });

function _back_to_top(){
		event.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
}
function scrolltodiv(divid, margintop){
	$('html, body').animate({
	scrollTop: $("#"+divid).offset().top - margintop}, 500);
}

function _open_menu(){
	   $('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'0'},200);
	   $('.live-chat-back-div').animate({'margin-left':'-100%'},400);
	   $('.index-menu-back-div').animate({'margin-left':'0'},400);
}
function _open_live_chat(){
	   $('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'0'},200);
	   $('.index-menu-back-div').animate({'margin-left':'-100%'},400);
	   $('.live-chat-back-div').animate({'margin-left':'0'},400);
}
function _close_side_nav(){
	   $('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'-100%'},200);
	   $('.index-menu-back-div,.live-chat-back-div').animate({'margin-left':'-100%'},400);
}

function _open_li(ids){
		 $('#'+ids+'-sub-li').toggle('slow');
}

function alert_close(){
		$('#get-more-div').html('').fadeOut(200);
}
function alert_secondary_close(){
		$('#get-more-div-secondary').html('').fadeOut(200);
}




///// for FAQs
function _collapse(div_id){
	var x = document.getElementById(div_id+"num");
	  if (x.innerHTML === '&nbsp;<i class="bi-plus"></i>&nbsp;') {
		  x.innerHTML = '&nbsp;<i class="bi-dash"></i>&nbsp;';
		  $('#'+div_id).addClass('active-faq');
	  }else{
		x.innerHTML = '&nbsp;<i class="bi-plus"></i>&nbsp;';
		  $('#'+div_id).removeClass('active-faq');
	  }
	$('#'+div_id+'answer').slideToggle('slow');
}



function _get_form(page){
	$('#get-more-div').html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action='get-form';
		var dataString ='action='+ action+'&page='+ page;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){$('#get-more-div').html(html);}
	});
}