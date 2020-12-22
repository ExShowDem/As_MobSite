<?php

$id = $_GET['id'];

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

$eventData = curl_post('event/details', ['id' => $id]);
$eventData = $eventData[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $eventData->title; ?></title>
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

  <div class="container" id="event_single">
  	<div class="section" id="event_feat_img">
  		<img src="<?php echo $eventData->images->cover->savename; ?>" data-toggle="modal" data-target="#modal_event" />
  	</div>

  	<div class="section" id="section1">
	  	<h4><?php echo $eventData->title; ?></h4>

	  	<?php echo $eventData->content; ?>
    </div>

  	<div class="section" id="section2">
	  	<h4><?php echo $eventData->subtitle; ?></h4>

	  	<p><i class="fa fa-calendar"></i><?php echo $eventData->date; ?></p>
	  	<p><i class="fa fa-clock-o"></i><?php echo $eventData->time; ?></p>
	  	<p><i class="fa fa-map-marker"></i><?php echo $eventData->location; ?></p>
	</div>

  </div>

	<!-- Modal -->
	<div id="modal_event" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-body" data-dismiss="modal">
	        <img src="<?php echo $eventData->images->poster->savename; ?>">
	      </div>
	    </div>

	  </div>
	</div>

  <button class="goback"></button>
  <!-- <h3 id="title"><?php echo $eventData->title; ?></h3> -->

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>