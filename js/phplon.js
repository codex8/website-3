//JS to preserve the layout
window.onload = (function(){

	var headerHeight = $('.header-img').height();

    $('#phplon-logo').css('margin-top', -(0.90 * headerHeight));
    $('#phplon-logo').css('margin-bottom', (0.90 * headerHeight));


 
}); 
$(document).ready(function(){
    $(window).resize(function(){
    	var headerHeight = $('.header-img').height();
    	
        $('#phplon-logo').css('margin-top', -(0.90 * headerHeight));
        $('#phplon-logo').css('margin-bottom', (0.90 * headerHeight));
           	
    });        
});