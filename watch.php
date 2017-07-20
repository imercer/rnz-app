<head><meta charset="UTF-8">
<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.indigo-teal.min.css" />
<script src="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script><script src="/analytics.js"></script><script src="/swipe.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/css/styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<link rel="stylesheet" href="/css/posts.css">
<link rel="stylesheet" href="/css/card.css">
<link rel="icon" href="favicon.png" type="image/png">
<title>Watch Checkpoint</title>
<style>
.nothidden {
    display: inline-block;
}
.material-icons {
    font-size: inherit;
}
video {
    width: 320px !important;
    height: 320px !important;
    margin: auto !important;
}
iframe {
    display: block;
    width: 100%;
    border: none;
    height: 80%;
 }
</style>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Watch Checkpoint</span>
    </div>
    <!-- Tabs -->
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
<main class="mdl-layout__content" style="text-align: center">
    <?php
        require_once('simple_html_dom.php');
        require_once('url_to_absolute.php');
        $html = file_get_html('http://www.radionz.co.nz/national/programmes/checkpoint');
        $video = $html->find('div.video-stream', 0);
        echo $video;
		if (!isset($video)) {
			echo 'Checkpoint is currently not streaming at this time';
		}
    ?>
  </main>
</div>
<script>
function nationalplay() {
    document.getElementById("nationalicon").className = "material-icons nothidden";
}
function nationalpause() {
    document.getElementById("nationalicon").className = "material-icons hidden";
}
function concertplay() {
    document.getElementById("concerticon").className = "material-icons nothidden";
}
function concertpause() {
    document.getElementById("concerticon").className = "material-icons hidden";
}
function internationalplay() {
    document.getElementById("internationalicon").className = "material-icons nothidden";
}
function internationalpause() {
    document.getElementById("internationalicon").className = "material-icons hidden";
}
function parliamentplay() {
    document.getElementById("parliamenticon").className = "material-icons nothidden";
}
function parliamentpause() {
    document.getElementById("parliamenticon").className = "material-icons hidden";
}
</script>
</body>