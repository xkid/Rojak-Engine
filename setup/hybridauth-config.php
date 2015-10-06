<?php

  // Use this PHP File As your Development
  
	// ****************  Default include  ****************
	
		// include All file
		include('../all.php');
		
		// New template engine object
		$TBS =& new clsTinyButStrong;
		// Load Your HTML file
		$TBS->LoadTemplate('hybridauth-config.html');    // <----- Place this script HTML
	
	// ****************************************************
	
	// **************  Write Your Code Here  **************
	
	$title = 'HybridAuth Config Setup';
	$message = '<p class="alert alert-info">Please key in needed provider info.</p>';

	$Submit_Link = 'hybridauth-config.php';

	// Get Project Root
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), 'setup');
	
	$config = '<?php
return
		array(
			"base_url" => "http://'.$host.$uri.'includes/hybridauth/",
			"providers" => array(
				// openid providers
				"OpenID" => array(
					"enabled" => true
				),
				"Yahoo" => array(
					"enabled" => true,
					"keys" => array("key" => "'.$_POST['y-key'].'", "secret" => "'.$_POST['y-secret'].'"),
				),
				"AOL" => array(
					"enabled" => true
				),
				"Google" => array(
					"enabled" => true,
					"keys" => array("id" => "'.$_POST['g-key'].'", "secret" => "'.$_POST['g-secret'].'"),
				),
				"Facebook" => array(
					"enabled" => true,
					"keys" => array("id" => "'.$_POST['f-key'].'", "secret" => "'.$_POST['f-secret'].'"),
					"trustForwarded" => false
				),
				"Twitter" => array(
					"enabled" => true,
					"keys" => array("key" => "'.$_POST['t-key'].'", "secret" => "'.$_POST['t-secret'].'"),
					"includeEmail" => false
				),
				// windows live
				"Live" => array(
					"enabled" => true,
					"keys" => array("id" => "'.$_POST['l1-key'].'", "secret" => "'.$_POST['l1-secret'].'")
				),
				"LinkedIn" => array(
					"enabled" => true,
					"keys" => array("key" => "'.$_POST['l2-key'].'", "secret" => "'.$_POST['l2-secret'].'")
				),
				"Foursquare" => array(
					"enabled" => true,
					"keys" => array("id" => "'.$_POST['fs-key'].'", "secret" => "'.$_POST['fs-secret'].'")
				),
			),
			// If you want to enable logging, set "debug_mode" to true.
			// You can also set it to
			// - "error" To log only error messages. Useful in production
			// - "info" To log info and error messages (ignore debug messages)
			"debug_mode" => false,
			// Path to file writable by the web server. Required if "debug_mode" is not false
			"debug_file" => "",
		);
?>';
	
	// create config.php file
	if ($fp = fopen("../config.php", "w")){
		// Puts the string inside config.php
		fputs( $fp, $config, strlen( $config ) );
		// Close the file.
		fclose( $fp );
	}
  
	
	// ****************************************************
	
	// Show result
	$TBS->Show() ;
	
	// **************  Example Code Here  *****************
	
		/*

		// Create database connection
			// ... please refer ./includes/adodb/docs/
			$db = NewADOConnection('mysql');
			$db->Connect($R_Host, $R_User, $R_Pass, $R_DB);

		// Create database connection
			$db = NewADOConnection('mysql');
			$db->Connect($R_Host, $R_User, $R_Pass, $R_DB);

		// Form SQL Query
			$sql="SELECT * FROM table where field01='$xxx' and field02='$yyy'";

		// Get Database result
			$result=$db->Execute($sql);
			if ($result === false) die("Query Failed->".$db->ErrorMsg());

		// Check Result record count
			if (($result->RecordCount()) == 1)
			{
				... Please refer to ./includes/adodb/docs/
			}
			
			or 
			
			foreach ($result as $row) 
			{
				print_r($row);
			}
		 
		// SQLite connection
			// SQLite Database, need to enable PHP pdo_sqlite module
			$db = &ADONewConnection('pdo');
			$db->PConnect('sqlite:sqlite.db');
			
		// PHP Class
		
			// New Class xxxx
			class xxxx{
				function yyyy(){
					...
				}
				function zzzz(){
					...
				}
			}

			$AAAA = new xxxx;  // declare new object
			$AAAA->yyyy();	  // calling yyyy function

		*/
	
	// ****************************************************
	
?>