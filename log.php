<?
$fp = fopen("./tools/tuscanauts/access.log", "a");
$entry = date("[Y-m-d] H:i:s -") . " - " . $content . " - " . $REMOTE_ADDR . "\r\n";
fwrite($fp, $entry);
fclose($fp);
?>