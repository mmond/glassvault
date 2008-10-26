<?
session_start();
if (!session_is_registered("valid_user")) header("location: http://tuscanauts.com/tools/tuscanauts/login.php");
include("dbconnect.php");
$valid_user = $_SESSION['valid_user'];
$source = $source_array["lid"];
$target = $_GET['position'];

if ($source !== $target) {
	// Move source list to new target parent		
	$query = 'UPDATE '. $valid_user .' SET parent = '. $target .' WHERE lid = '. $source;  
	mysql_query($query);   
	
	// Increment new target parent's haskids field
	$query = 'UPDATE '. $valid_user .' SET haskids = 1 WHERE lid = '. $position ;  
	mysql_query($query); 

	// Check if there are siblings to source list
	$query = 'select * from '. $valid_user .' where parent = '. $source_array["parent"];
	$result = mysql_query($query);
	$num_results = mysql_num_rows($result);

	// If not, reset old parent's haskids field to NULL
	if($num_results == 0) mysql_query('UPDATE '. $valid_user .' SET haskids = NULL WHERE lid = '. $source_array["parent"]);  
	
	// Return to update view
	unset($_SESSION['moving']);
	unset($_SESSION['rowarray']);
	$header = "http://tuscanauts.com/?expand=". $_GET['expand'] ."&position=". $target;
	header("location: $header");
} 	else {
	$header = "http://tuscanauts.com/?expand=". $_GET['expand'] ."&position=". $target;
	header("location: $header");
}
?>