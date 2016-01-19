<?php session_start(); ?>
<head>
<base href="http://radionz.co.nz">
<meta charset="UTF-8">
<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.indigo-teal.min.css" />
<script src="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script><script src="http://rnz.isaacmercer.nz/analytics.js"></script><script src="http://rnz.isaacmercer.nz/swipe.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="http://rnz.isaacmercer.nz/css/styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="http://rnz.isaacmercer.nz/css/posts.css">
<link rel="icon" href="http://rnz.isaacmercer.nz/favicon.png" type="image/png">
<link rel="stylesheet" href="http://rnz.isaacmercer.nz/css/card.css">
<link rel="stylesheet" href="http://rnz.isaacmercer.nz/css/articles.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="http://rnz.isaacmercer.nz/swipe.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<title>Article</title>
<script>
$(function() {      
                $("#card").swipe( {
                    //Generic swipe handler for all directions
                    swipeRight:function(event, direction, distance, duration, fingerCount) {
                        goBack();                        
                    },
                });
            });
$(function() {      
                $("body").swipe( {
                    //Generic swipe handler for all directions
                    swipeRight:function(event, direction, distance, duration, fingerCount) {
                        goBack();                        
                    },
                });
            }); 
$(document).ready(function(){
//TODO: Need to open links in new window on IOS and ANDROID
  $('#articletext').attr('target', '_blank');
}
</script>
</head>
<body>
    <?php
error_reporting(0);
$table = $_GET["category"];
$articleno = $_GET["id"];
$url = $_GET["url"];
if (isset($_GET['pos'])) {
    $link = $_GET["refurl"];
    $link .= "&pos=";
    $link .= $_GET["pos"];
    $link .= "#";
    $link .= $_GET["pos"];
} else {
    $link = $_GET["refurl"];
}
$servername = "localhost";
$username = "rnz_app_api";
$password = "UQBa9HrAhFQ77Mbw";
$dbname = "rnz_app";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `topics` WHERE url LIKE '%$url%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $title = $row['RawTitle'];
        $description = $row['Description'];
        $image = $row['ImageURL'];
        $date = $row['Date'];
        $url = $row['URL'];
        $body = $row['ArticleContent'];
        $table = $row['category'];
        $articleno = $row['id'];
        $data = "obtained";
        $link = $_GET["refurl"];
        $link .= "&pos=";
        $link .= $table;
        $link .= $articleno;
        $link .= "#";
        $link .= $table;
        $link .= $articleno;
    }
} else {

}
$conn->close();

?>
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header" style="position: fixed">
                <div class="mdl-layout__header-row" style="padding: 8px">
                    <a href="<?php echo $link ?>" style="color: white"><i class="material-icons">arrow_back</i></a>
                  <!-- Title -->
                  <!--<span class="mdl-layout-title" style="padding: 8px">New Zealand News</span>-->
                  <!-- Add spacer, to align navigation to the right -->
                  <div class="mdl-layout-spacer"></div>
                    <a onclick="openSharing()" id="sharingbutton" style="color: white"><i class="material-icons">share</i></a>
                    <div class="hidden" id="sharingurl">
                      <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="sample1" value="<?php echo $url ?>" />
                        <label class="mdl-textfield__label" for="sample1">Sharing URL</label>
                      </div>
                    </div>
                    <a onClick="window.location='http://rnz.isaacmercer.nz/bookmark.php?action=add&category=<?php echo $table ?>&id=<?php echo $articleno ?>&url=<?php echo $url ?>'" style="color: white"><i class="material-icons">bookmark_border</i></a>
                    <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                        <i class="material-icons">format_size</i>
                      </button>

                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        for="demo-menu-lower-right">
                      <li class="mdl-menu__item" onclick='resizeText(1)'>Increase Font Size</li>
                      <li class="mdl-menu__item" onclick='resizeTextDefault()'>Default Font Size</li>
                      <li class="mdl-menu__item" onclick='resizeText(-1)'>Decrease Font Size</li>
                      <li class="mdl-menu__item"><hr></li>
                      <li class="mdl-menu__item" onclick='darkMode()'>Dark Mode</li>
                      <li class="mdl-menu__item" onclick='lightMode()'>Light Mode</li>
                      <li class="mdl-menu__item"><hr></li>
                      <li class="mdl-menu__item" onclick='window.location.href = "http://rnz.isaacmercer.nz/settings.php"'>Change Defaults</li>
                    </ul>
                </div>
              </header>
<main class="mdl-layout__content">
          <div class="page-content <?php echo $bgcolour ?>" id="content">
                      <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--12-col" style="line-height: 1.5">
      <?php
    echo '<div class="card '.$bgcolour.'" id="card">
          <div class="image">
            <img src="'.$image.'"</img>
            <span class="title">' .$title. '</span>
          </div>
          <div class="content" id="articletext" style="font-size: '.$fontsize.'em">
            <!-- Just to make the captions display properly later on -->
            <div class="photo-captioned"><img src="/sggsg" style="width: 0px; height: 0px"/><div class="photo-credit" style="background-color: rgba(0,0,0,0)"></div></div>
            <p>'.$body.'</p>
          </div>
        </div>';

              ?>
  <div class="alert alert-success hidden" style="position: fixed; text-align: center; bottom: 0; right: 0;" id="successmessage">
    I've copied a link to the article. Simply open the app you want to share the link in and press paste.&nbsp;&nbsp;&nbsp;
  </div>
  <div class="alert alert-success hidden" style="position: fixed; text-align: center; bottom: 0; right: 0;" id="warningmessage">
    I couldn't copy the link to the article. You might have to select all of the link text above and copy it manually.&nbsp;&nbsp;&nbsp;
  </div>
<script>
function goBack() {
    window.location="<?php echo $link ?>";
}
function openSharing() {
    document.getElementById("sharingbutton").className = "hidden";
    document.getElementById("sharingurl").className = "nothidden";
    var copyTextarea = document.getElementById('sample1');
    //TODO: SELECTION NEEDS TO BE MADE ON IOS
    copyTextarea.select();
    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        if (msg = 'successful') {
            document.getElementById("successmessage").className = "alert alert-success nothidden";
            setTimeout(function(){
                        document.getElementById("successmessage").className = "alert alert-success hidden";
            }, 10000);
        } else {
            document.getElementById("warningmessage").className = "alert alert-warning nothidden";
            setTimeout(function(){
                        document.getElementById("warningmessage").className = "alert alert-warning hidden";
            }, 10000);
        }
        console.log('Copying text command was ' + msg);
        
      } catch (err) {
        console.log('Oops, unable to copy');
      }
}
function resizeText(multiplier) {
  if (document.getElementById('articletext').style.fontSize == "") {
    document.getElementById('articletext').style.fontSize = "1.0em";
    document.getElementById('articletext').style.lineHeight = "1.0em";
  }
  document.getElementById('articletext').style.fontSize = parseFloat(document.getElementById('articletext').style.fontSize) + (multiplier * 0.2) + "em";
  //document.getElementById('articleBody').style.lineHeight = parseFloat(document.getElementById('articleBody').style.lineHeight) + (multiplier * 0.2) + 0.5 + "em";
}
function resizeTextDefault() {
    document.getElementById('articletext').style.fontSize = "1.0em";
    document.getElementById('articletext').style.lineHeight = "1.0em";
}
function darkMode() {
    document.getElementById("card").className = "card dark"
    document.getElementById("content").className = "page-content dark"
}
function lightMode() {
    document.getElementById("card").className = "card light"
    document.getElementById("content").className = "page-content lights"
}
</script>