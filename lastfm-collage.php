<?php

//error_reporting(-1);
//ini_set('display_errors', 'On');

//$start = time();

$apikey = 'YOUR_API_KEY';

$username = 'edwardbowden';
$period = '7day';	// "overall" || "12month" || "6month" || "3month" || "1month" || "7day"

$artW = 300;	// Width of each album art
$artH = $artW;	// Height of each album art

$artHC = 5;		// Horizontal count of album arts
$artVC = 5;		// Vertical count of album arts


$totalC = $artHC * $artVC;

$albums = file_get_contents('https://ws.audioscrobbler.com/2.0/?method=user.gettopalbums&api_key='. $apikey .'&user='. $username .'&period='. $period .'&limit='. ($totalC + 5) .'&format=json');

if (!$albums) die("Could not load albums. Check config.");

$albums = json_decode($albums);

if (!$albums) die("Could not load albums. Check config.");

$canvas = imagecreatetruecolor($artW*$artHC, $artH*$artVC);

$x = 0;
$y = 0;

$done = 0;
foreach($albums->topalbums->album as $key => $album) {
	$imgurl = $album->image[3]->{"#text"};
	if (!$imgurl) continue;
	$imgurl = str_replace('300x300', $artW .'x'. $artH, $imgurl);
	$temp = imagecreatefrompng($imgurl);
	if (!$temp) die("Failed to load album art: $key");
	imagecopy($canvas, $temp, $x, $y, 0, 0, $artW, $artH);
	imagedestroy($temp);
	$x += $artW;
	if ($x >= ($artW*$artHC)) {
		$x = 0;
		$y += $artH;
	}
	$done++;
	if ($done >= $totalC) break;
}

//$black = imagecolorallocate($canvas, 255, 255, 255);
//imagestring($canvas, 3, 5, 5, time()-$start, $black);

header('Content-Type: image/png');
imagepng($canvas);	// Output the image (swap jpeg or png if required)
imagedestroy($canvas);
