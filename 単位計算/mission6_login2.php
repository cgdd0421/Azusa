<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>ログイン画面</title>
<style>
.class1{"text-align=center";}
</style>
</head>
<body>
<?php
session_start();
//DB接続
$dsn='データベース名';
$user='ユーザー名';
$pass='パスワード';
$pdo= new PDO($dsn,$user,$pass,
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
              );

//ログイン状態の確認
if(!isset($_SESSION["account"]))//ログインしていなかったら
  {header("Location: mission6_login.php"); exit();}
//ログインしていたら
$mail=$_SESSION["account"];
$sql='SELECT name FROM user WHERE mail=:mail';
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
$stmt->execute();
$results=$stmt->fetchAll();
foreach($results as $row){echo $row["name"]."さん、こんにちは！<br>";}
?>

<a href="http://tech-base.net/tb-230168/mission6/mission6_tanni.php">単位の登録・変更</a>
<br>
<a href="http://tech-base.net/tb-230168/mission6/mission6_tanikeisan.php">卒業に必要な単位</a>  

</form>

  
</body>
</html>