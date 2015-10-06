<?php
		
		// All Default Include Files
		// Do Not Change, unless you know what you do.
		
		// Define ROOT
		define('ROOT_PATH', dirname(__FILE__) . '/');
		
		// include Database setting file
		include(ROOT_PATH.'database.php');
		// include template engine
		include(ROOT_PATH.'includes/tbs/tbs_class.php');
		// include database engine
		include(ROOT_PATH.'includes/adodb/adodb-exceptions.inc.php');
		include(ROOT_PATH.'includes/adodb/adodb.inc.php');
		// require HybridAuth class
		require_once(ROOT_PATH.'includes/hybridauth/Hybrid/Auth.php');
		
		// Session Start
		session_start();

?>