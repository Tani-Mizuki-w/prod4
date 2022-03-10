<?php
 session_start();
 if (isset($_SESSION['uns'])) {
   $uns=$_SESSION['uns'];
 }
 if (isset($_SESSION['pws'])) {
   $pws=$_SESSION['pws'];
 }
 if (isset($_POST['unf'])){$uns=$_POST['unf'];}
 if (isset($_POST['pwf'])){$pws=$_POST['pwf'];}
 $aflag=0;
 if (isset($uns) &&isset($pws)){
   $sql="select * from dj_login where uname='". $uns . "';";
   $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
       or die('Could not connect: ' . pg_last_error());
   $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
   if(pg_num_rows($result)==1){
     $row = pg_fetch_row($result);
     if (password_verify($pws, $row[3])){
       $_SESSION['uns']=$uns;
       $_SESSION['pws']=$pws;
       $aflag=1;
       $uid=$row[0];
       $unf=$row[1];
     }
   }
 }
 if($aflag==0){
   header('location: ./login.html');
 }

?>
<html>
<head>
  <title>
    login
  </title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
     <div class="row">
        <!-- 4列をサイドメニューに割り当て -->
        <div class="col-xs-4">
         <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#">ジャンル</a></li>
            <li><a href="scared.php">怖い</a></li>
            <li><a href="happy.php">幸せ</a></li>
            <li><a href="shocking.php">衝撃的</a></li>
            <li><a href="interesting.php">面白い</a></li>
            <li><a href="disgusting.php">気持ち悪い</a></li>
            <li><a href="realistic.php">現実的</a></li>
            <a href="dj_post.php">投稿ページへ</a>
         </ul>
        </div>

        <!-- 残り8列はコンテンツ表示部分として使う -->
        <!-- <div class="col-xs-8">
         <div class="panel panel-info">
            <div class="panel-heading">
             <div class="panel-title">夢日記1</div>
            </div>
            <div class="panel-body">投稿</div>
         </div>

         <div class="panel panel-info">
            <div class="panel-heading">
             <div class="panel-title">夢日記2</div>
            </div>
            <div class="panel-body">投稿2</div>
         </div>

         <div class="panel panel-info">
            <div class="panel-heading">
             <div class="panel-title">夢日記3</div>
            </div>
            <div class="panel-body">投稿3</div>
         </div>
        </div> -->
        <?php
        $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
            or die('Could not connect: ' . pg_last_error());

          #$query="select * from dj_post ORDER BY id DESC;";
           $query="select * from dj_post ORDER BY id DESC;";
          $result = pg_query($query) or die('Query failed: ' . pg_last_error());

          while ($line = pg_fetch_row($result)){
            echo "<div class=\"col-xs-8\">";
              echo "<div class=\"panel panel-info\">";
                echo " <div class=\"panel-heading\">";
                echo "  <div class=\"panel-title\">夢日記</div>";
                echo "</div>";
                echo "<div class=\"panel-body\"><p>$line[1]さん<p><b>ジャンル：$line[2]</b><p>内容：$line[3]</p><b>日付$line[4]</b></div>";
              echo "</div>";

            #echo "<span style=font-weight:bold>$line[1]さん</span><br>";
            #echo "<span style=font-weight:bold>ジャンル</span>:$line[2]<br>";
            #echo "<span style=font-weight:bold>内容</span>:$line[3]<br>";
            #echo "<span style=font-weight:bold>日付</span>:$line[4]<br>";
          }
          ?>
     </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

  <!-- <h2>ジャンル</h2>
  <p><a href="scared.php">怖い</a></p>
  <p><a href="happy.php">幸せ</a></p>
  <p><a href="shocking.php">衝撃的</a></p>
  <p><a href="interesting.php">面白い</a></p>
  <p><a href="disgusting.php">気持ち悪い</a></p>
  <p><a href="realistic.php">現実的</a></p> -->
<?php
$dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
    or die('Could not connect: ' . pg_last_error());

 #$query="select * from dj_post ORDER BY id DESC;";
 $query="select * from dj_post ORDER BY id DESC;";
 $result = pg_query($query) or die('Query failed: ' . pg_last_error());

//  while ($line = pg_fetch_row($result)){
//    echo "<div class=\"col-xs-8\">";
//     echo "<div class=\"panel panel-info\">";
//       echo " <div class=\"panel-heading\">";
//       echo "  <div class=\"panel-title\">夢日記1</div>";
//        echo "</div>";
//        echo "<div class=\"panel-body\"><p>$line[1]さん<p><b>ジャンル：$line[2]</b><p>内容：$line[3]</p><b>日付$line[4]</b></div>";
//     echo "</div>";

//    #echo "<span style=font-weight:bold>$line[1]さん</span><br>";
//    #echo "<span style=font-weight:bold>ジャンル</span>:$line[2]<br>";
//    #echo "<span style=font-weight:bold>内容</span>:$line[3]<br>";
//    #echo "<span style=font-weight:bold>日付</span>:$line[4]<br>";
//  }
// ?>
</body>
</html>
