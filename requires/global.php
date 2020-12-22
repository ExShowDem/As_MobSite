<?php
session_start();

$_SESSION["lang"] = isset($_SESSION["lang"]) ? $_SESSION["lang"] : 'chi';

$isDev       = false;
$devUrlBase  = 'https://vtl-lab.com/1881-heritage-cms/api/';
$prodUrlBase = 'https://1881app2.ckmalls.com.hk/api/';
$GLOBALS['base_url'] = $isDev ? $devUrlBase : $prodUrlBase;
