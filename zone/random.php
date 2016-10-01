<?php
ini_set('display_errors', 'off');
include('module/database/database_connect.php');


$start = ($page-1)*16;
$end = $start + 16;

$sql ="SELECT * ,(sum(views.count)/1000+sum(upvote.count)/10 ) as 'score' from image,views,upvote WHERE image.image_id = views.image_id AND image.image_id = upvote.image_id and views.type ='daily' GROUP BY image.image_id  ORDER BY RAND() limit 1";
  $sth = $conn->prepare($sql);
  //$sth = $conn->prepare("SELECT * from image");

  $sth->execute();


  $result = $sth->fetchAll();
  foreach ($result as $row ) {

$image_key1 = $row['image_key'];

  ?>

<?php

}
if($image_id){ ?>
  <a href="image.php?u=<?php echo $image_key1;?>" style="color:white;"><div class="next_header_button" style="color:white;padding-top: 12px;
padding-left: 28px;">
    NEXT
    <div>
</a>
  <?php

}
else{
  header("Location: http://".$_SERVER['SERVER_NAME']."/image.php?u=".$image_key1);
  die();
}

 ?>
