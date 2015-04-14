$(document).ready(function(){
    
	//Homepage Slider
    var options = {
        nextButton: false,
        prevButton: false,
        pagination: true,
        animateStartingFrameIn: true,
        autoPlay: true,
        autoPlayDelay: 3000,
        preloader: true
    };
    
    var mySequence = $("#sequence").sequence(options).data("sequence");

    //Main menu Initialization
    mainMenu.init();

//COMENTADO EM 31/03
//	//Products slider
//	var produxtsSlider = $('.products-slider').bxSlider({
//		slideWidth: $('.products-slider .shop-item').outerWidth()-20, //Gets slide width
//		responsive: true,
//		minSlides: 1,
//		maxSlides: 4,
//		slideMargin: 20,
//		auto: true,
//		autoHover: true,
//		speed: 800,
//		pager: true,
//		controls: false
//	});

	//Make Videos Responsive
	$(".video-wrapper").fitVids();

	//Initialize tooltips
	$('.show-tooltip').tooltip();

	//Contact Us Map
	if($('#contact-us-map').length > 0){ //Checks if there is a map element
		var map = L.map('contact-us-map', {
			center: [-20.475309, -54.613738],
			scrollWheelZoom: false,
			zoom: 15
		});
		L.tileLayer('http://{s}.tile.cloudmade.com/{key}/22677/256/{z}/{x}/{y}.png', {
			key: 'BC9A493B41014CAABB98F0471D759707'
		}).addTo(map);
		L.marker([51.5, -0.09]).addTo(map).bindPopup("<b>Aluminium Center</b><br/>Rua Treze de Maio, 1123<br/> - Centro<br/>Campo Grande - MS</br>79004-423").openPopup();
	}

	$( window ).resize(function() {
		$('.col-footer:eq(0), .col-footer:eq(1)').css('height', '');
		var footerColHeight = Math.max($('.col-footer:eq(0)').height(), $('.col-footer:eq(1)').height()) + 'px';
		$('.col-footer:eq(0), .col-footer:eq(1)').css('height', footerColHeight);
	});
	$( window ).resize();

});