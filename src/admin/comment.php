<?php
	session_start();
	
	// include database handler
	include_once('dbh.php');
	include_once('functions.php');

	if(!$_POST['commentBtn']) {
		header("Location: ../home.php");
	} else if ($_POST['commentBtn']) {
		
		$postId = $_SESSION['postId'];
		$commentUser = $_SESSION['username'];
		$commentContent = $_POST['commentContent'];
		$commentContent = mynl2br($commentContent);
		$commentContent = mysqli_real_escape_string($conn, $commentContent);

		$sqlSave = "INSERT INTO comments (postid, commentuser, comment) VALUES ('$postId', '$commentUser', '$commentContent')";
       	$result = mysqli_query($conn, $sqlSave);
       	header("Location: ../viewposts.php?postid=" . $postId);
	}

?>
