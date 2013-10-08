<?php
//===============================================
// Debug
//===============================================
$_debug_mode = TRUE;

if ($_debug_mode) {
	ini_set('display_errors','On');
	error_reporting(E_ALL);
} else {
	// TO DO: Define production mode
}

//===============================================
// mod_rewrite
//===============================================
//Please configure via .htaccess or httpd.conf

//===============================================
// KISSMVC Settings (please configure)
//===============================================
define('WEB_DOMAIN','http://localhost'); //with http:// and NO trailing slash
define('WEB_FOLDER','/CrowdRoute/'); //with trailing slash
define('APP_PATH','app/'); //with trailing slash
define('VIEW_PATH','app/views/'); //with trailing slash

//===============================================
// Includes
//===============================================
require('kissmvc.php');
require(APP_PATH . 'libs/RenderTime.php');
require(APP_PATH . 'libs/MemoryUsage.php');

//===============================================
// Session
//===============================================
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
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
	$s .= WEB_FOLDER . $url;
	return $s;
}

//===============================================
// Database
//===============================================
function getdbh() {
	if (! isset($GLOBALS['dbh'])) {
		try {
			$GLOBALS['dbh'] =
				new PDO('sqlite:'.APP_PATH.'db/crowdroute.sqlite'); //make sure folder is writable!
		} catch (PDOException $e) {
			die('Connection failed: ' . $e->getMessage());
		}
	}

	return $GLOBALS['dbh'];
}

//===============================================
// Autoloading for Business Classes
//===============================================
// Assumes Model Classes start with capital letters and Helpers start with lower case letters
function __autoload($classname) {
	$a = $classname[0];
	if ($a >= 'A' && $a <='Z') {
		require_once(APP_PATH . 'models/' . $classname . '.php');
	} else {
		require_once(APP_PATH . 'helpers/' . $classname . '.php');  
	}
}

//===============================================
// Start the controller
//===============================================
$controller = new Controller(APP_PATH.'controllers/',
							WEB_FOLDER,
							'main',
							'index');
