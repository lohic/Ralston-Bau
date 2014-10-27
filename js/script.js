/**********************************
@ WP TRANSPLANT THEME SCRIPTS	  @
@ URL : http://www.transplant.nu  @
@ Author : Loïc Horellou		  @
**********************************/
var theTimer;

$ = jQuery.noConflict();

/**
 * ===================================================
 * ===================================================
 *                  RALSTON & BAU
 *              **** JAVASCRIPT ****
 * ===================================================
 * ===================================================
 *
 * author : Loïc Horellou
 * http://www.loichorellou.net
 * 
 * ===================================================
 */

/**
 * refs :
 * - http://stackoverflow.com/questions/1771627/preventing-click-event-with-jquery-drag-and-drop
 */



var hauteur = 0;

$(function(){

	/**
	 * detection des liens internes
	 */
	$.expr[':'].internal = function (obj, index, meta, stack) {
	    // Prepare
	    var
	    $this = $(obj),
	    url = $this.attr('href') || '',
	    isInternalLink;
	    // Check link
	    isInternalLink = /*url.substring(0, rootUrl.length) === rootUrl ||*/ url.indexOf(':') === -1 || obj.hostname == location.hostname;
	    // Ignore or Keep
	    return isInternalLink;
	};


	/**
	 * analyse d'une URL
	 * @return {[type]} [description]
	 */
	var parseUrl = (function () {
		var a = document.createElement('a');
		return function (url) {
			a.href = url;
			return {
				host: a.host,
				hostname: a.hostname,
				pathname: a.pathname,
				port: a.port,
				protocol: a.protocol,
				search: a.search,
				hash: a.hash
			};
		}
	})();



    /**
	 * ACTIVATION DE history.js
	 * @param  {[type]} window    [description]
	 * @param  {[type]} undefined [description]
	 * @return {[type]}           [description]
	 */
	(function(window,undefined){

		var State = History.getState();
		var rootURL = $('meta[name=identifier-url]').attr('content');
		
		if ( !History.enabled ) {
			//console.log( 'History.js is disabled for this browser.');
			return false;
		}else{
			//console.log('History.js is OK.');
		}

		//History.log('initial:', State.data, State.title, State.url);
			
		// console.log('meta : identifier-url');
		// console.log(parseUrl(rootURL));
		// console.log('history : getState');
		// console.log(parseUrl(State.url));

		// on ajoute une classe active si un lien correspond à l'URL de la page
		$('a.internal').each(function(){
			if($(this).attr('href') == State.url){
				$(this).addClass('active');
				// current-menu-item (menu)
			}
		});


		if(parseUrl(rootURL).pathname != parseUrl(State.url).pathname){

		
		}


		// Bind to StateChange Event
		History.Adapter.bind(window,'statechange',function(){
			var State = History.getState();

			//console.log('--------------------------');
			//console.log('State : ');
			//console.log(State);

			History.log('click:',State.data, State.title, State.url);

			console.log(State.data.isSlide);

			$isSlide = State.data.isSlide;

			$.ajax({
				url : State.url,
				success : function( data ) {
					//console.log( "Data : " + data );
					var retour = $( data );

					title =  retour.find('#menu h1').data('title') ;
					$(document).attr("title", title);

					if( $isSlide === false ){
						if($('#galerie').length > 0){		$('#galerie').jScrollPane().data().jsp.destroy(); }
		                if($('#project-info').length > 0){	$('#project-info').jScrollPane().data().jsp.destroy(); }
		                if($('#project-nav').length > 0){	$('#project-nav').jScrollPane().data().jsp.destroy(); }
		                if($('#category-info').length > 0){	$('#category-info').jScrollPane().data().jsp.destroy(); }

		                $('#contenu').empty();
						$('#galerie').empty();

						$('#contenu').html( retour.find( '#contenu' ).html() );
						$('#galerie').html( retour.find( '#galerie' ).html() );
					}
					
	                
	                if($('#post>.content').length > 0){	$('#post>.content').jScrollPane().data().jsp.destroy(); }

					
					$('#post_container').empty();
					//$('#wpadminbar').empty();

					//console.log( retour.find( '#contenu' ).html() );
					//console.log( retour.find( '#galerie' ).html() );

					
					$('#post_container').html( retour.find( '#post_container' ).html() );
					//$('#wpadminbar').html( retour.find( '#wpadminbar' ).html() );

					// https://bitbucket.org/tehrengruber/jquery.dom.path/src
			    	select = retour.find('.current-menu-item').attr('id') ;
					$('.current-menu-item').removeClass('current-menu-item');
					$("#"+select).addClass('current-menu-item');

					updateContent();
				}
			});

		});

	})(window);

	updateContent();

	$('#mobile-menu').click(function(event){
        $('#menu-main-menu').slideToggle();
    })


	function updateContent(){

       /**
        * MUTE VIMEO PLAYER
        */
       	if($('iframe').length > 0){ 
	        $('iframe').unbind('mouseover mouseout');
	    
			$(function () {
				var iframe = $('iframe')[0];
				var player = $f(iframe);
				var status = $('.status');

				// When the player is ready mute, unmute on rollover 
				player.addEvent('ready', function () {
					console.log('vimeo ready');
					player.api('setVolume', 0);
				});

				$('iframe').bind('mouseover' ,function(){
					player.api('setVolume', 1);
				});

				$('iframe').bind('mouseout' ,function(){
					player.api('setVolume', 0); 
				}); 
			});
		}

		/*$('#galerie #horizontal img').load(function(){
			if($('#galerie').length > 0){ 		$('#galerie').jScrollPane().data().jsp.destroy(); }

			$("#galerie #horizontal .image").height( $(window).height() - hauteur - 10 );

            $('#galerie').bind(
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
							$('#galerie').data('jsp').scrollToX(initX+delta);
						}
						//window.status = e.pageX+' '+leftScroll+' '+ endScroll+' '+mX +' '+delta;
						window.status = delta;
					})   
					    
					$('#galerie').mousedown(function(e){
						initX = $('#galerie').data('jsp').getContentPositionX();
						startX = e.pageX;
						startXX = $('#galerie .jspPane').offset().left;
						selection = true ;
						e.preventDefault();
					})
					$(window).mouseup(function(){
						selection = false ;
					})
				}
			).jScrollPane();
		})*/


		/**
		 * HIDE ALERT ON CLICK
		 */
		$('#alert').click(function(event){
			$(this).hide();
		})
		

		// on ajoute une classe internal sur les liens qui pointent sur le site
		$('a:internal').addClass('internal');
	    $('#wpadminbar a').removeClass('internal');    


	    $("a.internal").click(function(event){
	    	
	    	var isSlide = false;
	    	if( $(this).parent().parent().hasClass('slide') ||  $(this).parent().hasClass('close')){
	    		console.log('slide');
	    		isSlide = true;
	    	}

	    	$("#loading").show();

	    	History.pushState(
				{
					'isSlide' : isSlide,
					'title' : $(this).attr('title'),
					'url'   : $(this).attr('href')
				},
				null, //"Ralston & Bau » " + $(this).attr('title'),
				$(this).attr('href')
			);

			event.preventDefault();
	    });

	    $(".video").each(function(){
	        $(this).data('ratio', $(this).find('iframe').attr('width')/$(this).find('iframe').attr('height') );
	        console.log('ratio : '+ $(this).data('ratio'));
	    });


	    $('.slide').click(function(event){
	    	$(this).find('a').trigger('click');
	    });
	   

	    //$(".video").fitVids();

	    var apis = [];

	    var wall = new freewall("#wall");
	    wall.reset({
	        selector: '.item',
	        //cellW: 200,
	        //cellH: 160,
	        cellW : function(width) {
	            var cellWidth = ( $(window).width() - 70) / 4;
	            return cellWidth;
	        },
	        cellH : function(height) {
	            var stageW = $(window).width();
	            hauteur = 255 + 40 +10;
	            /*if(stageW >=  1600){
	                hauteur = 10 + 40;
	            }*/

	            var cellHeight = ( $(window).height() - hauteur) / 3;
	            return cellHeight;
	        },
	        gutterX: 10,
	        gutterY:10,
	        onResize: function() {

	            var stageW = $(window).width();

	            if(stageW >=  700){

	            	if($('#galerie').length > 0){ 		$('#galerie').jScrollPane().data().jsp.destroy(); }
	                if($('#project-info').length > 0){	$('#project-info').jScrollPane().data().jsp.destroy(); }
	                if($('#project-nav').length > 0){	$('#project-nav').jScrollPane().data().jsp.destroy(); }
	                if($('#category-info').length > 0){ $('#category-info').jScrollPane().data().jsp.destroy(); }
	                if($('#post>.content').length > 0){ $('#post>.content').jScrollPane().data().jsp.destroy(); }

	                hauteur = 255 + 40 + 20;
	                /*if(stageW >=  1600){
	                    hauteur = 10 + 40;
	                }*/
	                
	                wall.fitHeight($(window).height() - hauteur);

	                $("#galerie #horizontal .image").height( $(window).height() - hauteur - 10 );

	                $('#galerie').bind(
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
									$('#galerie').data('jsp').scrollToX(initX+delta);
								}
								//window.status = e.pageX+' '+leftScroll+' '+ endScroll+' '+mX +' '+delta;
								window.status = delta;
							})   
							    
							$('#galerie').mousedown(function(e){
								initX = $('#galerie').data('jsp').getContentPositionX();
								startX = e.pageX;
								startXX = $('#galerie .jspPane').offset().left;
								selection = true ;
								e.preventDefault();
							})
							$(window).mouseup(function(){
								selection = false ;
							})
						}
					).jScrollPane();
	
					if($('#contenu #project-nav').length > 0){ 
						
						$('#contenu #project-info').css('width','calc(100% - 170px)');

					}

	                $('#project-info').jScrollPane();
	                $('#project-nav').jScrollPane();
	                $('#category-info').jScrollPane();
	                $('#post>.content').jScrollPane();
	                $('#menu-main-menu').show();

	                $('.bxslider').bxSlider({
						speed: 150,
						mode: 'horizontal',
						infiniteLoop: false,
						pager: false,
						pagerType: 'short',
						pagerLocation: 'bottom',
						pagerShortSeparator: ' sur ',
						startSlide: 0,
						adaptiveHeight: true,
					});

	              	/*$('.slide').width( $("#slides").width()-40);
	                $('.slide').height( $("#slides").height()-100 );*/

	            }else{

	                $("#galerie #horizontal .image").height( 'auto' );

					$('#contenu #project-info').css('width','auto');
					
	                
	                //wall.fitWidth();
	                //wall.refresh();
	                wall.destroy();
	                if($('#galerie').length > 0){ 		$('#galerie').jScrollPane().data().jsp.destroy(); }
	                if($('#project-info').length > 0){	$('#project-info').jScrollPane().data().jsp.destroy(); }
	                if($('#project-nav').length > 0){	$('#project-nav').jScrollPane().data().jsp.destroy(); }
	                if($('#category-info').length > 0){ $('#category-info').jScrollPane().data().jsp.destroy(); }
	                if($('#post>.content').length > 0){ $('#post>.content').jScrollPane().data().jsp.destroy(); }
	                $('#menu-main-menu').hide();
	            }

	            $(".video").each(function(){
	                $(this).find('iframe').width($(this).width());
	                $(this).find('iframe').height($(this).height());
	            });

	            $("#loading").hide();
	            
	        }
	    });


	    /**
	     * Pour empecher le click quand on drag scroll
	     * @type {Boolean}
	     */
	    var move=false;

	    var $body = $('#galerie');
	    //$body.unbind('mousedown mouseup mousemove click')
	    $body.on('mousedown', function (event) {
	        $body.on('mouseup mousemove click', function handler(event) {
	            if (event.type === 'mouseup' || event.type === 'click') {
	                // click
	                if(move === true){
	                    move = false;
	                    event.preventDefault();
	                    return false;
	                }
	                move = false;
	            } else {
	                // drag
	                move = true;
	            }
	            $body.off('click mouseup mousemove', handler);
	        });
	    });

	    /**
	     * KEY SCROLL
	     * @param  {[type]} event [description]
	     * @return {[type]}       [description]
	     */
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

	    // caculator height for IE7;
	    //wall.fitHeight($(window).height() - 170);
	    //wall.fitHeight($(window).height());
	    $(window).trigger("resize");

	    (function() {
	        var beforePrint = function() {
	            console.log('Functionality to run before printing.');

	            wall.destroy();
	            $('#galerie').jScrollPane().data().jsp.destroy();
	            if($('#project-info').length){
	                $('#project-info').jScrollPane().data().jsp.destroy();
	            }
	            if($('#post>.content').length > 0){
	            	$('#post>.content').jScrollPane().data().jsp.destroy();
	            }
	            $('#category-info').jScrollPane().data().jsp.destroy();
	        };
	        var afterPrint = function() {
	            console.log('Functionality to run after printing');


	            $(window).trigger("resize");
	        };

	        if (window.matchMedia) {
	            var mediaQueryList = window.matchMedia('print');
	            mediaQueryList.addListener(function(mql) {
	                if (mql.matches) {
	                    beforePrint();
	                } else {
	                    afterPrint();
	                }
	            });
	        }

	        window.onbeforeprint = beforePrint;
	        window.onafterprint = afterPrint;
	    }());


	    /*(function() {
	        var upgradeImage = function() {
	          
	        };

	        if (window.matchMedia) {
	            var mediaQueryList = window.matchMedia('print');
	            mediaQueryList.addListener(upgradeImage);
	        }

	        window.onbeforeprint = upgradeImage;
	    });*/

	    function keyscroll(sens){
	        console.log('keyscroll '+sens);

	        var pane = $('#galerie');
	        var api = pane.data('jsp');
	        var xx = api.getContentPositionX() + pane.width()/4;
	        
	        var increment = 0;
	        var oldXpos = -1;
	        
	        $larg = new Array();
	        $larg.push(0);
	        

	        $('.image').each(function(){
	            if(oldXpos != $(this).offset().left ){
	                $larg.push( $(this).outerWidth(true) + increment );
	                //console.log($(this).outerWidth(true)+increment);
	                increment += $(this).outerWidth(true);
	                
	                oldXpos = $(this).offset().left;
	                //console.log(oldXpos);
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
	        
	        //console.log(indexImg+" "+$larg[indexImg]);
	        
	        api.scrollToX( $larg[indexImg], 300);
	        
	        return false;
	    }

	    //$("#loading").hide();
	}


    
});