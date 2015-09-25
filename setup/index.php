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
  
	// install.php template file
	$Template_HTML = 'index.html';

	// HTML Form Field Name
	$Host_Field_Name = 'Host';
	$User_Field_Name = 'User';
	$Pass_Field_Name = 'Pass';
	$DB_Field_Name   = 'DB';

// End of Database Install Script Configuration



// Fixed Configuration

	// Submit Button Link
	$Submit_Link = 'index.php';

	// Get Project Root
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

// End of Fixed Configuration



// **************************************************************************


include_once('../includes/tbs/tbs_class.php');
include("../includes/adodb/adodb-exceptions.inc.php"); 
include('../includes/adodb/adodb.inc.php');

$TBS =& new clsTinyButStrong;

$TBS->LoadTemplate($Template_HTML);

$title = 'MySQL Setting Setup';

if (($_POST[$Host_Field_Name] != '') && ($_POST[$User_Field_Name] != '') && ($_POST[$DB_Field_Name] != '') && ($_POST[$Pass_Field_Name] != ''))
{

	
	// setup the database file info
	$config = "<?php\n";
	$config .= "\$R_Host = '". $_POST[$Host_Field_Name] ."';\n";
	$config .= "\$R_User = '". $_POST[$User_Field_Name] ."';\n";
	$config .= "\$R_Pass = '". $_POST[$Pass_Field_Name] ."';\n";
	$config .= "\$R_DB = '". $_POST[$DB_Field_Name] ."';\n";
	$config .= "\$R_Root = 'http://". $host ."/';\n";
	
	$config .= "?".">";
	
	// create configuration.php file
	if ($fp = fopen("../database.php", "w")){
		fputs( $fp, $config, strlen( $config ) );
		fclose( $fp );
	}
	
	// Try include database setting file
	include('../database.php');

	try { 

		// Try Connect Database
		$db = NewADOConnection('mysql');
		$db->Connect($R_Host, $R_User, $R_Pass, $R_DB);
		
		// Success
		if ($db->ErrorMsg() == null){
			$message = '<p class="alert alert-success">Success Connect Database Setting, <a href=../index.php>Back to Home</a></p>';
		}

	} catch (exception $e) { 
		
		// Failed, Show Error Msg
		$message = "<p class='alert alert-danger'>".$db->ErrorMsg()."</p>";

	}

}else{

	// Message
	$message = '<p class="alert alert-info">Please set MySQL connection info.</p>';

}

$TBS->Show() ;

?>
