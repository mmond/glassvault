<?
session_start();

if (isset($_POST[password])) { 			// Begin user login sequence
	if (($_POST[password]) == "PASSWORD") {
		$_SESSION['valid_user'] = "USERNAME";
		header("location: http://tuscanauts.com/mobile");
	} else header("location: http://tuscanauts.com/tools/tuscanauts/mobile_login.php");
} 

// they are not logged in so provide form to log in 
print '
<html>
<body>
<font color="#5571B0">
<form method="post" name="login" action="mobile_login.php">
Password: <input type="password" name="password" size="20"><br>
<input type=submit value="Log in"><br>
</font>
</form>
</body>
<html>';
?>
