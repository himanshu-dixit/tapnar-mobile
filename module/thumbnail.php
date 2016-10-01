<?php
$thumb = "../zone/zupload/thumb/";
$file = "../zone/zupload/src/".$file;   /*Your Original Source Image */
 $pathToSave = $thumb; /*Your Destination Folder */
 $sourceWidth =60;
 $sourceHeight = 60;
 $what = getimagesize($file);
 $file_name = basename($file);/* Name of the Image File*/
 $ext   = pathinfo($file_name, PATHINFO_EXTENSION);

 /* Adding image name _thumb for thumbnail image */
 $file_name = basename($file_name, ".$ext") . '.' . $ext;
 if($what[0]>=$what[0]){
$computed_height = 290/$what[0]*$what[1];
$computed_width = 290;
}
else{
  $computed_width = 192/$what[1]*$what[0];
  $computed_height = 192;
}
 switch(strtolower($what['mime']))
 {
     case 'image/png':
         $img = imagecreatefrompng($file);
         $new = imagecreatetruecolor(290,$computed_height);
        // imagecopy($new,$img,0,0,0,0,$what[0],$what[1]);
           imagecopyresized($new, $img, 0, 0, 0, 0,$computed_width,$computed_height,$what[0],$what[1]);
         header('Content-Type: image/png');
     break;
     case 'image/jpeg':
         $img = imagecreatefromjpeg($file);
         $new = imagecreatetruecolor(290,$computed_height);
    //     imagecopy($new,$img,0,0,0,0,$what[0],$what[1]);
            imagecopyresized($new, $img, 0, 0, 0, 0,$computed_width,$computed_height,$what[0],$what[1]);
         header('Content-Type: image/jpeg');
     break;
     case 'image/gif':
         $img = imagecreatefromgif($file);
         $new = imagecreatetruecolor(290,$computed_height);
        // imagecopy($new,$img,0,0,0,0,$what[0],$what[1]);
           imagecopyresized($new, $img, 0, 0, 0, 0,$computed_width,$computed_height,$what[0],$what[1]);
         header('Content-Type: image/gif');
     break;
     default: die();
 }

     imagejpeg($new,$pathToSave.$file_name);
     imagedestroy($new);
     ?>
