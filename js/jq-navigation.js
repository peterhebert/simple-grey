jQuery( document ).ready(function() {

    jQuery( "#site-navigation h1, #site-navigation.toggled h1" ).click(function() {
      jQuery(this).parent().toggleClass( "toggled" );
    });

});



  
