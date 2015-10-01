<?php

// Rojak Install Script
// Rojak prepare a simple SQL install script
// Install script will create File Named : database.php
// Which is include:-
/* 
    <? php
      $R_Host = 'localhost';
      $R_User = 'root';
      $R_Pass = '';
      $R_DB = 'Rojak';
      $R_Root = 'http://localhost/';
    ? >
*/

// Start of Database Install Script Configuration

	// HTML Form Field Name
	$Host_Field_Name = 'Host';
	$User_Field_Name = 'User';
	$Pass_Field_Name = 'Pass';
	$DB_Field_Name   = 'DB';

// End of Database Install Script Configuration

// Fixed Configuration

	// Submit Button Link
	$Submit_Link = 'database-config.php';

	// Get Project Root
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

// End of Fixed Configuration

// **************************************************************************

	// include All file.
	include('../all.php');

	// Declare TinyButStrong class
	$TBS =& new clsTinyButStrong;

	// Load HTML Template
	$TBS->LoadTemplate('database-config.html');

	// Page Title
	$title = 'MySQL Setting Setup';

	// Check it Form Inputs is Empty or not?
	if (($_POST[$Host_Field_Name] != '') && ($_POST[$User_Field_Name] != '') && ($_POST[$DB_Field_Name] != '') && ($_POST[$Pass_Field_Name] != ''))
	{

		// Write to database.php
		$config = "<?php\n";
		$config .= "\$R_Host = '". $_POST[$Host_Field_Name] ."';\n";
		$config .= "\$R_User = '". $_POST[$User_Field_Name] ."';\n";
		$config .= "\$R_Pass = '". $_POST[$Pass_Field_Name] ."';\n";
		$config .= "\$R_DB = '". $_POST[$DB_Field_Name] ."';\n";
		$config .= "\$R_Root = 'http://". $host ."/';\n";
		$config .= "?".">";
		
		// create database.php file
		if ($fp = fopen("../database.php", "w")){
			// Puts the string inside database.php
			fputs( $fp, $config, strlen( $config ) );
			// Close the file.
			fclose( $fp );
		}

		// Try include database.php again
		include('../database.php');
		
		try { 

			// Try Connect Database
			$db = NewADOConnection('mysql');
			$db->PConnect($R_Host, $R_User, $R_Pass, $R_DB);
			
			// Success
			if ($db->ErrorMsg() == null){
				// Success, show success message
				$message = '<p class="alert alert-success">Success Connect Database Setting, <a href="../index.php">Back to Home</a></p>';
			}
		
		} catch (exception $e) { 
			
			// Failed, show error message
			$message = "<p class='alert alert-danger'>".$db->ErrorMsg()."</p>";

		}
	
	}else{

		// Message
		$message = '<p class="alert alert-info">Please set MySQL connection info.</p>';

	}

// **************************************************************************
	
	// Show result;
	$TBS->Show() ;

?>
