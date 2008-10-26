<? if (!session_is_registered("valid_user")) header("location: http://tuscanauts.com/tools/tuscanauts/login.php") ?>
<table  cellSpacing="0" cellPadding="0" width="900" border="0">
  <tr>
  </tr>
    <td>
		<font size="5">Tuscany Trip Information <font><br>
		<br>
    </td>
</table>
<table border="0" cellpadding="1" cellspacing="0" style="border-collapse: collapse" width="100%">
<tr><td valign="top">
<?
$valid_user = $_SESSION['valid_user'];
$position = $_GET['position'];
if (!isset($_GET['position'])) $position = 0;
$expand = $_GET['expand'];
$expanded = explode(",", $expand);   				// Convert url argument string into an array

if (!isset($expand)) $expand = "0,";
if (!isset($position)) $position = "0";
											
$query = 'SELECT * FROM '. $_SESSION[valid_user] . ' WHERE parent = 0 ORDER BY sort';	
$result = mysql_query($query);						// Query DB for top level lists
$num_results = mysql_num_rows($result);

for ($row=0; $row< $num_results; $row++) {
	$rowarray = mysql_fetch_array($result);
	if ($rowarray['haskids']) {						// Check for sublists
		if (in_array($rowarray['lid'], $expanded)) {		// if the list item is present in $expand, expand that list 
				$search = ','.$rowarray["lid"].',';
				$replace = ',';	
				print '<p style="margin-top: -1; margin-bottom: -1"><a href="index.php?expand='. str_replace($search, $replace, $expand) .'&position='. $rowarray['lid']. '" >'. $rowarray["listname"] .'</a>';	// Print each expanded list item and generate collapse link
				render($rowarray['lid'], $expanded, $expand, $valid_user);	
		} else print '<p style="margin-top: -1; margin-bottom: -1"><a href="index.php?expand='. $expand . $rowarray['lid'] .',&position='. $rowarray['lid']. '" >'. $rowarray["listname"] .'</a></p>';	// Otherwise, print list item and its expansion link
	} else print '<p style="margin-top: -1; margin-bottom: -1"><a href="index.php?expand='. $expand .'&position='. $rowarray['lid'].'" >' .$rowarray["listname"]. '</a>';							// Print each list with no children
}	

if($_GET['moving'] or $_SESSION['moving']) include "moving.php";
else include "update.php";
print "</table>";   


if($rowarray["html_content"]) {
    print "<table><tr><td><br>". $rowarray["largecontent"] ."</td></tr></table>";      
} else {										//  Render the large content   
    print "</td></tr></table>";						//  Don't render the large content, but close the table
}
                                                         

function render($listid, $expanded, $expand, $valid_user){
	$query = "select * from $valid_user where parent = $listid order by sort";				//   Query DB for sublists
	$result = mysql_query($query);
	$num_results = mysql_num_rows($result);
	for ($row=0; $row< $num_results; $row++) {
		$rowarray = mysql_fetch_array($result);											
		if ($rowarray ['haskids']) {					// Check for sublists
			if (in_array($rowarray['lid'], $expanded)) {	// if the list item is present in $expand, expand that list 
				$search = ','.$rowarray["lid"].',';		// Print each expanded list item and generate collapse link
				$replace = ',';
				print '<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
	 			<tr>
	 		 	<td width="8" align="center" valign="top"><p style="margin-top: -1; margin-bottom: -1">&nbsp&nbsp&nbsp&nbsp</td>
	 		 	<td><p style="margin-top: -1; margin-bottom: -1"><a href="index.php?expand='. str_replace($search, $replace, $expand) .'&position='. $rowarray["lid"]. '" >'. $rowarray["listname"] .'</a>';
	 		 	render($rowarray["lid"], $expanded, $expand, $valid_user);			
			} else {							// Otherwise, print listitem and its expansion link	
				print '<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
	 			<tr>
	 		 	<td width="8" align="center" valign="top"><p style="margin-top: -1; margin-bottom: -1">&nbsp&nbsp&nbsp&nbsp</td>
	 		 	<td><p style="margin-top: -1; margin-bottom: -1"><a href="index.php?expand='. $expand . $rowarray["lid"] .',&position='. $rowarray["lid"]. '" >'. $rowarray["listname"] .'</a>';	
	 		}			
		} else {                                                       	// Print each list with no children
				print '<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
	 			<tr>
	 		 	<td width="8" align="center" valign="top"><p style="margin-top: -1; margin-bottom: -1">&nbsp&nbsp&nbsp&nbsp</td>
	 		 	<td><p style="margin-top: -1; margin-bottom: -1"><a href="index.php?expand='. $expand .'&position='. $rowarray["lid"].'" >' .$rowarray["listname"]. '</a>';
		}
 		print '</td></tr></table>';
	}	
}

?>
