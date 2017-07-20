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
        "http://rnz.isaacmercer.nz/fallbackimages/1.jpg",
        "http://rnz.isaacmercer.nz/fallbackimages/2.jpg",
        "http://rnz.isaacmercer.nz/fallbackimages/3.jpg",
        "http://rnz.isaacmercer.nz/fallbackimages/4.jpg",
        "http://rnz.isaacmercer.nz/fallbackimages/5.jpg",
        "http://rnz.isaacmercer.nz/fallbackimages/6.jpg",
        "http://rnz.isaacmercer.nz/fallbackimages/7.jpg",
        "http://rnz.isaacmercer.nz/fallbackimages/8.jpg",
        "http://rnz.isaacmercer.nz/fallbackimages/9.jpg",
        "http://rnz.isaacmercer.nz/fallbackimages/10.jpg",
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

//Do national
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/rss/national.xml');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
              
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdescription = $feed[$x]['description']; $description = truncate($string=$rawdescription);
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $url = $link;
        $html = file_get_html($url);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $articlebodyraw = $html->find('div.article__body', 0); $articlebody = delete_all_between('<ul class="related-stories">', '</ul>', $articlebodyraw);
        $imgid = 0;
        foreach($html->find('div.photo-captioned') as $element) {
          $img = $element;
            foreach($img->find('img') as $imgelement) {
            if ($imgid == 0) {
                $imgid = 1;
                //$image = "http://radionz.co.nz";
                $image = $imgelement->src;
            }
            }
        }
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `topics` WHERE RawTitle='$rawtitlesql' OR EpochDate='$EpochDate';";
            $sql = "DELETE FROM `topics` WHERE RawTitle='$rawtitlesql' OR EpochDate='$EpochDate';";
            if ($conn->query($sql) === TRUE) {
                     echo "Duplicate Cleared \n";
            } else {
                    die("national not cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);	$imagesql = mysqli_real_escape_string($conn, $image);
            $bodytext = mysqli_real_escape_string($conn, $articlebody);			$linksql = mysqli_real_escape_string($conn, $postlink);

            $sql = "INSERT INTO topics 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `category`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$imagesql',
                        '$date',
                        '$linksql',
                        '$bodytext','$rawdate','$EpochDate','national');";
            if ($conn->query($sql) === TRUE) {
                     echo "National in Database \n";
            } else {
                    die("National Not Entered \n" . $conn->error);
            }
            $conn->close();
	}

//Do regional
              $rss = new DOMDocument();
                require_once('simple_html_dom.php');
                require_once('url_to_absolute.php');
	$rss->load('http://www.radionz.co.nz/rss/regional.xml');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
        $limit = count($feed);   
              
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']); $newtitle = truncate($string=$title,$length=50);
		$link = $feed[$x]['link'];
		$rawdescription = $feed[$x]['description']; $description = truncate($string=$rawdescription);
		$rawdate = new DateTime($feed[$x]['date'], new DateTimeZone('Pacific/Auckland')); $date = $rawdate->format('l, jS F'); $rawdate = $feed[$x]['date']; $EpochDate = strtotime($rawdate);
        $url = $link;
        $html = file_get_html($url);
        $randomno = mt_rand(0, count($fallbackimages)-1); $image = $fallbackimages[$randomno];
        $articlebodyraw = $html->find('div.article__body', 0); $articlebody = delete_all_between('<ul class="related-stories">', '</ul>', $articlebodyraw);
        $imgid = 0;
        foreach($html->find('div.photo-captioned') as $element) {
          $img = $element;
            foreach($img->find('img') as $imgelement) {
            if ($imgid == 0) {
                $imgid = 1;
                //$image = "http://radionz.co.nz";
                $image = $imgelement->src;
            }
            }
        }
            //print_r($_GET);
        //print_r($_POST); 
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);

            $postlink = mysqli_real_escape_string($conn, $link);

            echo "DELETE FROM `topics` WHERE RawTitle='$rawtitlesql' OR EpochDate='$EpochDate';";
            $sql = "DELETE FROM `topics` WHERE RawTitle='$rawtitlesql' OR EpochDate='$EpochDate';";
            if ($conn->query($sql) === TRUE) {
                     echo "Duplicate Cleared \n";
            } else {
                    die("national not cleared \n" . $conn->error);
            }
            $conn->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $rawtitlesql = mysqli_real_escape_string($conn, $title);            $titlesql = mysqli_real_escape_string($conn, $newtitle);
            $descriptionsql = mysqli_real_escape_string($conn, $description);	$imagesql = mysqli_real_escape_string($conn, $image);
            $bodytext = mysqli_real_escape_string($conn, $articlebody);			$linksql = mysqli_real_escape_string($conn, $postlink);

            $sql = "INSERT INTO topics 
                        (`Title`, `RawTitle`,
                        `Description`, 
                        `ImageURL`,
                        `Date`,
                        `URL`,
                        `ArticleContent`, `RawDate`, `EpochDate`, `category`) 
                    VALUES (
                        '$titlesql', '$rawtitlesql', 
                        '$descriptionsql', 
                        '$imagesql',
                        '$date',
                        '$linksql',
                        '$bodytext','$rawdate','$EpochDate','regional');";
            if ($conn->query($sql) === TRUE) {
                     echo "regional in Database \n";
            } else {
                    die("regional Not Entered \n" . $conn->error);
            }
            $conn->close();
	}
?>