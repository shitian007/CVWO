<?php
	session_start();
	
	// include database handler
	include_once('dbh.php');

	// Catch if user is not logged in
	if(!$_POST['loginBtn']) {
		header("Location: ../home.php");
	} else if ($_POST['loginBtn']) {
		//Prevention of sql injection
		// Strip html tags 
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		// Strip possible commenting slashes 
		$username = stripslashes($username);
		$password = stripslashes($password);
		// Escape quotation marks with backslashes
		$username = mysqli_real_escape_string($conn, $username);
		$password = mysqli_real_escape_string($conn, $password);
		// Basic encryption of password
		$password = md5($password);
		// Selections of two same usernames not allowed
		$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
		$query = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($query);
		// Select id and password from row of table
		$id = $row['id'];
		$database_password = $row['password'];

		if ($password == $database_password) {
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $id;
			header("Location: ../index.php");
		} else {
			header("Location: ../home.php?error=wrong");
            exit();
		}	
	}
?>