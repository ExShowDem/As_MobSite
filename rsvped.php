<?php

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $dictArray["RESERVATION_DETAILS"]; ?></title>
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
  <div class="container" id="rsvped_page">

    <div class="section" id="section1">
      <?php if( $_GET['status'] == 'true' ): ?>
        <img class="response-success" src="images/tick.png">
      <?php else: ?>
        <img class="response-fail" src="images/cross.png">
      <?php endif; ?>

      <?php if( $_GET['status'] == 'true' ): ?>
        <h4><?php echo $dictArray['UNDER_APPROVAL']; ?></h4>
      <?php else: ?>
        <h4><?php echo $_GET['message']; ?></h4>
      <?php endif; ?>

      <?php if( $_GET['status'] == 'true' ): ?>
        <p><?php echo $dictArray["EMAIL_RESERVATION_DETAILS"]; ?></p>
      <?php endif; ?>
    </div>

    <?php if( $_GET['status'] == 'true' ): ?>
    <div class="section" id="section2">
      <h4><?php echo $dictArray["RESERVATION_DETAILS"]; ?></h4>

      <div class="row">
        <div class="col-sm-5 col-xs-5">
          <p><?php echo $dictArray["NO_PARTICIPANTS"]; ?></p>
          <p><?php echo $_GET['params']['no_of_participant']; ?></p>
        </div>
        <div class="col-sm-7 col-xs-7">
          <p><?php echo $dictArray["MOBILE_NO"]; ?></p>
          <p><?php echo $_GET['params']['phone']; ?></p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-5 col-xs-5">
          <p><?php echo $dictArray["DATE"]; ?></p>
          <p><?php echo $_GET['params']['date']; ?></p>
        </div>
        <div class="col-sm-7 col-xs-7">
          <p><?php echo $dictArray["TIME"]; ?></p>
          <p><?php echo $_GET['params']['time']; ?></p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 col-xs-12">
          <p><?php echo $dictArray["EMAIL"]; ?></p>
          <p><?php echo $_GET['params']['email']; ?></p>
        </div>
      </div>
      
    </div>
    <?php endif; ?>

    <div class="section" id="section3">
      <a class="btn pill" href="rsvp.php"><?php echo $dictArray["OK"]; ?></a>
    </div>

  </div>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>