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
<div class="image_box_left border_image_box" id="image_box" style="width:100%;" title="<?php echo $row['title'];?>">
<div class="single_list" >

  <div id="image_view" class="left_image" style="">

    <?php if($format=='mp4' || $format =='gif'){ ?>
    <div class="gif_tag" style=""><strong>GIF</strong></div>

        <?php } ?>

<!--  <img src="http://<?php echo 'tapnar.com';?>/zone/zupload/thumb/f625sw8enm.<?php if($row['format']=="mp4"||$row['format']=="png"){
    echo 'jpg';
  } else { echo $row['format'];}?>" style="width:100%" /> -->


  <img src="http://tapnar.com/zone/zupload/src/f8ma29n9wc.jpg" width="130px" />
</div>

  <div class="single_image_text single_image_left"<?php if($format=='mp4' || $format =='gif'){ ?> onmouseover="move(this)" onmouseout="change(this)" data-id="<?php echo $row['image_key'];?>" <?php } ?> style='background-image:url("");'>


<div class="info_box left_info_box">
  <div class="left_info">
<div class="single_image_titleF"><?php echo substr($row['title'],0,18);?></div>
<div class="single_image_desc">
<div class="info_left_small view_left_info">


  <!--<span class="single_view small_text small_text_info">19 views</span>-->
  <span class="single_view small_text small_text_info">10 comments</span>

</div>
<div class="left_info_right">
  <div class="votes">
  12<!--to Be Replaced With Count-->
  </div>
  <div class="upvote">

  </div>
  <div class="downvote">

  </div>
  <div class="favorite">

  </div>
</div>

</div>
</div>
<div class="right_info right_info_small">


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
