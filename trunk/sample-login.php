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
		$TBS->LoadTemplate('./template/sample-login.html');    // <----- Place this script HTML
	
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
	
	// If logout button clicked
	if ( $_GET['logout'] == 1 ) 
	   $user->logout('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	
	// If user is login?
	if ( !$user->is_loaded() )
  {
      // User is NOT Loaded
    	// Checking Login input
    	if ( isset($_POST['uname']) && isset($_POST['pwd'])){
    	  
    	  // Check Login User Password
        if ( !$user->login($_POST['uname'],$_POST['pwd'],$_POST['remember'] )){//Mention that we don't have to use addslashes as the class do the job
    	    // Wrong User
          $message .= 'Wrong username and/or password';
    	  }else{
    	    // Correct User
    	    header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
    	  }
    	  
    	}
  	
  	  // Display Login Form
    	$message .= '<h1>Login</h1>
	                <p><form method="post" action="'.$_SERVER['PHP_SELF'].'" />
              	  username: <input type="text" name="uname" /><br /><br />
              	  password: <input type="password" name="pwd" /><br /><br />
              	  Remember me? <input type="checkbox" name="remember" value="1" /><br /><br />
              	  <input type="submit" value="login" />
              	  </form>
              	  </p>';
                	  
  }else{
    
      // User is Loaded
      // Display Logout Link
      $message .= '<h1>Logout</h1><br>Welcome, '. $user->get_property('username') .'<br>';
      $message .= '<a href="index.php">Home</a><br>';
      $message .= '<a href="'.$_SERVER['PHP_SELF'].'?logout=1">logout</a>';
  
  }
	
	
	
	
	
	// ****************************************************
	
	
	// Show result
	$TBS->Show() ;
	
?>