<!DOCTYPE HTML>
<html>
<head>
  <title>Upload | Tapnar</title>
  <meta charset="utf-8" />
<meta name="description" content="Tapnar | Most Popular Images & GIF On Internet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assests/upload.css" />
  <link rel="stylesheet" href="assests/common.css" />

<link rel="stylesheet" href="assests/dropzone.css">
</head>
<body>
<?php include 'parts/header.php';?>
</div>
</div>
<!-- Top Bar Ends -->
<!-- COntent Starts -->
<?php include 'parts/category_box.php'; ?>

<div class="content" id="preview" >
  <div class="container main_image_body">


<div id ="upload_bar">
<div class="upload_input_url">

    <input id="enter_url" name="enter_url" placeholder="Enter Image or Video Url To import" type="text" style="padding-left:16px;" class="url">


</div>
<div class="browse_button" id="url_submit">

<center>Enter<center>
</div>
</div>




<div id="drop_area" class="drag_drop_area"><form enctype= "multipart/form-data" type="file" name="file" class="needsclick dz-message"  id="drag-drop">

  <div class="needsclick" id="update">

<center>Click To Upload / DRAG & DROP HERE</center>
  </div>

</form></div>

<div id="processing" class="drag_drop_area">
<center>

<br>
<img src="assests/loading.gif" height="100px" style="margin-top:20px;" />
</center>
<center>
<div class="value_process">

</div>
</center>
</div>

</div>
</div>
</div>



<div class="content" id="process_area" >
  <div class="container main_image_body">

</div>
</div>
  <!-- footer Starts -->
<?php include('parts/footer'); ?>
  <script src="/parts/js/dropzone.js" ></script>
<script>

Dropzone.autoDiscover = false;
var instance = null;
$("#drop_area").dropzone({
    init: function() {
        var $this = this;
        instance = this;
      console.log("hell");
    },
        url : 'module/uploaded',
    paramName: "file",
    maxFilesize: 1000,
    maxFiles : 1,
    autoProcessQueue : true,
    acceptedFiles : 'image/*,.mp4'

});

$(function() {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners

instance.on("success", function(file, response) {
  var go_to_id = response;
window.location.assign(response);
  });
})

$(function() {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners

instance.on("uploadprogress", function(file, progress) {
document.getElementById('').innerHTML = "<center>"+progress+" % Uploaded </center>"
      console.log(progress);
  });
})

</script>


<script>
$('#url_submit').click(function(){
 var enter_url = document.getElementById("enter_url").value;
 if(enter_url){
           document.getElementById('drop_area').setAttribute("style","display:none");
 document.getElementById('processing').setAttribute("style","display:block");
 var post_url = document.getElementById("enter_url").value;
 $.post("module/remote_url",
   {
       url: post_url
   },
   function(data, status){
    //   alert("Data: " + data + "\nStatus: " + status);
       window.location.assign(data);
   });

}
else{
  alert('Please enter Url');
}
});

</script>
</body>
</html>
