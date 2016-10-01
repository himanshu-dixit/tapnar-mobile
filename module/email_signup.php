<?php
ini_set('display_errors', 'off');
$email = $_POST['email'];
$password = md5($_POST['password']);
$name = $_POST['name'];

session_start();
include 'database/database_connect.php';

    $sql = $conn->prepare("Select user_id from user where email= :email and password = :password");
$sql->execute(array(
'email'=>$email,
'password'=>md5($password)
));
$result = $sql->fetch(PDO::FETCH_ASSOC);

if($result['user_id']){

die('email exist');

}
else{


$password = md5($_POST['password']);



$sql = $conn->prepare("INSERT INTO user (email,name,type,password)
VALUES (:email,:name,:type,:password)");

$sql->execute(array(
'name'=>$name,
'email'=>$email,
'type'=>'user_not',
'password'=>md5($password)
));

$sql = $conn->prepare("Select user_id from user where password= :password and email = :email ");

$sql->execute(array(
  'email'=>$email,
  'password'=>md5($password)
));
$result = $sql->fetch(PDO::FETCH_ASSOC);
$_SESSION['user_id'] = $result['user_id'];





}


echo 'http://'.$_SERVER['SERVER_NAME'];


 ?>
