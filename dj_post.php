<?php
  session_start();
?>

<html>
  <head>
    <title>投稿</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- <link rel="stylesheet" href="../stylesheet.css"> -->
    <link rel="stylesheet" href="./post.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ephesis&family=Rampart+One&family=RocknRoll+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Rampart+One&family=RocknRoll+One&display=swap');
      </style>
  </head>
  <body>
    <h1 class='title'>今日見た夢を投稿してね！</h1>
    <form class='topic' method="POST" action="./dj_post.php">
      ジャンル<br>
      <select class="select" name="genre">
          <option value="怖い">怖い</option>
          <option value="幸せ">幸せ</option>
          <option value="衝撃的">衝撃的</option>
          <option value="面白い">面白い</option>
          <option value="気持ち悪い">気持ち悪い</option>
          <option value="現実的">現実的</option>
      </select><br>
      内容<br>
      <input class="textspace" type="text" name="content"><br>
      <input type="submit" value="登録"><br/>
    </form>


    <?php
    $d = date("Y-m-d H:i");
    if (isset($_POST['genre']) && !empty($_POST['genre'])) {
        $genre=$_POST['genre'];
        }

    if (isset($_POST['content']) && !empty($_POST['content'])) {
        $content=$_POST['content'];
        }

      $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
          or die('Could not connect: ' . pg_last_error());

    if(isset($genre) and isset($content)){

      $sql="insert into dj_post(uname, genre, content, post_time) values
      ('" .$_SESSION['uns'] . "','" .$genre . "','" .$content . "','" . $d . "');";

      pg_query($sql) or die('Query failed: ' . pg_last_error());


      echo  $_SESSION['uns'];
      echo  $genre;
      echo  $content;
      echo $d ;
      echo "<br>";
    }
      ?>

    <a href="index.php">戻る</a>

  </body>
</html>
