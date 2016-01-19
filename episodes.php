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
<title>Podcasts</title>
<style>
video {
    border-radius: 2px 2px 0 0;
    position: relative;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    width: 100%;    
}
    .title {
        position: absolute;
        top: 0;
        left: 0;
        padding: 20px;
        color: #FFF;
        width: 100%;
        background-color: rgba(0,0,0,0.8);
        bottom: auto !important;
    }
</style>
</head>
<body>
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Episodes</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <button id="refreshericon" class="mdl-button mdl-js-button mdl-button--icon" onclick="location.reload();">
          <i class="material-icons">refresh</i>
      </button>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title"><a href="/">RNZ</a></span>
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
$series = $_GET['series'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT image FROM `podcast_series` WHERE series LIKE '$series'";
$result = $conn->query($sql);
$storytitles = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         $image = $row['image'];
    }
} else {
}              
              
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `podcasts` WHERE series LIKE '$series' ORDER BY  `podcasts`.`EpochDate` DESC";
$result = $conn->query($sql);
$storytitles = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         $name = $row['Title'];
         $audio = $row['URL'];
         echo '<div class="card card-square">
                   <div class="image">
                <video controls preload="none" poster="'.$image.'">
                   <source src="'.$audio.'" type="audio/mpeg">
                   <p>Your browser does not support the <code>audio</code> element </p>
                </video>
                <span class="title" style="text-overflow: ellipsis">' .$name. '</span>
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
