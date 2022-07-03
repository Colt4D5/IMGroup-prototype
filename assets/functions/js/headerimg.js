jQuery.noConflict();
(function($) {
$( document ).ready(function() {
// andherewego.exe

	// Pages
	$("div[data-field_name='acf-field-5b7ef4212edaf']").addClass("acf-field-5b7ef4212edaf");
	$(".acf-field-5b7ef4212edaf p.description").click(function(event){
    $(this).toggleClass("open");
    $(".acf-field-5b7ef4212edaf ul.acf-radio-list").fadeToggle("fast");
    if($(".acf-field-5b7ef4212edaf ul.acf-radio-list").hasClass("open")) {
        $(".acf-field-5b7ef4212edaf ul.acf-radio-list").removeClass("open");
    } else {
        $(".acf-field-5b7ef4212edaf ul.acf-radio-list").addClass("open");
    }
	});

	$(".acf-field-5b7ef4212edaf ul.acf-radio-list li input + .headimg_thumb").click(function(event){
        $(this).addClass("chosen");
        $(".acf-field-5b7ef4212edaf ul.acf-radio-list li input + .headimg_thumb").not(this).removeClass("chosen");
	});

    $(".acf-field-5b7ef4212edaf ul.acf-radio-list li input[checked='checked'] + .headimg_thumb").addClass("chosen");

    // Promo Buttons
	$("div[data-field_name='acf-field-577f1b8e85d4b']").addClass("acf-field-577f1b8e85d4b");
	$(".acf-field-577f1b8e85d4b p.description").click(function(event){
    $(this).toggleClass("open");
    $(".acf-field-577f1b8e85d4b ul.acf-radio-list").fadeToggle("fast");
    if($(".acf-field-577f1b8e85d4b ul.acf-radio-list").hasClass("open")) {
        $(".acf-field-577f1b8e85d4b ul.acf-radio-list").removeClass("open");
    } else {
        $(".acf-field-577f1b8e85d4b ul.acf-radio-list").addClass("open");
    }
	});

	$(".acf-field-577f1b8e85d4b ul.acf-radio-list li input + .headimg_thumb").click(function(event){
        $(this).addClass("chosen");
        $(".acf-field-577f1b8e85d4b ul.acf-radio-list li input + .headimg_thumb").not(this).removeClass("chosen");
	});

    $(".acf-field-577f1b8e85d4b ul.acf-radio-list li input[checked='checked'] + .headimg_thumb").addClass("chosen");

    // Home Slider
	$("div[data-field_name='acf-field-5s7ef2382ecaq']").addClass("acf-field-5s7ef2382ecaq");
	$(".acf-field-5s7ef2382ecaq p.description").click(function(event){
    $(this).toggleClass("open");
    $(".acf-field-5s7ef2382ecaq ul.acf-radio-list").fadeToggle("fast");
    if($(".acf-field-5s7ef2382ecaq ul.acf-radio-list").hasClass("open")) {
        $(".acf-field-5s7ef2382ecaq ul.acf-radio-list").removeClass("open");
    } else {
        $(".acf-field-5s7ef2382ecaq ul.acf-radio-list").addClass("open");
    }
	});

	$(".acf-field-5s7ef2382ecaq ul.acf-radio-list li input + .headimg_thumb").click(function(event){
        $(this).addClass("chosen");
        $(".acf-field-5s7ef2382ecaq ul.acf-radio-list li input + .headimg_thumb").not(this).removeClass("chosen");
	});

    $(".acf-field-5s7ef2382ecaq ul.acf-radio-list li input[checked='checked'] + .headimg_thumb").addClass("chosen");



// end it all
});
})(jQuery);