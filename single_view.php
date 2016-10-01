
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
$title1 =   str_replace(" ","-",$title);
$title1 =   str_replace("?","",$title);


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

<!DOCTYPE html>
<html><head>

          <title><?php echo $title;?> | Tapnar</title>

        <meta id="viewport" name="viewport" content="width=820, user-scalable=yes">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        <meta charset="utf-8" />
          <meta name="description" content="Tapnar | Most Popular Images & GIF On Internet">

              <meta property="fb:app_id"      content="1031922230219226">
              <meta property="og:site_name"   content="TAPNAR">
              <meta property="og:url"         content="<?php  if($format=="mp4"){ ?>http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/gif/<?php echo $image_key.'.gif';?><?php } else { ?>http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key.'.'.$format;?><?php } ?>">
                <meta property="og:type"        content="video.other">
                <meta property="og:image"       content="<?php  if($format=="mp4"){ ?>http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/gif/<?php echo $image_key.'.gif';?><?php } else { ?>http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key.'.'.$format;?><?php } ?>">

                  <link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title1;?>/<?php echo $_GET['u'];?>"/>

        <!--[if lte IE 8]><script type="text/javascript" src="//s.imgur.com/min/iepoly.js?1470333945"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="assests/single_view.css">

<style type="text/css">
html,body{
  min-width: 820px;
}
    #content, #video {
        width:  720px;
        height: 404px;
    }

    #chrome, #progress {
        width: 720px;
    }
    #container1{
   position: absolute;
   top: 50%;
   margin-top: -200px;/* half of #content height*/
   left: 0;
   width: 100%;
}
#content1 {
   width: 624px;
   margin-left: auto;
   margin-right: auto;
   height: 395px;

}
</style>

    </head>
    <body class=" firefox" id="body">
      <div id="container1">
  <div id="content1">
        <div id="content">

            <div class="vid-container">



                <div class="post-image">


            <div class="video-container" >

              <?php if($format<>'mp4'){ ?>
            <img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key.'.'.$format;?>" class="mybox" width="100%">
            <?php } else{

            if($mode=="gif"){ ?>
            <img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/gif/<?php echo $image_key.'.gif';?>" class="mybox" width="100%">
            <?php }
            else{
              ?>

              <video id="tapnar-<?php echo $image_key;?>" onmouseover="allow(this)" onmouseout="mute(this)"  class="video-js" preload="auto" style="width:100%;height:100%;" class="mybox" loop autoplay >
                 <source src="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key;?>.mp4" type='video/mp4'>
               </video>

              <?php } } ?>

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






        </div>

</div>

            </div>

            <div id="chrome">

                <div class="my_image">
                    <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title1;?>/<?php echo $_GET['u'];?>">Tapnar</a>
                </div>
                <div class="controls">
                    <a href="http://tapnar.com/download?u=<?php echo $image_key;?>&format=<?php echo $format;?>">Download</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
      </div>
    </div>


<script>

$(window).load(function(){
var height = $('.vid-container').height();
if(height<160){
  var height = $('.post-image').height();
}
if(height>480 && height<625){

document.getElementById("container1").style.top = (height/2)+"px";

}
if(height>624 && height<700){

document.getElementById("container1").style.top = (height/3)+50+"px";

}
if(height>700 && height<895){

document.getElementById("container1").style.top = (height/3.3)+50+"px";

}
if(height>895){
  $("#container1").css({top: 200});
document.getElementById("container1").style.top = "200px";

}
console.log(height);});




</script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71984647-1', 'auto');
  ga('send', 'pageview');

</script>

</body></html>
