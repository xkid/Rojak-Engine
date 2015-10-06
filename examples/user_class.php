<?php

  // Use this PHP File As your Development
  
	// ****************  Default include  ****************
	
		// include All file
		include_once('../all.php');
	
	// ****************************************************
	
	// **************  Write Your Code Here  **************
	
	class user{

		var $db;
	
		function __construct() {
			if (file_exists(__DIR__.'/user')){
				$this->db = &ADONewConnection('pdo');
				$this->db->Connect('sqlite:'.__DIR__.'/user');
			}else{
				$this->db = &ADONewConnection('pdo');
				$this->db->Connect('sqlite:'.__DIR__.'/user');
				$this->db->execute("create table user(email,level)");
			}
		}
		
		function adduser($email,$level){
			$this->db->execute("insert into user(email,level) values ('".$email."','".$level."')");
		}
		
		function updateuser($email,$level){
			$this->db->execute("update user set level='".$level."' where email='".$email."'");
		}
		
		function deleteuser($email){
			$this->db->execute("delete from user where email='".$email."'");
		}
		
		function listuser(){
			$rs=$this->db->execute("select * from user");
			$rs = $rs->GetArray();
			return $rs;
		}
		
		function checkuser($user,$page_level){
			$approve = false;
			$rs = $this->listuser();
			foreach ($rs as $k => $v){
				if ($v['email'] == $user){
					$user_level = explode(',',$v['level']);
					foreach ($user_level as $v){
						if ($v >= $page_level){
							$approve = true;
						}
					}
				}
			}
			return $approve;
		}
		
	}
	
	// ****************************************************
	
?>