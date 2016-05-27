<?php

  // Use this PHP File As your Development
  
	// ****************  Default include  ****************
	
		// include All file
		include_once('all.php');
		
		// New template engine object
		$TBS = new clsTinyButStrong;
		// Load Your HTML file
		$TBS->LoadTemplate('views/index.html');    // <----- Place this script HTML
	
	// ****************************************************
	
	// **************  Write Your Code Here  **************

	$title = 'Rojak Engine';
	$message = 'Mix and Match ';
	
	// ****************************************************
	
	// Show result
	$TBS->Show() ;
	
	// **************  Example Code Here  *****************
	
		/*

		// Create database connection
			$db = NewADOConnection('mysql');
			$db->Connect($R_Host, $R_User, $R_Pass, $R_DB);
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
		 
		// SQLite connection
			// Try Connect Database
			$db = &ADONewConnection('pdo');
			$db->PConnect('sqlite:sqlite.db');

		*/
	
	// ****************************************************
	
?>