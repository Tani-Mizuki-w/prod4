<?php
session_start();
echo $_SESSION['uns'];
echo $_SESSION['ems'];
echo $_SESSION['pws'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> <head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" href="../stylesheet.css">


<title>コメント</title>
</head>
<body>

<!--
<div class="box"><a href="https://gms.gdl.jp/~tani/mtg/comment/chat_other.php">その他</a></div>
!-->
<p></p>
</div>
<div class="formats">
<form method="POST" action="./friend.php">
本文: <input type="text "name="message"><br />
<input type="submit" value="送信">
</form>
<!--
<form method="POST" action="./friend.php">
名前で検索する: <input type="text "name="search_name"><br />
<input type="submit" value="検索する">
</form>
 !-->
<?php

$dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
    or die('Could not connect: ' . pg_last_error());

if(isset($_POST['message']) && strlen($_POST['message'])>0){ $message=$_POST['message'];
}

$therad = "Recruiting_friends";
$therad_show = "Recruiting_friends";
#$link = "https://gms.gdl.jp/~tani/mtg/user_data/user.php";

if (isset($message)){
  $sql="insert into chats(uname, message,therad)
  values('" . $_SESSION['uns'] . "','" . $message ."', '" . $therad . "');";
  pg_query($sql) or die('Query failed: ' . pg_last_error());

}


  $query="select uname,message,pid,therad from chats where therad = '" . $therad_show . "' ";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());
  echo "スレッド名:フレンド募集<br>";
  echo "名前：本文<br>";
  while ($line = pg_fetch_row($result)){
    #echo $line[1] . " (" . $line[0] . ") by " . $line[2] . "<br>";
    #echo "unameは、$line[0]<br>";
    #echo "messageは、$line[1]<br>";
    #echo "theradは、$line[3]<br>";
    $n = "$line[0]";
    #https://gms.gdl.jp/~tani/mtg/test1.php
    $link = "https://gms.gdl.jp/~tani/mtg/user_data/user?page_name=".$n;
    echo "<a href=". $link ."> $line[0] </a>";
    echo ": $line[1]<br>";
  }

/*
if(isset($search_name)){
  $query="select uname,message,pid,therad from phpbbs where uname = '" . $search_name . "' ";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());
  echo "スレッド名:フレンド募集<br>";
  echo "名前：本文<br>";
  while ($line = pg_fetch_row($result)){
    echo "$line[0] : $line[1]<br>";
  }
}
*/
?>

</body>
</html>
