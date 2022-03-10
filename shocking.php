<?php
session_start();
?>

<html>
<head>
  <title>衝撃的</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="../stylesheet.css">
</head>
<body>


<?php

  $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
      or die('Could not connect: ' . pg_last_error());

$g = "衝撃的";
$query= "select * from dj_post where genre= '" . $g. "'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_row($result)){
  echo "<span style=font-weight:bold>$line[1]さん</span><br>";
  echo "<span style=font-weight:bold>ジャンル</span>:$line[2]<br>";
  echo "<span style=font-weight:bold>内容</span>:$line[3]<br>";
  echo "<span style=font-weight:bold>日付</span>:$line[4]<br>";

}


  ?>

</body>
</html>
