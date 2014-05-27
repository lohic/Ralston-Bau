$(document).ready(function(){
	
	$('.mosaic-item div.box').each(function(){
		if($(this).find('a').attr('href')){
			$(this).css('cursor','pointer');
		}
	});
	
	$('.mosaic-item div.box').click(function(){
	
		if($(this).find('a').attr('href')){
			//window.location = $(this).find('a').attr('href');
			
			$("#ajax").load($(this).find('a').attr('href')+' #ajax', function(){
				////
				//$(this).css('display','auto').css('opacity',100);
				updateAll();
				////
			});
		}
	});
	
	/* à vérifier */
	$('.mosaic-item div.box a').bind('click',
		function(){
			$("#ajax").load($(this).attr('href')+' #ajax');
		}
	);	
	
	/* DECLARATION jScrollPane */
	$(function() {
		$('.scroll-pane').each(function() {
				$(this).bind(
					'jsp-initialised',
					function(event, isScrollable)
					{
						$(function() {
							$('.jspContainer').dragscrollable({dragSelector:'.mosaic'});
						});
					}
				).jScrollPane();
				
				var api = $(this).data('jsp');
				var throttleTimeout;
						
				$(window).bind(
					'resize',
					function()
					{
						
						if ($.browser.msie) {
							// FOR EXPLORER
							if (!throttleTimeout) {
								throttleTimeout = setTimeout(
									function()
									{
										updateHeight();
										api.reinitialise();
										throttleTimeout = null;
									},
									50
								);
							}
						} else {
							updateHeight();
							api.reinitialise();
						}
					}
				);
		})
	});
	/*
	$(".jspPane").draggable({
		axis: 'x',
		//containment : '.jspContainer',
		start: function() {
			var element = $('.scroll-pane').jScrollPane({});
			var api = element.data('jsp');
			api.destroy();
		},
		stop: function() {
			$(function() {
				$('.scroll-pane').each(function() {
					$(this).bind(
						'jsp-initialised',
						function(event, isScrollable)
						{
						}
					).jScrollPane();
				})
			});
		}
			
		//containment: ".jspContainer",
	});*/
	
	/* FIN DE jScrollPane */
	
	var indexImg = 0;
	var signe = 1;
	
	$('body').keydown(function(event) {
		
		
		
		if(event.which == 37){
			//alert('gauche');
			signe = -1;
			keyscroll(indexImg);
			
			indexImg --;
			if(indexImg<0){
				indexImg = 0;	
			}
	
		}else if(event.which == 39){
			//alert('droite');
			signe = 1;
			
			keyscroll(indexImg);
			
			indexImg ++;
		}
	});
	
	
	
	function keyscroll(index){
		var pane = $('.scroll-pane');
		var api = pane.data('jsp');
		
		var largeur = $('#player .mosaic-item').eq(indexImg).outerWidth(true);
		//largeur = 0;
				
		api.scrollBy(largeur*signe,0);
	}
	
	$(function(){
		$("#slides").slides({
			//generateNextPrev: true,
			play: 10000
		});
	});

	updateHeight();
});

$(window).load(function(){
	/*$(function() {
		$('.scroll-pane').each(function() {
				$(this).bind(
					'jsp-initialised',
					function(event, isScrollable)
					{
						$(function() {
							$('.jspContainer').dragscrollable({dragSelector:'.mosaic'});
						});
					}
				).jScrollPane({
						//showArrows: $(this).is('.arrow')
						//animateScroll: true
				});
				var api = $(this).data('jsp');
				var throttleTimeout;
						
				$(window).bind(
					'resize',
					function()
					{
						
						if ($.browser.msie) {
							// IE fires multiple resize events while you are dragging the browser window which
							// causes it to crash if you try to update the scrollpane on every one. So we need
							// to throttle it to fire a maximum of once every 50 milliseconds...
							if (!throttleTimeout) {
								throttleTimeout = setTimeout(
									function()
									{
										updateHeight();
										api.reinitialise();
										throttleTimeout = null;
									},
									50
								);
							}
						} else {
							updateHeight();
							api.reinitialise();
						}
					}
				);
		})
	});*/
	
	//updateHeight();
	updateAll();
	
	$("#loading").animate({
		'opacity':0
	},'slow',function(){
		$(this).css('display','none');
	});
});

function updateHeight(){
	
	if($(window).width()<=768){
		$('.texte').removeClass('scroll-pane');
		var element = $('.texte').jScrollPane({});
		var api = element.data('jsp');
		api.destroy();
	}else{
		$('.texte').addClass('scroll-pane');
		//updateAll();
	}
	
		
	$('.mosaic').height($('#player').height());
	
	var unite = Math.floor(($('#player').height())/3-10);
	var uniteMargin = unite+10;
	
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
	
	var mosaicW = 0;
	var mosaicH = $('#player').height();
	
	$('.mosaic-img img').each(function(){
		var ratio = $(this).attr('width')/$(this).attr('height');
		
		$(this).height($('#player').height()-10);
		$(this).width($(this).height()*ratio);
		
		mosaicW += $(this).outerWidth(true);
	});
	
	//215
	if(unite<140){
		if(unite*2+10 < 140 && $('#player').height() >230){
			$(".news").height(unite*3+20);
		}else if($('#player').height() >230){
			$(".news").height(unite*2+10);
		}
	}
	
	//$('.mosaic').width(mosaicW);
	//$('.mosaic').height(mosaicH);
		

	$('.mosaic').isotope({
		layoutMode: 'masonryHorizontal',
		masonryHorizontal: {
			rowHeight: uniteMargin
		}
	});
	
}

function updateAll(){
	updateHeight();
				
	$(function() {
		$('.scroll-pane').each(function() {
				$(this).bind(
					'jsp-initialised',
					function(event, isScrollable)
					{
						$(function() {
							$('.jspContainer').dragscrollable({dragSelector:'.mosaic'});
						});
					}
				).jScrollPane({
						//showArrows: $(this).is('.arrow')
						//animateScroll: true
				});
				var api = $(this).data('jsp');
				var throttleTimeout;
						
				$(window).bind(
					'resize',
					function()
					{
						
						if ($.browser.msie) {
							// IE fires multiple resize events while you are dragging the browser window which
							// causes it to crash if you try to update the scrollpane on every one. So we need
							// to throttle it to fire a maximum of once every 50 milliseconds...
							if (!throttleTimeout) {
								throttleTimeout = setTimeout(
									function()
									{
										updateHeight();
										api.reinitialise();
										throttleTimeout = null;
									},
									50
								);
							}
						} else {
							updateHeight();
							api.reinitialise();
						}
					}
				);
		})
	});
	
	
	updateHeight();
}
