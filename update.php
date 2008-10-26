<?
if (!session_is_registered("valid_user")) header("location: http://tuscanauts.com/tools/tuscanauts/login.php");
$query = "select * from " . $_SESSION['valid_user'] . " where lid = $position";
$result = mysql_query($query);
$rowarray = mysql_fetch_array($result);
$_SESSION['source_array'] = $rowarray;
?>	

<td valign="top">
<TABLE>

	<!-- Add -->
<form method="POST" name="update" action="tools/tuscanauts/add.php">
    <TR><TD>
        <input type="hidden" name="expand" value="<? print $expand ?>">
        <input type="hidden" name="position" value="<? print $position ?>">
        <input type="text" name="namefield" size="20" style="border-style:solid; border-width:1">  
        <input type="submit" Value="Add New Item" style="color:blue; border-style:solid; border-width:1; border-color:blue">
	</TD><TD COLSPAN="2">
    </TD></TR>
</form>
    
	<!-- Rename -->
    <TR><TD>
        <form method="POST" name="rename" action="tools/tuscanauts/rename.php">
        <input type="hidden" name="expand" value="<? print $expand ?>">
	    <input type="hidden" name="position" value="<? print $position ?>">
        <input type="text" name="listname" Value="<? print $rowarray["listname"] ?>" size="20" style="border-style:solid; border-width:1">  
        <input type="submit" Value="Rename" style="color:blue; border-style:solid; border-width:1; border-color:blue"><br>
     <!-- Move -->
        <a href=".?moving=yes&position=<? print $position ?>&expand=<? print $expand ?>">
	    <img src="tools/tuscanauts/images/move.png" Title="Move List" border="0" ></a>
    <!-- Delete -->
    	<a onclick="return confirmSubmit()"	href="tools/tuscanauts/delete.php?expand=<? print $expand ?>&lid=<? print $rowarray["lid"] ?>">
		<img src="tools/tuscanauts/images/delete.png"  Title="Delete List" border="0" ></a>    
    <!-- Large / HTML Content -->
    <br>&nbsp;
    <TR><TD>
		<b>Item Detail Notes</b><br>
        <TEXTAREA name="largecontent" rows="20" wrap="off" cols="70" style="border-style:solid; border-width:3"><? print $rowarray["largecontent"] ?></TEXTAREA><br>
        &nbsp;<input type="submit" Value="Update Notes" style="color:blue; border-style:solid; border-width:1; border-color:blue">&nbsp;&nbsp;&nbsp;&nbsp;
	    <INPUT TYPE="CHECKBOX" NAME="html_content" <? if($rowarray["html_content"] == "on") print "checked" ?>><font color="blue">Render Notes Below in HTML</FONT>
    <BR>
    </TD></TR>
          
</form>
    </td>
</td></TABLE>
</td>
<script LANGUAGE="JavaScript">
<!--
function confirmSubmit()
{
var agree=confirm("Are you sure you wish to delete this list and all sublists?");
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>