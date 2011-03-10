<?

include('pw.php');

//$pattern = '/\:([^\!\n]+)\![^ \n]* PRIVMSG [^ \n]+ \:([^\n]+)/';
$pattern = '/\:([^\!\n]+)\![^ \n]* PRIVMSG \#' . $chan . ' \:([^\n]+)/';

while(!feof(STDIN))
{
$in = trim(fgets(STDIN));

$result = mysql_query("select value from prefs where name='text'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);
mysql_free_result($result);

if (preg_match ( $pattern, $in, $matches ))
{
//$query = "insert into whowhat (who, what) values ('" . mysql_real_escape_string($matches[1]) . "', '" . mysql_real_escape_string($matches[2]) . "')";
//mysql_query($query);
//echo "---" . $matches[1] . "---" . $matches[2] . "---" . "\n";
//echo "---" . $matches[1] . "---" . serialize($matches[2]) . "---" . "\n";
if($row['value']) mail($phone_number, $matches[1], $matches[2]);
echo $matches[1] . ": " . $matches[2] . "\n";
}
}

mysql_close();

?>
