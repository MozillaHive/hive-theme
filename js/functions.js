
$(function() {		
		
	// Remove width/height attr from all images for responsive
	$('#page-content img').each(function(){
        $(this).removeAttr('width')
        $(this).removeAttr('height');
    });	 
    
    $('.main-nav > ul > li:last-child').addClass('last');    	
	
	//***********************************************
	/* FLEXSLIDER */
	//***********************************************
	if($('#homepage-banner')){		
		$('#homepage-banner').flexslider({
			animation: 'fade',
			controlNav: true,
			directionNav: true,
			pausePlay:false,
			slideshowSpeed: 5000,
			touch:true,
			slideshow: true,
			animationSpeed: 500
		});		 
	}	
	
	//***********************************************
	/* MOBILE MENU */
	//***********************************************
	$('#mnav-toggle').click(function(){
		if(!$('.main-nav').hasClass('open')){
			$('.main-nav').slideDown(250, 'easeInOutQuad', function(){
				$(this).addClass('open');
				$('#mnav-toggle').addClass('open');
			});
		}else{
			$('.main-nav').slideUp(250, 'easeInOutQuad', function(){				
				$(this).removeClass('open');
				$('#mnav-toggle').removeClass('open');
			});
		}
	});	
	
	$('.main-nav > ul > li:has(> ul)').addClass('current-menu-ancestor');
	//***********************************************
	//Main Navigation drop menu
	//***********************************************
	if($.support.msie && $.browser.version=="6.0"){
		$('#mnav ul li').mouseenter(function(evt){
			$('ul', this).css('display', 'block');		
		});
		$('#mnav ul li').mouseleave(function(evt){			
			$('ul', this).css('display', 'none');	
		});	
	}
	//If not IE6 then...
	else{		
		function navOver(){
		   if($(window).width() > 767){
				$('ul', this).fadeIn(200);
		   }		
		}	
		function navOut(){
		    if($(window).width() > 767){
		    	$('ul', this).fadeOut(200);
		    }
		}
		var megaConfig = {interval: 150, sensitivity: 4, over: navOver, timeout: 150, out: navOut};	
		$(".main-nav > ul > li").hoverIntent(megaConfig);	
	} 
	
	
	//***********************************************
	//Load More - Ajax Infinite Scroll
	//***********************************************
	if($("#ajax-load-more").length){
		var page = 1,
	        $loading = true,
	        $finished = false,
	        $window = $(window),
	        $el = $('#ajax-load-more'),
	        $content = $('#ajax-load-more ul'),	        
	        $path =  $content.attr('data-path');
	        
	        if($path === undefined){
		        $path = '/wp-content/themes/hive/ajax-load-more.php';
	        }
	        //Define button text
    	    if($content.attr('data-button-text') === undefined){
                $button = 'Load More';
            }else{
	            $button = $content.attr('data-button-text');
            }
	        $el.append('<p id="load-more" class="more"><span class="loader"></span><span class="text">'+$button+'</span></p>');
	        
	    //Load posts function
	    var load_posts = function(){	             
            $('#load-more').addClass('loading');
			$('#load-more span.text').text("Loading...");
            $.ajax({
                type    : "GET",
                data    : {                	
                	postType   : $content.attr('data-post-type'),
                	category   : $content.attr('data-category'),
                	author     : $content.attr('data-author'),
                	taxonomy   : $content.attr('data-taxonomy'),
                	tag        : $content.attr('data-tag'),
                	postNotIn  : $content.attr('data-post-not-in'),
                	numPosts   : $content.attr('data-display-posts'),
                	pageNumber : page,
                },
                dataType   : "html",
                url        : $path+"/ajax-load-more.php",
                beforeSend : function(){
                    if(page != 1){
                        $('#load-more').addClass('loading');
						$('#load-more span.text').text("Loading...");
                    }
                },
                success    : function(data){
                    $data = $('<span>'+data+'</span>');// Convert data to an object            
                    if(data.length > 1){
                        $data.hide();
                        $content.append($data);  
                        $data.fadeIn(500, function(){
	                       $('#load-more').removeClass('loading');
						   $('#load-more span.text').text($button);
	                       $loading = false;
                       });
                    } else {
                         $('#load-more').removeClass('loading').addClass('done');
                         $('#load-more span.text').text($button);
                         $loading = false;
                         $finished = true;
                    }
                },
                error     : function(jqXHR, textStatus, errorThrown) {
                    $('#load-more').removeClass('loading');
                    $('#load-more span.text').text($button);
                    //alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
	        });
	    }
	    $('#load-more').click(function(){
		    if(!$loading && !$finished && !$(this).hasClass('done')) {
	            $loading = true;
	            page++;
	            load_posts();
	        }	    
	    });
	    
	   	$window.scroll(function() {
			var content_offset = $('#load-more').offset();
			if(!$loading && !$finished && $window.scrollTop() >= Math.round(content_offset.top - ($window.height() - 50)) && page < 5) {
				$loading = true;
				page++;
				load_posts();
			}
		});	    
	    load_posts();
    }
    
    //***********************************************
    // Events Widget
    //***********************************************
    if($('.widget.events').length){
	    $('.widget.events .inner').append('<p class="more"><a target="_blank" href="https://www.google.com/calendar/embed?src=hivelearningnyc%40gmail.com&amp;ctz=America/New_York"><i class="icon-arrow-right"></i> See our full calendar</a></p>');
    }
    
    
    //***********************************************
    //Searchform.php
    //***********************************************
    $('#searchsubmit', $(this)).click(function(){
		if($('#s').val() == ''){
			return false;
		}else{
			$('#searchform').submit();
		}			
	});
    
    //***********************************************
    //Placeholder inut type form replacement
    //***********************************************     
    if(!Modernizr.input.placeholder){	       
	    $('#searchform #s').val('Search');
		$("#searchform #s").focus(function(){
			if(this.value=='Search'){
				this.value='';
			}
		});
		$("#searchform #s").blur(function(){
			if(this.value==''){this.value='Search'}
		});
      }
    
	
	$('span.comment a').click(function(e){
		e.preventDefault();
		var $anchor = $(this).attr('href');
		var target_offset = $("#comments").offset();
        var target_top = target_offset.top;
		$('html, body').animate({scrollTop:target_top}, 1000, 'easeInOutQuad');
	})
		
});

$(window).load(function(){

		if($('#portfolio-tax-terms').length){
		var $selector = '*';
		$('#portfolio-tax-terms li a').click(function(){
			if(!$(this).parent().hasClass('active')){
				$('#portfolio-tax-terms li').removeClass('active');
				$(this).parent().addClass('active');
				$selector = $(this).attr('data-filter');
				setPortfolioList($selector);	
				return false;
			}
			else{
				$selector = '*';	
				setPortfolioList($selector);			
				$('#portfolio-tax-terms li').removeClass('active');
				$('#portfolio-tax-terms li.all').addClass('active');
				$('#portfolio-list li').removeClass('disabled');
				return false;
			}	
				
		});	
		
		function setPortfolioList($selector){
			if (typeof window.history.pushState == 'function') {
				var $url = '#/'+$selector
				history.replaceState('', document.title, $url);
			}	
			if($selector === '*'){
				$('#portfolio-tax-terms li').removeClass('active');
				$('#portfolio-tax-terms li.all').addClass('active');
				$('#portfolio-list li').removeClass('disabled');
			
			}else{
				$('#portfolio-list li').each(function(){
					if(!$(this).hasClass($selector)){
						$(this).addClass('disabled');
					}else{
						$(this).removeClass('disabled');
					}
				});			
			}
		}
		$('#portfolio-list li a').click(function(){
			if($(this).parent('li').hasClass('disabled')){
				return false;
			}
		});
		//PARSE URL ON RELOAD
		function checkAndParseURL() {
	   		var url = window.location.hash.slice(2).replace('/', '');	
	   		console.log(url);	   		
			if(url === '' || url === '*'){
				$selector = '*';	
				setPortfolioList($selector);
			}	
			else{
				$('#portfolio-tax-terms li').each(function(){
					$theLink = $(this).attr('data-type');	
					if($theLink == url){	
						$(this).addClass('active');
						setPortfolioList($theLink);
						return false;				
					}
					
				});
			}
		}	
		checkAndParseURL();
	}


	
});

