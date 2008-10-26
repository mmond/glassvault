<?
session_start();
if (!session_is_registered("valid_user")) header("location: http://tuscanauts.com/tools/tuscanauts/login.php");
include("dbconnect.php");
$valid_user = $_SESSION['valid_user'];
$lid = $_GET['lid'];
$expand = $_GET['expand'];

$query = "select * from $valid_user where lid = $lid";
$result = mysql_query($query);
$lidarray = mysql_fetch_array($result);	
$parent = $lidarray["parent"];

delete($lidarray, $valid_user);

//	Remove list item from expanded URL
	$search = ','.$lid.',';
	$replace = ',';	
	$expand = str_replace($search, $replace, $expand);

$header = "http://tuscanauts.com/?expand=". $expand ."&position=". $parent;
header("location: $header");


function delete($lidarray, $valid_user) {

	if ($lidarray["haskids"]) { 
		$query = 'select * from '. $valid_user .' where parent = '. $lidarray["lid"];											
		$result = mysql_query($query);
		$num_results = mysql_num_rows($result);
		for ($row=0; $row< $num_results; $row++) {
			$sublidarray = mysql_fetch_array($result);	
			delete($sublidarray, $valid_user);
			mysql_query('delete from '. $valid_user .' where lid = '. $sublidarray["lid"]);
		}
	}
	// Check if there are siblings to this list
	$query = 'select * from '. $valid_user .' where parent = '. $lidarray["parent"];
	$result = mysql_query($query);
	$num_results = mysql_num_rows($result);

	// If not, reset parent's haskids field to null
	if($num_results == 1) mysql_query('UPDATE '. $valid_user .' SET haskids = NULL WHERE lid = '. $lidarray["parent"]);  
	mysql_query('delete from '. $valid_user .' where lid = '. $lidarray["lid"]); 		//  Delete lists with no sublist  
}
?>
