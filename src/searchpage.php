<?php
	if (empty($_GET['search'])) {
		header("Location:index.php");
	}
	include("loggednavbar.php");
?>

<div class="jumbotron">
    <div class="justified">Search Results for: </div>
    <div class="justified" style="color: lightgreen;">
    	<?php
    		$searchquery = $_GET['search'];
    		// Allow search only for words
    		$searchquery = stripslashes($searchquery);
    		echo $searchquery;	
    	?>
    </div>
</div>

<div class="container">
	<?php
		// Get all posts
		$posts = getTableArray($conn, 'posts');
		// Convert search to lowercase 
		$searchquery = strtolower($searchquery);

		// Create array of relevant posts with weights assigned according to relevance of content 
		$relevantposts = [];
		for ($i = 0; $i < count($posts); $i++) {
			$weight = 0;
			// Add occurrence of keywords in title
			$weight += numOccurrence($posts[$i]['title'], $searchquery) * 2;
			// Add occurrence of keywords in content
			$weight += numOccurrence($posts[$i]['postcontent'], $searchquery);
			// Entire phrase within title
			if (strpos(strtolower($posts[$i]['title']), $searchquery)) {
				$weight += 100;
			// Entire phrase within content	
			} if (strpos(strtolower($posts[$i]['postcontent']), $searchquery)) {
				$weight += 50;
			} if ($weight > 0) {
				$relevantposts[$i] = $posts[$i];
				$relevantposts[$i]['priority'] = $weight;
			}
		}

		if (count($relevantposts) < 1) {
			echo "No results found";
		} else {
			usort($relevantposts, function ($item1, $item2) {
	            return $item1['priority'] < $item2['priority'] ? 1 : -1;
	        });

	        for ($i = 0; $i < count($relevantposts); $i++) {
	        	echo "<div><a href='viewposts.php?postid=" . $relevantposts[$i]['postid'] . "'>" . $relevantposts[$i]['title'] ."</a></br></br>" . 
	        	shorten($relevantposts[$i]['postcontent'], 40) .  
	        	"</br></br></br></div>";
	        }
		}
	?>
</div>