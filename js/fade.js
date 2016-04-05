$('head').append(
'<style type="text/css">body {display:none;}'
);
$(window).load(function() {
$('body').delay("100").fadeIn("500");
$(window).on("beforeunload",function(e){
    $('body').fadeOut("500");
});
});
