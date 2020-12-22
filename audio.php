<?php

$id = $_GET['id'];

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

$audioData = curl_post('tour/audio/details', ['id' => $id, 'language' => 'all']);
$audioData = $audioData[0];

$lang = $_SESSION["audio_lang"] ?? $_SESSION["lang"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $audioData->contents->{$lang}->name; ?></title>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles/style.css" />
  <?php require_once('requires/font.php'); ?>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styles/perspective_swiper.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
  <div class="container" id="audio_page">
    <div class="section" id="audio_img">
      <img src="<?php echo $audioData->images->cover->savename; ?>" data-toggle="modal" data-target="#modal_audio" />
      <div id="zone_tag"><?php echo $audioData->zone; ?></div>
    </div>

    <h4><?php echo $audioData->contents->{$lang}->name; ?></h4>

    <div class="section contents">
      <?php echo $audioData->contents->{$lang}->introduction; ?>
      <div id="bottom_buffer"></div>
    </div>

    <div id="lang"><span><?php echo $langDict[$lang]['s']; ?></span><i class="fa fa-angle-down"></i></div>

    <div id="player">
      <div class="row">
          <button id="play">
            <i class="fa fa-play"></i>
          </button>
          <button id="pause">
            <i class="fa fa-pause"></i>
          </button>
          <p id="audio-info"><?php echo $audioData->contents->{$lang}->name; ?></p>
      </div>

      <div class="row" id="tracker">
        <div class="col-sm-12 col-xs-12" id="progress-bar"> 
          <input type="range" min="0" value="0" class="slider">
          <span id="progress"></span> 
        </div>
      </div>

      <div class="row" id="durations">
        <span id="duration0"></span> 
        <span id="duration"></span> 
      </div>
    </div>
  </div>

  <div class="modal fade lang modalDialog" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">

          <form class="lang-choices">
            <?php foreach($audioData->audios as $k => $v): ?>
            <div class="form-check">
              <label class="form-check-label" for="<?php echo $k; ?>"><?php echo $langDict[$k]['l']; ?></label>
              <input class="form-check-input" type="radio" name="audio_lang" value="<?php echo $k; ?>" <?php echo ($k == $lang) ? 'checked' : ''; ?>>
              <input type="hidden" name="<?php echo $k; ?>" value="<?php echo $v->savename; ?>">
              <i class="fa fa-check"></i>
            </div>
            <?php endforeach; ?>
          </form>

        </div>
      </div>
    </div>
  </div>

  <button class="goback"></button>
  <!-- <h3 id="title"><?php echo $audioData->contents->{$lang}->name; ?></h3> -->

  <!-- Modal -->
  <div id="modal_audio" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
          <h3 class="modal-title"></h3>
        </div>
        <div class="modal-body">
          <img src="<?php echo $audioData->images->cover->savename; ?>" />
        </div>
      </div>

    </div>
  </div>

  <script>
    var lang_dict = <?php echo json_encode( $langDict ); ?>;
    var langs_intros = <?php echo json_encode( $audioData->contents ); ?>;
  </script>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>