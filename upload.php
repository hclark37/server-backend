<?php
$secret_key = "PASSWORDGOESHERE"; // Your Private Key that's used for ShareX connection
$user_list = '../logs/users.txt';
$users = file($user_list, FILE_IGNORE_NEW_LINES);
$sharexdir = "archive/"; // where are your images stored
if(isset($_POST['user'])) {
	if(in_array($_POST['user'], $users)) { //new user name 
        	global $sharexdir;
		$sharexdir = "archive/" . $_POST['user'] . "/"; //where you can add another user 
		if (!is_dir("archive/" . $_POST['user'] . "/")) {
			if (mkdir(("archive/" . $_POST['user'] . "/"), 0755, true)) {
				echo "User directory successfully created. ";
			} else {
				echo "User directory creation failed. Falling back to default. ";
				$sharexdir = "archive/";
			}
		}
	}
}

$domain_url = '0.0.0.0'; // Your domain name

if(isset($_POST['secret'])) {
	if($_POST['secret'] == $secret_key) {
        	$target_file = $_FILES["sharex"]["name"];
	        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
		if (move_uploaded_file($_FILES["sharex"]["tmp_name"], $sharexdir.$target_file)) {
			echo "http://".$domain_url."/".$sharexdir.$target_file;
        	} else {
           		echo "An error occured. ";
        	}
    	} else {
        	echo 'Invalid secret key. ';
    	}
} else {
	echo 'No data received. This is a ShareX Server.</a>';
}
?>
