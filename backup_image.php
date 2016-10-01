


      <meta property="og:type"        content="video.other">
      <meta property="og:image"       content="  <?php if($format<>'mp4'){ ?>
    http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key.'.'.$format;?>
      <?php } else{

      if($mode=="gif" || $format=="mp4"){ ?>
    http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/gif/<?php echo $image_key.'.gif';?>
      <?php }
        ?>
        <?php  } ?>">

      <meta property="og:image:width"       content="380">
      <meta property="og:image:height"       content="249">

      <meta property="og:type"        content="video">
      <meta property="og:image"       content=" <?php if($format<>'mp4'){ ?>
    http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/thumb/<?php echo $image_key.'.'.$format;?>
      <?php }
     if($format<>'mp4'){ ?>
      http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/thumb/<?php echo $image_key.'.jpg';?>
      <?php }
      else{
      if($mode=="gif" ){ ?>
    http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/thumb/<?php echo $image_key.'.gif';?>
      <?php }
      else{
        ?>
        <?php } } ?>">
      <meta property="og:image:width"       content="480">
      <meta property="og:image:height"       content="270">
      <?php ($fomart=="mp4"){ ?>
      <meta property="og:video"                content="http://<?php echo $_SERVER['SERVER_NAME'];?>/zone/zupload/src/<?php echo $image_key;?>.mp4">

      <?php } ?>

      <meta property="og:video:width"          content="470">
      <meta property="og:video:height"         content="249">

      <meta name="twitter:account_id" content="1020383864" />
      <meta name="twitter:card"           content="player">
      <meta name="twitter:title"          content="<?php echo $title;?> - The Image Database | Tapnar">
      <meta name="twitter:site"           content="@tapnar">
      <meta name="twitter:description"    content="Find &amp; Share this <?php echo $title;?>. Tapnar | The Image Database.Create & Share Images On Net.">
      <meta name="twitter:image:src"      content="https://media3.giphy.com/media/3o7TKEXVF0EnkLV36o/giphy-facebook_s.jpg?t=1">
      <meta name="twitter:image"          content="https://media3.giphy.com/media/3o7TKEXVF0EnkLV36o/giphy-facebook_s.jpg?t=1">
      <meta name="twitter:domain"         content="tapnar.com">

      <meta name="twitter:player"         content="http://tapnar.com/embed.php?u=<?php echo $image_key;?>&mode=<?php echo $mode;?>">
      <meta name="twitter:player:width"   content="435">
      <meta name="twitter:player:height"  content="285">

      <!-- /twitter seo -->

      <meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1.0">
      <meta name="description" content="Find &amp; Share this <?php echo $title;?>. Tapnar | The Image Database."/>
      <meta name="author" content="TAPNAR"/>
      <meta name="pinterest" content="nohover">
