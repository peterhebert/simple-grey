jQuery(document).ready(function($){

  // make Twitter embeds responsive
  setInterval( function() {
    $( '.twitter-tweet-rendered' ).removeAttr( 'width' );
    $( '.twitter-tweet-rendered' ).css({ "width": "100%" });
  }, 100 );

  // add wmode=transparent to YouTube iframes to fix z-index issue
  $('iframe[src*="youtube.com"]').each(function() {
      var url = $(this).attr("src")
      $(this).attr("src",url+"&amp;wmode=transparent")
  }); 

});
