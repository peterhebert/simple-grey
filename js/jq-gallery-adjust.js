jQuery( document ).ready(function() {

  setTimeout(function() {

    jQuery(".gallery").each(function(index, value) { 
        var maxImgHeight = 0;
        var maxItemHeight = 0;
        
        var galleryObject = jQuery(this);

        galleryObject.find("img").each(function(){
            if (jQuery(this).outerHeight() > maxImgHeight) { maxImgHeight = jQuery(this).outerHeight(); }
        });
        galleryObject.find(".gallery-item").each(function(){
            if (jQuery(this).outerHeight() > maxItemHeight) { maxItemHeight = jQuery(this).outerHeight(); }
        });
        galleryObject.find(".gallery-icon a").height(maxImgHeight);
        galleryObject.find(".gallery-item").height(maxItemHeight);

    });

  }, 500);

});



  
