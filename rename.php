<?
session_start();
if (!session_is_registered("valid_user")) header("location: http://tuscanauts.com/tools/tuscanauts/login.php");
include("dbconnect.php");

$valid_user = $_SESSION['valid_user']; 
$position = $_POST['position']; 
$expand = $_POST['expand']; 
$largecontent = $_POST['largecontent']; 
$html_content = $_POST['html_content']; 
$mobile = $_POST['mobile']; 
$listname = $_POST ['listname'];

if ($largecontent == "") $largecontent = 'NULL';		//  Store blanks as NULL in DB to easily query if exists
	else $largecontent = '"'. $largecontent .'"';
if(!isset($html_content)) $html_content="";
if(!isset($mobile)) $mobile="";

$query = 'update '. $valid_user .' set html_content = "'. $html_content .'", mobile = "'. $mobile. '", listname = "'. str_replace(" ", "&nbsp;", $listname) . '", largecontent = '. $largecontent .' where lid = '. $position;
mysql_query($query);
	
$header = 'location: http://tuscanauts.com/?expand='. $expand .'&position='. $position;
header($header);
?>