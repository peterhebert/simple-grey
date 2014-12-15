jQuery( document ).ready(function() {

  setTimeout(function() {

    jQuery(".gallery").each(function(index, value) {
    
      var maxImgHeight = 0;
      var maxCaptionHeight = 0;
      
      var galleryObject = jQuery(this);

      var galleryID = jQuery(this).attr('id');
      var imgCount = jQuery(this).find("img").size();

      galleryObject.find("img").each(function(){
         if (jQuery(this).outerHeight() > maxImgHeight) { maxImgHeight = jQuery(this).outerHeight(); }
      });
      galleryObject.find(".gallery-item .gallery-caption").each(function(){
         if (jQuery(this).outerHeight() > maxCaptionHeight) { maxCaptionHeight = jQuery(this).outerHeight(); }
      });

      var imageEMs = (maxImgHeight / 16) ;
      var captionEMs = (maxCaptionHeight / 16);
      var itemHeight = maxImgHeight + maxCaptionHeight ;
      var itemHeightEMs = imageEMs + captionEMs + .75;
          
      galleryObject.find(".gallery-icon a").height(maxImgHeight);
      galleryObject.find(".gallery-item").height(itemHeight);

    });

  }, 500);

});



  
