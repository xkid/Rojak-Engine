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
		$TBS->LoadTemplate('./template/sample-register.html');    // <----- Place this script HTML
	
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
	
	// Check User Name Input ?
	if (!empty($_POST['username'])){
    // Yes
    
    // The logic is simple. We need to provide an associative array, where keys are the field names and values are the values :)
    $data = array(
    	'username' => $_POST['username'],
    	'email' => $_POST['email'],
    	'password' => $_POST['pwd'],
    	'active' => 1
    );
    
    //The method returns the userID of the new user or 0 if the user is not added
    $userID = $user->insertUser($data);
    
    if ($userID==0)
      //user is allready registered or something like that
    	$message = 'User not registered';
    else
    	$message = 'User registered with user id '.$userID;
  }

	// ****************************************************
	
	
	// Show result
	$TBS->Show() ;
	
?>