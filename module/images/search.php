<?php
ini_set('display_errors', 'off');
include('../database/database_connect.php');

include('module/database/database_connect.php');
$page = $_GET['page'];
$search = $_GET['search'];
if(!$search ){
  $search = $_POST['search'];
}

if(!$page){
  $page = 1;
}

$start = ($page-1)*16;
$end = $start + 16;


$sql = 'SELECT image_key,format,title ,MATCH (image.title) AGAINST (:search IN BOOLEAN MODE)+ sum(views.count)/1000+sum(upvote.count)/10 +MATCH (image.tags) AGAINST (:search IN BOOLEAN MODE) as "score"
                  FROM image,views,upvote
                  WHERE image.image_id = views.image_id AND image.image_id = upvote.image_id  AND (MATCH ( image.title )
                  AGAINST (:search ) OR MATCH ( image.tags )
                  AGAINST (:search ))  GROUP BY image.image_id Order by score desc limit '.$start." ,".$end;

//echo $sql;

$sth = $conn->prepare($sql);

$sth->execute(array(
  'search' => $search
));


$result = $sth->fetchAll();
foreach ($result as $row ) {
  $title =   str_replace(" ","-",$row['title']);

    $title =   str_replace("?","",$title);
?>


<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title;?>/<?php echo $row['image_key'];?>">
<div class="col-sm-3" id="image_box">
<div class="single_list" >
<div class="single_image_text" style='background-image:url("http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/thumb/<?php echo $row['image_key'];?>.<?php if($row['format']=="mp4" || $row['format']=='gif' || $row['format']=="png"){
  echo 'jpg';
} else { echo $row['format'];}?>");'>
<div class="single_image_title"><?php echo substr($row['title'],0,40);?></div>
</div>
</div>
</div>
</a>
<?php

}
if($result){
  $title =   str_replace(" ","-",$row['title']);
      $title =   str_replace("?","",$title);

   ?>
<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/module/images/new.php?page=<?php echo $page+1;?>" class="next_page"></a>

<?php }


if(!$result){
?>

<?php
}
?>
