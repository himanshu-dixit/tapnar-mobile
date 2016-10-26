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
        <meta property="og:url"         content="<?php  if($format=="mp4"){ ?>http://tapnar.com/zone/zupload/gif/<?php echo $image_key.'.gif';?><?php } else { ?>http://tapnar.com/zone/zupload/src/<?php echo $image_key.'.'.$format;?><?php } ?>">
          <meta property="og:type"        content="video.other">
          <meta property="og:image"       content="<?php  if($format=="mp4"){ ?>http://tapnar.com/zone/zupload/gif/<?php echo $image_key.'.gif';?><?php } else { ?>http://tapnar.com/zone/zupload/src/<?php echo $image_key.'.'.$format;?><?php } ?>">

            <link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title1;?>/<?php echo $_GET['u'];?>"/>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

 <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="http://localhost/tapnar_mobile/assests/image_page.css" />
  <!--<link rel="stylesheet" href="http://tapnar.com/assests/image_page.css" />-->

</head>
<body>
<?php include 'parts/menu.php';?>

  <!-- Swipe Menu Ends -->
<?php include 'parts/image_page_header.php';?>
<!-- Top Bar Ends -->
<!-- COntent Starts -->
<div class="content main_content">
  <div class="container1 image_container">

<div class="top-layer">


<div class="title">
 Battlefield Intenses Gaming Showdown
</div>

<div class="info_layer">
  <div class="left_info_layer">

  <div class="author">
 By <span class="author_text">himanshu_dixit</span>
  </div>
    <div class="author">
  9 Hour
    <div>
      <div>

  </div>
  </div>
  </div>
  </div>

<div class="right_info_layer">
  <div class="app_notify">Next</div>
</div>

</div>

<div id="image_content">
  <div class="show_content">
  <?php if($format<>'mp4'){ ?>
<img src="http://tapnar.com/zone/zupload/src/<?php echo $image_key.'.'.$format;?>" width="100%">
<?php } else{

if($mode=="gif"){ ?>
<img src="http://tapnar.com/zone/zupload/gif/<?php echo $image_key.'.gif';?>" width="100%">
<?php }
else{
  ?>

  <video id="tapnar-<?php echo $image_key;?>" onmouseover="allow(this)" onmouseout="mute(this)"  class="video-js" preload="auto" style="width:100%;height:100%;" loop autoplay>
     <source src="http://tapnar.com/zone/zupload/src/<?php echo $image_key;?>.mp4" type='video/mp4'>
     <p class="vjs-no-js">
Your Broweser Doesn't Support This Type Of Content. Please Select GIF Mode From Link Below.
     </p>
   </video>

  <?php } } ?>
</div>
</div>

<div>
  <div class="left_info">

    <div class="upvote">

    </div>
    <div class="downvote">

    </div>
    <div class="favorite">

    </div>
    <div class="votes">
    12 Points
    <br>2122 Views<!--to Be Replaced With Count-->
    </div>
  </div>
<div class="right_info">


  <span class="source">Source - <i>Google</i></span>
</div>

</div>
<div class="below_content">
<div class="social_icon_box">
 <div class="social_icon facebook"><center><i class="fa fa_social fa-facebook" aria-hidden="true"></i></center> </div>
 <div class="social_icon twitter"><center><i class="fa fa_social fa-twitter" aria-hidden="true"></i></center> </div>
 <div class="social_icon pinterest"><center><i class="fa fa_social fa-pinterest" aria-hidden="true"></i></center> </div>
   <div class="social_icon reddit"><center><i class="fa fa_social fa-reddit" aria-hidden="true"></i></center> </div>
   <div class="social_icon whatsapp"><center><i class="fa fa_social fa-whatsapp" aria-hidden="true"></i></center> </div>

</div>

</div>

<?php include 'module/comments/comment-button.php';?>
<?php include 'module/comments/type_comment.php';?>


<div>




<!-- Category List Ends-->
<!-- Images Are Load Here
Script starets Her
<script>
$('.scroll').jscroll({
  debug:true ,
        loadingHtml: '</div><div><center><img src="http://tapnar.com/zone/zupload/src/f61qwse48q.jpg" /></center></div>',
    padding: 20
});
</script>
-->
</div>
</div>

<div class="open_in_app">
  <center>
  <div class="open_button">
    Write Comment
  </div>
</center>
</div>

<script>

$( ".open_in_app" ).click(function() {
 document.getElementsByClassName("open_in_app")[0].style = "display:none;";
  document.getElementsByClassName("write_comment_box")[0].style = "display:block;";
});

</script>


<?php include('parts/footer.php');?>
</body>
</html>
