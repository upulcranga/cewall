<?php
/* post.php : this page shows what insert.php has sent */

$date=new DateTime();
$myFile = $date->getTimestamp().".html";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = stripslashes($_POST['content']);
fwrite($fh, $stringData);
fclose($fh);


?>