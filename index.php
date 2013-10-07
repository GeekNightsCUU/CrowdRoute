<?php
//===============================================
// Debug
//===============================================
ini_set('display_errors','On');
error_reporting(E_ALL);

//===============================================
// mod_rewrite
//===============================================
//Please configure via .htaccess or httpd.conf

//===============================================
// KISSMVC Settings (please configure)
//===============================================
define('APP_PATH','app/'); //with trailing slash pls
define('WEB_DOMAIN','http://localhost'); //with http:// and NO trailing slash pls
define('WEB_FOLDER','/CrowdRoute/'); //with trailing slash pls
define('VIEW_PATH','app/views/'); //with trailing slash pls

//===============================================
// Includes
//===============================================
require('kissmvc.php');

//===============================================
// Session
//===============================================
session_start();

//===============================================
// Globals
//===============================================
$GLOBALS['sitename'] = 'CrowdRoute';

//===============================================
// Functions
//===============================================
function myUrl($url = '', $fullurl = FALSE) {
  $s = $fullurl ? WEB_DOMAIN : '';
  $s .= WEB_FOLDER.$url;
  return $s;
}

//===============================================
// Start the controller
//===============================================
$controller = new Controller(APP_PATH.'controllers/',
							WEB_FOLDER,
							'main',
							'index');
