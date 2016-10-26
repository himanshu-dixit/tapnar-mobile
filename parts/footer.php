<div class="footer">
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-71984647-1', 'auto');
    ga('send', 'pageview');

  </script>
  <script>
function move(obj){
  var one = obj.dataset.id;
  obj.style.backgroundImage = 'url(http://<?php echo $_SERVER["SERVER_NAME"];?>/zone/zupload/gif/'+one+'.gif)';

}
function change(obj){
  var one = obj.dataset.id;
  obj.style.backgroundImage = 'url(http://<?php echo $_SERVER["SERVER_NAME"];?>/zone/zupload/thumb/'+one+'.jpg)';

}
//On Click Menu Open
$( ".menu_icon" ).click(function() {
  $(".menu_swipe").css("display", "block");
});
//Menu Close
$( ".close_button" ).click(function() {
  $(".menu_swipe").css("display", "none");
});

$( ".close_icon" ).click(function() {
  $(".banner").css("display", "none");
});

$( ".fa-search" ).click(function() {
  var display = $(".search_box").css( "display" );
  if(display=="none"){
  $(".search_box").css("display", "block");
 }
 else {
  $(".search_box").css("display", "none");
 }

});

  </script>

</div>
