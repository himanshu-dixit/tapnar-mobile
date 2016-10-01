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

$sql ="SELECT image_key,format,title from image,views,upvote WHERE image.image_id = views.image_id AND image.image_id = upvote.image_id and views.type ='daily' GROUP BY image.image_id Order by image.date desc limit ".$start." ,".$end;
  $sth = $conn->prepare($sql);
  //$sth = $conn->prepare("SELECT * from image");

  $sth->execute();


  $result = $sth->fetchAll();
  foreach ($result as $row ) {
    $title =   str_replace(" ","-",$row['title']);

    $title =   str_replace("?","",$title);
  ?>


<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title;?>/<?php echo $row['image_key'];?>">
<div class="col-sm-3" id="image_box" style="min-width: 255px;
max-width: 400px;
width: 260px;">
<div class="single_list" >
  <div class="single_image_text" style='background-image:url("http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/thumb/<?php echo $row['image_key'];?>.<?php if($row['format']=="mp4" || $row['format']=="png" ){
    echo 'jpg';
  } else { echo $row['format'];}?>");'>
<div class="single_image_title"><?php echo substr($row['title'],0,40);?></div>
</div>
</div>
</div>
</a>
<?php

}
if($result){ ?>
  <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/module/images/new.php?page=<?php echo $page+1;?>" class="next_page"></a>

<?php }


if(!$result){
  ?>

  <?php
}
 ?>
