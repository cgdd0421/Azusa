<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"  />
<title>新規ログイン画面</title>
<style>
.mgr-30{margin-right:30px;}  
.center{text-align:center;}
</style>
</head>
<body>
<?php
session_start();
//クロスサイトリクエストフォージ(CSRF)対策
$_SESSION["token"]=base64_encode(openssl_random_pseudo_bytes(32));
$token=$_SESSION["token"];

//クリックジャッキング対策
header("X-FRAME-OPTIONS:SAMEORIGIN");

$errors=array();

//ログインボタンを押した場合
if(isset($_POST["submit"]))
  {if(empty($_POST["mail"])){$errors["mail_no"]="メールアドレスが未入力です。";}
   elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST["mail"]))
         {$errors["mail_type"]="メールアドレスの形式が正しくありません" ;}//メールアドレス形式が正しくない場合
    
   if(empty($_POST["pass"])){$errors["pass_no"]="パスワードが未入力です";}
   
   if(count($errors)===0)
     {try{//DB接続
          $dsn='データベース名';
          $user='ユーザー名';
          $pass='パスワード';
          $pdo= new PDO($dsn,$user,$pass,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
                       );
           //メールアドレスとパスワードが一致するか確認
          $mail=$_POST["mail"];
          $mail=trim($mail);
          $sql='SELECT * FROM user WHERE mail=:mail';
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row)
                  {if($row['mail']=$mail)
                     {//メールアドレスが存在したら
                       $password_hash=$row["password"];
                      //パスワードが一致したら
                      if(password_verify($_POST["pass"],$password_hash))
                        {//セッションハイジャック対策
                         session_regenerate_id(true);
                         $_SESSION["account"]=$_POST["mail"];
                         header("Location:mission6_login2.php");
                         exit();
                         }
                      else{$errors["login_pass"]="メールアドレス又はパスワードが一致しないためログインできませんでした。";}
                      ;}
                    else{$errors["login_mail"]="メールアドレス又はパスワードが一致しないためログインできませんでした。";}
                        $pdo=null;
                  };
           }
       catch(PDOException $e){echo "error".$e->getMessage(); die();}
     }
   if(count($errors)>0){foreach($errors as $error){echo $error."<br>";}}
  }
?>
<center><h1>ログイン画面</h1></center>
 <form method="POST" action=<?php $_SERVER["SCRIPT_NAME"] ;?>>
<div class="center">メールアドレス<input type="text" name="mail" placeholder="登録したメールアドレス">
<br><br>
<span class="mgr-30"></span>パスワード<input type="password" name="pass" placeholder="登録したパスワード">
<br><br>
     <input type="submit" name="submit" value="ログイン"></div>
 </form>
</body>
</html>