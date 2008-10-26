<?
session_start();
if (!session_is_registered("valid_user")) header("location: http://tuscanauts.com/tools/tuscanauts/login.php");

include("dbconnect.php");
$query = 'SELECT * FROM tuscanauts WHERE lid = '. $_GET['lid'];	    // Query db for moble list large content
$result = mysql_query($query);
$rowarray = mysql_fetch_array($result);

print '<b>'. $rowarray["listname"] .'<br></b>';
print nl2br($rowarray["largecontent"]);
	
?>