<?php
$dsn='データベース名';
$user='ユーザー名';
$pass='パスワード';
$pdo= new PDO($dsn,$user,$pass,
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
              );
              
$sql='CREATE TABLE IF NOT EXISTS user'
     ."("
     ."id INT AUTO_INCREMENT PRIMARY KEY,"
     ."name char(32),"
     ."mail char(128),"
     ."password varchar(200),"
     ."created_at DATETIME,"
     ."update_at DATETIME,"
     ."status INT(1) DEFAULT 2"
     .");";
$stmt=$pdo->query($sql);
?>