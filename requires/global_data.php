<?php

$globalData = curl_post('settings/global-information');
$readmeData = curl_post('settings/disclaimer', ['slug' => 'all']);

$langDict = [
              'eng'=>['l' => 'English', 's' => 'EN', 'w' => 'English', 'd' => 'en-GB'],
              'zho'=>['l' => '繁體中文',   's' => '繁', 'w' => '繁體中文', 'd' => 'zh-TW'],
              'chi'=>['l' => '简体中文',   's' => '簡', 'w' => '简体中文', 'd' => 'zh-CN'],
              'jap'=>['l' => '日本語',   's' => 'JP', 'w' => '日本語']
            ];

$langArray = file(__DIR__ . "/../lang/" . $_SESSION["lang"] . ".strings");
$dictArray = [];

foreach ($langArray as $line) 
{
	$line = preg_replace("([;\"]+)", '', $line);
	$dictPairs = explode('=', $line);
	$dictArray[ trim($dictPairs[0]) ] = trim($dictPairs[1]);
}
