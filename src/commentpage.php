<?php
	include("loggednavbar.php");
?>

<div class="jumbotron">
    <div class="jumbo-header">Comments on your posts</div>
</div>

<div class="container justified">
	<?php
		$username = $_SESSION['username'];

		// Get all posts by user
        $posts_sql = "SELECT * FROM posts WHERE user='$username'";
        $userposts_query = mysqli_query($conn, $posts_sql);
        $postids = [];
        $comments = [];
        $post_count = 0;
        $comment_count = 0;
        // Get array of postids for posts of user
        while ($post = mysqli_fetch_array($userposts_query)) {
            $postid = $post['postid'];
            $postids[$post_count] = $postid;
            $post_count += 1;
            // Get comments for each post
            $comments_sql = "SELECT * FROM comments WHERE postid='$postid'";
            $comments_query = mysqli_query($conn, $comments_sql);
            while ($comment = mysqli_fetch_array($comments_query)) {
                $comments[$comment_count] = $comment; 
                $comment_count += 1;   
            }
        }

        usort($comments, function ($item1, $item2) {
            return $item1['commentid'] < $item2['commentid'] ? 1 : -1;
        });

        for ($i = 0; $i < count($comments); $i++) {
            echo "<div style='margin: 20px;'>" . $comments[$i]['commentuser'] . "</br>" . 
            $comments[$i]['comment'] . "</br>" . 
            "<a href='viewposts.php?postid=" . $comments[$i]['postid'] . "'>" . "View this post" . "</a></br>
            </div>"; 
        }
	?>
</div>
