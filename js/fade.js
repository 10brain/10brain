$('head').append(
'<style type="text/css">body {display:none;}'
);
$(window).load(function() {
$('body').delay("700").fadeIn("3000");
$(window).on("beforeunload",function(e){
    $('body').fadeOut("3000");
});
});
