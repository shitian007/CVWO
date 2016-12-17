<?php
include("loggednavbar.php");
?>

<div class="writepost">
	<div class="row col-sm-12 justified">
		<h1>Write A New Post</h1>
	</div>
	<div class="row col-xs-12 justified">
	<form method="POST" action="admin/newpost.php">
		<div>
			<span>Title: </span>
			<input style="width: 500px; margin: 20px;" type="text" name="title" placeholder="Post Title">
		</div>
		<textarea rows="20" cols="100" name="postContent" placeholder="Your content"></textarea>
		
		<div style="text-align: right; padding-top: 10px">
			<input type="submit" name="savepostBtn" value="Save Entry">
			<input type="submit" name="publishpostBtn" value="Publish Post">
		</div>

	</form>
	</div>
</div>
</body>
</html>