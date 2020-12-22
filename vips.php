<?php

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

$vipPrivData = curl_post('vip/privileges');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $globalData->{'app-text'}->{'vip-privilege'}; ?></title>
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
  <div class="container" id="vip_page">
    <div class="row">
      <?php foreach ($vipPrivData as $k => $priv): ?>
        <div class="col-sm-6 col-xs-6">
          <div class="panel panel-default">
            <a href="vip.php?id=<?php echo $priv->id; ?>">
              <div class="panel-heading" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                      url(<?php echo $priv->images->cover->savename; ?>); background-position:center center;">
                <img src="<?php echo $priv->images->{'logo-white'}->savename; ?>" />
              </div>
              <div class="panel-body">
                <h4><?php echo $priv->title; ?></h4>
                <p><?php echo $priv->summary; ?></p>
              </div>
            </a>
          </div>
        </div>

        <?php if ($k > 0 && $k%2 !== 0): ?>
          </div><div class="row">
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

  <button class="goback"></button>
  <h3 id="title"><?php echo $globalData->{'app-text'}->{'vip-privilege'}; ?></h3>
  <div id="title_back" class="vips-page"></div>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>