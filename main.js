var start_time_post;
var duration_post;
var audio_post;
var meme_type_post;
var meme_size_post;
var meme_color_post;
var meme_x_cor_post;
var meme_y_cor_post;
var meme_text_post;
    // var duration = 22;
     var video = document.getElementById("video-dl");
    // duration = vid.duration;


$(document).ready(function(){
  var meme_type;
  $('#caption_type').change(function(){
       meme_type = $(this).find('option:selected').attr('id');


          });
  var v_point = document.getElementById("video-dl");
    //document.getElementById('hover_text').setAttribute("style","top:"+352.80+"px");
      //document.getElementById('hover_text').setAttribute("style","left:"+326.80+"px");
  $("#hover_text").draggable ({
        containment : "parent"
      });

  var gif_start,gif_duration;
   $("#marker").draggable ({
         axis : "x",
         containment : "#video-dl"
       });

       $("#marker2").draggable ({
             axis : "x",
             containment : "#progress_bar_down"
           });
           document.getElementById("video-dl").onloadstart = function() {

};
           var vid = document.getElementById("video-dl");



           var first = setInterval(first_repeat, 3);
              var second = setInterval(second_repeat,3);
           function first_repeat() {
                var p = $("#marker");
                var post =  p.position().left;

                var start = (duration/727)*post;

                gif_start=start;
  document.getElementById("hidden_time").value = start;
  start_time_post = start;

                var minutes = "0" + Math.floor(start / 60);
                var seconds = "0" + (start - minutes * 60);
                formatted_start = minutes.substr(-2) + ":" + seconds.substr(1,2)+":"+Math.round(seconds.substr(-2,3));

                if(!start){
                  start = 0;
                }

                document.getElementById("start_time").value = formatted_start;

         document.getElementById('moved').setAttribute("style","width:"+post+"px");


           }

           function second_repeat() {



  if($('#audio_check').is(':checked')==true){
  v_point.muted = true;
  audio_post = true;

  }
  else{
  v_point.muted = false;
    audio_post = false;
  }
             // for 2nd slider
                var p1 = $("#marker2");
                var post1 =  p1.position().left;


                              var d_start = (allowed/727)*post1;

  gif_duration = d_start;
  duration_post = d_start;
                              var d_seconds = "0" + (d_start* 60);
                              formatted_start =  d_seconds.substr(-2);

                              if(!d_start){
                                d_start = 0;
                              }

                                p1.position().left = 365;

                              document.getElementById("duration_time").value = d_start;


              document.getElementById('moved1').setAttribute("style","width:"+post1+"px");



              var current_video_time = v_point.currentTime;


  if(current_video_time>=(gif_start+gif_duration)){
     v_point.currentTime = gif_start;
  }

  var meme_box = $("#hover_text");

  var hover_top = meme_box.position().top;


  document.getElementById("hover_caption").innerHTML = document.getElementById("caption_content").value;

  // refresh meme_box
var font_size = document.getElementById("font-size").value;
if(font_size>70){
  font_size = 70;
}

meme_type_post = meme_type;
meme_color_post = document.getElementById("font-color").value;
meme_size_post = font_size;
meme_text_post = document.getElementById("caption_content").value;
meme_x_cor_post =   meme_box.position().left;
meme_y_cor_post =   meme_box.position().top;

  if(meme_type == "none"){
    document.getElementById('hover_caption').setAttribute("style","display:none;");
      $("#font-size").css("visibility","hidden");
      $("#font-color").css("visibility","hidden");
      $("#caption_content").css("visibility","hidden");

  }
  else if(meme_type == "meme"){

  $("#hover_caption").css("font-family","Impact");
  $("#hover_caption").css("display","block"); // Bullshit
  $("#hover_caption").css("font-size",font_size+"px");
  $("#hover_caption").css("font-weight","400");
    $("#hover_caption").css("text-transform","uppercase");
    $("#hover_caption").css("text-shadow","0 0 2px #000");

  $("#hover_caption").css("color","#"+document.getElementById("font-color").value);
  $("#hover_caption").css("visibility","visible");
  $("#font-size").css("visibility","visible");
  $("#font-color").css("visibility","visible");
  $("#caption_content").css("visibility","visible");

  }
  else if(meme_type == "simple"){
    if(!font_size){
      font_size = 30;
    }
      $("#hover_caption").css("font-family","Arial");
    $("#hover_caption").css("display","block"); // Bullshit
    $("#hover_caption").css("font-size",font_size+"px");
    $("#hover_caption").css("font-weight","400");
    $("#hover_caption").css("color","#"+document.getElementById("font-color").value);
    $("#hover_caption").css("visibility","visible");
    $("#hover_caption").css("text-transform","none");
    $("#hover_caption").css("text-shadow","0");
    $("#font-size").css("visibility","visible");
    $("#font-color").css("visibility","visible");
    $("#caption_content").css("visibility","visible");
  }
  else if(meme_type == "subtitle"){
  $("#hover_caption").css("font-family","Arial");
    $("#hover_caption").css("display","block"); // Bullshit
    $("#hover_caption").css("font-size",17+"px");
    $("#hover_caption").css("font-weight","500");
    $("#hover_caption").css("color","#"+document.getElementById("font-color").value);

    $("#hover_caption").css("visibility","visible");
    $("#hover_caption").css("text-transform","none");
    $("#hover_caption").css("text-shadow","0");
    $("#font-size").css("visibility","visible");
    $("#font-color").css("visibility","visible");
    $("#caption_content").css("visibility","visible");
meme_size_post = 14;

  }


           }
           function sleep (time) {
    return new Promise((resolve) => setTimeout(resolve, time));
  }

  // change video to start point
   $(document.body).on("mouseup", "#marker", function (e) {
     sleep(.5).then(() => {sleep
      // Do something after the sleep!
  })
   v_point.currentTime = gif_start;
     v_point.play();
           });



  //resizable div
});
