<? if (!session_is_registered("valid_user")) header("location: http://tuscanauts.com/tools/tuscanauts/login.php") ?>
<table><td align="left"><font size="5">Tuscanauts Gallery</font><br>
<br>
Upload and store photos, browse them online and download full sized originals.  More gallery information available on the <a href=".?content=tools/tuscanauts/help.html"><b>help page.</a></b><br>
<br>
<b>FTP upload pictures <a href="ftp://tuscanauts:Italy2008@tuscanauts.com/">here</a>.</b> 	This link includes the username/password.<br>
<br>
<br>
</td></table>
<table>

<?
$gallery = "2008/May/privateTuscanauts";
include("tools/gallery/render_tuscanauts.php");
?>
</table>
