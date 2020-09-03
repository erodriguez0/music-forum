$(window).resize(function() {
	var s = $(this).width();
	if(s < 768) {
		$(".btn-update").addClass("btn-block");
	} else {
		$(".btn-update").removeClass("btn-block");
	}
	// if(s >= 768 && s < 992) {
	// 	$(".recent-title").each(function() {
	// 		var v = $(this).children().children().children().children().next().html();
	// 		var l = v.length;
	// 		if(l > 30) {
	// 			$(this).children().children().children().children().next().html(v.substr(0, 30)+"...");
	// 		}
	// 	})
	// } else if(s >= 992 && s < 1200) {
	// 	$(".recent-title").each(function() {
	// 		var v = $(this).children().children().children().children().next().html();
	// 		var l = v.length;
	// 		if(l > 45) {
	// 			$(this).children().children().children().children().next().html(v.substr(0, 45)+"...");
	// 		}
	// 	})
	// } else if(s >= 1200) {
	// 	$(".recent-title").each(function() {
	// 		var v = $(this).children().children().children().children().next().html();
	// 		var l = v.length;
	// 		if(l > 50) {
	// 			$(this).children().children().children().children().next().html(v.substr(0, 50)+"...");
	// 		}
	// 	})
	// } else if(s < 768) {
	// 	$(".recent-title").each(function() {
	// 		var v = $(this).children().children().children().children().next().html();
	// 		var l = v.length;
	// 		if(l > 80) {
	// 			$(this).children().children().children().children().next().html(v.substr(0, 80)+"...");
	// 		}
	// 	})	
	// }
});

$(document).ready(function() {
	$("#new-thread").click(function() {
		$("#new-thread-form").slideToggle("medium");
	});
	$(".reply-btn").each(function() {
		$(this).click(function() {
			$(this).next("div").slideToggle("medium");
		});
	});
	var s = $(this).width();
	if(s < 768) {
		$(".btn-update").addClass("btn-block");
	} else {
		$(".btn-update").removeClass("btn-block");
	}
	if(s >= 768 && s < 992) {
		$(".recent-title").each(function() {
			var v = $(this).children().children().children().children().next().html();
			var l = v.length;
			if(l > 30) {
				$(this).children().children().children().children().next().html(v.substr(0, 30)+"...");
			}
		})
	} else if(s >= 992 && s < 1200) {
		$(".recent-title").each(function() {
			var v = $(this).children().children().children().children().next().html();
			var l = v.length;
			if(l > 45) {
				$(this).children().children().children().children().next().html(v.substr(0, 45)+"...");
			}
		})
	} else if(s >= 1200) {
		$(".recent-title").each(function() {
			var v = $(this).children().children().children().children().next().html();
			var l = v.length;
			console.log(v);
			console.log(l);
			if(l > 50) {
				$(this).children().children().children().children().next().html(v.substr(0, 50)+"...");
			}
		})
	} else if(s < 768) {
		$(".recent-title").each(function() {
			var v = $(this).children().children().children().children().next().html();
			var l = v.length;
			if(l > 80) {
				$(this).children().children().children().children().next().html(v.substr(0, 80)+"...");
			}
		})	
	}

	// $(".show-replies").each(function() {
	// 	$(this).click(function() {
	// 		$.post()
	// 	});
	// });

	$("#info-bio").keyup(function() {
		var l = $(this).val().length;
		var limit = 384;
		var sub = limit - l;
		if(sub == limit) {
			$("#bio-msg").children().html("&nbsp;");
		} else if(sub > 0 && sub < limit) {
			$("#bio-msg").children().html(sub + " characters left");
		} else if(sub <= 0) {
			$("#bio-msg").children().html("Limit reached");
			$(this).val($(this).val().substr(0,limit));
		}
	});
});