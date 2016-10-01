var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
if(isChrome){
chrome = 210;

}
else{
  chrome = 0;
}
function getCssProperty(elmId, property){
   var elem = document.getElementById(elmId);
   return window.getComputedStyle(elem,null).getPropertyValue(property);
}
  <!-- marke 1 starts -->
$(document).ready(function() {
    var $dragging = null;
y=270;
  var p = $("#marker");
    $(document.body).on("mousemove", function(e) {
      var p = $("#marker");

        if ($dragging) {
          if(p.offset().left>=(260+chrome) && p.offset().left <= (989+chrome) ){

            $dragging.offset({
                left: e.pageX
            });
}

   var y = p.offset().left;

   var width= y-260;

   if(width>(740-chromewidth){
     width = 740-chromewidth;
   }
   if(width<0){
     width = 0;
   }

document.getElementById('moved').setAttribute("style","width:"+width+"px");


// You could now get your value like

              console.log(y);

              if(p.offset().left<(260+chrome)){

          p.offset({left:(261+chrome)});
              }

              if(p.offset().left>(987+chrome)){

          p.offset({left:(987+chrome)});
              }

        }
    });


    $(document.body).on("mousedown", "#marker", function (e) {
        $dragging = $(e.target);


    });

    $(document.body).on("mouseup", function (e) {
        $dragging = null;
    });
});
  <!-- marker 1 ends-->

  <!-- marker 2 starts -->
  $(document).ready(function() {
      var $dragging = null;
  y=270;
    var p = $("#marker2");
      $(document.body).on("mousemove", function(e) {
        var p = $("#marker2");
          if ($dragging) {
            if(p.offset().left>=260 && p.offset().left <= 989 ){

              $dragging.offset({
                  left: e.pageX
              });
  }

     var y = p.offset().left;

     var width= y-260;

     if(width>740){
       width = 740;
     }
     if(width<0){
       width = 0;
     }

  document.getElementById('moved1').setAttribute("style","width:"+width+"px");


                console.log(y);

                if(p.offset().left<260){

            p.offset({left:261});
                }

                if(p.offset().left>987){

            p.offset({left:987});
                }

          }
      });


      $(document.body).on("mousedown", "#marker2", function (e) {
          $dragging = $(e.target);
      });

      $(document.body).on("mouseup", function (e) {
          $dragging = null;
      });
  });
  <!--marke 2 ends-->
