<?php

$id = $_GET['id'];

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

$shopData = curl_post('shop/details', ['id' => $id]);
$shopData = $shopData[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $shopData->name; ?></title>
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
  <div class="container" id="shop_single">
    <div data-toggle="modal" data-target="#modal_shop" id="shop_feat_img" style="
            background-image: url('<?php echo $shopData->images->cover->savename; ?>');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            height: 270px;
            width: 100%;
            border-radius: 0 0 40px 0;
            overflow: hidden;">
    </div>
    <div class="entry">
      <div class="text">
        <h4><?php echo mb_convert_case($shopData->name, MB_CASE_UPPER); ?></h4>
      </div>
      <div class="image">
        <img src="<?php echo $shopData->images->{'logo-black'}->savename; ?>">
      </div>
    </div>

    <div class="contact-row dummy"></div>
    <div class="contact-row address">
      <?php if (count($shopData->location) > 1): ?>
        <a data-toggle="modal" href="#modal_locations">
          <div class="text">
            <p><?php echo $dictArray["LOCATION"]; ?></p>
            <p><?php echo $shopData->location_text; ?></p>
          </div>
          <div class="icon"></div>
        </a>
      <?php else: ?> 
        <a href="floor_plan.php?id=<?php echo $shopData->id; ?>">
          <div class="text">
            <p><?php echo $dictArray["LOCATION"]; ?></p>
            <p><?php echo $shopData->location_text; ?></p>
          </div>
          <div class="icon"></div>
        </a>
      <?php endif; ?>  
    </div>
    <div class="contact-row phone">
      <a href="tel:<?php echo str_replace(' ', '', $shopData->telephone); ?>">
        <div class="text">
          <p><?php echo $dictArray["TELEPHONE"]; ?></p>
          <p><?php echo $shopData->telephone; ?></p>
        </div>
        <div class="icon"></div>
      </a>
    </div>
    <div class="contact-row website">
      <a href="<?php echo $shopData->website; ?>">
        <div class="text">
          <p><?php echo $dictArray["WEBSITE"]; ?></p>
          <p><?php echo $shopData->website; ?></p>
        </div>
        <div class="icon"></div>
      </a>
    </div>
    <div class="contact-row desc">
      <div class="text">
        <p><?php echo $dictArray["SHOP_DESCRIPTION"]; ?></p>
        <?php echo $shopData->description; ?>
      </div>
    </div>
  </div>

  <button class="goback"></button>
  <!-- <h3 id="title"><?php echo $shopData->name; ?></h3> -->

  <!-- Modal -->
  <div id="modal_shop" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
          <h3 class="modal-title"></h3>
        </div>
        <div class="modal-body">
          <img src="<?php echo $shopData->images->cover->savename; ?>">
        </div>
      </div>

    </div>
  </div>

  <div id="modal_locations" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-body">
          <?php foreach($shopData->location as $location): ?>
            <p>
              <a href="floor_plan.php?id=<?php echo $shopData->id; ?>&zone=<?php echo $location->id; ?>">
                <?php echo $location->zone; ?>
              </a>
            </p>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>