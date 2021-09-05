<?php
$dsn='データベース名';
$user='ユーザー名';
$pass='パスワード';
$pdo= new PDO($dsn,$user,$pass,
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
              );
              
$sql='CREATE TABLE IF NOT EXISTS preuser'
     ."("
     ."id INT AUTO_INCREMENT PRIMARY KEY,"
     ."token varchar(255),"
     ."mail char(128),"
     ."date DATETIME,"
     ."flag TINYINT(1) DEFAULT 0"//本登録したら１になるようにする
     .");";
$stmt=$pdo->query($sql);
?>