<?php

  // Use this PHP File As your Development
  
	// ****************  Default include  ****************
	
		// include All file
		include('all.php');
		
		// New template engine object
		$TBS =& new clsTinyButStrong;
		// Load Your HTML file
		$TBS->LoadTemplate('views/openid.html');    // <----- Place this script HTML
	
	// ****************************************************
	
	
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
	
	// **************  Write Your Code Here  **************
	
	// ToDo : need add session example.
	
	$title = 'Yahoo Open ID';
	
	// Prepare Login and Logout button link
	$logout = '?logout=1';
	$login = '?login=1';
	 
	// Init HybridAuth Class with config file
	$ha = new Hybrid_Auth("config.php");
	
	// If click Login
	if (isset($_GET['login'])){
		// Authenticate with Yahoo! then grab the user profile
		$adapter = $ha->authenticate("OpenID", array( "openid_identifier" => "http://me.yahoo.com/"));
		$user_profile = $adapter->getUserProfile();
	}
	
	// If click Logout
	if (isset($_GET['logout'])){
		// If Login previously
		if ($user_profile != null){
			$user_profile->logout();
		}
		// remove all session variables
		session_unset();
		// destroy the session 
		session_destroy();
	}
	
	// Display Login user email
	$message = $user_profile->email;
	
	// ****************************************************
	
	// Show result
	$TBS->Show() ;
	
?>