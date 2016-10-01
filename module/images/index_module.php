<?php

ini_set('display_errors', 'off');
include('module/database/database_connect.php');
include('../database/database_connect.php');
$page=$_GET['page'];
if(!$page){
  $page = 1;
}
$start = ($page-1)*16;
$end = $start + 16;

$sql ="SELECT image_key,format,title,(sum(views.count)/1000+sum(upvote.count)/10 ) as 'score' from image,views,upvote WHERE image.image_id = views.image_id AND image.image_id = upvote.image_id and views.type ='daily' GROUP BY image.image_id Order by score desc limit ".$start." ,".$end;
  $sth = $conn->prepare($sql);
  //$sth = $conn->prepare("SELECT * from image");

  $sth->execute();



  $result = $sth->fetchAll();
  foreach ($result as $row ) {
  $title =   str_replace(" ","-",$row['title']);
    $title =   str_replace("?","",$title);
$format = $row['format'];
  ?>


<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title;?>/<?php echo $row['image_key'];?>">
<div class="col-sm-3" id="image_box" style="min-width: 255px;
max-width: 400px;
width: 260px;" title="<?php echo $row['title'];?>">
<div class="single_list" >
  <div class="single_image_text"<?php if($format=='mp4' || $format =='gif'){ ?> onmouseover="move(this)" onmouseout="change(this)" data-id="<?php echo $row['image_key'];?>" <?php } ?> style='background-image:url("http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/thumb/<?php echo $row['image_key'];?>.<?php if($row['format']=="mp4"||$row['format']=="png"){
    echo 'jpg';
  } else { echo $row['format'];}?>");'>
  <?php if($format=='mp4' || $format =='gif'){ ?>
<div class="gif_tag" style="float:right;margin-right:15px;font-size:16px;margin-top:5px; text-shadow: 1px 1px #000;"><strong>GIF</strong></div>

    <?php } ?>
<div class="single_image_title"><?php echo substr($row['title'],0,32);?></div>
</div>
</div>
</div>
</a>

<?php

}
if($result){ ?>
  <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/module/images/index_module.php?page=<?php echo $page+1;?>" class="next_page"></a>

<?php }

if(!$result){
  ?>

  <?php
}
 ?>