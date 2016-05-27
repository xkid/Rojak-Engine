<?php

  // Use this PHP File As your Development
  
	// ****************  Default include  ****************
	
		// include All file
		include_once('../all.php');
		
		// New template engine object
		$TBS = new clsTinyButStrong;
		// Load Your HTML file
		$TBS->LoadTemplate('index.html');    // <----- Place this script HTML
	
	// ****************************************************
	
	// **************  Write Your Code Here  **************
	
	$title = 'Rojak Engine Examples';
	$message = 'Examples';
	
	// Scan All files in current directory
	$links = scandir('./');
	// Check each link for filter . .. index.php user and all .html
	foreach ($links as $key => $link) {
		if ((substr($link,-5) == '.html') || ($link == '.') || ($link == '..') || ($link == 'index.php') || ($link == 'user')){
			// Remove that array
			unset($links[$key]);
		}
	}
	// Merge array to HTML
	$TBS->MergeBlock('blk1',$links);
	
	// ****************************************************
	
	// Show result
	$TBS->Show() ;
	
?>