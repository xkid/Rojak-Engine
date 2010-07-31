<?php

// XFW Install Script
// XFW prepare a simple SQL install script
// Install script will create File Named : configuration.php
// Which is include:-
/* 
    <? php
      $XFW_Host = 'localhost';
      $XFW_User = 'root';
      $XFW_Pass = '';
      $XFW_DB = 'XFW';
      $XFW_Root = 'http://localhost/';
      $settings = array(
      'dbName' => 'xfw',
      'dbHost' => '127.0.0.1',
      'dbPort' => '3306',
      'dbUser' => 'root',
      'dbPass' => '',
      'dbTable' => 'users'
      );
    ? >
*/

// Start of Database Install Script Configuration
  
  // install.php template file
  $Template_HTML = 'install.html';
  
  // HTML Form Field Name
  $Host_Field_Name = 'Host';
  $User_Field_Name = 'User';
  $Pass_Field_Name = 'Pass';
  $DB_Field_Name   = 'DB';

  // SQL Install script
  $SQL = 'xfw.sql';

// End of Database Install Script Configuration



// Fixed Configuration

  // Submit Button Link
  $Submit_Link = 'install.php?step=2';
  
  // Get Project Root
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

// End of Fixed Configuration



// **************************************************************************


include_once('./includes/tbs_class.php');
include('./adodb/adodb.inc.php');

$TBS =& new clsTinyButStrong;

$TBS->LoadTemplate('http://'. $host.$uri .'/template/'.$Template_HTML);

if ((isset($_GET['step']) == '2') && ($_POST[$Host_Field_Name] != '') && ($_POST[$User_Field_Name] != '') && ($_POST[$DB_Field_Name] != ''))
{

	
	// setup the database file info
	$config = "<?php\n";
	$config .= "\$XFW_Host = '". $_POST[$Host_Field_Name] ."';\n";
	$config .= "\$XFW_User = '". $_POST[$User_Field_Name] ."';\n";
	$config .= "\$XFW_Pass = '". $_POST[$Pass_Field_Name] ."';\n";
	$config .= "\$XFW_DB = '". $_POST[$DB_Field_Name] ."';\n";
	$config .= "\$XFW_Root = 'http://". $host.$uri ."/';\n";
	$config .= "\$settings = array(\n";
  $config .= "'dbName' => '". $_POST[$DB_Field_Name] ."',\n";
  $config .= "'dbHost' => '". $_POST[$Host_Field_Name] ."',\n";
  $config .= "'dbPort' => '3306',\n";
  $config .= "'dbUser' => '". $_POST[$User_Field_Name] ."',\n";
  $config .= "'dbPass' => '". $_POST[$Pass_Field_Name] ."',\n";
  $config .= "'dbTable' => 'users'\n";
  $config .= ");\n";
	$config .= "?".">";
	
	// create configuration.php file
	if ($fp = fopen("configuration.php", "w")){
		fputs( $fp, $config, strlen( $config ) );
		fclose( $fp );
	}
	
	// include database setting file
	include('configuration.php');
	
	// Create database connection
	$db = NewADOConnection('mysql');
	$db->Connect($XFW_Host, $XFW_User, $XFW_Pass, $XFW_DB);
	
	// Function01 : Insert Data to MySQL using SQL script
	function populate_db(&$db, $sqlfile) {
		global $errors;

		$mqr = @get_magic_quotes_runtime();
		@set_magic_quotes_runtime(0);
		$query = fread( fopen( $sqlfile, 'r' ), filesize( $sqlfile ) );
		@set_magic_quotes_runtime($mqr);
		$pieces  = split_sql($query);

		for ($i=0; $i<count($pieces); $i++) {
			$pieces[$i] = trim($pieces[$i]);
			if(!empty($pieces[$i]) && $pieces[$i] != "#") {
				$result = $db->Execute($pieces[$i]);
			}
		}
	}

	// Function02 : used in Function 01
	function split_sql($sql) {
		$sql = trim($sql);
		$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);

		$buffer = array();
		$ret = array();
		$in_string = false;

		for($i=0; $i<strlen($sql)-1; $i++) {
			if($sql[$i] == ";" && !$in_string) {
				$ret[] = substr($sql, 0, $i);
				$sql = substr($sql, $i + 1);
				$i = 0;
			}

			if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
				$in_string = false;
			}
			elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
				$in_string = $sql[$i];
			}
			if(isset($buffer[1])) {
				$buffer[0] = $buffer[1];
			}
			$buffer[1] = $sql[$i];
		}

		if(!empty($sql)) {
			$ret[] = $sql;
		}
		return($ret);
	}
	
	// Call Function01
	populate_db($db, $SQL);
	
	// Message
	$message = '<center>Database Install Success, <a href=index.php>Back to Home</a></center>';

}else{

	// Message
	$message = 'Please configure MySQL connection.';

}

$TBS->Show() ;

?>
