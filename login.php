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

  <link rel="stylesheet" href="assests/index.css" />
    <link rel="stylesheet" href="assests/login.css" />
</head>
<body>
  <!-- Swipe Menu Start -->
<?php include 'parts/menu.php';?>

  <!-- Swipe Menu Ends -->
<?php include 'parts/header.php';?>


  <video poster="http://tapnar.com/assests/login.jpg" id="bgvid" playsinline autoplay muted loop>
      <source src="https://media.giphy.com/media/JOK5PP5Ol2Hzq/giphy.mp4" type="video/mp4">
  </video>



<div class="content" id="start">

<br><br>
<div class="container main_image_body" >
  <center><div class="logo"><img src="http://tapnar.com/resources/3s.png" height="54px" style="margin: -1px 0px 0px -24px" /></div></center><br>


<div>
<center>
<div class="facebook_login" id="facebook_connect"><center>Login With Facebook</center></div></center>

<div class="or">
  <center>OR</center></div>


<center>
  <div class="email">
    <input id="email" name="email" placeholder="Email" type="text" style="width:400px;height:60px;padding-left:15px; border: none !important;">
  </div>
</center>


<center>
  <div class="password">
    <input id="password" name="password" placeholder="Enter Your  Password" type="password" style="width:400px;height:60px;padding-left:15px;margin-top:10px; border: none !important;">
  </div>
</center>

<center>
<div class="button" id="email_connect"><center>LOGIN</center></div></center>

<!--<center>
<div class="button" id="email_connect" style="background-color:#fdb94f;"><center>SINGUP</center></div></center>
-->

<div class="join_tapnar" style="margin-top:20px;"><center>
<span class="no_account">Don't Have A Account | </span> <a href="signup.php"><span class="join_tapnar">SIGN UP</span></a>
</center>
</div>


<div class="forgot_password" style="margin-top:10px;"><center>
<a href="login.php"><span class="forgot_password">Forgot Password </span></a>


</center>
</div>

</div>
<script>

$(window).load(function() {
var fb_id,fb_name;
var response_count=0;
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
//    console.log('statusChangeCallback');
    //console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      response_count=-1;
      // The person is logged into Facebook, but not your app.
      console.log(" 212");

    } else {

      response_count=0;

    }
  }
  $('#facebook_connect').click(function(){

  });
  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }



  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1031922230219226',
    cookie     : true,  // enable cookies to allow the server to access
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.

  function testAPI() {
  //  console.log('Welcome!  Fetching your information.... ');
    //send response for login and send user id to module/fb_login.pgp
    FB.api('/me', function(response) {


      var array = $.map(response, function(value, index) {
    return [value];
});



fb_id =   array[1];
fb_name = response.name;

if(response==1){
$.post("module/fb_login",
{
    user_id: fb_id,
    name :  fb_name
},
function(data, status){
 window.location.assign(data);
});}
});




}
$('#facebook_connect').click(function(){
  var response=1;

  FB.login(function(response) {

      // handle the response
  }, {
      scope: 'public_profile,email',
      return_scopes: true
  });


testAPI();

$.post("module/fb_login",
{
    user_id: fb_id,
    name :  fb_name
},
function(data, status){
 alert("Data: " + data + "\nStatus: " + status);
   console.log(name+"date"+data);
 //window.location.assign(data);
});


  });
      $('#email_connect').click(function(){

var email =   document.getElementById('email').value;
var password =  document.getElementById('password').value;;

$.post("module/email_login",
  {
      email: email,
      password : password
  },
  function(data, status){
window.location.assign(data);
  });



        });
         });
  </script>
</div>
</html>
