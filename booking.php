<?php

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');
require_once('requires/patch_ups.php');

$bookData = curl_post('booking/items');
$termsData = curl_post('booking/terms');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $dictArray["PRE_BOOKING"]; ?></title>
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
  <div class="container" id="booking_page">

    <div class="wizard">
      <ul class="nav nav-tabs nav-justified">
        <li><a href="#tab1" data-toggle="tab"></a></li>
        <li><a href="#tab2" data-toggle="tab"></a></li>
      </ul>

      <form id="booking_form" autocomplete="off">
        <input autocomplete="false" name="hidden" type="text" class="hidden">

        <input type="hidden" name="language" value="<?php echo $_SESSION['lang']; ?>">

        <div class="tab-content">

          <div class="tab-pane" id="tab1">
            <h2><?php echo $dictArray["SELECT_BOOK"]; ?></h2>

            <p><i class="fa fa-check-circle"></i>  <?php echo $dictArray["MULTI_OPT"]; ?></p>

            <div class="err_msg">
              <p id="item"><?php echo $dictArray['REQ_ITEM']; ?></p>
            </div>

            <div class="row">
              <?php foreach($bookData as $k => $item): ?>

              <div class="col-sm-4 col-xs-4">
                <div class="panel panel-default">
                  <input type="checkbox" id="<?php echo $bookingItemDict[intval($item->Sort)]; ?>" name="item_id[]" value="<?php echo isset($item->Item->id) ? $item->Item->id : ''; ?>">
                  <i class="tick fa fa-check-circle"></i>

                  <div class="panel-heading">
                    <img class="normal" src="<?php echo 'images/book_black/' . $bookingItemDict[intval($item->Sort)] . '.png'; ?>" />
                    <img class="active" src="<?php echo 'images/book_white/' . $bookingItemDict[intval($item->Sort)] . '.png'; ?>" />
                  </div>

                  <div class="panel-body"><h6><?php echo $item->Item->name; ?></h6></div>
                </div>
              </div>

              <?php if ($k > 0 && ($k+1)%3 === 0): ?>
                </div><div class="row">
              <?php endif; ?>

              <?php endforeach; ?>
            </div>

            <div id="item_counter"></div>

          </div>
          <div class="tab-pane" id="tab2">

            <div class="err_msg">
              <p id="name"><?php echo $dictArray['REQ_NAME']; ?></p>
              <p id="phone"><?php echo $dictArray['REQ_PHONE']; ?></p>
              <p id="email"><?php echo $dictArray['REQ_EMAIL']; ?></p>
              <p id="time"><?php echo $dictArray['REQ_TIME']; ?></p>
              <p id="agree"><?php echo $dictArray['REQ_AGREE']; ?></p>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="full_name" name="full_name" placeholder="<?php echo $dictArray["FULL_NAME"]; ?>">
            </div>

            <div class="form-group">
              <input type="number" class="form-control" id="phone" name="phone" placeholder="<?php echo $dictArray["REG_MOB"]; ?>">
              <small class="form-text text-muted"><?php echo $dictArray["CHECK_VIP"]; ?></small>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo $dictArray["EMAIL"]; ?>">
              <small class="form-text text-muted"><?php echo $dictArray["EMAIL_CONFIRM_BOOK"]; ?></small>
            </div>

            <div class="form-group">
              <small class="form-text text-muted"><?php echo $dictArray["PICKUP_TIME"]; ?></small>
              <select class="form-control" name="take_time" id="take_time">
                <option value="" disabled selected><?php echo $dictArray["SELECT_TIMESLOT"]; ?></option>
                <?php foreach($termsData->timeslots as $timeslot): ?>
                  <option value="<?php echo $timeslot; ?>"><?php echo $timeslot; ?></option>
                <?php endforeach; ?>
              </select>
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
            <div class="icon"><i class="fa"></i></div>
          </button>
        </div>
      
      </form>
    </div>
  </div>

  <div class="modal fade book modalDialog" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <img class="booking-icon" src="">
          <h4></h4>
        </div>
        <div class="modal-body">

          <?php foreach($bookData as $modalData): ?>

            <?php if ( !empty($modalData->Item->selection) ): ?>
              <div class="custom-content" id="<?php echo $bookingItemDict[intval($modalData->Sort)]; ?>">
                <h5><?php echo $dictArray["PLEASE_SELECT"]; ?></h5>

                <?php foreach($modalData->Item->selection as $option): ?>
                  <div class="form-check">
                    <label class="form-check-label"><?php echo $option->name; ?></label>
                    <input class="form-check-input" type="radio" name="<?php echo $bookingItemDict[intval($modalData->Sort)]; ?>_option" value="<?php echo $option->id; ?>">
                    <i class="fa fa-check"></i>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <?php if ( !empty($modalData->Item->remark) ): ?>
              <div class="custom-content" id="<?php echo $bookingItemDict[intval($modalData->Sort)]; ?>">
                <h5><?php echo $dictArray["REMARKS"]; ?></h5>
                <p><?php echo $modalData->Item->remark; ?></p>
              </div>
            <?php endif; ?>

          <?php endforeach; ?>

        </div>
        <div class="modal-footer">
            <button type="button" id="cancel" data-dismiss="modal"><?php echo $dictArray["CANCEL"]; ?></button>
            <button type="button" id="confirm" data-dismiss="modal"><?php echo $dictArray["CONFIRM"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade book modalPrivacy" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4><?php echo $dictArray["PRIVACY_STATEMENT"]; ?></h4>
        </div>
        <div class="modal-body">
          <?php echo $termsData->{'statement_'.$_SESSION['lang']}->privacy; ?>
        </div>
        <div class="modal-footer">
          <button type="button" id="disagree" data-dismiss="modal"><?php echo $dictArray["DISAGREE"]; ?></button>
          <button type="button" id="agree" data-dismiss="modal"><?php echo $dictArray["AGREE"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade book modalConfirm" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
          <p><?php echo $dictArray["CONFIRM_RSVP"]; ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" id="keep" data-dismiss="modal"><?php echo $dictArray["CONFIRM"]; ?></button>
          <button type="button" id="discard" data-dismiss="modal"><?php echo $dictArray["CANCEL"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  <button class="goback"></button>
  <h3 id="title"><?php echo $dictArray["PRE_BOOKING"]; ?></h3>
  <div id="title_back"></div>

  <script>
    var base_url = <?php echo '"' . $GLOBALS['base_url'] . '"'; ?>;
    //var base_url = 'https://vtl-lab.com/1881-heritage-cms/api/';
  </script>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>