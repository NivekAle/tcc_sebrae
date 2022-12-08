


export function Toast(msg, timer = 2500) {
	$(".Toast").addClass("active");
	$(".Toast-progress").addClass("active");
	$(".Toast-text").html(msg);

	var toast_timer = setTimeout(() => {
		$(".Toast").removeClass("active");
		// clearTimeout(toast_timer);
	}, timer);

	var progess_bar = setTimeout(function () {
		$(".Toast-progress").removeClass("active");
		// clearTimeout(progess_bar);
	}, timer);

	$("#btn-close-toast").on("click", function () {
		$(".Toast").removeClass("active");

		var progress_bar_close = setTimeout(() => {
			$(".Toast-progress").removeClass("active");
		}, 300);
		clearTimeout(progress_bar_close);
	});
}