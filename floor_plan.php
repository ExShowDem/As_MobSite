<?php

$id = $_GET['id'];

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

$shopData = curl_post('shop/details', ['id' => $id]);
$shopData = $shopData[0];

$zone = isset($_GET['zone']) ? $_GET['zone'] : null;

if (is_null($zone))
{
  $loc = $shopData->location[0];
}
else
{
  $loc = array_column($shopData->location, null, 'id');
  $loc = $loc[$zone];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $shopData->name; ?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <script type="text/javascript" src="https://www.cssscript.com/demo/image-zoomer-moible-pinchzoom/pinch-zoom.umd.js"></script>

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
  <div class="container" id="floor_plan">
    <div class="heading">
      <h3 class="placeholder">placeholder</h3>
      <h4><?php echo $dictArray['FLOOR_PLAN']; ?></h4>
      <p><?php echo $loc->zone . ', ' . $loc->floor; ?></p>
    </div>

    <div class="pinch-zoom-parent">
        <div class="pinch-zoom">
          <div id="map_container">
            <div 
              data-width="<?php echo $loc->images->floor_plan->width; ?>" 
              data-height="<?php echo $loc->images->floor_plan->height; ?>" 
              data-posX="<?php echo $loc->posX; ?>" 
              data-posY="<?php echo $loc->posY; ?>" 
              id="shop_here">
              <i class="fa fa-map-marker"></i>
            </div>
            <img src="<?php echo $loc->images->floor_plan->savename; ?>"/>
          </div>
        </div>
    </div>
  </div>

  <button class="goback"></button>
  <h3 id="title"><?php echo $shopData->name; ?></h3>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>