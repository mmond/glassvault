<?
session_start();
if (isset($_POST[password])) { 			// Begin user login sequence
	if (($_POST[password]) == "$PASSWORD") {
		$_SESSION['valid_user'] = "$USERNAME";
		header("location: http://tuscanauts.com");
	} else {
		if (isset($_POST[address])) { 			// Begin password mailer sequence
			$addresses = array("EMAIL2@ADDRESS.COM", "EMAIL2@ADDRESS.COM", "EMAIL3@ADDRESS.COM");
			if (in_array($_POST[address], $addresses)) {
				$content = 'The Tuscanauts.com password is "$PASSWORD"';
				$headers = "To: <". $_POST[address] .">\n";
				$headers .= "From: Tuscanauts <mmond@io.com>\n";
				$headers .= "bcc: Mark Reynolds <mmond@io.com>\n";
				$headers .= "Reply-To: Mark Reynolds <mmond@io.com>\n";
				$subject = "Tuscanauts Password";
				mail("", $subject, $content, $headers);
				print '<font color="#5571B0">The password has been mailed.  Thanks. </font><br><br>';
			} else print '<font color="#5571B0">I don&rsquo;t know that address.  Please try again or contact $ADMIN.  Thanks. </font><br><br>';
		} else header("location: http://tuscanauts.com/tools/tuscanauts/login.php");
	}
} 
// they are not logged in so provide form to log in 
?>
<script language="JavaScript">
TargetDate = "5/3/2008 5:00 PM";
BackColor = "";
ForeColor = "";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds!!";
FinishMessage = "It is finally here!";
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<meta http-equiv="Content-Language" content="en-us">
	<title>Tuscanauts Web</title>
	<link rel="stylesheet" href="http://markpreynolds.com/style/mobile.css" type="text/css" />
</head>
<body OnLoad="jump2form()">
<table border="0">
	<td><font size="5" color="#5571B0">&nbsp;&nbsp;GlassVault.com&nbsp;&nbsp;&nbsp;(The&nbsp;Tuscanauts&nbsp;Edition)</font></td>
	<td width="85%" align="right"><font color="#5571B0"><script language="JavaScript" src="../../scripts/countdown.js"></script>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Store, share, publish anything.</td>
</table>
<br>
<br>
<font color="#5571B0">
<form method="post" name="login" action="login.php">
Password: <input type="text" name="password" size="20"><br>
<input type=submit value="Log in"><br>
<br>
<br>
To email our password, please enter an address I know.<br>
<input type="text" name="address" size="20"><br>
<input type=submit value="Mail Me"><br>
</font>
</form>
</body>
<html>