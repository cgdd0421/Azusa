<?php
$dsn='データベース名';
$user='ユーザー名';
$pass='パスワード';
$pdo= new PDO($dsn,$user,$pass,
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
              );
              
$sql='SELECT * FROM  mission5_01';
$stmt = $pdo->query($sql);
$result=$stmt->fetchAll();
foreach($result as $row)
{echo $row['id']."<br>".$row['name']."<br>".$row['comment']."<br>".$row['password']."<br>";
//$row['created_at']."<br>".$row['update_at']."<br>".$row['status']
//."<br>";
}

?>