<?php
session_start();
ini_set('display_errors', 'off');
include 'database/database_connect.php';
include 'unique_filename.php';
$url = $_POST['url'];
if($_SESSION['user_id']){
  $user_id = $_SESSION['user_id'];
}
else{
  $user_id=0;
}
$type = 'in_process';
$source = $url;
$category_id = 1;

$unique_key = uniqid_base36();




function get_url_hostname($url) {

    $parse = parse_url($url);
    return str_ireplace('www.', '', $parse['host']);

}
$y_sites = array("youtube.com", "facebook.com", "yahoo.com", "vimeo.com", "dailymotion.com", "viceshow.com", "twitter.com","9gag.com","imgur.com","tumblr.com");

$url = $_POST['url'];
$domain = get_url_hostname($url);

if (in_array($domain, $y_sites))
  {
// youtube -dl


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
':format'=>"mp4"


   ));


$gen_name = "/var/www/html/zone/uploads/".$unique_key.".mp4";

if($user_id>0&&$user_id<10){
$exec = 'youtube-dl -f 22 -o '.$gen_name.' '.$url;
}
else{
$exec = 'youtube-dl -f 18 -o '.$gen_name.' '.$url;
}

$out1 = shell_exec($exec);

  echo "http://".$_SERVER['SERVER_NAME']."/process?u=".$unique_key;

//redirect to process part

//var_dump($out1);
//echo 'this';
  }
else
  {




// remote_url
/*

$file_type = substr($url,-3,3);
$gen_name = "/var/www/html/zone/uploads/my.".$file_type;
$exec = 'sudo wget '.$url.' -O '.$gen_name;
$out1 = shell_exec('root');
$out1 = shell_exec($exec);
echo $exec;

*/



function getHeaders($url)
{
  $ch = curl_init($url);
  curl_setopt( $ch, CURLOPT_NOBODY, true );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
  curl_setopt( $ch, CURLOPT_HEADER, false );
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt( $ch, CURLOPT_MAXREDIRS, 3 );
  curl_exec( $ch );
  $headers = curl_getinfo( $ch );
  curl_close( $ch );

  return $headers;
}

function download($url, $path)
{
  # open file to write
  $fp = fopen ($path, 'w+');
  # start curl
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $url );
  # set return transfer to false
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
  curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
  # increase timeout to download big file
  curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
  # write data to local file
  curl_setopt( $ch, CURLOPT_FILE, $fp );
  # execute curl
  curl_exec( $ch );
  # close curl
  curl_close( $ch );
  # close local file
  fclose( $fp );

  if (filesize($path) > 0) return true;
}


$file_type = substr($url,-3,3);

if($file_type=="jpe"){
  $file_type = "jpeg";
}

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
':format'=>$file_type


));


$path = '../zone/uploads/'.$unique_key.'.'.$file_type;

$headers = getHeaders($url);

if($file_type=='png'||$file_type=='gif'||$file_type=='jpg'||$file_type=='jpeg')
if ($headers['http_code'] === 200 and $headers['download_content_length'] < 1024*1024) {
  if (download($url, $path)){
    //redirect to image port
  echo "http://".$_SERVER['SERVER_NAME']."/add_meta.php?u=".$unique_key;
  }
}

if($file_type=='mp4')
if ($headers['http_code'] === 200 and $headers['download_content_length'] < 1024*1024) {
  if (download($url, $path)){
        //redirect to process port
  echo "http://".$_SERVER['SERVER_NAME']."/process?u=".$unique_key;
  }
}




  }



?>
