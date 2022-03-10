<?php
session_start();
echo $_SESSION['uns'];
echo $_SESSION['ems'];
echo $_SESSION['pws'];
echo "<br />";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> <head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" href="../stylesheet.css">
<title>ユーザー情報</title>
</head>
<body>

  <div class="body">
    <div class="top">
      <p></p><br>
   <div class="box"><p>掲示板一覧（ガチプレイヤー用）</p></div>
   <p></p><br>
 </div>
 <p></p><br>
 <div class="formats">

   <?php
   $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
       or die('Could not connect: ' . pg_last_error());

     $receive_name = $_GET['page_name'];

   echo "To $receive_name";
   echo "さん<br/>";?>
  <form method="POST" action="">
  メッセージを送る: <input type="text "name="message"><br />
  <input type="submit" value="送信">
  </form>
<?php

$dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
    or die('Could not connect: ' . pg_last_error());

  $receive_name = $_GET['page_name'];

  if(isset($_POST['message'])>0){
    #urlから変数をもってくる
    $message=$_POST['message'];
    $query="insert into message(message_text,send_name,receive_name) values ('" .$message . "','" . $_SESSION['uns'] . "'
    ,'" . $receive_name . "');";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());

  }

  #$send_name = $_SESSION['uns'];
  #$receive_name = $_GET['page_name'];

  #send->receive
  $query="select message_text,send_name,receive_name from message where send_name = '" . $_SESSION['uns'] . "' and  receive_name = '" . $receive_name . "'";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    echo $_SESSION['uns'];
    echo ":$line[0]<br />";
  }
  #receive->send
  $query1="select message_text,send_name,receive_name from message where receive_name  = '" . $_SESSION['uns'] . "' and  send_name = '" . $receive_name . "'";
  $result1 = pg_query($query1) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result1)){
    echo $_SESSION['uns'];
    echo ":$line[0]<br />";
  }
?>
</div>
</div>
<a href="https://gms.gdl.jp/~tani/mtg/user_data/user_profile.php">戻る</a>

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
</div>
</body>
</html>
