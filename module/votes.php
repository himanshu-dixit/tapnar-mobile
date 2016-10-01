<?php
ini_set('display_errors', 'off');
include('module/database/database_connect.php');


$start = ($page-1)*16;
$end = $start + 16;

if($_SESSION['user_id']){
  $user_id=$_SESSION['user_id'];
}
else{
$user_id=$_SERVER['REMOTE_ADDR'];
}


$sth = $conn->prepare("SELECT count from upvote where  user_id = :user_id and image_id = :image_id");

$sth->execute(array(
  'image_id' => $image_id,
  'user_id' => $user_id
));
$sth->execute();


$result = $sth->fetchAll();
$count = $result[0][0];





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


<div class="next_header_button upvote" id="upvote" style="color:white;float:left;background-color:#626262;<?php if($count=='1'){ ?> background-color: #6833ff;<?php } ?>">
UPVOTE
</div>
<div class="next_header_button downvote" id="downvote" style="color:white;float:left;margin-left:10px;background-color:#626262;<?php if($count=='-1'){ ?> background-color: rgb(228, 44, 44);<?php } ?>">
DOWNVOTE
</div>
<div style="font-size: 15px;
margin-left: 218px;
position: relative;
padding-top: 8px;">
<strong><?php echo $count;?></strong> Vote
</div>
<?php
if($image_user_id==$_SESSION['user_id'] && $_SESSION['user_id'] <> '0' && $_SESSION['user_id'] <> 1){
?>
<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>delete?u=<?php echo $image_key;?>&format=<?php echo $format;?>&i=<?php echo $image_id;?>">
<div class="delete" id="delete" style="color:white;float:left;margin-left:10px;margin-top:10px;color:red;">
DELETE
</div></a>
<?php

}
?>


<?php if($source){ ?>

<div class="image-source" style="float:right;margin-top:11px;">Source - <a href="<?php echo $source;?>" style="color:white;"><?php echo $domain;?></a></div> <?php } ?>


</div></div>
<?php if($_SESSION['user_id']){ ?>
<script>
$('#upvote').click(function(){

      $.post("http://<?php echo $_SERVER['SERVER_NAME'];?>/module/vote_it",
        {
            type : "upvote",
            image_id : <?php echo $image_id;?>
        },
        function(data, status){
          document.getElementById("upvote").style.backgroundColor = "#6833ff";
  document.getElementById("downvote").style.backgroundColor = "rgb(98, 98, 98)";
        });
});
$('#downvote').click(function(){

      $.post("http://<?php echo $_SERVER['SERVER_NAME'];?>/module/vote_it",
        {
            type : "downvote",
              image_id : <?php echo $image_id;?>
        },
        function(data, status){
  document.getElementById("downvote").style.backgroundColor = "rgb(228, 44, 44)";
  document.getElementById("upvote").style.backgroundColor = "rgb(98, 98, 98)";
        });
});
</script>
  <?php }

  else{
    ?>
    <script>
    $('#upvote').click(function(){

          $.post("http://<?php echo $_SERVER['SERVER_NAME'];?>/module/vote_it",
            {
                type : "upvote",
                image_id : <?php echo $image_id;?>
            },
            function(data, status){
              document.getElementById("upvote").style.backgroundColor = "#6833ff";
      document.getElementById("downvote").style.backgroundColor = "rgb(98, 98, 98)";
            });
    });
    $('#downvote').click(function(){

          $.post("http://<?php echo $_SERVER['SERVER_NAME'];?>/module/vote_it",
            {
                type : "downvote",
                  image_id : <?php echo $image_id;?>
            },
            function(data, status){
      document.getElementById("downvote").style.backgroundColor = "rgb(228, 44, 44)";
      document.getElementById("upvote").style.backgroundColor = "rgb(98, 98, 98)";
            });
    });
    console.log("via ip");
    </script>

    <?php



  }

}


 ?>
