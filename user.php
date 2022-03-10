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
  <div class="wrapper">

<div class="body">

  <div class="top">
 <div class="box"><p>ユーザー情報</p></div>
 <p></p><br>
</div>
<p></p><br>
<div class="formats">

<?php
$dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
    or die('Could not connect: ' . pg_last_error());

#urlから変数をもってくる
  $now = $_GET['page_name'];

  $query="select user_name,age,format,play_style from profile where user_name = '" . $now . "' ";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    #echo $line[1] . " (" . $line[0] . ") by " . $line[2] . "<br>";
    #echo "unameは、$line[0]<br>";
    #echo "messageは、$line[1]<br>";
    #echo "theradは、$line[3]<br>";
    echo "ユーザー名: $line[0]<br />";
    echo "年齢 : $line[1]<br />";
    echo "フォーマット: $line[2]<br />";
    echo "プレイスタイル: $line[3]<br />";

    if ($_SESSION['uns'] != $line[0]){
    $n = "$line[0]";
    $link = "https://gms.gdl.jp/~tani/mtg/message/message?page_name=".$n;
    echo "<a href=". $link ."> メッセージを送る<br> </a>";
  }
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

</div>
</body>
</html>
