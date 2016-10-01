
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="navbar" id="topbar" style="border-radius:0px;">
  <div class="container-fluid" id="bar">

    <div class="topbar_logo navbar_header"><a href="htpp://tapnar.com"><img src="http://tapnar.com/resources/3s.png" height="27px" style="margin: 0px 0px 0px -6px;" /></a></div>
    <div class="search_bar">
      <div class="search_bar left">

      <div class="search_box">

                    <input id="search_input" name="search_input" placeholder="Search Here" type="text" style="padding-left:16px;">

                      <a id="search_icon_link" href="javascript:;">
                        <div id="search_icon" style="color:black;"><i class="fa fa-search" aria-hidden="true" style="color: #c5c5c5;
font-size: 24px;margin-left: -44px; margin-top: 16px;"></i></div>
                      </a>
<script>


$('#search_icon').click(function(){

          window.location.assign("http://<?php echo $_SERVER['SERVER_NAME'];?>/search.php?search="+document.getElementById("search_input").value);
});

</script>
      </div>

      </div>
    </div>
    <!-- Navbar Starts -->
<style>
@media only screen and (max-width: 800px) {
  .button_action{
    margin-top: -8px; margin-left: 16px;
  }
}
</style>
    <div class=" navbar-collapse" id="myNavbar">


  <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'];?>/random"> <div class="randomize left" style="padding-top:15px;" id="random_icon"></div></a>
  <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'];?>/upload"> <div class="upload_button left"><center>Upload</center></div></a>

 <ul class="nav navbar-nav navbar-right">
<li>    <div class="button_action left">
<?php

session_start();
if(!$image_key ){

}
if(!$_SESSION['user_id']){ ?>
  <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'];?>/login">
 <div class="login_button left"><center>Login</center></div></a>  <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'];?>/signup">
  <div class="signup_button left"><center>Signup</center></div></a>
  <?php } else{ ?>

    <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'];?>/logout">
    <div class="signup_button left"><center>Logout</center></div></a>

  <?php } ?>
</li>
    </div>
  </ul>
</div>
<!-- navbar Ends-->
  </div>
</div>
</div>
