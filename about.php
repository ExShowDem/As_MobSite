<?php

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

$aboutData = curl_post('home/about', ['slug' => 'all']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $readmeData->{'fact-aboutus'}->name; ?></title>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" type="text/css" type="text/css" href="styles/perspective_swiper.css" />
  <link rel="stylesheet" type="text/css" href="styles/style.css" />
  <?php require_once('requires/font.php'); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>

  <div class="container" id="about">
    <div class="panel-group" id="accordion">
      <div class="panel panel-default" id="intro">
        <div id="collapse1" class="panel-collapse collapse in">
			<div class="panel-body">
				<img src="<?php echo $aboutData->introduction->photo; ?>" class="feat-img" data-toggle="modal" data-target="#modal_about" />

				<div class="text-contents">
					<?php echo $aboutData->introduction->content; ?>
				</div>

				<div class="contact-row dummy"></div>
				<div class="contact-row phone">
					<a href="tel:<?php echo str_replace(' ', '', $globalData->contact->hotline); ?>">
						<div class="text">
							<p><?php echo $dictArray["CS_HOTLINE"]; ?></p>
							<p><?php echo $globalData->contact->hotline; ?></p>
						</div>
						<div class="icon"></div>
					</a>
				</div>
				<div class="contact-row address">
					<a href="location.php">
						<div class="text">
							<p><?php echo $dictArray["Address"]; ?></p>
							<p><?php echo $globalData->contact->address; ?></p>
						</div>
						<div class="icon"></div>
					</a>
				</div>
				<div class="contact-row website">
					<a href="<?php echo $globalData->contact->website; ?>">
						<div class="text">
							<p><?php echo $dictArray["Website"]; ?></p>
							<p><?php echo preg_replace('/^https?:\/\//i', '', $globalData->contact->website); ?></p>
						</div>
						<div class="icon"></div>
					</a>
				</div>
				<div class="contact-row metro">
					<div class="text">
						<p><?php echo $dictArray["MTR"]; ?></p>
						<p><?php echo $globalData->{'google-map'}->mtr; ?></p>
					</div>
					<div class="icon"></div>
				</div>
			</div>
        </div>
        <div class="panel-heading">
          <div class="back-filler"></div>
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?php echo $aboutData->introduction->title; ?></a>
          </h4>
        </div>
      </div>
      <div class="panel panel-default" id="history">
        <div id="collapse2" class="panel-collapse collapse">
			<div class="panel-body">
				<img src="<?php echo $aboutData->history->photo; ?>" class="feat-img" data-toggle="modal" data-target="#modal_about" />

				<div class="text-contents">
					<?php echo $aboutData->history->content; ?>
				</div>
			</div>
        </div>
        <div class="panel-heading">
          <div class="back-filler"></div>
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><?php echo $aboutData->history->title; ?></a>
          </h4>
        </div>
      </div>
      <div class="panel panel-default" id="transform">
        <div id="collapse3" class="panel-collapse collapse">
          <div class="panel-body">
				<div class="row">
					<?php foreach ($aboutData->transformation->transformations as $transformation): ?>
					<div class="col-sm-4 col-xs-4 transf-item" data-id="<?php echo $transformation->sorting; ?>">
						<img src="<?php echo $transformation->photo; ?>" data-toggle="modal" data-target="#modal_transf" />
						<p class="caption"><?php echo $transformation->age; ?></p>
					</div>
					<?php endforeach; ?>
				</div>

				<div class="text-contents">
					<?php echo $aboutData->transformation->content; ?>
				</div>

          </div>
        </div>
        <div class="panel-heading">
          <div class="back-filler"></div>
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><?php echo $aboutData->transformation->title; ?></a>
          </h4>
        </div>
      </div>

      <div class="panel panel-default" id="moments">
        <div id="collapse4" class="panel-collapse collapse">
          <div class="panel-body">

	          <div class="swiper-container perspective">
	            <div class="swiper-wrapper">
	              <?php 
	              	$memoryCount = count($aboutData->memory->memories);
					$memoryContent = [];

					$memories = $aboutData->memory->memories;
					$last = array_pop($memories);
					array_unshift($memories, $last);
	              ?>
	              <?php foreach ($memories as $memory): ?>
		              <div class="swiper-slide">
		                <div class="slide-content">
		                  <img class="moment-img" src="<?php echo $memory->photo; ?>" data-toggle="modal"
                               data-target="#modal_memory" />
		                  <p class="caption"><?php echo $memory->title; ?></p>
		                </div>
		              </div>
		              <?php $memoryContent[] = $memory->content; ?>
	              <?php endforeach; ?>

	              <?php
					$first = array_shift($memoryContent);
					array_push($memoryContent, $first);
	              ?>
	            </div>
	          </div>

	          <div class="memory-content"></div>
              <div class="page"></div>

          </div>
        </div>

          <div class="panel-heading">
          <div class="back-filler"></div>
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><?php echo $aboutData->memory->title; ?></a>
          </h4>
        </div>


      </div>
      <div class="panel panel-default" id="awards">
        <div id="collapse5" class="panel-collapse collapse">
          <div class="panel-body">
          		<?php foreach ($aboutData->award->awards as $i => $award): ?>
					<div class="award-row <?php echo ($i < 5) ? 'init-show' : 'init-hide'; ?>">
						<p><?php echo $award->age; ?></p>
						<h4><?php echo $award->title; ?></h4>
						<p><?php echo $award->content; ?></p>
					</div>
				<?php endforeach; ?>

				<button type="button" class="btn pill" id="show_more"><?php echo $dictArray["MORE"]; ?></button>
          </div>
        </div>
        <div class="panel-heading">
          <div class="back-filler"></div>
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"><?php echo $aboutData->award->title; ?></a>
          </h4>
        </div>
      </div>
    </div> 
  </div>

	<!-- Modal -->
	<div id="modal_transf" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><img src="images/close.png"></button>
	        <h3 class="modal-title"></h3>
	      </div>
	      <div class="modal-body">
	        <img src="">
	      </div>
	      <div class="modal-footer">
	      	<h4></h4>
	      	<div id="content"></div>
	      </div>
	    </div>

	  </div>
	</div>

	<div id="modal_about" class="modal fade" role="dialog">
		<div class="modal-dialog">

		  <div class="modal-content">
		    <div class="modal-header">
		      <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
		      <h3 class="modal-title"></h3>
		    </div>
		    <div class="modal-body">
		      <img src="" />
		    </div>
		  </div>

		</div>
	</div>

	<div id="modal_memory" class="modal fade" role="dialog">
		<div class="modal-dialog">

		  <div class="modal-content">
		    <div class="modal-header">
		      <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
		      <h3 class="modal-title"></h3>
		    </div>
		    <div class="modal-body">
		      <img src="" />
		    </div>
		  </div>

		</div>
	</div>

  <script>
  	var transf_arr = <?php echo json_encode( array_column(json_decode(json_encode($aboutData->transformation->transformations), true), null, 'sorting') ); ?>;
    var memory_content = <?php echo json_encode( $memoryContent ); ?>;
    var memory_count = <?php echo $memoryCount; ?>;
  </script>

  <button class="goback"></button>
  <h3 id="title"></h3>
  <div id="title_back"></div>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>