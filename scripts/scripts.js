(function($) {
    $(document).ready(function() {

		let vh = window.innerHeight * 0.01;
		document.documentElement.style.setProperty('--vh', `${vh}px`);

    	var more_top = $("div.row.tab-content").height() - $("li#more_dropdown ul.dropdown-menu").height();
    	$("li#more_dropdown ul.dropdown-menu").css("top", more_top+"px");

		$("#more_dropdown").on('click', function() {
			$("ul#bottom_nav > li").each(function() {
				$(this).removeClass('active');
			});
		});

    	// Home Slider
    	var home_slider = setup_slider('#home_pane');

		$('#bottom_nav.nav-tabs a#home').on('shown.bs.tab', function(e) {
			home_slider.destroy();
			home_slider = setup_slider('#home_pane');
			home_slider.slideToLoop(0);
		});

		if ($('#home_pane').length)
		{
			show_tab(document.location.toString());

			window.addEventListener("hashchange", function (e) {
				show_tab(e.newURL);
			});

			$('.nav-tabs a').on('shown.bs.tab', function (e) {
			    window.location.hash = e.target.hash;
			});
		}

    	// About accordion
    	var headingHeight = $("#about .panel-heading").outerHeight();
    	var headingPad    = $("#about .panel-heading").css('padding-top');
    	var neededOffset  = ( headingHeight + parseFloat(headingPad) ) * -1;
    	// About accordion - positioning backfillers
    	$("#about .panel-heading .back-filler").outerHeight(headingHeight);
    	$("#about .panel-heading .back-filler").css('margin-top', neededOffset + 'px');
    	// About accordion - put active to first
		$("#about .collapse").on('show.bs.collapse', function(e) {
			var curr = $(e.target).closest('.panel');
			curr.parent().prepend(curr);
		});

		if ($("#about .collapse").length > 0)
		{
			$('h3#title').text($("#about .panel-collapse.collapse.in").closest('.panel').find('.panel-title a').text());
		}

		// About accordion - adjust back filler display
		adjustBackFillerDisplay();

		var moments_slider;

		$("#about .collapse").on('shown.bs.collapse', function(e) {
			// About accordion - sort
			$("#about .panel-collapse.collapse:not(.in)").sort(function (a, b) {
				return parseInt(a.id.replace("collapse", "")) - parseInt(b.id.replace("collapse", ""));
			}).each(function () {
				var elem = $(this).closest('.panel');
				elem.parent().append(elem);
			}); // @todo: Sorting here doesnt always work. Repro prob: keep clicking on history and moments alternately
			
			$('h3#title').text($("#about .panel-collapse.collapse.in").closest('.panel').find('.panel-title a').text());

			if ($("#about .panel-collapse.collapse.in").attr('id') === 'collapse1'
				|| $("#about .panel-collapse.collapse.in").attr('id') === 'collapse3'
				|| $("#about .panel-collapse.collapse.in").attr('id') === 'collapse5')
			{
				$('#title_back').show();
			}
			else
			{
				$('#title_back').hide();
			}

			// About accordion - adjust back filler display
			adjustBackFillerDisplay();

			// About - Transform
			if (e.target.id == 'collapse3')
			{
				$(".transf-item").each(function(e) {
					$(this).find('img').height( $(this).width() );
				});
			}
		
			// About Moments Slider
			if (e.target.id == 'collapse4')
			{
				if (moments_slider == undefined || moments_slider.destroyed)
				{
					moments_slider = setup_moments_slider('#moments');
					
					moments_slider.slideToLoop(0);
					$('#moments .page').text('1 / ' + memory_count);
					$('#moments .memory-content').html(memory_content[0]);
					$('#moments .memory-content').css('width', $('.swiper-slide-active').width() * 2.5);

					moments_slider.on('transitionEnd', function(s) {
						var i = s.realIndex + 1;
						$('#moments .page').text(i + ' / ' + memory_count);
						$('#moments .memory-content').html(memory_content[s.realIndex]);
					});

					moments_slider.on('click', function(s, e) {
						$('#modal_memory .modal-body img').attr('src', $(e.target).closest(".slide-content").find(".moment-img").attr('src'));
					});
				}
			}
			else
			{
				if (moments_slider != undefined && !moments_slider.destroyed)
				{
					moments_slider.destroy();
				}
			}
		});

		$("#about .panel-body").outerHeight($(document).height() - ($(".panel-heading").outerHeight() * 5) - 20 );
		
		$('.panel-heading a').on('click',function(e){
		    if($(this).parents('.panel').children('.panel-collapse').hasClass('in')){
		        e.stopPropagation();
		    }
		    // You can also add preventDefault to remove the anchor behavior that makes the page jump
		    // https://stackoverflow.com/questions/15725717/how-do-you-make-twitter-bootstrap-accordion-keep-one-group-open 
		    // e.preventDefault();
		});

		$("#about #awards #show_more").on('click', function(e) {
			$('.init-hide').show();
			$(e.target).hide();
		});

		// About - Modal - Intro and History
		$(".feat-img").on('click',function(e){
			$('#modal_about .modal-body img').attr('src', $(e.target).attr('src'));
		});

		// About - Transform - Modal
		$(".transf-item").on('click',function(e){
			var transf_id = $(e.target).closest('.transf-item').data('id');
			$("#modal_transf .modal-title").text(transf_arr[transf_id].sorting+' / '+Object.keys(transf_arr).length);
			$("#modal_transf .modal-body img").attr('src', transf_arr[transf_id].photo);
			$("#modal_transf .modal-footer h4").text(transf_arr[transf_id].age);
			$("#modal_transf .modal-footer #content").html(transf_arr[transf_id].content);
		});

		$("#modal_transf").outerHeight(window.innerHeight);

		// Event tab Sliders
		var event_slider;
		var offer_slider;

		/* event_type_8 is special events */
		/* event_type_9 is seasonal offers */
		/* @todo Maybe this can be less hard-coded */
		if ($("#home_page #events_pane .swiper-container").length > 0)
		{
			$('#bottom_nav.nav-tabs a#events').on('shown.bs.tab', function(e) {
				if (event_slider == undefined || event_slider.destroyed)
				{
					event_slider = setup_slider('#event_type_8_pane');
					offer_slider = setup_slider('#event_type_9_pane');
				}
				else
				{
					event_slider.destroy();
					event_slider = setup_slider('#event_type_8_pane');
					offer_slider.destroy();
					offer_slider = setup_slider('#event_type_9_pane');
				}

				event_slider.slideToLoop(0);
			});
			$('#events_nav.nav-tabs a#event_type_8').on('shown.bs.tab', function(e) {
				if (event_slider == undefined || event_slider.destroyed)
				{
					event_slider = setup_slider('#event_type_8_pane');
				}
				else
				{
					event_slider.destroy();
					event_slider = setup_slider('#event_type_8_pane');
				}
				
				event_slider.slideToLoop(0);
			});
			$('#events_nav.nav-tabs a#event_type_9').on('shown.bs.tab', function(e) {
				if (offer_slider == undefined || offer_slider.destroyed)
				{
					offer_slider = setup_slider('#event_type_9_pane');
				}
				else
				{
					offer_slider.destroy();
					offer_slider = setup_slider('#event_type_9_pane');
				}
				
				offer_slider.slideToLoop(0);
			});
		}

		// Pinch Zoom floor plan
		if ($("#floor_plan").length > 0)
		{
	        var el = document.querySelector('div.pinch-zoom');
	        new PinchZoom.default(el, {});
	        var top = ( $("#floor_plan #shop_here").data('posy') * $(window).width() ) - 20;
	        var left = ( $("#floor_plan #shop_here").data('posx') * $(window).width() ) - 10;

	        $("#floor_plan #shop_here").css('top', top+'px').css('left', left+'px');
		}

		// Booking wizard
		var bookingWizard = $('#booking_page .wizard').bootstrapWizard({
			'onTabShow': function (tab, navigation, index) 
			{
				if (index === 0)
				{
					$("#booking_page .wizard button.prev").css('display', 'none');

					$("#booking_page .wizard button.next").css('background-color', '#6A3D69');

					$("#booking_page .wizard button.next .icon i").removeClass('fa-check');
					$("#booking_page .wizard button.next .icon i").addClass('fa-arrow-right');

					$("#item_counter").text( $("#booking_page #tab1 input[type=checkbox]:checked").length );

					if ($("#item_counter").text() == 0)
					{
						$("#item_counter").hide();
					}
					else
					{
						$("#item_counter").show();
					}
				}
				else
				{
					$("#booking_page .wizard button.prev").css('display', 'inline-block');

					$("#booking_page .wizard button.next").css('background-color', '#6A3D69');

					$("#booking_page .wizard button.next .icon i").removeClass('fa-arrow-right');
					$("#booking_page .wizard button.next .icon i").addClass('fa-check');
				}
			}
		});
		$("#booking_page .wizard #tab1 input[type=checkbox]").change(function() {
			$("#item_counter").text( $("#booking_page #tab1 input[type=checkbox]:checked").length );

			if ($("#item_counter").text() == 0)
			{
				$("#item_counter").hide();
			}
			else
			{
				$("#item_counter").show();
			}
		});
		$('#booking_page .wizard button.prev').click(function(e) {
			e.preventDefault();
			bookingWizard.bootstrapWizard('previous');
			return false;
		});
		$('#booking_page .wizard button.next').click(function(e) {
			e.preventDefault();
			
			if (bookingWizard.bootstrapWizard('currentIndex') === 0)
			{
				if ($("#booking_page #tab1 input[type=checkbox]:checked").length > 0)
				{
					$('.err_msg #item').hide();
					bookingWizard.bootstrapWizard('next');
				}
				else
				{
					$('.err_msg #item').show();
				}
			}
			else if (bookingWizard.bootstrapWizard('currentIndex') === 1)
			{
				$('.err_msg p').each(function() {
					$(this).hide();
				});

				if (!$("#booking_page #tab2 input#full_name").val())
				{
					$('.err_msg #name').show();
				}
				else if (!$("#booking_page #tab2 input#phone").val()) 
				{
					$('.err_msg #phone').show();
				}
				else if (!$("#booking_page #tab2 input#email").val()) 
				{
					$('.err_msg #email').show();
				}
				else if (!$("#booking_page #tab2 #take_time").val()) 
				{
					$('.err_msg #time').show();
				}
				else if (!$("#booking_page #tab2 input:checkbox#is_agree").prop('checked'))
				{
					$('.err_msg #agree').show();
				}
				else
				{
		            $.ajax({
		                url: base_url + 'booking/submit.json',
		                type: 'post',
		                contentType: 'application/x-www-form-urlencoded',
		                data: $("form#booking_form").serialize(),
		                success: function( data, textStatus, jQxhr ) 
		                {
							var feedback = objToQueryParamsNested(data);
							window.location.href = `booked.php?${feedback}`;
		                },
		                error: function( jqXhr, textStatus, errorThrown )
		                {
		                }
		            });
				}
			}
			else
			{
				bookingWizard.bootstrapWizard('next');
			}
			
			return false;
		});

		// Booking - Selectable Tiles
		$("#booking_page #tab1 input:checkbox").click(function(e) {

			var source     = e.target.id;
			var haveDialog = ['hongkongmap', 'ipad', 'portablecharger', 'umbrella', 'babydiaper', 'breasttowel', 'wheelchair'];

			if (e.target.checked) 
			{
				if (haveDialog.indexOf(source) != -1)
				{
					e.preventDefault();
					$(".modalDialog").attr('data-id', source);

					var curr_img = $('input#'+source).closest('.panel').find('img').attr('src');
					$(".modalDialog .modal-header img").attr('src', curr_img);

					var curr_item = $('input#'+source).closest('.panel').find('h6').text();
					$(".modalDialog .modal-header h4").text(curr_item);

					$(".modalDialog").modal();
					$(".modal-backdrop").css('background-image', 'initial').css('opacity', 0.5);
				}
				else
				{
					$("#booking_page #tab1 input:checkbox#"+source).prop('checked', true);
					$("#booking_page #tab1 input:checkbox#"+source).closest(".panel").addClass('chosen');
				}
			}
			else
			{
				$("#booking_page #tab1 input:checkbox#"+source).closest(".panel").removeClass('chosen');
			}
		});
		// Modal - Booking - Selectable Tiles
		$("#confirm").click(function(e) {
			var dialog = $(e.target).closest(".modalDialog");
			var source = dialog.attr('data-id');

			if ($('.modal-content .custom-content#'+source+' .form-check').length > 0)
			{
				var value  = (dialog.find('input:checked').length > 0) ? dialog.find('input:checked').val() : '';
				
				$("#booking_page #tab1 input:checkbox#"+source).val(value);

				if (value)
				{
					$("#booking_page #tab1 input:checkbox#"+source).prop('checked', true);
					$("#booking_page #tab1 input:checkbox#"+source).closest(".panel").addClass('chosen');
				}
			}
			else
			{
				$("#booking_page #tab1 input:checkbox#"+source).prop('checked', true);
				$("#booking_page #tab1 input:checkbox#"+source).closest(".panel").addClass('chosen');
			}

			$("#item_counter").text( $("#booking_page #tab1 input[type=checkbox]:checked").length );

			if ($("#item_counter").text() == 0)
			{
				$("#item_counter").hide();
			}
			else
			{
				$("#item_counter").show();
			}

			$(".modalDialog").removeAttr('data-id');
		});
		$("#cancel").click(function(e) {
			var source = $(e.target).closest(".modalDialog").attr('data-id');
			$("#booking_page #tab1 input:checkbox#"+source).prop('checked', false);
			$(".modalDialog").removeAttr('data-id');
		});

		// Booking - radio to ticks
		$('.modalDialog .modal-content #babydiaper .form-check').on('click', function(e) {

			$('.modalDialog .modal-content #babydiaper .form-check').each(function() {
				$(this).find('i').css('display', 'none');
				$(this).find('.form-check-input').attr('checked', false);
			});

			$(e.target).closest('.form-check').find('i').css('display', 'block');
			$(e.target).closest('.form-check').find('.form-check-input').attr('checked', true);
		});
		$('.modalDialog .modal-content #hongkongmap .form-check').on('click', function(e) {

			$('.modalDialog .modal-content #hongkongmap .form-check').each(function() {
				$(this).find('i').css('display', 'none');
				$(this).find('.form-check-input').attr('checked', false);
			});

			$(e.target).closest('.form-check').find('i').css('display', 'block');
			$(e.target).closest('.form-check').find('.form-check-input').attr('checked', true);
		});

		// Booking - Privacy Agreement
		$("#booking_page #tab2 input:checkbox#is_agree").click(function(e) {
			if (e.target.checked) 
			{
				e.preventDefault();
				$(".modalPrivacy.book").modal();
				$(".modal-backdrop").css('background-image', 'initial').css('opacity', 0.5);
			}
		});
		// Modal - Booking - Privacy Agreement
		$(".modalPrivacy.book #agree").click(function(e) {
			$("#booking_page #tab2 input:checkbox#is_agree").prop('checked', true);
			$("#booking_page #tab2 input:checkbox#is_agree").attr('checked', true);
		});
		// Modal - Booking - Privacy Agreement - Control Height
		$(".modalPrivacy.book").on('shown.bs.modal', function() {
			$(".modalPrivacy .modal-body").outerHeight($('.modalPrivacy.book .modal-dialog').height() - $('.modalPrivacy.book .modal-header').outerHeight() - $('.modalPrivacy.book .modal-footer').outerHeight());
		});

		// Modal - Booking - Confirm
		$(".modalConfirm.book #keep").click(function(e) {
			window.location.href = 'home.php#events_pane';
		});


		// Reservation wizard
		var reservationWizard = $('#rsvp_page .wizard').bootstrapWizard({
			'onTabShow': function (tab, navigation, index) 
			{
				if (index === 0)
				{
					$("#rsvp_page .wizard button.prev").css('display', 'none');
				}
				else
				{
					$("#rsvp_page .wizard button.prev").css('display', 'inline-block');
				}

				if (index === 2)
				{
					var selected_date_input = $('#rsvp_form #tab2 input#shadow');

					if ( selected_date_input.val() )
					{
						$('#rsvp_form #tab3 h4').text( moment(selected_date_input.val(), 'YYYY-MM-DD').lang(curr_lang.toLowerCase()).format(getDateFormat(curr_lang)) );

						var slot_container = $('#rsvp_form #tab3 #slots');
						slot_container.empty();

						$(available_dates[ selected_date_input.val() ].session).each(function(i, v) {
							slot_container.append(`<div class="col-sm-6 col-xs-6"><div class="panel panel-default"><input type="checkbox" name="session_id" value="${v.id}"><i class="tick fa fa-check-circle"></i><div class="panel-body"><h6>${v.time.replace(/^0+/, '')}</h6></div></div></div>`);
						});

						// Reservation - Selectable time slots
						$("#rsvp_page .wizard #tab3 input:checkbox").click(function(e) {
							$("#rsvp_page .wizard #tab3 input:checkbox").each(function() {
								$(this).prop('checked', false);
								$(this).closest(".panel").removeClass('chosen');
							});

							$(e.target).prop('checked', true);
							$(e.target).closest(".panel").addClass('chosen');
						});
					}
					else
					{
						reservationWizard.bootstrapWizard('previous');
					}
				}
			}
		});
		$('#rsvp_page .wizard button.prev').click(function(e) {
			e.preventDefault();
			reservationWizard.bootstrapWizard('previous');
			return false;
		});
		$('#rsvp_page .wizard button.next').click(function(e) {
			e.preventDefault();
			
			if (reservationWizard.bootstrapWizard('currentIndex') === 1)
			{
				if (!$('input#shadow').val())
				{
					$('.err_msg #date').show();
				}
				else
				{
					$('.err_msg #date').hide();
					reservationWizard.bootstrapWizard('next');
				}
			}
			else if (reservationWizard.bootstrapWizard('currentIndex') === 2)
			{
				if (!$('#rsvp_page #tab3 input:checkbox:checked').length > 0)
				{
					$('.err_msg #time').show();
				}
				else
				{
					$('.err_msg #time').hide();
					reservationWizard.bootstrapWizard('next');
				}
			}
			else if (reservationWizard.bootstrapWizard('currentIndex') === 3)
			{
				$('#rsvp_page #tab4 .err_msg p').each(function() {
					$(this).hide();
				});

				if (!$("#rsvp_page #tab4 input#phone").val()) 
				{
					$('#rsvp_page #tab4 .err_msg #phone').show();
				}
				else if (!$("#rsvp_page #tab4 input#email").val()) 
				{
					$('#rsvp_page #tab4 .err_msg #email').show();
				}
				else if (!$("#rsvp_page #tab4 input:checkbox#is_agree").prop('checked'))
				{
					$('#rsvp_page #tab4 .err_msg #agree').show();
				}
				else
				{
		            $.ajax({
		                url: base_url + 'tour/submit.json',
		                type: 'post',
		                contentType: 'application/x-www-form-urlencoded',
		                data: $("form#rsvp_form").serialize(),
		                success: function( data, textStatus, jQxhr ) 
		                {
							var feedback = objToQueryParamsNested(data);
							window.location.href = `rsvped.php?${feedback}`;
		                },
		                error: function( jqXhr, textStatus, errorThrown )
		                {
		                }
		            });
				}
			}
			else
			{
				reservationWizard.bootstrapWizard('next');
			}
			
			return false;
		});

		var participant_swiper = new Swiper('#rsvp_page #tab1 .swiper-container', {
			direction: 'vertical', // https://swiperjs.com/api/#parameters
			slidesPerView: 3,
			slidesPerGroup: 1,
			loop: false,
			on: {
				init: function (s) 
				{
					var curr = $('#rsvp_page .swiper-slide-active+.swiper-slide').text().trim();
					$('#no_of_participant').val(curr);
				},
				slideChangeTransitionEnd: function (s) 
				{
					var curr = $('#rsvp_page .swiper-slide-active+.swiper-slide').text().trim();
					$('#no_of_participant').val(curr);
				},
			},
		});

		var remainingHeight = $(document).outerHeight() - $("#rsvp_page .wizard .nav").outerHeight();
		$("#rsvp_page .wizard .tab-content").outerHeight(remainingHeight);
		$("#rsvp_page .wizard .tab-content .tab-pane").outerHeight(remainingHeight);

		// Tour RSVP - Privacy Agreement
		$("#rsvp_page #tab4 input:checkbox#is_agree").click(function(e) {
			if (e.target.checked) 
			{
				e.preventDefault();
				$(".modalPrivacy.rsvp").modal();
				$(".modal-backdrop").css('background-image', 'initial').css('opacity', 0.5);
			}
		});
		// Modal - Tour RSVP - Privacy Agreement
		$(".modalPrivacy.rsvp #agree").click(function(e) {
			$("#rsvp_page #tab4 input:checkbox#is_agree").prop('checked', true);
		});
		// Modal - Tour RSVP - Privacy Agreement - Control Height
		$(".modalPrivacy.rsvp").on('shown.bs.modal', function() {
			$(".modalPrivacy .modal-body").outerHeight($('.modalPrivacy.rsvp .modal-dialog').height() - $('.modalPrivacy.rsvp .modal-header').outerHeight() - $('.modalPrivacy.rsvp .modal-footer').outerHeight());
		});

		// Modal - Booking - Confirm
		$(".modalConfirm.rsvp #keep").click(function(e) {
			window.location.href = 'home.php#tours_pane';
		});

		// Date Calendar Picker
		if ($('#rsvp_form').length > 0)
		{
			$.fn.datepicker.dates['zh-CN'].titleFormat = $.fn.datepicker.dates['zh-TW'].titleFormat = "yyyy年MM";
			$.fn.datepicker.dates['zh-CN'].months = $.fn.datepicker.dates['zh-TW'].months = ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"];

			$('#rsvp_form #calendar').datepicker({
				format: 'dd MM yyyy, DD',
				todayHighlight: true,
				language: curr_lang,
				startDate: new Date(),
				beforeShowDay: function(d) 
				{
			        var year  = d.getFullYear(),
			            month = ("0" + (d.getMonth() + 1)).slice(-2),
			            day   = ("0" + (d.getDate())).slice(-2);

			        var formatted = year + '-' + month + '-' + day;

					if ($.inArray(formatted, Object.keys(available_dates)) != -1)
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			}).on("changeDate", function(e) {
				var selected = e.date.valueOf();

				$('#rsvp_page .wizard #tab2 input[name=tour_date]').val( moment(selected).lang(curr_lang.toLowerCase()).format(getDateFormat(curr_lang)) );
				$('#rsvp_page .wizard #tab2 input#shadow').val( moment(selected).lang(curr_lang.toLowerCase()).format('YYYY-MM-DD') );
			});
		}

		// Audio Tours - Upwards-draggable bottom panel
		if ($('#audios_page').length > 0)
		{
			$('#audios_page .drag-bottom-tab').resizable({
				handles: {'n': '#handle'}
			});
		}

		// Audio tour list bottom menu
		disToTop();

		// Keeping audio list images square
		$("#audios_page .drag-bottom-tab img").each(function(e) {
			$(this).height( $(this).width() );
		});

		// Audio Tours - main page
		$("#audios_page .pin").on('click', function(e) {
			$("#audios_page .bottom-tab").attr('data-id', $(e.target).data('id') );
			$("#audios_page .bottom-tab img").attr('src', $(e.target).data('image') );
			$("#audios_page .bottom-tab img").width($(".bottom-tab img").height());
			$("#audios_page .bottom-tab .caption").text( $(e.target).text() );
			$("#audios_page .bottom-tab .caption").css( 'left', ($(".bottom-tab img").height()/2)+'px' );
			$("#audios_page .bottom-tab .caption").css( 'top', ( ($(".bottom-tab img").height()/2) - 12 )+'px' );
			$("#audios_page .bottom-tab #title_holder p").text($(e.target).data('title') );
			$("#audios_page .drag-bottom-tab").css('display', 'none');
		});

		$("#audios_page #list_view").on('click', function(e) {
			$("#audios_page .bottom-tab").removeAttr('data-id');
			$("#audios_page .drag-bottom-tab").css('display', 'block');
		});

		$("#audios_page .bottom-tab").on('click', function(e) {
			window.location.href = 'audio.php?id=' + $(e.target).closest('.bottom-tab').attr('data-id');
		});

		$('#audios_page .pin').each(function(i, v) {
			$(this).css('width', $(this).css('height'));
		});
		$('#audios_page .map-marker').each(function(i, v) {
			var left = parseFloat( $(this).css('left') );
			var top = parseFloat( $(this).css('top') );
			var size = $(this).height();
			left -= (size/2);
			top -= (size/2);
			$(this).css('left', left+'px');
			$(this).css('top', top+'px');
		});

		// Audio single page
		$('#audio_page .contents #bottom_buffer').height($('#audio_page #player').outerHeight() + parseFloat($('#audio_page #player').css('bottom')));

		$('#audio_page #lang').on('click', function() {

			if ( $('.modalDialog.lang .lang-choices i:visible').length === 0 )
			{
				$('.modalDialog.lang .lang-choices input:checked').closest('.form-check').find('i').css('display','block');
			}

			$('.modalDialog.lang').modal();
			$(".modal-backdrop").css('background-image', 'initial').css('opacity', 0.5);
		});

		$(".modalDialog.lang .modal-dialog").on('click', function() {
			$('.modalDialog.lang').modal('hide');
		});

		// Audio single page
		var audioElement;  

		// Audio single page
		$('.modalDialog.lang .modal-content .form-check').on('click', function(e) {
			// Radio to ticks
			var source = $(e.target).closest('.form-check').find('.form-check-input').val();
			$('.modalDialog.lang .modal-content .form-check').each(function() {
				$(this).find('i').css('display', 'none');
			});

			$(e.target).closest('.form-check').find('i').css('display', 'block');
			$(".lang.modalDialog input[value="+source+"]").prop("checked", true);

		    $('.modalDialog.lang').modal('hide');
		    $('#audio_page #lang span').text( lang_dict[source]['s'] );

		    $("#audio_page .section.contents").html(langs_intros[source]['introduction']);
		    $("#audio_page h4").html(langs_intros[source]['name']);
		    $("#audio_page #audio-info").html(langs_intros[source]['name']);

		    // Reload audio
		    var selectedAudio = $('.modalDialog.lang input[name='+source+']').val();
		    stopAudio(audioElement);
		    resetAudio(audioElement);
     		audioElement = loadAudio(selectedAudio, audioElement);
			initAudio(audioElement);
		});

		// Audio single page - The custom-css audio player
		// https://www.jqueryscript.net/other/Custom-HTML5-Audio-Player-with-jQuery-CSS.html
		if ($("#audio_page").length > 0)
		{
			var selectedAudio = $('.modalDialog.lang .lang-choices input:checked').closest('.form-check').find('input[type=hidden]').val();
     		audioElement = loadAudio(selectedAudio, audioElement);
	        initAudio(audioElement);

			$('#audio_page #player button#play').click(function() { startAudio(audioElement); });
			$('#audio_page #player button#pause').click(function() { stopAudio(audioElement); });
			$(audioElement).on('ended', function() { stopAudio(audioElement); });
		}

		$("#languages_page .option-row").on('click', function(e) {
			var lang = $(e.target).closest('.option-row').find('input[name=lang]').val();
			window.location.href = 'languages.php?lang=' + lang;
		});

		$('.goback').on('click', function(e) {
			if (window.location.href.includes('setting'))
			{
				window.location.href = 'home.php';
			}
			else if (window.location.href.includes('booking'))
			{
				$(".modalConfirm.book").modal('show');
				$(".modal-backdrop").css('background-image', 'initial').css('opacity', 0.5);
			}
			else if (window.location.href.includes('rsvp'))
			{
				$(".modalConfirm.rsvp").modal('show');
				$(".modal-backdrop").css('background-image', 'initial').css('opacity', 0.5);
			}
			else
			{
				history.back();
			}
		});

		$("#modal_locations").on('shown.bs.modal', function() {
			$('.modal-backdrop').css('background-image', 'initial').css('opacity', 0.5);
		});

		$('#modal_locations .modal-dialog').on('click', function() {
			$("#modal_locations").modal('hide');
		});
    });

	$(window).resize(function(){
		disToTop();
	});

	function adjustBackFillerDisplay() 
	{
		$("#about .panel-collapse.collapse").each(function (index) {
			$(this).closest('.panel').find('.panel-heading').css('z-index', $(".panel-collapse.collapse").length - index);

			if ($(this).hasClass('in'))
			{
				$(this).closest('.panel').find('.back-filler').css('display', 'none');
			}
			else
			{
				$(this).closest('.panel').find('.back-filler').css('display', 'block');
			}
		});
	}

	function disToTop() 
	{
		var windowHeight = $(window).height(),
		    resizeHeight = $("#audios_page .drag-bottom-tab").height(),
		    difference   = windowHeight - resizeHeight;

	    if (difference <= 0)
	    {
	    	difference = 0;
	    	$('#audios_page .drag-bottom-tab').css('border-radius', '0 0 0 0');
	    }
	    else
	    {
	    	$('#audios_page .drag-bottom-tab').css('border-radius', '10px 10px 0 0');
	    }

		$("#audios_page .drag-bottom-tab").css("top", difference);

		var container_height = $(window).height() 
			- difference 
			- $('.drag-bottom-tab h3').outerHeight() 
			- parseFloat( $('.drag-bottom-tab h3').css('margin-bottom') )
			- $('#padder-top').outerHeight()
			- parseFloat( $('#padder-top').css('margin-top') );
		$('.items-container').height(container_height);
	}

	function initAudio(audioElement)
	{
		audioElement.currentTime = 0;

		$('#audio_page #player button#pause').hide();
		$("#audio_page #player button#play").show();

		$(audioElement).on("loadedmetadata", function () { // Can't use canplay event for iPhone
			$("#audio_page #player #duration0").text(new Date(0).toISOString().substr(15, 4));
			$("#audio_page #player #duration").text(new Date(this.duration * 1000).toISOString().substr(15, 4));
			$("#audio_page #player #tracker input.slider").attr('max', this.duration.toFixed(2));
			$("#audio_page #player button#play").removeAttr('disabled');
			$("#audio_page #player button#pause").removeAttr('disabled');
	    });

		$(audioElement).bind('timeupdate',function() {
			setProgressBar(audioElement);
		});

		$("#audio_page #player #tracker input.slider").on('change', function(e) {
			$("#audio_page #player #duration0").text(new Date(e.target.value * 1000).toISOString().substr(15, 4));
			$("#audio_page #player #tracker input.slider").val(e.target.value);
			var value = Math.floor((100 / audioElement.duration) * e.target.value);
			$('#audio_page #player #progress').css('width', value+'%');
			audioElement.currentTime = e.target.value;
		});
	}
	function setProgressBar(audioElement)
	{
		var value = 0;

		if(audioElement.currentTime > 0)
		{
			value = Math.floor((100 / audioElement.duration) * audioElement.currentTime);
		}

		$("#audio_page #player #duration0").text(new Date(audioElement.currentTime * 1000).toISOString().substr(15, 4));
		$("#audio_page #player #tracker input.slider").val(audioElement.currentTime.toFixed(2));
		$('#audio_page #player #progress').css('width', value+'%');
	}

	function startAudio(audioElement)
	{
		audioElement.play();
		$("#audio_page #player button#play").hide();
    	$('#audio_page #player button#pause').show();
	}
	function stopAudio(audioElement)
	{
		audioElement.pause();
		$("#audio_page #player button#play").show();
    	$('#audio_page #player button#pause').hide();
	}

	function loadAudio(audio, audioElement)
	{
 		// audioElement = document.createElement('audio');
		// audioElement.setAttribute('src', 'media/'+lang+'/Sample.mp3');  
		// OR
        audioElement = new Audio(audio);

        return audioElement;
	}
	function resetAudio(audioElement)
	{
	    $(audioElement).unbind();
	    // delete audioElement;
        // audioElement.removeAttribute('src');
        // audioElement.load();
        audioElement.currentTime = 0;
		setProgressBar(audioElement);
	}

	// https://stackoverflow.com/questions/1714786/query-string-encoding-of-a-javascript-object
	function objToQueryParams(obj) 
	{
		let str = [];
		for (let p in obj)
		{
			if (obj.hasOwnProperty(p)) 
			{
				str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
			}
		}

		return str.join("&");
	}
	function objToQueryParamsNested(obj, prefix) 
	{
		var str = [], p;

		for (p in obj) 
		{
			if (obj.hasOwnProperty(p)) 
			{
				var k = prefix ? prefix + "[" + p + "]" : p,
				v = obj[p];
				str.push(
					(v !== null && typeof v === "object") ?
					objToQueryParamsNested(v, k) :
					encodeURIComponent(k) + "=" + encodeURIComponent(v)
				);
			}
		}

		return str.join("&");
	}
	function show_tab(url)
	{
		if (url.match('#')) 
		{
		    $('.nav-tabs#bottom_nav a[href="#' + url.split('#')[1] + '"]').tab('show');
		} 
	}
	function getDateFormat(lang)
	{
		if (lang === 'en-GB')
		{
			return 'D MMMM YYYY, dddd';
		}
		else
		{
			return 'YYYY年 M月 D日, dddd';
		}
	}
})(jQuery);