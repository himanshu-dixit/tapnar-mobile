<?php
ini_set('display_errors', 'on');


function hex2rgba($color, $opacity = false) {
    $default = 'rgb(0,0,0)';

    if (empty($color))
        return $default;

    if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);

    elseif (strlen($color) == 3)
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);

    else
        return $default;


    $rgb = array_map('hexdec', $hex);

    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;

        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
        $new = implode(",", $rgb);
        $color_rgb = explode(",",$new);

    }
    return $color_rgb;
}

$meme_color = "#".$meme_color;
$color_r = hex2rgba($meme_color)[0];
$color_g = hex2rgba($meme_color)[1];
$color_b = hex2rgba($meme_color)[2];
  //Set the Content Type

  $width = 640;
     $height = 480;
  /*   $text = "My asd";
  $meme_type="afo";
  $meme_color = "FFFFFF";
     $fontsize =40;
     $meme_x_cor = 0;
     $meme_y_cor = 0;
     $image_key = "now";
*/
   $font_size = $meme_size;
   $text = $meme_text;
     $fontpath = realpath('.'); //replace . with a different directory if needed

     $font = "arial";
     $meme_y_cor = $meme_y_cor*1.40+$font_size;
     $meme_x_cor = $meme_x_cor;
     $img = imagecreate($width, $height);
     if($meme_type=="subtitle"){
       $fontsize = 12.4;
     }
     if($meme_type=="meme"){
       $font = "meme";
     }
     // Transparent background

  $outline = imagecolorallocate($img,$color_r,$color_g,$color_b);
  imagecolortransparent($img, $outline);

     // Red text
     $red = imagecolorallocate($img,$color_r,$color_g,$color_b);
     $black = imagecolorallocate($img,0,0,0);

    // imagestring($img, $fontsize, 50, 60, $text, $red);
putenv('GDFONTPATH=' . realpath('.'));
if($meme_type<>"subtitle"){
imagefttext($img, $font_size,0,  $meme_x_cor+1,  $meme_y_cor+1, $black,$font,$text);
}
imagefttext($img, $font_size,0,  $meme_x_cor,  $meme_y_cor, $red,$font,$text);

//putenv('GDFONTPATH=' . realpath('.'));
//imagettftext($img, 25, 0, 75, 300, $white, "arial", $text);

//  header('Content-type: image/png');
  imagepng($img,'../zone/uploads/'.$image_key.'i.png');
  imagedestroy($img);


?>
