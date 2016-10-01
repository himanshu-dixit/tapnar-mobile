<?php
ini_set('display_errors', 'off');
include('module/database/database_connect.php');
include('../database/database_connect.php');
$page=$_GET['page'];
$category_id=$_POST['id'];
if(!$category_id){
  $category_id=$_GET['id'];
}

if(!$page){
  $page = 1;
}
$start = ($page-1)*16;
$end = $start + 16;
if($category_id){
  $sql ="SELECT image_key,format,title  ,(sum(views.count)/1000+sum(upvote.count)/10 ) as 'score' from image,views,upvote WHERE image.image_id = views.image_id AND image.image_id = upvote.image_id and views.type ='daily' and image.category_id='".$category_id."' GROUP BY image.image_id Order by score desc limit ".$start." ,".$end;
    $sth = $conn->prepare($sql);
    //$sth = $conn->prepare("SELECT * from image");

    $sth->execute();

}

else{
  $sql ="SELECT image_key,format,title ,(sum(views.count)/1000+sum(upvote.count)/10 ) as 'score' from image,views,upvote WHERE image.image_id = views.image_id AND image.image_id = upvote.image_id and views.type ='daily' GROUP BY image.image_id Order by score desc limit ".$start." ,".$end;
    $sth = $conn->prepare($sql);
    //$sth = $conn->prepare("SELECT * from image");

    $sth->execute();

}


  $result = $sth->fetchAll();
  foreach ($result as $row ) {

    $title =   str_replace(" ","-",$row['title']);
    $title =   str_replace("?","",$title);
  ?>


<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title;?>/<?php echo $row['image_key'];?>">
<div class="col-sm-4" id="image_box" style="min-width: 255px;
max-width: 400px;
width: 260px;">
<div class="single_list" >
  <div class="single_image_text" style='background-image:url("http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/thumb/<?php echo $row['image_key'];?>.<?php if($row['format']=="mp4" || $row['format']=="png"){
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
  <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/module/images/category.php?page=<?php echo $page+1;?>&id=<?php echo $category_id;?>" class="next_page"></a>

<?php }

if(!$result){
  ?>

  <?php
}
 ?>
