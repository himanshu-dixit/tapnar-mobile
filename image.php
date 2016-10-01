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
$title1 =   str_replace(" ","-",$title);
$title1 =   str_replace("?","",$title);
?>
<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo $title;?> | Tapnar</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<meta name="description" content="Tapnar | Most Popular Images & GIF On Internet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta property="fb:app_id"      content="1031922230219226">
        <meta property="og:site_name"   content="TAPNAR">
        <meta property="og:url"         content="<?php  if($format=="mp4"){ ?>http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/gif/<?php echo $image_key.'.gif';?><?php } else { ?>http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key.'.'.$format;?><?php } ?>">
          <meta property="og:type"        content="video.other">
          <meta property="og:image"       content="<?php  if($format=="mp4"){ ?>http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/gif/<?php echo $image_key.'.gif';?><?php } else { ?>http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key.'.'.$format;?><?php } ?>">

            <link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title1;?>/<?php echo $_GET['u'];?>"/>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


  <link rel="stylesheet" href="http://tapnar.com/assests/image_page.css" />

</head>
<body>
<?php include('parts/header.php');?>
<!-- navbar Ends-->
  </div>
</div>
</div>
<!-- Top Bar Ends -->
<?php include('parts/category_box.php');?>


<div class="content">
  <div class="container main_image_body">
<div class="col-md-9 content_box" style="width: 743px; float: left;">
<div id="image_header">
<div class="image_header_left">
  <div class="image_title_head"><?php echo $title;?></div>
  <div class="image_uploader_left"><?php echo $user_name; if(!$user_name){ echo 'Anonymous'; } ?></div>
</div>
<div class="image_header_right">
<?php include('random.php'); ?></div>

</div>

</div>
</div>

<div id="image_content">
  <?php if($format<>'mp4'){ ?>
<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key.'.'.$format;?>" width="100%">
<?php } else{

if($mode=="gif"){ ?>
<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/gif/<?php echo $image_key.'.gif';?>" width="100%">
<?php }
else{
  ?>

  <video id="tapnar-<?php echo $image_key;?>" onmouseover="allow(this)" onmouseout="mute(this)"  class="video-js" preload="auto" style="width:100%;height:100%;" loop autoplay>
     <source src="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key;?>.mp4" type='video/mp4'>
     <p class="vjs-no-js">
Your Broweser Doesn't Support This Type Of Content. Please Select GIF Mode From Link Below.
     </p>
   </video>

  <?php } } ?>
</div>
<div class="image_below">
    <div>  <?php include('module/votes.php'); ?><div>
<div><div>

</div>

<div class="image_below2">
<div class="social_icon_box">
<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title1;?>/<?php echo $_GET['u'];?>" target='_blank' >  <div class="social_icon facebook"><center><i class="fa fa-facebook" aria-hidden="true"></i></center> </div></a>
  <a href="http://twitter.com/share?url=<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title1;?>/<?php echo $_GET['u'];?>&via=TAPNAR" target='_blank' >  <div class="social_icon twitter"><center><i class="fa fa-twitter" aria-hidden="true"></i></center> </div></a>
  <a href="http://www.pinterest.com/pin/create/link/?url=<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title1;?>/<?php echo $_GET['u'];?>&media=<?php if($format=="gif" || $format =='mp4'){ ?> http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/gif/<?php echo $image_key.'.gif'; } else{ ?>http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key.'.'.$format; } ?> &description=via%20TAPNAR" target='_blank' >  <div class="social_icon pinterest"><center><i class="fa fa-pinterest" aria-hidden="true"></i></center> </div></a>
  <a href="http://www.reddit.com/submit?url=<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title1;?>/<?php echo $_GET['u'];?>" target='_blank' >      <div class="social_icon reddit"><center><i class="fa fa-reddit" aria-hidden="true"></i></center> </div></a>

</div>

<div class="right_box">
  <?php if($format=="mp4" && $mode == "none") { ?>

  <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/image?u=<?php echo $image_key;?>&mode=gif" style="color:white;"><div class="gif_mode"> View In GIF mode</div></a>

  <?php }
  else if($format=="mp4") { ?>

  <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/image?u=<?php echo $image_key;?>" style="color:white;"><div class="gif_mode"> View In HD mode</div></a>

  <?php }

  ?>
  <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/single_view?u=<?php echo $image_key;?>" style="color:white;"><div class="gif_mode">Screen Mode</div></a>

  <!--
<div class="advance_option"> Advance Option</div>-->
<div class="image-download"><a href="download?u=<?php echo $image_key;?><?php if($mode=='gif'){ ?>&mode=gif<?php }?>&format=<?php echo $format;?>" style="color:white;font-size:14px;">Download</a></div>
</div>
</div>
<?php if($format=="mp4" && $mode =="none") { ?>

<script>

var ua = navigator.userAgent.toLowerCase();
var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
if(isAndroid) {
document.getElementById("tapnar-<?php echo $image_key;?>").controls = true;
}
/*
function allow(x) {
    x.muted = false;
}

function mute(x) {
    x.muted = true;
}*/
</script>

  <?php } ?>


<div class="image_embed">
<div class="left_title" style="padding:17px 0px 0px 12px;">EMBED</div>
<div class="left_box">
<input type="text" rows="1" cols="70" onclick="this.focus();this.select()" readonly="readonly" style="color: gray;height: 41px;padding-top:8px;width:100%;" value="<iframe src='//tapnar.com/embed?u=<?php echo $image_key;?>&mode=<?php echo $mode;?>' width='100%' height='100%' style='border:none;overflow:none;' allowFullScreen></iframe><p><a href='http://tapnar.com/image?u=<?php echo $image_key;?>'>via TAPNAR</a></p>">

</div>
</div>

<?php
$tagarray =  explode(',', $tag);
if($tagarray){

 ?>
<div class="image_tags">
  <div class="left_title"  style="padding:10px 0px 0px 12px;" >TAGS</div>
  <div class="left_box">
    <?php
    foreach ($tagarray as $item) {
      if($item){
        echo "<a href='http://".$_SERVER["SERVER_NAME"]."/search?search=".$item."' ><div class='tag_box'><center>".$item."</center></div></a>";
    }}
  ?>


  </div>
</div>

<?php } ?>
<div id="comments" style="margin-top:20px;">

</div>
</div></div></div>
<div class="col-md-3" style="width: 300px; float: left;">

<?php include('module/images/sidebar.php'); ?>



</div>
</div></div>
</div>
  <!-- footer Starts -->
<?php include('parts/footer.php');?>
</body>
</html>
