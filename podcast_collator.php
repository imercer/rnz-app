<?php
       $servername = "localhost";
        $username = "rnz_app_api";
        $password = "UQBa9HrAhFQ77Mbw";
        $dbname = "rnz_app";

     function truncate($string,$length=80,$append="&hellip;") {
              $string = trim($string);

              if(strlen($string) > $length) {
                $string = wordwrap($string, $length);
                $string = explode("\n", $string, 2);
                $string = $string[0] . $append;
              }

              return $string;
     }
$fallbackimages=array(
        "http://rnz.isaacmercer.nz/images/rnz.jpg",
);

function delete_all_between($beginning, $end, $string) {
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if ($beginningPos === false || $endPos === false) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return str_replace($textToDelete, '', $string);
}

//Do Checkpoint
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/checkpoint.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "Checkpoint Duplicate Cleared \n";
            } else {
                    die("Checkpoint Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','checkpoint');";
            if ($conn->query($sql) === TRUE) {
                     echo "checkpoint in Database \n";
            } else {
                    die("checkpoint Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do At the Movies
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/atthemovies.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "atthemovies Duplicate Cleared \n";
            } else {
                    die("atthemovies Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','atthemovies');";
            if ($conn->query($sql) === TRUE) {
                     echo "atthemovies in Database \n";
            } else {
                    die("atthemovies Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do countrylife
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/countrylife.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "countrylife Duplicate Cleared \n";
            } else {
                    die("countrylife Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','countrylife');";
            if ($conn->query($sql) === TRUE) {
                     echo "countrylife in Database \n";
            } else {
                    die("countrylife Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do insight
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/insight.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "insight Duplicate Cleared \n";
            } else {
                    die("insight Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','insight');";
            if ($conn->query($sql) === TRUE) {
                     echo "insight in Database \n";
            } else {
                    die("insight Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do afternoons
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/afternoons.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "afternoons Duplicate Cleared \n";
            } else {
                    die("afternoons Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','afternoons');";
            if ($conn->query($sql) === TRUE) {
                     echo "afternoons in Database \n";
            } else {
                    die("afternoons Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do mediawatch
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/mediawatch.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "mediawatch Duplicate Cleared \n";
            } else {
                    die("mediawatch Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','mediawatch');";
            if ($conn->query($sql) === TRUE) {
                     echo "mediawatch in Database \n";
            } else {
                    die("mediawatch Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do morningreport
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/morningreport.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "morningreport Duplicate Cleared \n";
            } else {
                    die("morningreport Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','morningreport');";
            if ($conn->query($sql) === TRUE) {
                     echo "morningreport in Database \n";
            } else {
                    die("morningreport Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do morningreport
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/nights.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "nights Duplicate Cleared \n";
            } else {
                    die("nights Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','nights');";
            if ($conn->query($sql) === TRUE) {
                     echo "nights in Database \n";
            } else {
                    die("nights Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do ninetonoon
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/ninetonoon.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "ninetonoon Duplicate Cleared \n";
            } else {
                    die("ninetonoon Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','ninetonoon');";
            if ($conn->query($sql) === TRUE) {
                     echo "ninetonoon in Database \n";
            } else {
                    die("ninetonoon Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do ourchangingworld
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/ourchangingworld.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "ourchangingworld Duplicate Cleared \n";
            } else {
                    die("ourchangingworld Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','ourchangingworld');";
            if ($conn->query($sql) === TRUE) {
                     echo "ourchangingworld in Database \n";
            } else {
                    die("ourchangingworld Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do thiswayup
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/thiswayup.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "thiswayup Duplicate Cleared \n";
            } else {
                    die("thiswayup Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','thiswayup');";
            if ($conn->query($sql) === TRUE) {
                     echo "thiswayup in Database \n";
            } else {
                    die("thiswayup Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
//Do standing-room-only
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/podcasts/standing-room-only.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
    $image = $rss->getElementsByTagName('url');          
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $rawdescription = $feed[$x]['description']; $description = delete_all_between("<![CDATA[", "]]>", $rawdescription);
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `podcasts` WHERE URL='$postlink';";
            $sql = "DELETE FROM `podcasts` WHERE URL='$postlink';";
            if ($conn->query($sql) === TRUE) {
                     echo "standing-room-only Duplicate Cleared \n";
            } else {
                    die("standing-room-only Duplicate Not Cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);

            $sql = "INSERT INTO podcasts 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `series`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$image',
                        '$date',
                        '$postlink',
                        '','$rawdate','$EpochDate','standing-room-only');";
            if ($conn->query($sql) === TRUE) {
                     echo "standing-room-only in Database \n";
            } else {
                    die("standing-room-only Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
?>