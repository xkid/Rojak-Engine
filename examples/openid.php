<?php

  // Use this PHP File As your Development
  
	// ****************  Default include  ****************
	
		// include All file
		include_once('../all.php');
		
		// New template engine object
		$TBS = new clsTinyButStrong;
		// Load Your HTML file
		$TBS->LoadTemplate('openid.html');    // <----- Place this script HTML
	
	// ****************************************************
	
	// **************  Write Your Code Here  **************
	
	$title = 'Yahoo Open ID';
	
	// Init HybridAuth Class with config file
	$ha = new Hybrid_Auth("../config.php");
	
	// If click Login
	if (isset($_GET['login'])){
		// Authenticate with Yahoo! then grab the user profile
		$adapter = $ha->authenticate("OpenID", array( "openid_identifier" => "http://me.yahoo.com/"));
		$user_profile = $adapter->getUserProfile();
		$_SESSION['member_email'] = $user_profile->email;
		header('Location: '.$_SERVER['PHP_SELF']);
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
		// Reload
		header('Location: '.$_SERVER['PHP_SELF']);
	}
	
	// Check Session member_email is null?
	// If null mean not yet login!
	if ($_SESSION['member_email'] == ''){
		// Prepare Login and Logout button link
		$login = '?login=1';
	}else{
		// Show User Management and Logout button
		// magnet=a is kept as is when the field has a value, 
		// and is deleted when the field is null or empty string.
		$main = 'main.php';
		$user = 'user.php';
		$logout = '?logout=1';
	}
	
	// Display Login user email
	$message = $_SESSION['member_email'];
	
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