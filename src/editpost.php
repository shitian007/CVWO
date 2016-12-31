<?php
include("loggednavbar.php");
?>

<div class="container"  style="margin-top: 100px;">
	
	<div class="row col-xs-12 col-sm-3">
		<span class="side-header" style="font-size: 30px;">Edit Saved Posts</span>
		
		<?php
			$user = $_SESSION['username'];
			viewSavedPosts($user, $conn);

			// Check if postid within url corresponds to a post that has already been published 
			if (getPostId() > 0) {
				$PostId = getPostId();
				if (checkPublishStatus($PostId, $conn)) {
					// Add javascript alert here
					header("Location: index.php");
				} else {
					$_SESSION['postId'] = getPostId();;
				}
			} else {
				;
			}
		?>
	</div>

	<div class="row col-xs-12 col-sm-9 post-content justified">
		<form method="POST" action="admin/edit.php">	
			<span>Title: &nbsp;   
				<textarea id="title" rows="1" cols="50" name="title" style="margin-top: 15px"><?php
						if (getPostId() > 0) {
							echo postAtt($PostId, "title", $conn);
						}
					?>
				</textarea> 	
			</span>
			<span class="postcontent justified">
				<textarea id="postContent" rows="20" cols="90" name="postContent"><?php
						if (getPostId() > 0) {
							$rawContent = postAtt($PostId, "postcontent", $conn);
							$breaks = array("<br />","<br>","<br/>");  
							$postContent = str_ireplace($breaks, "\r\n", $rawContent);
							echo $postContent;
						}?>
				</textarea>
			</span>

			<div style="text-align: center; padding-top: 10px">
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