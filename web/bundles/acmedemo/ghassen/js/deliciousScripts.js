/*!
 *  DELICIOUS
 *  HTML One-Page Template
 *  Author: MUUteam / Lukasz Florczak
 *  http://muuteam.com
 */

//var originalState = $("#slides").clone();

$(document).ready(function(){ 

	changePositions();

	/* Create a local hrefs table for FullPage anchors */
	var hrefs = [];

	$('nav').find('a[href]').each(function() {
		if ($(this).attr("href").match("^#")) {
			href = $(this).attr("href").replace('#', '');
        	hrefs.push(href);
        }
    })

	/* Full Page */
	$('#fullpage').fullpage({
		anchors: hrefs,
		fixedElements: '.navbar-fixed-top',
		paddingTop: '50px',
		resize: false,
		scrollOverflow: true,

		afterSlideLoad: function() {
			setTimeout(function() {
				$('#finger').hide();
			}, 3200);
		}

	});

	/* Disable some effects on mobile devices */
	if (isMobile.any) {
		$('#send').removeClass('hover');
		$('#finger').show();
		$('.fp-controlArrow').css('display', 'none');

		if (isMobile.phone) {
			$("#send").appendTo("#mobile-send");
		}
	} else {
		/* Photoset Grid & ColorBox */
		$('.gallery-grid').photosetGrid({
			gutter: '20px',
			highresLinks: true,
			rel: 'withhearts-gallery',

			onComplete: function(){
			    $('.gallery-grid').attr('style', '');
			    $('.gallery-grid a').colorbox({
			    	photo: true,
			    	scalePhotos: true,
			    	maxHeight:'90%',
			    	maxWidth:'90%'
			    });
			}
		});
	}
});


$(window).resize(function() {
    changePositions();
});


function changePositions() {
	if ($(window).width() < 992) {
    	$("ul.ingredients.left-side").parent().each(function() {
		    var item = $(this);
		    item.insertAfter(item.next());
		});

		$("ul.ingredients.left-side>li>p").each(function() {
		    var item = $(this);
		    item.insertAfter(item.next('img'));
		});
    } else {
    	$("ul.ingredients.left-side").parent().each(function() {
		    var item = $(this);
		    item.insertBefore(item.prev());
		});

		$("ul.ingredients.left-side>li>p").each(function() {
		    var item = $(this);
		    item.insertBefore(item.prev('img'));
		});
   	}
}
