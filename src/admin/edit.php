<?php

session_start();

	// include database handler
	include_once('dbh.php');
	include_once('functions.php');

	$user = $_SESSION['username'];
	$postId = $_SESSION['postId'];
	$title = $_POST['title'];
	$title = mysqli_real_escape_string($conn, $title);
	$content = $_POST['postContent'];
	$content = mynl2br($content);
	$content = mysqli_real_escape_string($conn, $content);
	// Check if user is owner of post
	if (postAtt($postId, 'user', $conn) !== $user) {
		echo 
		"<script>
			alert('Please make sure you are the owner of the post!');
			window.location.href='../index.php';
		</script>";
	} else if ($_POST['savepostBtn']) {
		$sqlSave = "UPDATE `blog`.`posts` SET `title`='$title', `postcontent`='$content' WHERE `postid`='$postId';";
       	$result = mysqli_query($conn, $sqlSave);
       	header("Location: ../index.php");
	} else if ($_POST['publishpostBtn']) {
		$sqlPublish = "UPDATE `blog`.`posts` SET `title`='$title', `postcontent`='$content', `publish`='1' WHERE `postid`='$postId';";
        $result = mysqli_query($conn, $sqlPublish);
        header("Location: ../index.php");
	} else {
		header("Location: ../editpost.php");
	}

?>