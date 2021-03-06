<?php

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $dictArray["SETTINGS"]; ?></title>
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
  <div class="container" id="settings_page">

    <div class="option-row">
      <a href="languages.php">
        <div class="text">
          <p class="left">
            <?php echo $dictArray["LANG"]; ?>
            <span class="right">
              <?php echo $langDict[ $_SESSION["lang"] ]['w']; ?>
              <i class="fa fa-arrow-right"></i>
            </span>
          </p>
        </div>
        <div class="icon"></div>
      </a>
    </div>

    <div class="option-row">
      <a href="tnc.php">
        <div class="text">
          <p class="left">
            <?php echo $dictArray['TNC']; ?>
            <span class="right">
              <i class="fa fa-arrow-right"></i>
            </span>
          </p>
        </div>
        <div class="icon"></div>
      </a>
    </div>

    <div class="option-row">
      <a href="privacy.php">
        <div class="text">
          <p class="left">
            <?php echo $dictArray['PRIVACY_POLICY']; ?>
            <span class="right">
              <i class="fa fa-arrow-right"></i>
            </span>
          </p>
        </div>
        <div class="icon"></div>
      </a>
    </div>

    <div class="option-row">
      <a href="mailto:<?php echo $globalData->support; ?>">
        <div class="text">
          <p class="left">
            <?php echo $dictArray["ENQUIRY"]; ?>
            <span class="right">
              <?php echo $dictArray["EMAIL"]; ?>
              <i class="fa fa-arrow-right"></i>
            </span>
          </p>
        </div>
        <div class="icon"></div>
      </a>
    </div>

  </div>

  <button class="goback"></button>
  <h3 id="title"><?php echo $dictArray['SETTINGS']; ?></h3>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>