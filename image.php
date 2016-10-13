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

 <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="http://localhost/tapnar_mobile/assests/image_page.css" />
  <!--<link rel="stylesheet" href="http://tapnar.com/assests/image_page.css" />-->

</head>
<body>
<?php include 'parts/menu.php';?>

  <!-- Swipe Menu Ends -->
<?php include 'parts/header.php';?>
<!-- Top Bar Ends -->
<!-- COntent Starts -->
<div class="content">
  <div class="container1 image_container">
<div class="scroll" style="display:inline-block;">
<?php // include 'module/images/index_module_2.php';?>
</div>




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

  <!-- footer Starts
<?php include('parts/footer.php');?>-->
</body>
</html>
