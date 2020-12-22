<?php

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $dictArray["LOCATION_MAP"]; ?></title>
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
  <script type="text/javascript" src="//api.map.baidu.com/api?v=2.0&ak=LN5aYn5dUbwPXNkOGIKpBG03pUw1bOyA"></script>
</head>

<body>
  <div class="container" id="location_page">
    <div id="allmap" 
      data-lat="<?php echo $globalData->{'google-map'}->lat; ?>" 
      data-lon="<?php echo $globalData->{'google-map'}->lon; ?>" 
      data-mtr="<?php echo $globalData->{'google-map'}->mtr; ?>">
    </div>
  </div>

  <div id="location_label"><p><?php echo $dictArray['MTR_ADDR']; ?></p></div>

  <button class="goback"></button>

  <script>
    var map = new BMap.Map("allmap");
    //var point = new BMap.Point($('#allmap').data('lon'), $('#allmap').data('lat'));
    var point = new BMap.Point('114.18148','22.298182');
    map.centerAndZoom(point,15);
    map.enableScrollWheelZoom(true);

    // Create marker
    var marker1 = new BMap.Marker(new BMap.Point('114.18148','22.298182'));
    // Set marker to map
    map.addOverlay(marker1);

    // var geolocation = new BMap.Geolocation();
    // geolocation.getCurrentPosition(function(r){
    //   if(this.getStatus() == BMAP_STATUS_SUCCESS){
    //     var mk = new BMap.Marker(r.point);
    //     map.addOverlay(mk);
    //     // map.panTo(r.point, 17);
    //     map.centerAndZoom(new BMap.Point(r.point.lng, r.point.lat), 17);
    //     // map.centerAndZoom(r.point, 19);
    //     // alert('Position: '+r.point.lng+','+r.point.lat);
    //   }
    //   else {
    //     alert('failed'+this.getStatus());
    //   }        
    // },{enableHighAccuracy: true})

    function theLocation(lng, lat){
      map.clearOverlays(); 
      var new_point = new BMap.Point(lng,lat);
      var marker = new BMap.Marker(new_point);  // 创建标注
      map.addOverlay(marker);              // 将标注添加到地图中
      map.panTo(new_point);      
    }
  </script>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>