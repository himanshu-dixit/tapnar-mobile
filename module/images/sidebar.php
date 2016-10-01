<?php
ini_set('display_errors', 'on');
include('module/database/database_connect.php');




  $sth = $conn->prepare("SELECT image_key,format,title ,MATCH (image.title) AGAINST (:search IN BOOLEAN MODE)+ (sum(views.count)/1000+sum(upvote.count)/10 )+MATCH (image.tags) AGAINST (:search IN BOOLEAN MODE) as 'score' FROM image,views,upvote WHERE image.image_id = views.image_id AND image.image_id = upvote.image_id and image.image_id <> :i_id AND (MATCH ( image.title ) AGAINST (:search ) OR MATCH ( image.tags ) AGAINST (:search ))  GROUP BY image.image_id Order by score desc limit 0 ,5");
  //$sth = $conn->prepare("SELECT * from image");

  $sth->execute(array(
    'i_id' => $image_id,
    'search' => $title
  ));

$ad_count=0;
  $result = $sth->fetchAll();
  if(!$result){
    $sql ="SELECT image_key,format,title ,(sum(views.count)/1000+sum(upvote.count)/10 ) as 'score' from image,views,upvote WHERE image.image_id = views.image_id AND image.image_id = upvote.image_id GROUP BY image.image_id Order by score desc limit 0,5";
      $sth = $conn->prepare($sql);
      //$sth = $conn->prepare("SELECT * from image");

      $sth->execute();


      $result = $sth->fetchAll();

  }
  foreach ($result as $row ) {
    $title =   str_replace(" ","-",$row['title']);

    $title =   str_replace("?","",$title);
  ?>

<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$title;?>/<?php echo $row['image_key'];?>">
    <div class="single_list" >
  <div class="single_image_text" style='background-image:url("http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/thumb/<?php echo $row['image_key'];?>.<?php if($row['format']=="mp4" || $row['format']=="png"){
    echo 'jpg';
  } else { echo $row['format'];}?>");'>

  <div class="single_image_title"><?php echo substr($row['title'],0,40);?></div>
  </div>
    </div>
</a>
<?php if($ad_count=="0") { ?>
<div id="ad_box">
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- Tapnar -->
  <ins class="adsbygoogle"
       style="display:inline-block;width:300px;height:600px"
       data-ad-client="ca-pub-2215762794474693"
       data-ad-slot="6480897166"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</div>
<?php }
$ad_count++;
 } ?>
