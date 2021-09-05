<?php
$dsn='データベース名';
$user='ユーザー名';
$pass='パスワード';
$pdo= new PDO($dsn,$user,$pass,
             array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
             );
$sql='CREATE TABLE IF NOT EXISTS lawpoli'
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."mail char(128),"
."rui1 INT,"
."rui2 INT,"
."rui3A INT,"
."rui3B INT,"
."rui3C INT,"
."rui4 INT,"
."rui5 INT,"
."rui6a INT,"
."rui6b INT,"
."rui7 INT,"
."grade INT"
.");";
$stmt=$pdo->query($sql);
?>
