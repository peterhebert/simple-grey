jQuery( document ).ready(function() {

    jQuery( "nav button.menu-toggle" ).click(function() {
      jQuery(this).parent().toggleClass( "toggled" );
    });

});


