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
 <script src="parts/Gruntfile.js"></script>
 <link rel="stylesheet" href="assests/common.css" />

  <link rel="stylesheet" href="assests/index.css" />
</head>
<body>
<?php include 'parts/header.php';?>
<!-- Top Bar Ends -->
<!-- COntent Starts -->
<div class="content">
  <div class="container">
<?php include 'parts/category_box.php'; ?>
<!-- Category List Ends-->
<!-- Images Are Load Here-->
<div class="container" id="image_content">
<div class="scroll">
<?php include ('module/images/search.php'); ?>
</div>

</div>

<script>
$('.scroll').jscroll({
  debug:true ,
    loadingHtml: '<div><center><img src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif" /></center></div>',
    padding: 20
});
</script>
</div>
</div>
<!-- COntent Ends -->
  <!-- footer Starts -->
<?php include 'parts/footer.php';?>
</body>
</html>
