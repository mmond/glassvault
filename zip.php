Building zip file...

<?
$gallery = $_GET['gallerylink'];
$dir = "../../pics/" . $gallery ."/";

// Create the arrays with the dir's media files
$dp = opendir($_SERVER['DOCUMENT_ROOT']."/pics/".$gallery);
while ($filename = readdir($dp)) {
	if (!is_dir($_SERVER['DOCUMENT_ROOT']."/pics/".$gallery. "/". $filename))  {  // If it's a file, begin
		$type = getimagesize($_SERVER['DOCUMENT_ROOT']."/pics/".$gallery. "/". $filename);
       		if ($type[2] == 1 or $type[2] == 2 or $type[2] == 3 or $type[2] == 6 ) $pic_array[] = $filename;           // If it's a picture, add it to thumb array
			else {
				$movie_types = array("AVI", "avi", "MOV", "mov", "MP3", "mp3", "MP4", "mp4");								
				if (in_array(substr($filename, -3), $movie_types)) $movie_array[] = $filename; 							// If it's a movie, add name to the movie array
			}						
	}
}

foreach ($pic_array as $filename) {
	$media_files = $media_files . " " . $dir . $filename;
}

if ($movie_array) {
	foreach ($movie_array as $filename) {
		$media_files = $media_files . " " . $dir . $filename;
	}
}

$output = `zip -j -u $dir/test.zip $media_files`;
print "<pre>$output</pre>";
print "Complete";
?>