<?

include('pw.php');

$pattern = '/\:([^\!\n]+)\![^ \n]* PRIVMSG [^ \n]+ \:([^\n]+)/';

while(!feof(STDIN))
{
$in = trim(fgets(STDIN));
if (preg_match ( $pattern, $in, $matches ))
{
$query = "insert into whowhat (who, what) values ('" . mysql_real_escape_string($matches[1]) . "', '" . mysql_real_escape_string($matches[2]) . "')";
//mysql_query($query);
//echo "---" . $matches[1] . "---" . $matches[2] . "---" . "\n";
//echo "---" . $matches[1] . "---" . serialize($matches[2]) . "---" . "\n";
mail($phone_number, $matches[1], $matches[2]);
}
}

mysql_close();

?>
