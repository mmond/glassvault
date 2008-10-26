<?
if (!session_is_registered("valid_user")) header("location: http://tuscanauts.com/tools/tuscanauts/mobile_login.php");
$position = $_GET['position'];
if (!isset($_GET['position'])) $position = 0;
$expand = $_GET['expand'];
$expanded = explode(",", $expand);   				// Convert url argument string into an array
$valid_user = $_SESSION[valid_user];

if (!isset($expand)) $expand = "0,";
if (!isset($position)) $position = "0";
											
$query = 'SELECT * FROM '. $_SESSION[valid_user] . ' WHERE parent = 0 ORDER BY sort';	
$result = mysql_query($query);						// Query DB for top level lists
$num_results = mysql_num_rows($result);

for ($row=0; $row< $num_results; $row++) {
	$rowarray = mysql_fetch_array($result);
	if ($rowarray['haskids']) {								// Check for sublists
		if (in_array($rowarray['lid'], $expanded)) {		// If the list item is present in $expand, print it and call the sublist render function
				$search = ','.$rowarray["lid"].',';
				$replace = ',';
				if($rowarray['largecontent']) $noteslink = '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../tools/tuscanauts/viewnotes.php?lid='. $rowarray["lid"] .'">-oo-</a>';
				print '<br><a href="index.php?expand='. str_replace($search, $replace, $expand) .'&position='. $rowarray['lid']. '" >'. $rowarray["listname"] .'</a>'. $noteslink;	// Print each expanded list item and generate collapse link
				$indent = "&nbsp;&nbsp;";
				render($rowarray['lid'], $expanded, $expand, $valid_user, $indent);	
		} else {
			if($rowarray['largecontent']) $noteslink = '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../tools/tuscanauts/viewnotes.php?lid='. $rowarray["lid"] .'">-oo-</a>';
			else $noteslink = "";
			print '<br><a href="index.php?expand='. $expand . $rowarray['lid'] .',&position='. $rowarray['lid']. '" >'. $rowarray["listname"] .'</a>'. $noteslink;	// Otherwise, print list item and its expansion link
		}
	} else {
		if($rowarray['largecontent']) $noteslink = '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../tools/tuscanauts/viewnotes.php?lid='. $rowarray["lid"] .'">-oo-</a>';
		else $noteslink = "";
		print '<br>' .$rowarray["listname"]. '&nbsp;&nbsp;'. $noteslink;							// Print each list with no children
	}	
}

                                                        
function render($listid, $expanded, $expand, $valid_user, $indent) {
	$query = "select * from $valid_user where parent = $listid order by sort";			//	Query DB for sublists
	$result = mysql_query($query);
	$num_results = mysql_num_rows($result);
	for ($row=0; $row< $num_results; $row++) {
		$rowarray = mysql_fetch_array($result);										
		if ($rowarray ['haskids']) {						// 	Check for sublists
			if (in_array($rowarray['lid'], $expanded)) {	// If the list item is present in $expand, print it and call the sublist render function 
				$search = ','.$rowarray["lid"].',';			// 	Print each expanded list item and generate collapse link
				$replace = ',';
				if($rowarray['largecontent']) $noteslink = '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../tools/tuscanauts/viewnotes.php?lid='. $rowarray["lid"] .'">-oo-</a>';
				else $noteslink = "";
				print '<br>'. $indent .'<a href="index.php?expand='. str_replace($search, $replace, $expand) .'&position='. $rowarray["lid"]. '" >'. $rowarray["listname"] .'</a>'. $noteslink;
				$indent = "&nbsp;&nbsp;" . $indent;
	 		 	render($rowarray["lid"], $expanded, $expand, $valid_user, $indent);			
			} else {										// 	Otherwise, print list item and its expansion link	
				if($rowarray['largecontent']) $noteslink = '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../tools/tuscanauts/viewnotes.php?lid='. $rowarray["lid"] .'">-oo-</a>';
				else $noteslink = "";
				print '<br>'. $indent .'<a href="index.php?expand='. $expand . $rowarray["lid"] .',&position='. $rowarray["lid"]. '" >'. $rowarray["listname"] .'</a>'. $noteslink;	
	 		}			
		} 	else {                                            // 	Print each list with no children
			if($rowarray['largecontent']) $noteslink = '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../tools/tuscanauts/viewnotes.php?lid='. $rowarray["lid"] .'">-oo-</a>';
				else $noteslink = "";
				print '<br>'. $indent . $rowarray["listname"]. '&nbsp;&nbsp;'. $noteslink;
			}
	}	
}

?>