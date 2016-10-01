<?php
ini_set('display_errors', 'on');
include 'database/database_connect.php';
$image_id = $_POST['image_id'];
session_start();
if($_SESSION['user_id']){
  $user_id=$_SESSION['user_id'];
}
else{
$user_id=$_SERVER['REMOTE_ADDR'];
}
$type = $_POST['type'];
if($type == "upvote"){
  $sql = $conn->prepare("Delete  from upvote where image_id= :image_id and user_id = :user_id");

$sql->execute(array(
'image_id'=>$image_id,
'user_id'=>$user_id
));
$sql = $conn->prepare("Insert into upvote  (image_id,count,type,user_id) VALUES(:image_id,'1','upvote',:user_id)");

$sql->execute(array(
'image_id'=>$image_id,
'user_id'=>$user_id
));

echo 'upvote';
}
else{
  $sql = $conn->prepare("Delete  from upvote where image_id= :image_id and user_id = :user_id");

$sql->execute(array(
'image_id'=>$image_id,
'user_id'=>$user_id
));
$sql = $conn->prepare("Insert into upvote  (image_id,count,type,user_id) VALUES(:image_id,'-1','downvote',:user_id)");

$sql->execute(array(
'image_id'=>$image_id,
'user_id'=>$user_id
));

echo 'downvote';

}

 ?>
