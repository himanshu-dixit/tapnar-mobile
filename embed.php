<?php
//ini_set('display_errors', 'on');
session_start();
//echo $_SESSION['user_id'];
function get_url_hostname($url) {

    $parse = parse_url($url);
    return str_ireplace('www.', '', $parse['host']);

}
$image_key = $_GET['u'];
include 'module/database/database_connect.php';
$sql = $conn->prepare("Select * from image where image_key= :image_key");
$sql->execute(array(
'image_key'=>$image_key));
$result = $sql->fetch(PDO::FETCH_ASSOC);
$image_id = $result['image_id'];
$image_user_id = $result['user_id'];
if(!$image_id){
  die('sorry');
}
$title = $result['title'];
$user_id = $result['user_id'];
$source = $result['source'];
$format = $result['format'];

$tag = $result['tags'];

$mode = $_GET['mode'];

if(!$mode){
  $mode = "none";
}

$domain = get_url_hostname($source);


$sql = $conn->prepare("INSERT INTO views ( image_id,count,type)
VALUES (:image_id,:value,:type)");

$sql->execute(array(
'image_id'=>$image_id,
'value'=> 1,
'type'=>'daily'
));



$sql = $conn->prepare("INSERT INTO upvote ( image_id,count,type,user_id)
VALUES (:image_id,:value,:type,:user_id)");

$sql->execute(array(
'image_id'=>$image_id,
'value'=> 1,
'type'=>'initial',
'user_id'=>'0'

));



if($user_id<>0){

$sql = $conn->prepare("Select * from user where user_id= :user_id");
$sql->execute(array(
'user_id'=>$user_id));
$result = $sql->fetch(PDO::FETCH_ASSOC);
$user_name = $result['name'];
}

?>
<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo $title;?></title>
<style>
body{
  margin: 0px;
  padding: 0px;
}
iframe { width:100% ; // set your width here
        height:100% ;
    border:none ;
}
</style>
</head>
<body>




<div class="content">


<div id="image_content">
  <?php if($format<>'mp4'){ ?>
<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key.'.'.$format;?>" width="100%">
<?php } else{

if($mode=="gif"){ ?>
<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/gif/<?php echo $image_key.'.gif';?>" width="100%">
<?php }
else{
  ?>

  <video id="tapnar-<?php echo $image_key;?>" onmouseover="allow(this)" onmouseout="mute(this)"  class="video-js" preload="auto" style="width:100%;height:100%;" loop muted autoplay>
     <source src="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key;?>.mp4" type='video/mp4'>
     <p class="vjs-no-js">
    <img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/gif/<?php echo $image_key.'.gif';?>" width="100%">
     </p>
   </video>

  <?php } } ?>
</div>
<div class="image_below">
    <div> <div>
<div>

<div class="image_below2">


<div class="right_box">
  <?php if($format=="mp4" && $mode == "none") { ?>

  <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/image.php?u=<?php echo $image_key;?>&mode=gif" style="color:white;"><div class="gif_mode"> View In GIF mode</div></a>

  <?php }
  else if($format=="mp4") { ?>

  <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/image.php?u=<?php echo $image_key;?>" style="color:white;"><div class="gif_mode"> View In HD mode</div></a>

  <?php }

  ?>
  <!--
<div class="advance_option"> Advance Option</div>-->

</div>
<?php if($format=="mp4" && $mode =="none") { ?>

<script>

var ua = navigator.userAgent.toLowerCase();
var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
if(isAndroid) {
document.getElementById("tapnar-<?php echo $image_key;?>").controls = true;
}
function allow(x) {
    x.muted = false;
}

function mute(x) {
    x.muted = true;
}
</script>

  <?php } ?>





  </div>
</div>


</div></div></div>

</div>

</body>
</html>
