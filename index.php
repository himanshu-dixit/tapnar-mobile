<!DOCTYPE HTML>
<html>
<head>
  <title>Tapnar | Best Images on Internet Worth Clicking</title>
  <meta charset="utf-8" />
<meta name="description" content="Tapnar | Most Popular Images & GIF On Internet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <script src="parts/jquery.jscroll.js"></script>


 <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assests/login.css" />
  <link rel="stylesheet" href="assests/index.css" />
</head>
<body>
  <!-- Swipe Menu Start -->
<?php include 'parts/menu.php';?>

  <!-- Swipe Menu Ends -->
<?php include 'parts/header.php';?>
<!-- Top Bar Ends -->
<!--Top Banner -->
<?php include 'parts/banner_block.php';?>
<!-- COntent Starts -->
<div class="content">
  <div class="container1 image_container">
<div class="scroll" style="display:inline-block;">
<?php include 'module/images/index_module.php';?>
</div>

<?php include ('parts/open_in_app.php');?>
<!-- Category List Ends-->
<!-- Images Are Load Here-->

<script>
$('.scroll').jscroll({
  debug:true ,
        loadingHtml: '</div><div><center><img src="http://tapnar.com/zone/zupload/src/f61qwse48q.jpg" /></center></div>',
    padding: 20
});
</script>
</div>
</div>
<!-- COntent Ends -->
  <!-- footer Starts -->
  <!--
<?php //include 'parts/footer.php';?>-->
</body>
</html>
