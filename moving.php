<?
if (!$_SESSION['moving']) $_SESSION['moving'] = $_GET['moving']; 	// Set source list in session.  This allow renderlists to load this file and persists the source list for moving
$expand = $_GET['expand'];
$source_name = $source_array["listname"];

// Get target listname from lid
$query = 'SELECT listname FROM '. $_SESSION[valid_user] . ' WHERE lid = '. $_GET[position];		
$result = mysql_query($query);
$target_array = mysql_fetch_array($result);
$target_name = $target_array['listname'];
		

																	//  display the source and target
?>
<td valign="top">
<BR>
<TABLE>
	<font size="4">Please select the new location<font><br>
     <!-- Move -->
<form method="POST" name="update" action=".">
    <TR>
        <TD>Move: </td>
        <td><input type="text" Value="<? print $source_name ?>" READONLY size="20" style="color:#808080; border-style:solid; border-width:1"></TD>
    </TR>    
    <TR>
        <TD>To: </TD>
        <TD><input type="text" Value="<? if(!$_GET['moving']) print $target_name ?>" READONLY size="20" style="color:#808080; border-style:solid; border-width:1"></TD>
    </TR>
    <TR>
    <TD COLSPAN="2">
        <a href="tools/tuscanauts/move.php?position=<? print $_GET[position] ?>&expand=<? print $expand ?>"><img src="tools/tuscanauts/images/move.png" BORDER=0></A>
	</TD>
    </TR> 
</form>
</TABLE>
</td>
