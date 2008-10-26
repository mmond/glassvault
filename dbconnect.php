<?

@ $db = mysql_pconnect("DATABASE_HOST", "DATABASE_USER", "DATABASE_PASSWORD");
if (!$db) {
	echo "Error: Could not connect to database.  Please try again later.";
	exit;
	}
mysql_select_db("glassvault");

?>