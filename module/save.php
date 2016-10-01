<?php
//ini_set('display_errors', 'on');
include 'database/database_connect.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!$user_id){
  $user_id=0;
}

$image_key = $_POST['image_key'];
$output = $_POST['output'];
$format = $_POST['format'];
$title = $_POST['title'];
$tags = $_POST['tags'];
$category_id = $_POST['category_id'];
$source = $_POST['source'];


if($format=="mp4"){
if($user_id>0 && $user_id < 10){

}
else{
  $exec = 'ffmpeg -i /var/www/html/zone/uploads/'.$output.' -ss 00:00:00.000 -pix_fmt rgb24 -r 10  -t 01:00:10.000  /var/www/html/zone/zupload/gif/'.$image_key.'.gif';
  $out1 = shell_exec($exec);
}
  $exec ='mv /var/www/html/zone/uploads/'.$output.'  /var/www/html/zone/zupload/src/'.$image_key.'.mp4';

  $out1 = shell_exec($exec);

//ffmpeg -y  -i input.mp4 -f mjpeg -vframes 1 -ss 534 thumbnail.jpg
//   $exec ='ffmpeg -y -i /var/www/html/zone/zupload/src/'.$output.' -f mjpeg -ss 10 -vframes 1 480*360 /var/www/html/zone/zupload/thumb/'.$image_key.'.jpg';
$frame = 1;
   $exec ='ffmpeg -y -i /var/www/html/zone/zupload/src/'.$image_key.'.mp4 -f mjpeg -vframes 1 -ss '.$frame.' /var/www/html/zone/zupload/thumb/'.$image_key.'.jpg';
   $out1 = shell_exec($exec);
   $exec ='ffmpeg -y -i /var/www/html/zone/zupload/src/'.$image_key.'O.mp4 -f mjpeg -vframes 1 -ss '.$frame.' /var/www/html/zone/zupload/thumb/'.$image_key.'.jpg';
   $out1 = shell_exec($exec);
   $exec ='ffmpeg -y -i /var/www/html/zone/zupload/src/'.$image_key.'OO.mp4 -f mjpeg -vframes 1 -ss '.$frame.' /var/www/html/zone/zupload/thumb/'.$image_key.'.jpg';
   $out1 = shell_exec($exec);

}
else{
// create thmb in php
$output = $image_key.".".$format;
$exec ='mv /var/www/html/zone/uploads/'.$output.'  /var/www/html/zone/zupload/src/';
$out1 = shell_exec($exec);

$file = $image_key.'.'.$format;
include 'thumbnail.php';

}




$sql = $conn->prepare("Delete from before_image_id where image_key= :image_key");
$sql->execute(array(
'image_key'=>$image_key));
$result = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $conn->prepare("INSERT INTO image ( user_id, title,type,category_id,source,image_key,format,tags)
VALUES (:user_id,:title,:type,:category_id,:source,:image_key,:format,:tags)");

$sql->execute(array(
'user_id'=>$user_id,
'title'=> $title,
'type'=>$format,
'category_id'=>$category_id,
'image_key'=>$image_key,
'source'=>$source,
':format'=>$format,
':tags'=>$tags
));


$sql = $conn->prepare("Select * from image where image_key= :image_key");
$sql->execute(array(
'image_key'=>$image_key));
$result = $sql->fetch(PDO::FETCH_ASSOC);
$image_id = $result['image_id'];

$sql = $conn->prepare("INSERT INTO upvote ( image_id,count,type,user_id)
VALUES (:image_id,:value,:type,:user_id)");

$sql->execute(array(
'image_id'=>$image_id,
'value'=> 1,
'type'=>'daily',
'user_id'=>0
));


echo 'http://'.$_SERVER['SERVER_NAME'].'/image.php?u='.$image_key;


?>
