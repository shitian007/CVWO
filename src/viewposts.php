<?php
include("loggednavbar.php");
?>

<div class="container" style="margin-top: 100px;">
	
	<div class="row col-sm-8">
		<div class="posttitle">
			<i><?php
				if (checkPublishStatus(getPostId(), $conn) > 0) {
					$_SESSION['postId'] = getPostId();
					echo postAtt(getPostId(), 'title', $conn);
				} else {
					header("Location: index.php");
				}
			?></i>
		</div>
		<div>
			<?php
				if (checkPublishStatus(getPostId(), $conn) > 0) {
					echo postAtt(getPostId(), 'postcontent', $conn);
				} else {
					header("Location: index.php");
				}
			?>
		</div>
	</div>

	<div class="row col-sm-offset-1 col-sm-3">
		<div class="side-header">Similar Posts</div>
		<p style="font-size: 15px; color: red; text-align: center ">(In Progress)</p>		
	</div>

	<div class="row col-sm-8" style="margin-top: 50px;">
		<p style="font-size: 25px">Comment Section</p>
		<?php
			viewComments(getPostId(), $conn);
		?>
		<form method="POST" action="admin/comment.php">
			<textarea rows="4" cols="90" placeholder="Comment" name="commentContent"></textarea></br>
			<input type="submit" name="commentBtn" value="Comment">
		</form>
	</div>

</div>

</body>
</html>