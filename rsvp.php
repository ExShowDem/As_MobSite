<?php

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');

$rsvpData = curl_post('tour/terms');
$availableDates = json_decode(json_encode($rsvpData->timeslots), true);
$availableDates = array_column($availableDates, null, 'date');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $dictArray["RESERVATION"]; ?></title>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment-with-locales.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.zh-CN.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.zh-TW.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="styles/style.css" />
  <?php require_once('requires/font.php'); ?>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styles/perspective_swiper.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
  <div class="container" id="rsvp_page">

    <div class="wizard">
      <ul class="nav nav-tabs nav-justified">
        <li><a href="#tab1" data-toggle="tab"><?php echo $dictArray["1_VISITOR"]; ?></a></li>
        <li><a href="#tab2" data-toggle="tab"><?php echo $dictArray["2_DATE"]; ?></a></li>
        <li><a href="#tab3" data-toggle="tab"><?php echo $dictArray["3_TIMESLOT"]; ?></a></li>
        <li><a href="#tab4" data-toggle="tab"><?php echo $dictArray["4_DETAILS"]; ?></a></li>
      </ul>

      <form id="rsvp_form" autocomplete="off">
        <input autocomplete="false" name="hidden" type="text" class="hidden">

        <input type="hidden" name="language" value="<?php echo $_SESSION['lang']; ?>">

        <div class="tab-content">
          <div class="tab-pane" id="tab1">
            
            <h4><?php echo $dictArray["NO_PARTICIPANTS"]; ?></h4>

            <div class="swiper-holder">
              <div class="swiper-container">
                <div class="swiper-wrapper">

                  <div class="swiper-slide"></div>

                  <?php for ($x = 1; $x <= $rsvpData->maximum_person; $x++): ?>
                  <div class="swiper-slide"><?php echo $x; ?></div>
                  <?php endfor; ?>

                  <div class="swiper-slide"></div>

                </div>
              </div>
            </div>

            <input type="hidden" id="no_of_participant" name="no_of_participant" min="1" step="1">

          </div>
          <div class="tab-pane" id="tab2">

            <div class="err_msg">
              <p id="date"><?php echo $dictArray['REQ_DATE']; ?></p>
            </div>

            <div id="tour_date">
              <div class="form-group">
                <div id="calendar"></div>
              </div>
              <input type='text' name="tour_date" class="form-control" disabled />
              <input type='hidden' id="shadow" />
            </div>
          </div>
          <div class="tab-pane" id="tab3">
            <div class="err_msg">
              <p id="time"><?php echo $dictArray['REQ_TIME']; ?></p>
            </div>

            <h4></h4>

            <div class="row" id="slots"></div>

            <p><?php echo $dictArray["OTHER_TIMESLOTS"]; ?></p>
          </div>
          <div class="tab-pane" id="tab4">

            <div class="err_msg">
              <p id="phone"><?php echo $dictArray['REQ_PHONE']; ?></p>
              <p id="email"><?php echo $dictArray['REQ_EMAIL']; ?></p>
              <p id="agree"><?php echo $dictArray['REQ_AGREE']; ?></p>
            </div>

            <div class="form-group">
              <label for="email"><?php echo $dictArray["ENTER_EMAIL"]; ?></label>
              <p class="form-text text-muted"><?php echo $dictArray["WILL_EMAIL"]; ?></p>
              <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo $dictArray["EMAIL"]; ?>">
            </div>

            <div class="form-group">
              <label for="phone"><?php echo $dictArray["ENTER_MOB"]; ?></label>
              <input type="number" class="form-control" id="phone" name="phone" placeholder="<?php echo $dictArray["MOBILE_NO"]; ?>">
            </div>

            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="is_agree" id="is_agree">
              <span class="checkmark"></span>
              <label class="form-check-label" for="is_agree"><?php echo $dictArray["PRIVACY_STATEMENT"]; ?></label>
            </div>

          </div>

          <button class="btn prev">
            <div class="icon"><i class="fa fa-arrow-left"></i></div>
          </button>
          <button class="btn next">
            <div class="icon"><i class="fa fa-arrow-right"></i></div>
          </button>
        </div>

      </form>
    </div>

  </div>

  <div class="modal fade rsvp modalPrivacy" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4><?php echo $dictArray["PRIVACY_STATEMENT"]; ?></h4>
        </div>
        <div class="modal-body">
          <?php echo $rsvpData->{'statement_'.$_SESSION['lang']}->privacy; ?>
        </div>
        <div class="modal-footer">
          <button type="button" id="disagree" data-dismiss="modal"><?php echo $dictArray["DISAGREE"]; ?></button>
          <button type="button" id="agree" data-dismiss="modal"><?php echo $dictArray["AGREE"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade rsvp modalConfirm" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
          <p><?php echo $dictArray['CONFIRM_RSVP']; ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" id="keep" data-dismiss="modal"><?php echo $dictArray["CONFIRM"]; ?></button>
          <button type="button" id="discard" data-dismiss="modal"><?php echo $dictArray["CANCEL"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  <button class="goback"></button>
  <h3 id="title"><?php echo $dictArray["RESERVATION"]; ?></h3>

  <script>
    var available_dates = <?php echo json_encode( $availableDates ); ?>;
    var base_url = <?php echo '"' . $GLOBALS['base_url'] . '"'; ?>;
    //var base_url = 'https://vtl-lab.com/1881-heritage-cms/api/';
    var curr_lang = <?php echo '"' . $langDict[$_SESSION['lang']]['d'] . '"'; ?>;
  </script>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>