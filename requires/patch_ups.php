<?php
if (!function_exists('array_key_first')) {
    function array_key_first(array $arr) {
        foreach($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}
// https://www.php.net/manual/en/function.array-key-first.php#refsect1-function.array-key-first-notes

if((!empty( $_SERVER['HTTP_X_FORWARDED_HOST'])) || (!empty( $_SERVER['HTTP_X_FORWARDED_FOR'])) ) 
{
    $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
    $_SERVER['HTTPS'] = 'on';
}

$bookingItemDict = [
	1 => 'hongkongmap',
	2 => 'ipad',
	3 => 'portablecharger',
	4 => 'umbrella',
	5 => 'disposableraincoat',
	6 => 'disposablesuitcaseraincover',
	7 => 'mask',
	8 => 'babydiaper',
	9 => 'breasttowel',
	10 => 'sewingkit',
	11 => 'wheelchair',
];

$homeSliderTabLinks = [
	//'event' => 'home.php#events_pane',
	'event' => 'event_single.php?id=',
	'pre-booking-services' => 'booking.php',
	'vip-privileges' => 'vips.php',
];

?>