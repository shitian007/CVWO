<?php
include("loggednavbar.php");
?>
    
<div class="jumbotron">
    <div class="jumbo-header">Popular Posts</div>
    <p style="font-size: 15px; color: red; text-align: center">(Coming Soon!)</p>
</div>

<div class="container">
    
    <div class="row col-sm-offset-2 col-sm-2">
        <form method="GET" action="writepost.php">
            <button type="submit" class="btn btn-info" id="writepostBtn">PEN YOUR THOUGHTS</button>
        </form>
        <p>Write a new post.</p>
    </div>

    <div class="row col-sm-offset-1 col-sm-2">
        <form method="GET" action="#">
            <button type="submit" class="btn btn-warning" id="editBtn">CONTINUE YOUR WORK</button>
        </form>
        <p>Edit an existing saved entry.</p>
        <p style="font-size: 15px; color: red; text-align: center">(In Progress)</p>
    </div>
    
    <div class="row col-sm-offset-1 col-sm-2">
        <form method="GET" action="#">
            <button type="submit" class="btn btn-success" id="viewcommentsBtn">VIEW COMMENTS</button>
        </form>
        <p>See what others have to say about your stories.</p>
        <p style="font-size: 15px; color: red; text-align: center">(In Progress)</p>
    </div>

    <div class="row col-sm-12" style="text-align: center; margin-top: 5px;">
        <u>VIEW MY PUBLISHED POSTS</u>
    </div>

    <div class="row col-sm-12" style="text-align: center;">
        <?php
            $user = $_SESSION['username'];
            viewPosts($user, $conn);
        ?>
    </div>

</div>    
    
    
    
    
</body>
</html>