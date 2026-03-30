jQuery(document).ready(function($) {
	$('.ssp-btn').on('click', function(e) {
		// Prevent default behavior if there's a valid link and it's not whatsapp (whatsapp handles its own intent on mobile/web)
		var url = $(this).attr('href');
		if (url && url !== '#' && !$(this).hasClass('ssp-whatsapp')) {
			e.preventDefault();
			var windowWidth = 600;
			var windowHeight = 400;
			var windowLeft = window.screenLeft + (window.outerWidth / 2) - (windowWidth / 2);
			var windowTop = window.screenTop + (window.outerHeight / 2) - (windowHeight / 2);
			
			window.open(url, 'share_popup', 'width=' + windowWidth + ',height=' + windowHeight + ',left=' + windowLeft + ',top=' + windowTop + ',resizable=yes,scrollbars=yes,status=yes');
		}
	});

	// Mobile specific handling
	if (window.matchMedia("(max-width: 768px)").matches) {
		$('.ssp-whatsapp').attr('href', function(i, href) {
			return href.replace('api.whatsapp.com', 'api.whatsapp.com');
		});
	}
});
