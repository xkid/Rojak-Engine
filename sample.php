<?php

  // Use this PHP File As your Development
  
	// ****************  Default include  ****************
	
		// include All file
		include_once('all.php');
		
		// New template engine object
		$TBS = new clsTinyButStrong;
		// Load Your HTML file
		$TBS->LoadTemplate('views/sample.html');    // <----- Place this script HTML
	
	// ****************************************************
	
	// **************  Write Your Code Here  **************
	
	$title = 'Rojak Engine';
	$message = 'Mix and Match';
	
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