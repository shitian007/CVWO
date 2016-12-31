<?php
include("loggednavbar.php");
?>
    
<div class="jumbotron">
    <div class="jumbo-header">Popular Posts</div>
    <div class="row col-sm-offset-2">   
        <?php
            popularPosts($conn);
        ?>
    </div>
</div>

<div class="container">
    
    <div class="row col-sm-offset-2 col-sm-2">
        <form method="POST" action="writepost.php">
            <button type="submit" class="btn btn-info" id="writepostBtn">PEN YOUR THOUGHTS</button>
        </form>
        <p>Write a new post.</p>
    </div>

    <div class="row col-sm-offset-1 col-sm-2">
        <form method="POST" action="editpost.php">
            <button type="submit" class="btn btn-warning" id="editBtn">CONTINUE YOUR WORK</button>
        </form>
        <p>Edit an existing saved entry.</p>
    </div>
    
    <div class="row col-sm-offset-1 col-sm-2">
        <form action="commentpage.php">
            <button type="submit" class="btn btn-success" id="viewcommentsBtn">RECENT COMMENTS</button>
        </form>
        <p>See what others have to say about your stories.</p>
    </div>

    <div class="row col-sm-12 justified">
        <button id="postsBtn" class="btn-danger" onclick="displayPosts()">VIEW MY PUBLISHED POSTS</button>
    </div>

    <div id="userPosts" class="row col-sm-12" style="text-align: center;">
        <?php
            $user = $_SESSION['username'];
            viewPosts($user, $conn);
        ?>
    </div>
</div>     

<script>
    $(document).ready(function() {
        $("#postsBtn").click(function(){
            $("#userPosts").fadeIn(1000);
        });
    });
</script>
    

</body>
</html>
    
    
</body>
</html>