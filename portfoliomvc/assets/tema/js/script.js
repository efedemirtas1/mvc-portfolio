(function() {

	"use strict";

	var RexLaw = {
		init: function() {
			this.Basic.init();  
		},

		Basic: {
			init: function() {

				this.BackgroundImage();
				this.StickyHeader();
				this.MobileMenu();
				this.Animation();
				this.SideInner();
				this.scrollTop();
				this.MianSlider();
				this.bannerParalax();
				this.TestimonialSlider();
				this.videoBox();
			},
			BackgroundImage: function (){
				$('[data-background]').each(function() {
					$(this).css('background-image', 'url('+ $(this).attr('data-background') + ')');
				});
			},
			StickyHeader: function (){
				jQuery(window).on('scroll', function() {
					if (jQuery(window).scrollTop() > 250) {
						jQuery('.main_header').addClass('menu-bg-overlay')
					} else {
						jQuery('.main_header').removeClass('menu-bg-overlay')
					}
				})
			},
			SideInner: function (){
				$('.open_side_area').on("click", function() {
					$('.wide_side_inner').toggleClass("wide_side_on");
				});
				$('.open_side_area').on('click', function () {
					$('body').toggleClass('body_overlay_on');
				});
			},
			scrollTop: function (){
				$(window).on("scroll", function() {
					if ($(this).scrollTop() > 250) {
						$('.scrollup').fadeIn();
					} else {
						$('.scrollup').fadeOut();
					}
				});

				$('.scrollup').on("click", function()  {
					$("html, body").animate({
						scrollTop: 0
					}, 800);
					return false;
				});
			},
			MobileMenu: function (){
				$('.open_mobile_menu').on("click", function() {
					$('.mobile_menu_wrap').toggleClass("mobile_menu_on");
					return false;
				});
				$('.open_mobile_menu').on('click', function () {
					$('body').toggleClass('mobile_menu_overlay_on');
					return false;
				});
				$(document).on('click', ".mobile_menu_wrap ul li.dropdown > a", function(event) {
					$(this).parent().find(".dropdown-menu").slideToggle("slow");
					return false;
				});
			},
			Animation: function (){
				if($('.wow').length){
					var wow = new WOW(
					{
						boxClass:     'wow',
						animateClass: 'animated',
						offset:       0,
						mobile:       true,
						live:         true
					}
					);
					wow.init();
				}
			},
			MianSlider: function (){
				jQuery('#slider_id').owlCarousel({
					items: 1,
					loop: true,
					nav: true,
					dots: false,
					autoplay: false,
					navSpeed: 800,
					smartSpeed: 1000,
					animateOut: 'fadeOut',
					navText:["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
				});
			},
			
			bannerParalax: function (){
				$('.background_parallax').jarallax({
					speed: 0.3,
				});
			},
			TestimonialSlider: function (){
				jQuery('#testimonial_slide').owlCarousel({
					items: 1,
					margin: 30,
					loop: true,
					nav: false,
					dots: true,
					smartSpeed: 1000,
					autoplay: false,
				});
			},
			videoBox: function (){
				jQuery('.video_box').magnificPopup({
					disableOn: 200,
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false,
				});
			},
		}
	}
	jQuery(document).ready(function (){
		RexLaw.init();
	});

})();