<?php
ini_set('display_errors', 'off');
include('database/database_connect.php');

$image_key= $_POST['image_key'];
$start_time= $_POST['start_time'];
$duration= $_POST['duration'];
$audio= $_POST['audio'];
$meme_type= $_POST['meme_type'];
$meme_size= $_POST['meme_size']/1.1555; // scaling factor
$meme_x_cor= $_POST['meme_x_cor']/1.1555;
$meme_y_cor= $_POST['meme_y_cor']/1.1555;
$meme_color = $_POST['meme_color'];
$meme_text = $_POST['meme_text'];

if(!$meme_type){
  $meme_type = "none";
}
$sql = $conn->prepare("Select * from before_image_id where image_key= :image_key");
$sql->execute(array(
'image_key'=>$image_key));
$result = $sql->fetch(PDO::FETCH_ASSOC);
echo $image_key.' '.$result['image_key'];
if(!$image_key || $result['image_key']<>$image_key ){
die('Some Error Occurred. Please Upload Again');
}

$end_time = $start_time+$duration;
$gen_name = "/var/www/html/zone/uploads/".$image_key.".mp4";
$out_name = "/var/www/html/zone/uploads/".$image_key."O.mp4";
$out2_name = "/var/www/html/zone/uploads/".$image_key."OO.mp4";
$image_loc = '/var/www/html/zone/uploads/'.$image_key."i.png";
if($audio=='true'){
  $audio_value = '-an ';

}
else{
    $audio_value = '';
}


$exec = 'ffmpeg -ss '.$start_time.' -i '.$gen_name.' -t '.$duration.' '.$audio_value.$out_name;

$out1 = shell_exec($exec);

$last_output_file = $out_name;

$del = 'rm -r '.$gen_name;
$out_del = shell_exec($del);


if($meme_type=="none" ){

}
else{
include 'create_image.php';

$exec_last = 'ffmpeg -i '.$out_name.' -i '.$image_loc.' -filter_complex "overlay=0:0" -codec:a copy '.$out2_name;

$last_output_file = $out2_name;

$out1 = shell_exec($exec_last);


$del = 'rm -r '.$out_name;
$out_del = shell_exec($del);

$del = 'rm -r '.$image_loc;
$out_del = shell_exec($del);

}

echo 'http://'.$_SERVER['SERVER_NAME'].'/add_meta.php?o='.$last_output_file."&u=".$image_key;
 ?>
