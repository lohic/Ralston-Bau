/**********************************
@ WP TRANSPLANT THEME SCRIPTS	  @
@ URL : http://www.transplant.nu  @
@ Author : Loïc Horellou		  @
**********************************/
var theTimer;


/**************************
****** DOCUMENT PRET ******
**************************/
$(document).ready(function(){
	//alert(document.location.href);

	if(document.location.href != site_url+'/'){
		
		if( document.location.href.indexOf('/#/') == -1 ){
			//alert('adresse ok ');
			
			var new_url = document.location.href.replace(site_url+'/',site_url+'/#/');
			//document.location.href= new_url;
			//alert(site_url +'/ '+new_url);
			window.location = new_url;
		}
	}
	
	//$.address.hash('#!/');
	//!document.location.href.contains('/#')){
	
	var theTimer;
	
	// QUAND L'ADRESSE CHANGE
	var ua = $.browser;
	if ( ua.msie && parseInt(ua.version.slice(0,1)) < 8 ) {
		
	}else{
		$.address.change(function(event) {
			//alert($.address.queryString());
			
			$('#loading').css('opacity',1).css('display','block');
			//clearScroll();
			
			$("#menu a").each(function(){
				if($(this).attr("href")==$.address.baseURL()+$.address.path()){
					$("#menu li").removeClass('current-menu-item');
					$(this).parent().addClass('current-menu-item');
				}
			});
			
			$("#footer-menu a").each(function(){
				if($(this).attr("href")==$.address.baseURL()+$.address.path()){
					$("#menu li").removeClass('current-menu-item');
					$(this).parent().addClass('current-menu-item');
				}
			});
			
			var URLelem = $.address.path().split('/');
			var URL = $.address.baseURL()+$.address.path();
			
			if(URLelem[1] == 'search'){
				var URL = $.address.baseURL()+"/?s="+URLelem[2];
			}
			/*else{
				$('#s').val('');
			}*/
			
			$("#ajax").load(URL+' #ajax>*', function(){
				init();
				updateBlocSize();
			});
	
			
		});
	}
	
	// ON VIDE LE CONTENEUR AJAX INITIAL
	$('#ajax').html('');
	
	// QUAND LE REDIMENTIONNEMENT SE TERMINE
	$(window).resizeend({
		onDragEnd : function() {
			init('redim');
		},
		runOnStart : true
	});
	
	
	/***************
	** KEY SCROLL **
	***************/
	
	$('body').keyup(function(event) {
		if(event.which == 37){
			//alert('gauche');
			sens = -1;
			keyscroll(sens);
			return false;
	
		}else if(event.which == 39){
			//alert('droite');
			sens = 1;
			keyscroll(sens);
			return false;
		}
	});
});


function deselectMenu(){
	$("#menu li").removeClass('current-menu-item');
}

/**************************
** CHARGEMENT DES IMAGES **
**************************/
$(window).load(function(){
	//alert('images ok');
	updateBlocSize();
	loadingReady();
});


/**************************
***** INITIALISATION ******
**************************/
function init(param){	
	// ACTIVATION DES LIENS AVEC JQUERY ADDRESS
	$('a').click(function(){
		if($(this).attr("target")!="_blank"){
			var ua = $.browser;
			if ( ua.msie && parseInt(ua.version.slice(0,1)) < 8 ) {
				
			}else{
				var URL = $(this).attr('href').replace($.address.baseURL(), '');
				
				$.address.value(URL);
				return false;
				
			}
		}
	});
	
	$('#searchsubmit').click(function(){
		//alert($('#searchform').attr('action'));
		//var URL = $('#searchform').attr('action').replace($.address.baseURL(), '');
		//alert(URL + " " +$.address.baseURL());
		var ua = $.browser;
		if ( ua.msie && parseInt(ua.version.slice(0,1)) < 8 ) {
				
		}else{
			$.address.value("search/"+$('#s').val());
			return false;
		}
	});
	
	// AJOUT DU CLIC SUR LES BOITES DE LA MOSAIQUE
	$('.mosaic-item div.box').each(function(){
		if($(this).find('a').attr('href')){
			$(this).css('cursor','pointer');
			
			$(this).click(function(){
				var ua = $.browser;
				if ( ua.msie && parseInt(ua.version.slice(0,1)) < 8 ) {
					location.href= $(this).find('a').attr('href');
				}else{
					var URL = $(this).find('a').attr('href').replace($.address.baseURL(), '');
					$.address.value(URL);
				}
			});
		}
	});
		
	// SLIDES NEWS
	
	if(param != 'redim'){
		$(function(){
			$("#slides").slides({
				play: 10000
			});
		});
	}
	
	// CALCUL DE LA TAILLE DES BOITES DE LA MOSAIQUE
	var uniteMargin = updateBlocSize();
	
	// ISOTOPE
	$('.mosaic').isotope({
		layoutMode: 'masonryHorizontal',
		masonryHorizontal: {
			rowHeight: uniteMargin
		}
	});
	
	$('.slide').jScrollPane();
	
	if($(window).width()<=768){
		$('.texte').removeClass('scroll-pane');
		var element = $('.texte').jScrollPane({});
		var api = element.data('jsp');
		api.destroy();
	}else{
		$('.texte').jScrollPane();
	}
	
	
	$('#mosaic-wrapper').bind(
		'jsp-initialised',
		function(event, isScrollable)
		{
			// POUR FAIRE LE DRAG SCROLL
			//http://jsfiddle.net/PWYpu/28/
			//var leftScroll = $('#mosaic-wrapper').offset().left;
			//var endScroll = leftScroll + $('#mosaic-wrapper').width();
			//var f = ($('#mosaic-wrapper').width() / $('#mosaic-wrapper .jspPane').width())*5;
			var startX;
			var startXX;
			var initX;
			var delta = 0;
			var selection = false ;
		
			$(document).mousemove(function(e){
				var mX;
				var delta = startX - e.pageX;
				
				if(selection){
					//$('#mosaic-wrapper').data('jsp').scrollToX(e.pageX-delta);
					$('#mosaic-wrapper').data('jsp').scrollToX(initX+delta);
				}
				//window.status = e.pageX+' '+leftScroll+' '+ endScroll+' '+mX +' '+delta;
				window.status = delta;
			})   
				
			$('#mosaic-wrapper').mousedown(function(e){
				initX = $('#mosaic-wrapper').data('jsp').getContentPositionX();
				startX = e.pageX;
				startXX = $('#mosaic-wrapper .jspPane').offset().left;
				selection = true ;
				e.preventDefault();
			})
			$(window).mouseup(function(){
				selection = false ;
			})
		}
	).jScrollPane();
	
	
	$('.mosaic-img').click(function(){
		if($(this).attr('video') && $(this).attr('platform')){
			
			//var vimeo_ID  = $(this).attr('vimeo');
			var video_ID  = $(this).attr('video');
			
			var w = $(this).find('img').outerWidth();
			var h = $(this).find('img').outerHeight();
			
			if($(this).attr('platform') == 'vimeo'){
				$(this).html('<iframe src="http://player.vimeo.com/video/'+video_ID+'?title=0&amp;byline=0&amp;portrait=0" width="'+w+'" height="'+h+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
			}
			
			if($(this).attr('platform') == 'dailymotion'){
				$(this).html('<iframe frameborder="0" width="'+w+'" height="'+h+'" src="http://www.dailymotion.com/embed/video/'+video_ID+'"></iframe>');
			}
			
			if($(this).attr('platform') == 'youtube'){
				$(this).html('<iframe width="'+w+'" height="'+h+'" src="http://www.youtube.com/embed/'+video_ID+'" frameborder="0" allowfullscreen></iframe>');				
			}
			
		}
	});
	
	$('.mosaic-img img').load(function(){
		updateBlocSize();
	});
	
	
	var titrePage = "";
	titrePage = $("h2.project-title").text();
	
	if(titrePage != ""){
		document.title = "Ralston & Bau | Designers - Norway : "+titrePage;
	}else{
		document.title = "Ralston & Bau | Designers - Norway";
	}

	// WEBCAM
	$(".mosaic-img").each(function(){
		if($(this).hasClass('webcam')){
			theTimer = setTimeout("reloadImage()", 1);
		}
	});

}

function reloadImage(){
	var BaseURL = "http://www.transplant.nu/webcam/";
	var DisplayWidth = "640";
	var DisplayHeight = "360";
	var File = "webcam.php";

	theDate = new Date();
	var url = BaseURL;
	url += File;
	url += "?dummy=" + theDate.getTime().toString(10);
	$(".webcam img").attr("src",url);
	theTimer = setTimeout("reloadImage()", 1000);
}

/**************************
*** COMPTER l'ID DES PHOTOS
**************************/
	
function keyscroll(sens){
	var pane = $('.scroll-pane');
	var api = pane.data('jsp');
	
	//var xx = window.pageXOffset+$("body").width()/2;
	//var xx = api.getContentPositionX()+$('#player').width()/2;
	var xx = api.getContentPositionX()+200;
	
	var increment = 0;
	var oldXpos = -1;
	
	$larg = new Array();
	$larg.push(0);
	
	$('.mosaic-item').each(function(){
		if(oldXpos != $(this).offset().left){
			$larg.push($(this).outerWidth(true)+increment);
			//alert($(this).outerWidth(true)+increment);
			increment += $(this).outerWidth(true);
			
			oldXpos = $(this).offset().left;
			//alert(oldXpos);
		}
	});

	if(sens>0){
		var indexImg = 0;
		
		for(i=0 ; i<$larg.length ; i++){
			if($larg[i]<=xx && xx<$larg[i+1]){
				indexImg=(i+sens)<0?0:i+sens;
				break;	
			}	
		}
	}else{
		var indexImg = $larg.length-1;
		
		for(i=indexImg; i>=0; i--){
			if($larg[i]<=xx && xx<$larg[i+1]){
				indexImg=(i+sens)<0?0:i+sens;
				break;	
			}
		}
	}
	
	//alert(indexImg+" "+$larg[indexImg]);
	
	
	//var largeur = $('#player .mosaic-item').eq(indexImg).outerWidth(true);
	//largeur = 0;
			
	//api.scrollBy(largeur*signe,300);
	api.scrollToX($larg[indexImg],300);
	
	return false;
}


/**************************
*** MASQUAGE DU LOADING ***
**************************/
function loadingReady(){
	$("#loading").animate({
		'opacity':0
	},'slow',function(){
		$(this).css('display','none');
	});
}

/**************************
** NETTOYAGE DES SCROLLS **
**************************/
function clearScroll(){
	$('.texte').removeClass('scroll-pane');
	var element = $('.scroll-pane').jScrollPane({});
	var api = element.data('jsp');
	api.destroy();
}

/**************************
* MISE A JOUR DES TAILLES *
* DES BLOCS + IMAGES ******
**************************/
function updateBlocSize(){
	
	var playerHauteur = $('#player').height();
	var unite = Math.floor(playerHauteur/3-10);
	var uniteMargin = unite+10;
	var mosaicW = 0;
		
	$('.mosaic').height(playerHauteur);
		
	if(unite>70){
		$('.box1x1').height(unite);
		$('.box1x2').height(unite*2+10);
		$('.box2x2').height(unite*2+10);
		$('.box2x3').height(unite*3+20);
	}else{
		$('.box1x1').height(unite*3+20);
		$('.box1x2').height(unite*3+20);
		$('.box2x2').height(unite*3+20);
		$('.box2x3').height(unite*3+20);
	}
	
	
	$('.mosaic-img img').each(function(){
		//var ratio = $(this).attr('width')/$(this).attr('height');
		var ratio = $(this).attr('ratio');
		
		$(this).height(playerHauteur-10);
		$(this).width((playerHauteur-10)*ratio);
		
		mosaicW += $(this).outerWidth(true);
	});
	
	
	$('.mosaic-img iframe').each(function(){
		var ratio = $(this).attr('width')/$(this).attr('height');
		
		$(this).height(playerHauteur-10);
		$(this).width((playerHauteur-10)*ratio);
		
		mosaicW += $(this).outerWidth(true);
	});
	
	if(unite<140){
		if(unite*2+10 < 140 && playerHauteur >230){
			$(".news").height(unite*3+20);
		}else if(playerHauteur >230){
			$(".news").height(unite*2+10);
		}
	}
	
	$('.slides_container').height($(".news").height()-40);
	$('.slide').height($(".news").height()-40);
	
	loadingReady();
	
	return uniteMargin;
}