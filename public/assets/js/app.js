$(function() {
	var $activeElement = $('.sidebar-menu .active');

	if ($activeElement.length) {
		var activeElementOffset = $activeElement.offset().top;

		$('.sidebar-inner').slimScroll({
			scrollTo: activeElementOffset
		});

		$('.sidebar-inner').animate({
			scrollTop: activeElementOffset
		}, 500);
	}

	$('.logout_user').on('click', function(e) {
		e.preventDefault();

		$.post({
			url: '/logout',
			success: function() {
				location.reload();
			},
			error: function(error) {
				console.log(error);
				alert("There's something error.");
			}
		});
	});

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
});
