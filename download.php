<?php
ini_set('display_errors', 'on');

$image_key = $_GET['u'];
$mode = $_GET['mode'];
if(!$mode){
  $mode = 'none';
}


$format =$_GET['format'];
if($format=="mp4" ){
  $file = "zone/zupload/src/".$image_key.'.mp4';
}
else if($mode=="gif"){
  $file = "zone/zupload/gif/".$image_key.'.gif';
}
else{
  $file = "zone/zupload/src/".$image_key.'.'.$format;
}
echo $file;

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
?>
