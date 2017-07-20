<head><meta charset="UTF-8">
<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.indigo-teal.min.css" /> 
<script src="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script><script src="/analytics.js"></script><script src="/swipe.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/css/styles.css">
<script src="/jquery.lazyload.js" type="text/javascript"></script>
<script src="/jquery.scrollstop.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<link rel="stylesheet" href="/css/posts.css">
<link rel="stylesheet" href="/css/card.css">
<link rel="icon" href="favicon.png" type="image/png">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<title>Home</title>
</head>
<body>
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">News</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <button id="refreshericon" class="mdl-button mdl-js-button mdl-button--icon" onclick="location.reload();">
          <i class="material-icons">refresh</i>
      </button>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title"><a href="/">Radio</a></span>
    <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="/index.php">News</a>
        <a class="mdl-navigation__link" href="/listen.html">Listen</a>
        <a class="mdl-navigation__link" href="/watch.php">Watch</a>
        <a class="mdl-navigation__link" href="/podcasts.php">Listen Again</a>
    </nav>
  </div>
<main class="mdl-layout__content">
    <div class="page-content">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--12-col" style="line-height: 1.5">
              <?php
error_reporting(0);
$servername = "localhost";
$username = "rnz_app_api";
$password = "UQBa9HrAhFQ77Mbw";
$dbname = "rnz_app";

$adcode = "<iframe src='/ad.html' style='width: 100%; height: auto; border: 0; float: left;' ></iframe>";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	echo "<div class=\"alert alert-danger\" role=\"alert\">An error occured while retriving stories! I'll be onto it <br>";
    die("Connection failed: " . $conn->connect_error);
	echo "</div>";
}
$sql = "SELECT * FROM `topics` ORDER BY  `topics`.`EpochDate` DESC";
$result = $conn->query($sql);
$storytitles = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         $title = $row['RawTitle'];
         $description = $row['Description'];
         $image = $row['ImageURL'];
         $date = $row['Date'];
         $link = $row['id'];
         $category = $row['category'];
         $url = $row['URL'];
         $currenturl = "http://rnz.isaacmercer.nz/index.php?pos=$category$link#$category$link";
         echo '<div class="card" id="'.$category .  $link . '" onClick="window.location=\'/article.php?ref=foryou&category='.$category.'&id='.$link.'&url='.$url.'&refurl='.$currenturl.'\';">
                   <div class="image">';
				   		if (strpos($image, 'http://') !== false) {
							echo '<img class="lazy" style="width: 100%" src="fallbackimages/4.jpg" data-original="'.$image.'"</img>';
						} else {
							echo '<img class="lazy" style="width: 100%" src="fallbackimages/4.jpg" data-original="http://radionz.co.nz'.$image.'"</img>';
						} 
						echo'
                        <span class="title" style="text-overflow: ellipsis">' .$title. '</span>
                   </div>
                   <div class="content">
                          <small><em>Posted on '.$date.'</em></small></p>
                          <p>'.$description.'</p>
                  </div>
                  <div class="action">
                        <a href="/article.php?ref=foryou&category='.$category.'&id='.$link.'&url='.$url.'&refurl='.$currenturl.'">Read More</a><br>
                  </div>
                </div>';
    }
} else {
}
    
?>
          </div>
        </div>
      </div>
      <script>
        var iframes = $('iframe');

        $('button').click(function() {
            iframes.attr('src', function() {
                return $(this).data('src');
            });
        });

        iframes.each(function() {
            var src = $(this).attr('src');
            $(this).data('src', src).attr('src', '');
        });
          
      	$("img.lazy").lazyload({
      	event : "loadcomplete"
      });
      $(window).bind("load", function() {
          iframes.attr('src', function() {
                return $(this).data('src');
          });
          $("img.lazy").trigger("loadcomplete");
          setTimeout(function(){
            document.getElementById('<?php echo $_GET["pos"];?>').scrollIntoView(); 
            }, 1500);
});      </script>
  </main>
</div>
</body>
