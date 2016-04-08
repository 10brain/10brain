$('head').append(
'<style type="text/css">#content {display:none;}'
);
$(window).load(function() {
$('#content').delay("700").fadeIn("3000");
$(window).on("beforeunload",function(e){
    $('#content').fadeOut("3000");
});
});

$('head').append(
'<style type="text/css">#login {display:none;}'
);
$(window).load(function() {
$('#login').delay("700").fadeIn("3000");
$(window).on("beforeunload",function(e){
    $('#login').fadeOut("3000");
});
});
