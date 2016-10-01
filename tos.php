<!DOCTYPE HTML>
<html>
<head>
  <title>TOS | Tapnar</title>
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

<div class="content" id="preview" >
  <div class="container main_image_body" style="color:white;">
<br><br>
<center><h2>Terms Of Service</h2></center>



<div style="font-size:12px; width:100%; margin-bottom:60px;">

<br><br><br><br>
  Use of our website to do anything other than simple accessing/viewing it (that is uploading, downloading, signinng in, commenting and browsing other GIFs/ Videos/ Images), constitutes not merely your consent,but also your electronic signature, meaning that you are actually bound by these terms and by our privacy policy.
  <br><br>Thing you are not allowed to do:
  <br><br>·0 You are not allowed to upload GIFs/Videos/Images whose copyright is owned by any individual/corporation.
  <br><br>·1 You are not allowed to upload GIFs/Videos/Images that highlight topics like race, gender, age, relegion, taboo, sexual orientation.
  <br><br>·2 You are strictly advised not to encourage violence or crime in your comments or uploads.
  <br><br>·3 Uploading or commenting any illegal content such as child porn or forced porn.
  <br><br>·4 Dont provide link to adult websites(requiring their age to be 18+), gambling site, dark web, torrent.
<br>  <br>·5 Impersonating of someone else is strictly banned.
<br>  <br>·6 We have full power to ban you and your hotlinks on the account of your uploads/comments.
<br>  <br>·7 You might be banned from Uploading/Viewing if you fail comply with our privacy policy and terms.
<br><br>  What to do in case you find something unusual
<br><br>  In case of finding something unusual you can report to our HR development at complaint@tapnar.com
<br><br>  GIFs/Videos/Images You Upload
<br><br>  GIFs/Videos/Images you upload on www.tapnar.com will be made public and will be available to anyone who access www.tapnar.com . If You share GIFs/Videos/Images by Facebook, Reditt, Twitter, YouTube etc it will be made public and will be showcased in our gallery.
<br>  <br>Propety Rights
  <br><br>By uploading a file or other content or by making a comment, you represent and warrant to us that
<br><br>  ·8  Doing so does not violate or infringe antone else rights
<br><br>  ·9  You created the file or other content you are uploading, or otherwise have suffecient intellectual property rights to upload the material consistent with these terms.
<br> <br> ·10 With regard to any file or content you upload to the public portions of our website, you grant tapnar a non exclusive, royalty free , perpetual, irrevocable worldwide license (with sublicense and assignments rights) to use,display online and in any present or future media
<br> <br> Use of Tapnar Content
<br> <br> By downloading GIFs/Videos/Images or copycomments or any content from tapnar you agree that you do not have any rights to it.
<br> <br>  You have to follow following conditions:
<br> <br> ·11 You may use content for individual, non-commercial purposes.
<br> <br> ·12 If you use content for fair use you are requested to include an attribute (www.tapnar.com) .
<br> <br> ·13 You may not use content for commercial purpose.
<br> <br> ·14 Your use of content is at your own risk "TAPNAR MAKES NO WARRANTIES OF NONINFRINGEMENT', and you will idemnify and hold tapnar harmless from any copyright infringement claims arising out of use of content




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
<br><br><br>

</script>
</body>
</html>
