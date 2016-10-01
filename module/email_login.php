<?php
ini_set('display_errors', 'off');
$email = $_POST['email'];
$password = md5($_POST['password']);

session_start();
include 'database/database_connect.php';


$sql = $conn->prepare("Select user_id from user where password= :password and email = :email ");

$sql->execute(array(
  'email'=>$email,
  'password'=>md5($password)
));
$result = $sql->fetch(PDO::FETCH_ASSOC);
$_SESSION['user_id'] = $result['user_id'];



if($result['user_id']){
echo 'http://'.$_SERVER['SERVER_NAME'];
}
else{
  echo 'wrong';
}

 ?>
