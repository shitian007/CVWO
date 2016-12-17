<?php

    // Displays corresponding errors for registration
    function regError() {
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strpos($url, 'error=empty')) {
		    echo "<div style='color: red'>Please fill out all fields!</div>";
		} else if (strpos($url, 'error=nomatch')) {
            echo "<div style='color: red'>Passwords do not match!</div>";
        } else if (strpos($url, 'error=usertaken')) {
            echo "<div style='color: red'>Sorry, username already taken!</div>";
        } else {
            ;
        }
    }
    // Displays corresponding errors for login
    function loginError() {
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if (strpos($url, 'error=wrong')) {
		    echo "<div style='color: red; font-size: 14px'>Wrong Username or Password! <a style='color: green' href='#registerForm'> Register Here</a></div>";
		} else {
            ;
        }
    }
    
    // Displays the title according to the url 
    function displayTitle($conn) {
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if (strpos($url, 'index.php')) {
		    echo "<title>Blog: User Home</title>";
		} else if (strpos($url, 'writepost.php')) {
            echo "<title>Blog: Write a Post</title>";
        } else if (strpos($url, 'viewposts.php')) {
            $postid = '6';
            echo "<title>Blog: " . postAtt($postid, 'title', $conn) . "</title>";
        } else {
            ;
        }
    }

    // Retains indentations and line-spacings in textarea
    function mynl2br($text) { 
        return strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />')); 
    }   

    // Extracs post id from url
    function getPostId() {
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $postId = explode('postid=', $url)[1];
        return $postId;
    }

    // Finds attribute in post table with postid
    function postAtt($postid, $att, $conn) {
        $sql = "SELECT * FROM posts WHERE postid='$postid' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $postTitle = $row[$att];
        return $postTitle;
    }

    // Lists out all published posts by user
    function viewPosts($user, $conn) {
        $sql = "SELECT * FROM posts WHERE user='$user'";
        $query = mysqli_query($conn, $sql);
        // Get all posts by user and list them
        while($i = mysqli_fetch_array($query)) {
            $id = $i['postid'];
            $title = $i['title'];
            if (checkPublishStatus($id, $conn)) {
                echo 
                "<div style='margin: 5px'>
                    <a href='viewposts.php?postid=" . $id . "'>" . $title . "</a>
                </div>";
            } else {
                ;
            }
            
        }
   }

   // Returns 1 if post has been published, 0 otherwise 
    function checkPublishStatus($postId, $conn) {
        $sql = "SELECT * FROM posts WHERE postid='$postId' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        return $row['publish'];
    }

    function viewComments($postId, $conn) {
        $sql = "SELECT * FROM comments WHERE postid='$postId'";
        $query = mysqli_query($conn, $sql);
        // Get all posts by user and list them
        while($i = mysqli_fetch_array($query)) {
            $user = $i['commentuser'];
            $comment = $i['comment'];
            echo 
            "<div>
                <p><i>" . $user . ": </i></p>
            </div>
            <div style='margin-bottom: 10px'>
                <p>" . $comment . "</p>
            </div";
        }
   }

?>