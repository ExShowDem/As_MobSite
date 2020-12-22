<?php

require_once('requires/global.php');
require_once('requires/curl.php');
require_once('requires/global_data.php');
require_once('requires/patch_ups.php');

if (isset($_GET['lang']))
{
  $_SESSION['lang'] = $_GET['lang'];

  $redir = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace('languages', 'setting', $_SERVER['REQUEST_URI']);
  $noQueryParam = explode('?', $redir);
  $redir = $noQueryParam[0];
  
  header("Location: " . $redir);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $dictArray["LANG"]; ?></title>
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
  <div class="container" id="languages_page">
    <?php 
      $languages = array_reverse($globalData->languages);
    ?>
    <?php foreach($languages as $language): ?>
      <div class="option-row">
        <div class="text">
          <p class="left">
            <?php echo $language->name; ?>
            <?php if ($_SESSION["lang"] === $language->language): ?>
              <span class="right"><i class="fa fa-check"></i></span>
            <?php endif; ?>
          </p>
        </div>
        <div class="icon"></div>
        <input type="hidden" name="lang" value="<?php echo $language->language; ?>">
      </div>
    <?php endforeach; ?>
  </div>

  <button class="goback"></button>
  <h3 id="title"><?php echo $dictArray['LANG']; ?></h3>

  <script type="text/javascript" src="scripts/perspective_swiper.js"></script>
  <script src="scripts/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>

</body>
</html>