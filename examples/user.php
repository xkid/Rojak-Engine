<?php

  // Use this PHP File As your Development
  
	// ****************  Default include  ****************
	
		// include All file
		include_once('../all.php');
		
		// New template engine object
		$TBS = new clsTinyButStrong;
		// Load Your HTML file
		$TBS->LoadTemplate('user.html');    // <----- Place this script HTML
	
	// ****************************************************
	
	// **************  Write Your Code Here  **************
	
	$title = 'Rojak Engine';
	$message = 'User Control';
	
	include('user_class.php');
	
	// Declare User Class
	$user = new user();
	
	if (isset($_GET['add'])){
		if (isset($_POST['email']) && isset($_POST['level'])){
			if (($_POST['email'] != '') && ($_POST['level'] != '')){
				$user->adduser($_POST['email'],$_POST['level']);
			}
		}
	}
	
	if (isset($_GET['update'])){
		if (isset($_POST['email']) && isset($_POST['level'])){
			if (($_POST['email'] != '') && ($_POST['level'] != '')){
				$user->updateuser($_POST['email'],$_POST['level']);
			}
		}
	}
	
	if (isset($_GET['delete'])){
		if (isset($_POST['email'])){
			if ($_POST['email'] != ''){
				$user->deleteuser($_POST['email']);
			}
		}
	}
	
	$rs = $user->listuser();
	
	// Replace Array[k][0] for CSS ID
	foreach ($rs as $k => $v){
		foreach ($v as $k2 => $v2){
			if ($k2 == 0){
				$rs[$k][0] = "L_$k";
			}
		}
	}
	
	$TBS->MergeBlock('blk1',$rs);
	
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