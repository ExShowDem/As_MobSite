<?php

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

$audioTourMapData = curl_post('tour/map');
$audiosData = curl_post('tour/audios');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $dictArray["Tours"]; ?></title>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery.ui.all.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles/style.css" />
  <?php require_once('requires/font.php'); ?>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styles/perspective_swiper.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
  <div class="container" id="audios_page">

    <img id="aerial" src="<?php echo $audioTourMapData->map->savename; ?>">

    <?php foreach($audiosData as $tag): ?>
      
        <div class="pin map-marker" 
          data-id="<?php echo $tag->id; ?>" 
          data-title="<?php echo $tag->contents->{$_SESSION["lang"]}->name; ?>" 
          data-image="<?php echo $tag->images->cover->savename; ?>" 
          style="left:<?php echo (100*$tag->posX).'vw'; ?>;top:<?php echo 'calc('. (100*$tag->posY).'vw + ' .'45px)'; ?>;">
          <?php echo $tag->zone; ?>
        </div>
      
    <?php endforeach; ?>

    <div class="drag-bottom-tab">
      <div id="handle" class="ui-resizable-handle ui-resizable-n"></div>
      <p id="padder-top"><span>---</span></p>
      <h3><?php echo $dictArray["LIST_GUIDED_TOURS"]; ?></h3>

      <div class="items-container">
        <div class="row">
          <?php $k = 0; ?>
          <?php foreach($audiosData as $tour): ?>
            <?php if ($tour->id != 10): ?>

              <div class="audio-item col-sm-6 col-xs-6">
                <a href="audio.php?id=<?php echo $tour->id; ?>">
                  <span class="pin tag_num"><?php echo $tour->zone; ?></span>
                  <img src="<?php echo $tour->images->cover->savename; ?>">
                  <p class="caption"><?php echo $tour->contents->{$_SESSION["lang"]}->name; ?></p>
                </a>
              </div>

              <?php if ($k > 0 && $k%2 !== 0): ?>
                </div><div class="row">
              <?php endif; ?>

              <?php $k++; ?>

            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div id="list_view">
        <i class="fa fa-list" aria-hidden="true"></i>
        <?php echo $dictArray["LIST_VIEW"]; ?>
    </div>

    <div class="bottom-tab">
      <div class="row">
        <div class="col-sm-4 col-xs-4 col-sm-offset-1 col-xs-offset-1">
          <img class="" src="">
          <p class="caption pin"></p>
        </div>
        <div class="col-sm-6 col-xs-6" id="title_holder">
          <p></p>
        </div>
      </div>
    </div>

  </div>

  <button class="goback"></button>
  <h3 id="title"><?php echo $dictArray["Audio Tour Guide"]; ?></h3>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>