<?php

  // Use this PHP File As your Development

	// ****************  Default include  ****************
	
		// include XFW setting file
		include('configuration.php');
    // include template engine
		include_once('./includes/tbs_class.php');
		// include database engine
		include('./adodb/adodb.inc.php');
		// require user access class
    require_once('./includes/access.class.php');
		
    // Declare User access class
    if (file_exists('configuration.php')){
      $user = new flexibleAccess('', $settings);
    }
		// New template engine object
		$TBS =& new clsTinyButStrong;
		// Load Your HTML file
		$TBS->LoadTemplate('./template/index.html');    // <----- Place this script HTML
	
	// ****************************************************
	
	
	// **************  Example Code Here  *****************
	
		 /*
		 
		 $saveLink = 'save.php';
		 $cssLink = './template/style.css';
		 
		 // Create database connection
			 $db = NewADOConnection('mysql');
			 $db->Connect($XFW_Host, $XFW_User, $XFW_Pass, $XFW_DB);
		 // ... please refer ./adodb/docs/

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
		 
		 // Create database connection
		 $db = NewADOConnection('mysql');
		 $db->Connect($XFW_Host, $XFW_User, $XFW_Pass, $XFW_DB);
		 
		 // Form SQL Query
		 $sql="SELECT * FROM table where field01='$xxx' and field02='$yyy'";
		 
		 // Get Database result
		 $result=$db->Execute($sql);
		 if ($result === false) die("Query Failed->".$db->ErrorMsg()); 
		 
		 // Check Result record count
		 if (($result->RecordCount()) == 1)
		 {
				... Please refer to ./adodb/docs/
		 }
		 
		 */
	
	// ****************************************************
	
	// **************  Write Your Code Here  **************
	
	// checks for configuration file, if none found loads installation page
  if (!file_exists('configuration.php')){
     $self = rtrim( dirname( $_SERVER['PHP_SELF'] ), '/\\' ) . '/';
     header("Location: http://" . $_SERVER['HTTP_HOST'] . $self . "install.php" );
     exit();
  }
	
	$message = 'Hello, XFW World ! <br>';
	$message .= 'Simple PHP Framework <br>';
	$message .= '- <strong><a href=\'http://www.tinybutstrong.com\'>TinyButStrong</a></strong><br>';
	$message .= '- <strong><a href=\'http://adodb.sourceforge.net\'>ADODB for PHP</a></strong><br><br>';
	$message .= 'Read the source code, this is simple example.<br>';
	$message .= '<a href="sample-login.php">Sample Login</a><br>';
	$message .= '<a href="sample-register.php">Sample Register</a><br>';
	$message .= '<a href="sample-protected-page.php">Sample Protected Page</a><br>';
	
	
	
	
	// ****************************************************
	
	
	// Show result
	$TBS->Show() ;
	
?>