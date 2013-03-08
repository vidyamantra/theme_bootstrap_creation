//floating menu
YUI().use('node', function(Y){
   var basket = Y.one('#awesomebar');

   if(basket != null){
   		var basketY = basket.getY(); 	
	   var basketCase = Y.one('#menucontainer');
  	 //var basketHolder = Y.one('#basketHolder');
   	var overflow = Y.one('#awesomebar');   
   }
   


   function constrain()
   {
    var basketHeight = basket.getComputedStyle("height").split("px")[0];
    var windowHeight = Y.one("body").get("winHeight");
    if (basketHeight > windowHeight) {
     var diff = basketHeight - windowHeight;
     var scrollHeight = Y.one("#awesomebar").getComputedStyle("height").split("px")[0];
     var newHeight = scrollHeight - diff;

     overflow.setStyle("height", newHeight+"px");

    }
   }

   Y.on('scroll', fixBasket);
   Y.on('resize', fixBasket);

   function fixBasket(e){
     var windowY = Y.DOM.docScrollY();
     //if(windowY > basketY && !basket.hasClass("fixed"))
     if(windowY > basketY){
     	basketCase.addClass("fixed");
     	constrain();
     }else if(windowY < basketY && basketCase.hasClass("fixed")){
     	basketCase.removeClass("fixed");
      	//alert("removing");
     }
    }
});

