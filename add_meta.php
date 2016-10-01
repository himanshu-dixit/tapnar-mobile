<?php
session_start();
$user_id = $_SESSION['user_id'];

if(!$user_id){
  $user_id=0;
}


$image_key = $_GET['u'];
$output = $_GET['o'];
$output = str_replace("/var/www/html/zone/uploads/","",$output);

include 'module/database/database_connect.php';

$sql = $conn->prepare("Select * from before_image_id where image_key= :image_key");
$sql->execute(array(
'image_key'=>$image_key));
$result = $sql->fetch(PDO::FETCH_ASSOC);
if(!$image_key || $result['image_key']<>$image_key ){
die('Some Error Occurred. Please Upload Again');
}
$format = $result['format'];
$date = $result['date'];
$source = $result['source'];

 ?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Save Image | Tapnar</title>
  <meta charset="utf-8" />
<meta name="description" content="Tapnar | Most Popular Images & GIF On Internet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link href="http://vjs.zencdn.net/5.10.4/video-js.css" rel="stylesheet">


  <link rel="stylesheet" href="assests/process.css" />
</head>
<body>
<?php include 'parts/header.php';?>
</div>
<!-- Top Bar Ends -->
<!-- COntent Starts -->


<div class="content" id="start">




<div class="container" style="width:770px;">


<div id="star_time" style="margin-top:50px;">
<div id="star_header">
<div id="header_text">Title </div>
<div id="header_value"> <input id="title" name="Title" placeholder="Title" type="text" style=" color:black;border: none !important;padding-left:7px;width:560px;height:50px;margin-top:-5px;">
</div>  </div>

</div>
<br>
<!--<div id="start_bar">


</div>-->


<br><br>
<br><br>

<div id="duration" style="margin-top:-05px;">
  <div id="star_header">
  <div id="duration_text">Tags</div>
  <div id="duration_value">  <input id="tags" name="start_time" placeholder="Tags Separated By Comma" type="text" style=" color:black;border: none !important;padding-left:7px;width:560px;height:50px;margin-top:-5px;">
  </div> </div>
  </div>
<br><br>
<br><br>

<div id="duration" style="margin-top:-05px;">
  <div id="star_header">
  <div id="duration_text">Category Id</div>
  <div id="duration_value">

    <select id="category_id" name="category" style=" color:black;border: none !important;padding-left:7px;width:560px;height:50px;margin-top:-5px;">
      <option value="0">Select</option>
      <option value="1">Funny</option>
      <option value="2">Meme</option>
      <option value="3">Comic</option>
      <option value="4">Story</option>
      <option value="5">Reaction</option>
      <option value="6">Awesome</option>
      <option value="7">Aww</option>
      <option value="8">TIL</option>
      <option value="9">Creative</option>
      <option value="10">Inspiring</option>
      <option value="11">Science & Tech</option>
      <option value="12">Eat & Burp</option>
            <option value="13">Sit Back & Relax</option>
                <option value="14">Gaming</option>
                    <option value="15">Outdoor</option>
                        <option value="16">Personal</option>
    </select>

    <!-- <input id="category_id" name="category" placeholder="Enter Category Id" type="text" style=" color:black;border: none !important;padding-left:7px;width:560px;height:50px;margin-top:-5px;">-->
  </div> </div>
  </div>
<br><br>

</div>
</div>
<div id="processing" class="drag_drop_area" style="display:none;">
<center>
<br>
<img src="assests/loading.gif" height="100px" style="margin-top:20px;" />
</center>
<center>
<div class="value_process">

</div>
</center>
</div>
<center>
<div class="create_gif" id="save_gif" style="backround-color:#8D33FF;">Save Image</div>
</center>

</div>
</div>

</div>
</div>

<script>






$('#save_gif').click(function(){

  document.getElementById('processing').setAttribute("style","display:block");


    $.post("module/save",
      {
          image_key: '<?php echo $image_key;?>',
          output:'<?php echo $output;?>',
          format:'<?php echo $format;?>',
          title:document.getElementById("title").value,
          tags:document.getElementById("tags").value,
          category_id:document.getElementById("category_id").value,
          date:'<?php echo $date;?>',
          source:'<?php echo $source;?>'
      },
      function(data, status){
console.log(data);
  window.location.assign(data);
      });


});
</script>



  <!-- footer Starts -->
<?php include('parts/footer.php'); ?>
</body>
</html>
