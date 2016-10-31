<?php
ini_set('display_errors', 'on');
include('module/database/database_connect.php');
session_start();
$user_id = $_SESSION['user_id'];
$image_key = $_GET['u'];
$image_id = $_GET['i'];
$format = $_GET['format'];
if($_SESSION['user_id'] && $image_id && $image_key){
$sth = $conn->prepare("Delete from image where  user_id = :user_id and image_id = :image_id");

$sth->execute(array(
  'image_id' => $image_id,
  'user_id' => $_SESSION['user_id']
));
$sth->execute();
$sth = $conn->prepare("Delete from upvote where image_id = :image_id");

$sth->execute(array(
  'image_id' => $image_id
));
$sth->execute();
$sth = $conn->prepare("Delete from views where image_id = :image_id");

$sth->execute(array(
  'image_id' => $image_id
));
$sth->execute();

$exec ='rm -r /var/www/html/zone/zupload/src/'.$image_key.'.'.$format;
//echo $exec;
$out1 = shell_exec($exec);
if($format=='mp4'){
  $exec ='rm -r /var/www/html/zone/zupload/gif/'.$image_key.'.gif';
  $out1 = shell_exec($exec);
}
if($format=="gif"){
$exec ='rm -r /var/www/html/zone/zupload/thumb/'.$image_key.'.gif';
$out1 = shell_exec($exec);
}
else{
  $exec ='rm -r /var/www/html/zone/zupload/thumb/'.$image_key.'.'.$format;
  $out1 = shell_exec($exec);
}
}
header('Location: http://'. $_SERVER['SERVER_NAME']);
?>
