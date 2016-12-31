<?php
    
    // Displays corresponding errors for registration
    function regError() {
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strpos($url, 'error=empty')) {
		    echo "<div style='color: red'>Please fill out all fields!</div>";
        } else if (strpos($url, 'error=short')) {
            echo "<div style='color: red'>Username and Password have to be more than 8 characters long</div>";
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
        if (strpos($url, 'postid')) {
            $postId = explode('postid=', $url)[1];
            return $postId;
        } else {
            ;
        }
    }

    // Finds attribute in post table with postid
    function postAtt($postid, $att, $conn) {
        $sql = "SELECT * FROM posts WHERE postid='$postid'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $attribute = $row[$att];
        return $attribute;
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

   // Lists out all saved posts by user
   function viewSavedPosts($user, $conn) {
        $sql = "SELECT * FROM posts WHERE user='$user'";
        $query = mysqli_query($conn, $sql);
        // Get all posts by user and list them
        while($i = mysqli_fetch_array($query)) {
            $id = $i['postid'];
            $title = $i['title'];
            if (!checkPublishStatus($id, $conn)) {
                echo 
                "<div style='margin: 5px'>
                    <a href='editpost.php?postid=" . $id . "'>" . $title . "</a>
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

    // Lists out comment for specific post
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

    // Creates a multi-dimensional array with all rows of table
    function getTableArray($conn, $table) {
        $sql = "SELECT * FROM $table";
        $query = mysqli_query($conn, $sql);
        $count = 0;
        $array = [];
        // Create array of each row
        while ($arr = mysqli_fetch_array($query)) {
            $array[$count] = $arr;
            $count += 1;
        }
        return $array; 
    }

    // Adds views to a post if viewer is not writer of post
    function addViews($conn, $postId, $user) {
        $postSql = "SELECT * FROM posts WHERE postid = '$postId' LIMIT 1";
        $query = mysqli_query($conn, $postSql);
        $array = mysqli_fetch_array($query);
        $username = $array['user'];
        if ($username !== $user) {
            $newViews = $array['views'] + 1;
            $viewsSql = "UPDATE `blog`.`posts` SET `views`='$newViews' WHERE `postid`='$postId'";
            mysqli_query($conn, $viewsSql);
        } else {
            ;
        }
    }

    // Counts number of occurrences of keywords of search phrase within content
    function numOccurrence($content, $searchquery) {
        $keywords = preg_split("/[\s,]+/", $searchquery);
        $num = 0;
        for ($i = 0; $i < count($keywords); $i++) {
            if (empty($keywords[$i])) {
                ;
            } else {
                $num += substr_count(strtolower($content), $keywords[$i]);
            }
        }
        return $num;
    }

    // Truncates content after a certain length
    function shorten($content, $length) {
        if (strlen($content) > $length) {
            return substr($content, 0, $length) . "...";
        } else {
            return $content;
        }
    }

    // Prints out the popular posts of the blog site 
    function popularPosts($conn) {
        $array = getTableArray($conn, 'posts');
        // Remove unpublished posts
        for ($i = 0; $i < count($array); $i++) { 
            if (checkPublishStatus($array[$i]['postid'], $conn)) {
                ;
            } else {
                unset($array[$i]);
            }
        }
        // Sort multi-dimensional array by key = 'views'
        usort($array, function ($item1, $item2) {
            if ($item1['views'] == $item2['views']) {
                return 0;
            } else {
                return $item1['views'] < $item2['views'] ? 1 : -1;
            }
        });
        // At least 3 posts within site to determine popular posts
        if (count($array) < 3) {
            echo "Currently not enough posts to determine which ones are popular!";
        } else {
            for ($i = 0; $i < 3; $i++) {
                echo "<div class='col-sm-offset-1 col-sm-2'>
                <a href='viewposts.php?postid=" . $array[$i]['postid'] . "'>" . $array[$i]['title'] . "</a></br>
                <div>" . shorten($array[$i]['postcontent'], 100) . "</div>
                </div>";
            }
        }
    }

?>