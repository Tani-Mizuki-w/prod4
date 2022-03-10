<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> <head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" href="../stylesheet.css">


<title>フレンド募集</title>
</head>
<body>

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

?>

</div>
</div>
<div class="parent">

  <div class="children1">
    <p>ユーザー情報</p>
    <a href="http://gms.gdl.jp/~tani/mtg/user_data/user_regist.php">マイページ</a><br>
  </div>

  <div class="children2">
    <p>掲示板を作成・検索できます</p>
    <a href="https://gms.gdl.jp/~tani/mtg/keijiban/keijiban_gachi.php">掲示板作成</a><br>
  </div>

  <div class="children3">
    <p>コメント広場</p>
    <a href="https://gms.gdl.jp/~tani/mtg/comment/friend.php">コメント</a>

  </div>

  <div class="children4">
    <p>メッセージ</p>
    <a href="http://gms.gdl.jp/~tani/mtg/user_data/user_profile.php">チャット表示</a><br>
  </div>

  <div class="children5">
    <p>How to use</p>
    <a href="http://gms.gdl.jp/~tani/mtg/how_to_use/how_to_use.php">HOW TO USE</a><br>
  </div>

</div>
</body>
</html>
