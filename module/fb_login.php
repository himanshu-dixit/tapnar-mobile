<?php
ini_set('display_errors', 'off');
$fb_user_id = $_POST['user_id'];
$fb_user_name = $_POST['name'];
if(!$fb_user_id || !$fb_user_name){
  die('');
}
else{
  session_start();
  include 'database/database_connect.php';

      $sql = $conn->prepare("Select user_id from user where fb_meta_id= :fb_user_id");
  $sql->execute(array(
  'fb_user_id'=>$fb_user_id));
  $result = $sql->fetch(PDO::FETCH_ASSOC);

  if($result['user_id']==$fb_user_id){

$_SESSION['user_id'] = $result['user_id'];

  }
  else{


if($fb_user_id<>"no"){



  $sql = $conn->prepare("INSERT INTO user (email,name,type,fb_meta_id)
  VALUES (:email,:name,:type,:fb_meta_id)");

  $sql->execute(array(
  'name'=>$fb_user_name,
  'email'=>$fb_user_id.'@facebook.com',
  'type'=>'user',
  'fb_meta_id'=>$fb_user_id
  ));

  $sql = $conn->prepare("Select user_id from user where fb_meta_id= :fb_user_id");

$sql->execute(array(
'fb_user_id'=>$fb_user_id));
$result = $sql->fetch(PDO::FETCH_ASSOC);
$_SESSION['user_id'] = $result['user_id'];

}



  }

echo 'http://'.$_SERVER['SERVER_NAME'];


}
 ?>
