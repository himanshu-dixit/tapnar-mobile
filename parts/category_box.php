<style>.single_category{
float: left;
  min-width: 255px;max-width:400px;

  width:255px;
  margin: 0px 2px;

}

@media only screen and (max-width: 1024px) {
  .button_action{
    margin-top: -8px; margin-left: 16px;
  }
  #NEW{
    margin-top: -1px;
  }
  #TRENDING{
    margin-top: -2px;
  }
  #FAVORITES{
    margin-top: -3px;
  }
}
</style>

<div><div class="content">
  <div class="container">

<div class="category_list">
  <div class="row">
    <div class="col-sm-3" >
<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/category"><div class="single_category purple_category" id="categories" ><center>CATEGORIES</center></div></a>
</div>
<div class="col-sm-3">
<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/new"><div class="single_category blue_category" id="NEW" ><center>NEW</center></div></a>
</div>
<div class="col-sm-3" >
<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/popular"><div class="single_category red_category" id="TRENDING" ><center>Popular</center></div></a>
</div>
<div class="col-sm-3" >
<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/favorite"><div class="single_category yellow_category" id="FAVORITES" ><center>EDITOR</center></div></a>
</div>
</div>
</div>
  </div>
</div>
</div>
