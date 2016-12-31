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
			<input style="width: 500px; margin: 20px;" type="text" id="title" name="title" placeholder="Post Title">
		</div>
		<textarea rows="20" cols="100" id="postContent" name="postContent" placeholder="Your content"></textarea>
		
		<div style="text-align: right; padding-top: 10px">
			<input onclick="return checkEmpty()" type="submit" name="savepostBtn" value="Save Entry">
			<input onclick="return checkEmpty()" type="submit" name="publishpostBtn" value="Publish Post">
		</div>

	</form>
	</div>
</div>

<script type="text/javascript">
	// Check if textarea field are empty
	function checkEmpty() {
		if ((document.getElementById("title").value).replace(/\s+/, "").length < 1) {
			alert("Please give your post a title!");
			return false;
		} else if ((document.getElementById("postContent").value).replace(/\s+/, "").length < 1) {
			alert("Please do not leave the content blank!");
			return false;
		} else {
			return true;
		}
	}	
</script>

</body>
</html>