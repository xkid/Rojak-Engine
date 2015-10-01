<?php

  // Use this PHP File As your Development
  
	// ****************  Default include  ****************
	
		// include All file
		include('all.php');
		
		// New template engine object
		$TBS =& new clsTinyButStrong;
		// Load Your HTML file
		$TBS->LoadTemplate('views/user.html');    // <----- Place this script HTML
	
	// ****************************************************
	
	// **************  Write Your Code Here  **************
	
	$title = 'Rojak Engine';
	$message = 'User Control';
	
	class user{

		var $db;
	
		function __construct() {
			
			if (file_exists('user')){
				$this->db = &ADONewConnection('pdo');
				$this->db->Connect('sqlite:user');
			}else{
				$this->db = &ADONewConnection('pdo');
				$this->db->Connect('sqlite:user');
				$this->db->execute("create table user(email,level)");
			}
		}
		
		function adduser($email,$level){
			$this->db->execute("insert into user(email,level) values ('".$email."','".$level."')");
		}
		
		function updateuser($email,$level){
			$this->db->execute("update user set level='".$level."' where email='".$email."')");
		}
		
		function deleteuser($email){
			$this->db->execute("delete from user where email='".$email."'");
		}
		
		function listuser(){
			$rs=$this->db->execute("select * from user");
			return $rs->GetArray();
		}
		
	}
	
	$user = new user();
	
	if (isset($_GET['add'])){
		if (isset($_POST['email']) && isset($_POST['level'])){
			if (($_POST['email'] != '') && ($_POST['email'] != '')){
				$user->adduser($_POST['email'],$_POST['level']);
			}
		}
	}
	
	if (isset($_GET['update'])){
		if (isset($_POST['email']) && isset($_POST['level'])){
			if (($_POST['email'] != '') && ($_POST['email'] != '')){
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
	
	$TBS->MergeBlock('blk1',$user->listuser());
	
	// ****************************************************
	
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
	
	// Show result
	$TBS->Show() ;
	
?>