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
$start = 5;
$end = 6;

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
<div class="" id="image_box" style="width:100%;" title="<?php echo $row['title'];?>">
<div class="single_list" >

  <div id="image_view" style="max-height:190px;overflow:hidden;">

    <?php if($format=='mp4' || $format =='gif'){ ?>
    <div class="gif_tag" style=""><strong>GIF</strong></div>

        <?php } ?>

<!--  <img src="http://<?php echo 'tapnar.com';?>/zone/zupload/thumb/f625sw8enm.<?php if($row['format']=="mp4"||$row['format']=="png"){
    echo 'jpg';
  } else { echo $row['format'];}?>" style="width:100%" /> -->


  <img src="http://tapnar.com/zone/zupload/src/f8ma29n9wc.jpg" width="100%" />
</div>

  <div class="single_image_text"<?php if($format=='mp4' || $format =='gif'){ ?> onmouseover="move(this)" onmouseout="change(this)" data-id="<?php echo $row['image_key'];?>" <?php } ?> style='background-image:url("");'>


<div class="info_box">
  <div class="left_info">
<div class="single_image_title"><?php echo substr($row['title'],0,32);?></div>
<div class="single_image_desc">
  <span class="">himanshu</span>
  <span class="single_comments">21 Comments</span>
  <span class="single_view">19 views</span>
</div>
</div>
<div class="right-info">
</div>
</div>
</div>
</div>
</div>
</a>

<?php

}
if($result){ ?>
  <a href="http://<?php echo 'tapnar.com';?>/module/images/index_module.php?page=<?php echo $page+1;?>" class="next_page"></a>

<?php }

if(!$result){
  ?>

  <?php
}
 ?>
