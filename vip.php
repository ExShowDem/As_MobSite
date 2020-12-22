<?php

$id = $_GET['id'];

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

$vipPrivData = curl_post('vip/privileges/details', ['id' => $id]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $vipPrivData[0]->title; ?></title>
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
  <div class="container" id="vip_single">
    <div class="section" id="vip_feat_img">
      <img src="<?php echo $vipPrivData[0]->images->cover->savename; ?>" data-toggle="modal" data-target="#modal_vip" />
    </div>

    <div class="entry">
      <div class="text">
        <div>
          <p><?php echo $vipPrivData[0]->location; ?></p>
          <h4><?php echo $vipPrivData[0]->title; ?></h4>
        </div>
      </div>
      <div class="image">
        <img src="<?php echo $vipPrivData[0]->images->{'logo-black'}->savename; ?>">
      </div>
    </div>

    <div class="info-row dummy"></div>
    <div class="info-row">
      <div class="text">
        <?php echo $vipPrivData[0]->content; ?>
      </div>
    </div>
    <div class="info-row">
      <div class="text">
        <?php echo $vipPrivData[0]->terms; ?>
      </div>
    </div>
  </div>

  <button class="goback"></button>
  <!-- <h3 id="title"><?php echo $vipPrivData[0]->title; ?></h3>
  <div id="title_back"></div> -->

  <!-- Modal -->
  <div id="modal_vip" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
          <h3 class="modal-title"></h3>
        </div>
        <div class="modal-body">
          <img src="<?php echo $vipPrivData[0]->images->cover->savename; ?>">
        </div>
      </div>

    </div>
  </div>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>