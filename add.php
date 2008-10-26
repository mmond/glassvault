<?
session_start();
if (!session_is_registered("valid_user")) header("location: http://tuscanauts.com/tools/tuscanauts/login.php");
$listname = $_POST['namefield'];
$position = $_POST['position'];
$expand = $_POST['expand'];
$valid_user = $_SESSION['valid_user'];

include("dbconnect.php");

$listname = mysql_real_escape_string(stripslashes(str_replace(" ", "&nbsp;", $listname)));
if ($listname) {
	$query = 'insert into '. $valid_user .' (listname, parent) values ("'. $listname .'", '. $position . ')';
	mysql_query($query);
	$query = "update $valid_user set haskids = 1 where lid = $position";
	mysql_query($query);
	

	$expanded = explode(",", $expand);
	if (!in_array($position, $expanded))	{		// If the list we are adding to wasn't expanded, expand it
		$expand = $expand . $position . ",";
	}
}	
$header = 'location: http://tuscanauts.com/?expand='. $expand .'&position='. $position;
header($header);
?>
