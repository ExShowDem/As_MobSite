<?php

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');
require_once('requires/patch_ups.php');

$homeData = curl_post('home/slider');

foreach ($homeData as $i => $slide)
{
  if (in_array($slide->type, ['e-photo', 'wallpaper']))
  {
    unset($homeData[$i]);
  }
}

$first = array_pop($homeData);
array_unshift($homeData, $first);

$eventTypeData = curl_post('event/types');

foreach ($eventTypeData as &$eventType) 
{
  $eventType->events = curl_post('event/list', ['type_id' => $eventType->id]);
}

$eventTypeData = json_decode(json_encode($eventTypeData), true);
$eventTypeData = array_column($eventTypeData, null, 'id');

$shopTypeData = curl_post('shop/types');

foreach ($shopTypeData as &$shopType) 
{
  $shopType->shops = curl_post('shop/list', ['type_id' => $shopType->id]);
}

$shopTypeData = json_decode(json_encode($shopTypeData), true);
$shopTypeData = array_column($shopTypeData, null, 'id');

$bookData = curl_post('booking/items');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $readmeData->{'fact-aboutus'}->name; ?></title>
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
  <div class="container" id="home_page">

    <div class="row tab-content">
      <div id="home_pane" class="row tab-pane fade in active">
        <div class="pane-content">
          <img class="img-1881" src="images/1881.png">

            <a href="about.php">
              <div class="home-about-btn">
                <h3 class="home-about-text"><?php echo $dictArray["ABOUT_1881"]; ?></h3>
                <img class="home-about-icon" src="images/icon_forward.png">
              </div>
            </a>

            <div class="swiper-container perspective">
            <div class="swiper-wrapper">

              <?php foreach ($homeData as $slide): ?>
                <div class="swiper-slide">
                  <div class="slide-content">
                    <a href="<?php echo $homeSliderTabLinks[$slide->type] . ($slide->id ?? ''); ?>">
                      <img src="<?php echo $slide->photo ?>">
                      <p class="caption"><?php echo $slide->title ?></p>
                    </a>
                  </div>
                </div>
              <?php endforeach; ?>

            </div>
          </div>
          <div class="swiper-pagination"></div>

        </div>
      </div>
      <div id="shop_pane" class="row tab-pane fade">
        <div class="pane-content">
          <img class="img-1881" src="images/1881.png">
          
          <ul class="row nav nav-tabs" id="shop_nav">
            <?php foreach ($shopTypeData as $shopTypeId => $shopData): ?>
              <li class="<?php echo (array_key_first($shopTypeData) === $shopTypeId) ? 'active' : ''; ?>">
                <a data-toggle="tab" href="#shop_type_<?php echo $shopTypeId; ?>_pane" id="shop_type_<?php echo $shopTypeId; ?>">
                  <?php echo $shopData['name']; ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>

          <div class="tab-content">
            <?php foreach ($shopTypeData as $shopTypeId => $shopData): ?>
              <div id="shop_type_<?php echo $shopTypeId; ?>_pane" class="row tab-pane fade <?php echo (array_key_first($shopTypeData) === $shopTypeId) ? 'in active' : ''; ?>">
                <div class="pane-content">

                  <!-- $shopTypeId === 10 is Luxury Shops -->
                  <!-- $shopTypeId === 11 is Hotel & Fine-Dining -->
                  <div id="entry_list">
                    <?php foreach ($shopData['shops'] as $shop): ?>
                      <a href="shop_single.php?id=<?php echo $shop['id']; ?>">
                        <div class="entry">
                          <div class="image">
                            <div class="image_inner" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?php echo $shop['images']['cover']['savename']; ?>);">
                              <img src="<?php echo $shop['images']['logo-white']['savename'] ?>">
                            </div>
                          </div>
                          <div class="text">
                            <div class="content-box">
                              <h4><?php echo mb_convert_case($shop['name'], MB_CASE_UPPER); ?></h4>
                              <p><i class="fa fa-map-marker"></i><?php echo $shop['location_text']; ?></p>
                              <p><i class="fa fa-phone"></i><?php echo $shop['telephone']; ?></p>
                            </div>
                          </div>
                        </div>
                      </a>
                    <?php endforeach; ?>
                  </div>

                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div id="events_pane" class="row tab-pane fade">
        <div class="pane-content">
          <img class="img-1881" src="images/1881.png">

          <ul class="row nav nav-tabs" id="events_nav">
            <?php foreach ($eventTypeData as $eventTypeId => $eventData): ?>
              <li class="<?php echo (array_key_first($eventTypeData) === $eventTypeId) ? 'active' : ''; ?>">
                <a data-toggle="tab" href="#event_type_<?php echo $eventTypeId; ?>_pane" id="event_type_<?php echo $eventTypeId; ?>">
                  <?php echo $eventData['name']; ?>
                </a>
              </li>
            <?php endforeach; ?>

            <li><a data-toggle="tab" href="#vips_pane" id="vips" style="font-family:Baskerville;">1881 VIPs</a></li>
          </ul>

          <div class="tab-content">
            <?php foreach ($eventTypeData as $eventTypeId => $eventData): ?>
              <div id="event_type_<?php echo $eventTypeId; ?>_pane" class="row tab-pane fade <?php echo (array_key_first($eventTypeData) === $eventTypeId) ? 'in active' : ''; ?>">
                <div class="pane-content">

                  <!-- $eventTypeId === 8 is Special Event -->
                  <!-- $eventTypeId === 9 is Seasonal Offer -->

                  <?php if (count($eventData['events']) > 1): ?>

                    <div class="swiper-container perspective">
                      <div class="swiper-wrapper">
                        <?php foreach ($eventData['events'] as $event): ?>
                          <div class="swiper-slide">
                            <div class="slide-content">
                              <a href="event_single.php?id=<?php echo $event['id']; ?>">
                                <img src="<?php echo $event['images']['poster']['savename'] ?>">
                                <p class="caption"><?php echo $event['title'] ?></p>
                              </a>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </div>

                  <?php elseif (count($eventData['events']) === 1): ?>

                    <div class="poster">
                      <a href="event_single.php?id=<?php echo $eventData['events'][0]['id']; ?>">
                        <img src="<?php echo $eventData['events'][0]['images']['poster']['savename'] ?>">
                        <p class="caption"><?php echo $eventData['events'][0]['title'] ?></p>
                      </a>
                    </div>

                  <?php endif; ?>

                </div>
              </div>
            <?php endforeach; ?>

            <div id="vips_pane" class="row tab-pane fade">
              <div class="pane-content">
                <div class="vip_item">
                  <a href="vips.php">
                    <img src="<?php echo $globalData->{'app-icon'}->{'vip-privilege'}; ?>">
                    <p class="caption"><?php echo $globalData->{'app-text'}->{'vip-privilege'}; ?></p>
                  </a>
                </div>

                <div class="vip_item">
                  <?php if (empty($bookData)): ?>
                  <a onclick="alert('<?php echo $dictArray['SERV_ENDED']; ?>');"> 
                  <?php else: ?>  
                  <a href="booking.php">
                  <?php endif; ?>  
                    <img src="<?php echo $globalData->{'app-icon'}->{'pre-booking-service'}; ?>">
                    <p class="caption"><?php echo $globalData->{'app-text'}->{'pre-booking-service'}; ?></p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="tours_pane" class="row tab-pane fade">
        <div class="pane-content">
          <img class="img-1881" src="images/1881.png">
          <h3><?php echo $dictArray["Tours"]; ?></h3>

          <div class="tour_item">
            <a href="rsvp.php">
              <img src="<?php echo $globalData->{'app-icon'}->reservation; ?>">
              <p class="caption"><?php echo $globalData->{'app-text'}->reservation; ?></p>
            </a>
          </div>

          <div class="tour_item">
            <a href="audios.php">
              <img src="<?php echo $globalData->{'app-icon'}->{'audio-tour-guide'}; ?>">
              <p class="caption"><?php echo $globalData->{'app-text'}->{'audio-tour-guide'}; ?></p>
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <ul class="row nav nav-tabs" id="bottom_nav">
      <li class="active"><a data-toggle="tab" href="#home_pane" id="home">
        <p class="nav-icon"></p>
        <p class="nav-text"><?php echo $dictArray["HOME"]; ?></p>
      </a></li>
      <li><a data-toggle="tab" href="#shop_pane" id="shop">
        <p class="nav-icon"></p>
        <p class="nav-text"><?php echo $dictArray["SHOPS"]; ?></p>
      </a></li>
      <li><a data-toggle="tab" href="#events_pane" id="events">
        <p class="nav-icon"></p>
        <p class="nav-text"><?php echo $dictArray["HAPPENINGS"]; ?></p>
      </a></li>
      <li><a data-toggle="tab" href="#tours_pane" id="tours">
        <p class="nav-icon"></p>
        <p class="nav-text"><?php echo $dictArray["TOURS"]; ?></p>
      </a></li>
      <li class="dropdown" id="more_dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="more">
          <p class="nav-icon"></p>
          <p class="nav-text"><?php echo $dictArray["MORE"]; ?></p>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><p id="padder-top"><span>---</span></p></li>
          <li><a href="about.php"><?php echo $dictArray["ABOUT_1881"]; ?></a></li>
          <li><a href="location.php"><?php echo $dictArray["LOCATION_MAP"]; ?></a></li>
          <li><a href="setting.php"><?php echo $dictArray["SETTINGS"]; ?></a></li>
          <li><p id="padder-bottom"></p></li>
        </ul>
      </li>
    </ul>

  </div>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script type="text/javascript" src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>