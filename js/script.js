$(document).ready(function(){
	
	
	/*$(".mosaic-img img").each(function(){
		var larg = $(this).attr("width");
		var haut = $(this).attr("height");
		if(haut%220 != 0){
			haut = haut - haut%220;	
		}
		
		if(larg%220 != 0){
			larg = larg - larg%220;	
		}
				
		$("this").parent().css("overflow","hidden");
		
		$("this").parent().width(larg);
		$("this").parent().height(haut);
	});*/
	
	
	$('.mosaic').isotope({
		layoutMode: 'masonryHorizontal',
		masonryHorizontal: {
			rowHeight: 225
			,columnWidth: 225
			//,maxRows: 3
		}
	});
	
	
	
	/*$('.mosaic-item').click(function(){
		//alert("yo");
		if($(this).find('a').attr('href')){
			window.location = $(this).find('a').attr('href');
		}
	});*/
	/*
	$(function()
	{
		$('.scroll-pane').jScrollPane();
	});

	*/	
	
	
	/* DECLARATION jScrollPane */
	$(function()
	{
		$('.scroll-pane').each(
			function()
			{
				$(this).jScrollPane(
					{
						//showArrows: $(this).is('.arrow')
						animateScroll: true
					}
				);
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
										api.reinitialise();
										throttleTimeout = null;
									},
									50
								);
							}
						} else {
							api.reinitialise();
						}
					}
				);
			}
		)
	
	});
	
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
});



