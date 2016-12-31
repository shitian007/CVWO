<?php
include("loggednavbar.php");
?>

<div class="container" style="margin-top: 100px;">
	
	<div class="row col-sm-8">

		<?php
			if (checkPublishStatus(getPostId(), $conn) > 0) {
				$_SESSION['postId'] = getPostId();
				addViews($conn, $_SESSION['postId'], $_SESSION['username']);
				echo "<div class='posttitle'><i>" . postAtt(getPostId(), 'title', $conn) . "</i></div>";
				echo "<div>" . postAtt(getPostId(), 'postcontent', $conn) . "</div>";
			} else {
				header("Location: index.php");
			}
		?>
	</div>

	<div class="row col-sm-offset-1 col-sm-3">
		<div class="side-header">Similar Titles</div>
		<div><?php
			$title = strtolower(postAtt($_SESSION['postId'], 'title', $conn)); 
			$posts = getTableArray($conn, 'posts');
			$similarPosts = [];

			// Give weights for posts with similar titles
			for ($i = 0; $i < count($posts); $i++) {
				$weight = 0;
				// Add occurrence of keywords in title
				$weight += numOccurrence($posts[$i]['title'], $title);

				if ($weight > 0) {
					$similarPosts[$i] = $posts[$i];
					$similarPosts[$i]['priority'] = $weight;
				}
			}

			if (count($similarPosts) < 1) {
				echo "No similar titles found";
			} else {
				usort($similarPosts, function ($item1, $item2) {
	            	return $item1['priority'] < $item2['priority'] ? 1 : -1;
	        	});

		        for ($i = 0; $i < count($similarPosts); $i++) {
		        	echo 
		        	"<div class='justified'>
		        	<a href='viewposts.php?postid=" . $similarPosts[$i]['postid'] . "'>" . $similarPosts[$i]['title'] ."</a></br></br>
		        	</div>";
	       		}
	       	}
		?></div>			
	</div>

	<div class="row col-sm-8" style="margin-top: 50px;">
		<p style="font-size: 25px">Comment Section</p>
		<?php
			viewComments(getPostId(), $conn);
		?>
	</div>

	<div>
		<form method="POST" action="admin/comment.php">
			<textarea rows="7" cols="90" placeholder="Comment" name="commentContent"></textarea></br>
			<input type="submit" name="commentBtn" value="Comment">
		</form>
	</div>

</div>

</body>
</html>