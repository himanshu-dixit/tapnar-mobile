<?php
error_reporting(E_ALL);
ini_set('display_errors', 'off');
include 'module/database/database_connect.php';
$image_key = $_GET['u'];


    $sql = $conn->prepare("Select * from before_image_id where image_key= :image_key");
$sql->execute(array(
'image_key'=>$image_key));
$result = $sql->fetch(PDO::FETCH_ASSOC);

if(!$image_key || $result['image_key']<>$image_key ){
  die('Some Error Occurred. Please Upload Again');
}

?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Upload | Tapnar</title>
  <meta charset="utf-8" />
<meta name="description" content="Tapnar | Most Popular Images & GIF On Internet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link href="http://vjs.zencdn.net/5.10.4/video-js.css" rel="stylesheet">
 <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
 <script src="jscolor.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

 <!-- If you'd like to support IE8 -->
 <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

 <script src="main.js" async></script>
    <link rel="stylesheet" href="assests/common.css" />
  <link rel="stylesheet" href="assests/process.css" />
  <?php include 'parts/head_tag.php';?>
</head>
<body>
<?php include 'parts/header.php';?>

</div>
<!-- Top Bar Ends -->
<!-- COntent Starts -->


<div class="content" id="start">
  <div class="container main_image_body">

<center>
<div id ="process_bar">

 <div class="video-text" id="hover_text" ><center><div id="hover_caption" style="visibility:hidden;min-width:30px;min-height:20px;max-height:80px;height:80px;background: none;text-align: center;">Hello</div></center></div>
<div class="hover">
  <video id="video-dl" class="video-js"  style="width:100%;height:100%;" autoplay  preload="metadata">
     <source src="/zone/uploads/<?php echo $image_key;?>.mp4" type='video/mp4'>

   </video>
 </div>

</div><script>
<?php

$ffmpeg_path = 'ffmpeg'; //or: /usr/bin/ffmpeg - depends on your installation
$vid = 'zone/uploads/'.$image_key.'.mp4'; //Replace here!

if (file_exists($vid)) {

    $video_attributes = _get_video_attributes($vid, $ffmpeg_path);



$duration = $video_attributes['hours']*3600+ $video_attributes['mins']*60+$video_attributes['secs']+ $video_attributes['ms']*.001;
          echo "var duration = ".$duration.";";


} else { echo 'File does not exist.'; }

function _get_video_attributes($video, $ffmpeg) {

    $command = $ffmpeg . ' -i ' . $video . ' -vstats 2>&1';
    $output = shell_exec($command);

    $regex_sizes = "/Video: ([^,]*), ([^,]*), ([0-9]{1,4})x([0-9]{1,4})/";
    if (preg_match($regex_sizes, $output, $regs)) {
        $codec = $regs [1] ? $regs [1] : null;
        $width = $regs [3] ? $regs [3] : null;
        $height = $regs [4] ? $regs [4] : null;
     }

    $regex_duration = "/Duration: ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}).([0-9]{1,2})/";
    if (preg_match($regex_duration, $output, $regs)) {
        $hours = $regs [1] ? $regs [1] : null;
        $mins = $regs [2] ? $regs [2] : null;
        $secs = $regs [3] ? $regs [3] : null;
        $ms = $regs [4] ? $regs [4] : null;
    }

    return array (
            'hours' => $hours,
            'mins' => $mins,
            'secs' => $secs,
            'ms' => $ms
    );


}

 ?>
</script>
<script>
<?php
$user_id = $_SESSION['user_id'];
if($user_id>0&&$user_id<10){
?>
var allowed = duration;
<?php } else { ?>
var allowed = 30;
 <?php } ?>

</script>

   <div id="progress_bar_down">

<div id="timeline"></div>
<div id="moved"><div class="marker" id="marker"></div></div>
   </div>
   </center>

<script>
var vid = document.getElementById("video-dl");

vid.currentTime = 50;
</script>


</div>



<div class="container" style="width:770px;">


<div id="star_time" style="margin-top:50px;">
<div id="star_header">
<div id="header_text">Start Time</div>
<div id="header_value">  <input id="start_time" name="start_time" placeholder="Start Time" type="text" style=" border: none !important;padding-left:7px;width:90px;height:40px;margin-top:-5px;"> </div>
 <input id="hidden_time" name="hidden_time" placeholder="" type="text" style="display:none;">
</div>
<br>
<!--<div id="start_bar">


</div>-->
</div>


<br><br>

<div id="duration" style="margin-top:-05px;">
  <div id="star_header">
  <div id="duration_text">Duration</div>
  <div id="duration_value">  <input id="duration_time" name="start_time" placeholder="Duration" type="text" style=" border: none !important;padding-left:7px;width:90px;height:40px;margin-top:-5px;">  </div>
  </div>
<br><br>
<div id="duration_bar">

</div>

</div>
<br><br>

<div>

     <div id="progress_bar_down">

  <div id="timeline1"></div>
  <div id="moved1"><div class="marker" id="marker2" style="height:35px;left:363.5px;"></div></div>
     </div>

</div>

<br><br><br>



<div id="audio">
  <div id="audio_text">Audio</div>
  <div id="audio_value"><input type="checkbox" id="audio_check" name="audio" value="disable" style="margin-right:10px;">Disable Audio</div>
</div>
<br>

<br>
<div id="caption">

  <div id="caption_text" stlye="margin-top:6px;">Caption</div>
  <div id="caption_value"> <select type="caption" id="caption_type" style="color:black; height:40px;"> >
  <option value="none" id="none">None</option>
  <option value="meme" id="meme">MEME</option>
  <option value="simple" id="simple">Simple</option>
  <option value="subtitle" id="subtitle">Subtitle</option>
</select>
<input id="font-size" name="font-size" placeholder="font-size" type="text" value="14" style="  margin-left:20px;color:black;border: none !important;padding-left:7px;width:80px;height:40px;margin-top:-5px;">
<input id="font-color" class="jscolor"  name="font-size" placeholder="font-size" type="text" value="14" style=" margin-left:20px;color:black;border: none !important;padding-left:7px;width:90px;height:40px;margin-top:-5px;">

 <br><br>
<input id="caption_content" name="start_time" placeholder="Caption Here" type="text" style=" color:black;border: none !important;padding-left:7px;width:560px;height:50px;margin-top:-5px;">
</div>

</div>
</div>
<div id="processing" class="drag_drop_area" style="display:none;">
<center>
<br>
<img src="assests/loading.gif" height="100px" style="margin-top:20px;" />
</center>
<center>
<div class="value_process">

</div>
</center>
</div>


<center>
<div class="create_gif" id="create_submit">Create GIF</div>
</center>

</div>
</div>

</div>
</div>
</div>

<script >


var count = 1;



$('#create_submit').click(function(){
  if(count==1){
  var image_key = "<?php echo $image_key;?>";
count = count+1;

  console.log(start_time_post);
 document.getElementById('processing').setAttribute("style","display:block");


    $.post("module/ffmpeg",
      {
          image_key: image_key,
          start_time:start_time_post,
          duration:duration_post,
          audio:audio_post,
          meme_type:meme_type_post,
          meme_size:meme_size_post,
          meme_x_cor:meme_x_cor_post,
          meme_y_cor:meme_y_cor_post,
          meme_color:meme_color_post,
          meme_text:meme_text_post
      },
      function(data, status){

          window.location.assign(data);
      });

}
});
</script>

  <!-- footer Starts -->
<?php include('parts/footer.php'); ?>
</div>
</div>
</body>
</html>
