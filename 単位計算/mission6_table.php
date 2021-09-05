<?php
$$dsn='データベース名';
$user='ユーザー名';
$pass='パスワード';
$pdo= new PDO($dsn,$user,$pass,
             array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
             );
//神学部            
$sql='CREATE TABLE IF NOT EXISTS god'
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."mail char(128),"
."ruir INT,"
."rui1 INT,"
."rui2 INT,"
."rui3 INT,"
."rui4 INT,"
."rui5 INT,"
."rui6 INT,"
."grade INT"
.");";
$stmt=$pdo->query($sql);
//法法
$sql='CREATE TABLE IF NOT EXISTS lawlaw'
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."mail char(128),"
."rui1 INT,"
."rui2 INT,"
."rui3 INT,"
."rui4 INT,"
."rui5 INT,"
."rui6a INT,"
."rui6b INT,"
."rui7 INT,"
."grade INT"
.");";
$stmt=$pdo->query($sql);
//法政
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

//英文
$sql='CREATE TABLE IF NOT EXISTS English'
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."mail char(128),"
."ruir INT,"
."rui1A INT,"
."rui1B INT,"
."rui1C INT,"
."rui1D INT,"
."rui1E INT,"
."rui1F INT,"
."rui2G INT,"
."rui2 INT,"
."grade INT"
.");";
$stmt=$pdo->query($sql);
//国文
$sql='CREATE TABLE IF NOT EXISTS Japanese'
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."mail char(128),"
."ruir INT,"
."rui1A INT,"
."rui1B INT,"
."rui1C INT,"
."rui2P INT,"
."rui2 INT,"
."rui3E INT,"
."rui3 INT,"
."grade INT"
.");";
$stmt=$pdo->query($sql);

?>
