<?php
	session_start();

	// include database handler
	include_once('dbh.php');
	include_once('functions.php');

	$user = $_SESSION['username'];
	$title = $_POST['title'];
	$title = mysqli_real_escape_string($conn, $title);
	$content = $_POST['postContent'];
	$content = mynl2br($content);
	$content = mysqli_real_escape_string($conn, $content);
	// vary publish post values
	if ($_POST['savepostBtn']) {
		$sqlSave = "INSERT INTO posts (user, title, postcontent, publish) VALUES ('$user', '$title', '$content', '0')";
       	$result = mysqli_query($conn, $sqlSave);
       	header("Location: ../index.php");
	} else if ($_POST['publishpostBtn']) {
		$sqlPublish = "INSERT INTO posts (user, title, postcontent, publish) VALUES ('$user', '$title', '$content', '1')";
        $result = mysqli_query($conn, $sqlPublish);
        header("Location: ../index.php");
	} else {
		header("Location: ../writepost.php");
	}

?>