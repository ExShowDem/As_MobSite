function setup_slider(parent_id) 
{
	var swiper = new Swiper(parent_id + ' .swiper-container', {
		slidesPerView: 3,
		spaceBetween: 20,
		slidesPerGroup: 1,
		loop: true,
		on: {
			imagesReady: function () {
				$('.swiper-container.perspective .swiper-slide .slide-content').each(function() {
					if (parent_id == '#event_type_8_pane' || parent_id == '#event_type_9_pane')
					{
						$(this).outerHeight($(this).outerWidth() * 3 / 2);
					}
					else
					{
						$(this).outerHeight($(this).outerWidth() * 2 / 3);
					}
				});


				var orig_height = $(parent_id + " .swiper-slide.swiper-slide-active").height();
				var enlarged_height = orig_height * 2.5; // Must be same as CSS's scale - .swiper-slide-next .slide-content : scale(2.5)
				$(parent_id + " .swiper-container").height(enlarged_height);
				var diff = enlarged_height - orig_height;
				var vert_margin = diff / 2;

				$(parent_id + " .swiper-slide").each(function() {
					$(this).css('top', vert_margin+'px');
				});

				var new_nav_top = $(".swiper-container").offset().top + $(parent_id + " .swiper-container").height();
				$(parent_id + ' .swiper-pagination').css('top', new_nav_top+'px');

				$(parent_id + ' .swiper-slide').each(function() {	
					let slide_height    = $(this).find('.slide-content').outerHeight();
					let caption_height  = $(this).find('.caption').outerHeight();
					let new_caption_top = slide_height - caption_height;
					$(this).find('.caption').css('top', new_caption_top+'px');
				});
			},
			// slidePrevTransitionStart: function (s) {},
			// slideNextTransitionStart: function (s) {},
		},
		pagination: {
			el: parent_id + ' .swiper-pagination',
			clickable: true,
			type: 'bullets'
		},
	});

	if ($(parent_id + ' .swiper-pagination').length > 0)
	{
		$(parent_id + ' .swiper-pagination').ready(function() {
			var nav_width    = $(parent_id + ' .swiper-pagination').outerWidth();
			var swiper_left  = $(parent_id + ' .swiper-container').offset().left;
			var swiper_width = $(parent_id + ' .swiper-container').outerWidth();
			var nav_left     = swiper_left + (swiper_width/2) - (nav_width/2);
			$(parent_id + ' .swiper-pagination').css('left', nav_left+'px');
		});
	}

	return swiper;
}

function setup_moments_slider(parent_id)
{
	return new Swiper(parent_id + ' .swiper-container', {
		slidesPerView: 3,
		spaceBetween: 40,
		loop: true,
		on: {
			imagesReady: function () {
				$('.swiper-container.perspective .swiper-slide .slide-content').each(function () {
					if (parent_id == '#event_type_8_pane' || parent_id == '#event_type_9_pane') {
						$(this).outerHeight($(this).outerWidth() * 3 / 2);
					} else {
						$(this).outerHeight($(this).outerWidth() * 2 / 3);
					}
				});

				var orig_height = $(parent_id + " .swiper-slide.swiper-slide-active").height();
				var enlarged_height = orig_height * 2.5; // Must be same as CSS's scale - .swiper-slide-next .slide-content : scale(2.5)
				$(parent_id + " .swiper-container").height(enlarged_height);
				var diff = enlarged_height - orig_height;
				var vert_margin = diff / 2;

				$(parent_id + " .swiper-slide").each(function () {
					$(this).css('top', vert_margin + 'px');
				});

				var new_nav_top = $(".swiper-container").offset().top + $(parent_id + " .swiper-container").height();
				$(parent_id + ' .swiper-pagination').css('top', new_nav_top + 'px');

				$(parent_id + ' .swiper-slide').each(function () {
					let slide_height = $(this).find('.slide-content').outerHeight();
					let caption_height = $(this).find('.caption').outerHeight();
					let new_caption_top = slide_height - caption_height;
					$(this).find('.caption').css('top', new_caption_top + 'px');
				});
			},
		},
		pagination: {
			el: parent_id + ' .swiper-pagination',
			clickable: true,
			type: 'bullets'
		},
	});
}

// https://swiperjs.com/api/