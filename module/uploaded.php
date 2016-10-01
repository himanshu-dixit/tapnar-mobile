<?php
include 'database/database_connect.php';
include 'unique_filename.php';

if($_SESSION['user_id']){
  $user_id = $_SESSION['user_id'];
}
else{
  $user_id=1;
}
$type = 'in_process';
$source = $url;
$category_id = 1;

$unique_key = uniqid_base36();

$upload_dir = '../zone/uploads';
if (!empty($_FILES))
{



$name = $_FILES["file"]["name"];
$ext = end((explode(".", $name))); # extra () to prevent notice

$ext = strtolower($ext);

     $tempFile = $_FILES['file']['tmp_name'];//this is temporary server location



     // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
     $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $upload_dir. DIRECTORY_SEPARATOR;

     // Adding timestamp with image's name so that files with same name can be uploaded easily.
     $mainFile = $uploadPath.$unique_key.'.'.$ext;

     move_uploaded_file($tempFile,$mainFile);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = $conn->prepare("INSERT INTO before_image_id ( user_id, title,type,category_id,source,image_key,format)
     VALUES (:user_id,:title,:type,:category_id,:source,:image_key,:format)");

     $sql->execute(array(
     'user_id'=>'2',
     'title'=> "doesn't matter",
     'type'=>'under_progress',
     'category_id'=>'1',
     'image_key'=>$unique_key,
     'source'=>$url,
     ':format'=>$ext


     ));

}

if($ext=="mp4"){
  echo "http://".$_SERVER['SERVER_NAME']."/process.php?u=".$unique_key;
}
else{
    echo "http://".$_SERVER['SERVER_NAME']."/add_meta.php?u=".$unique_key;
}

?>
