// $(window).scroll(function() {
//     if ($(this).scrollTop() >= $("nav").height()) { // this refers to window
//     	// $("nav").addClass("sticky-top");
//         $(".side-col .sticky-top").addClass("top-pad");
//     } else {
//     	// $("nav").removeClass("sticky-top");
//     	$(".side-col .sticky-top").removeClass("top-pad");
//     }
// });

$('.reply-btn').each(function() {
	$(this).click(function(){
		// var str = $(this).html();
    	$(this).parent().next('.thread-reply-form').slideToggle(200);
    	if($(this).hasClass("text-white")) {
    		$(this).removeClass("text-white bg-dark");
    	} else {
    		$(this).addClass("text-white bg-dark");
    	}
    });
});

$(document).ready(function() {

});