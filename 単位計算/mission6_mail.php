<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"  />
<title>仮会員登録画面</title>
</head>
<body>
<?php
session_start();
//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

$errors = array();

// メール内容設定
if(isset($_POST["mail"]))//送信ボタンが押された場合
      {if(empty($_POST["mail"]))
         {$errors["mail_empty"]="メールアドレスが空欄です";}

       elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST["mail"]))
         {$errors["mail_type"]="メールアドレスの形式が正しくありません" ;}//メールアドレス形式が正しくない場合

      //DB接続
      $dsn='データベース名';
      $user='ユーザー名';
      $pass='パスワード';
       $pdo= new PDO($dsn,$user,$pass,
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
              );
              
      //userテーブルに同一のメールアドレスがないか検索//
      $sql='SELECT id FROM user WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$_POST["mail"],PDO::PARAM_STR);
      $stmt->execute();

      $result=$stmt->fetch(PDO::FETCH_ASSOC);
      if(isset($result['id']))
        {$errors["mail_exists"]="このメールアドレスは既に登録されています" ;}
        
      if(count($errors)===0)//エラーの数が0個だったら
        {$urltoken = hash('sha256',uniqid(rand(),1));
	     $url = "http://tech-base.net/tb-230168/mission6/mission6_signup.php"."?urltoken=".$urltoken;
	     //「?urltoken=」とすることでGETメソッドによりトークンを取得できるようになります。
            
         require 'src/Exception.php';
         require 'src/PHPMailer.php';
         require 'src/SMTP.php';
         require 'setting.php';
         // PHPMailerのインスタンス生成
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->isSMTP(); // SMTPを使うようにメーラーを設定する
        $mail->SMTPAuth = true;
        $mail->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
        $mail->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
        $mail->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
        $mail->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
        $mail->Port = SMTP_PORT; // 接続するTCPポート
        
        $mail->CharSet = "UTF-8";
        $mail->Encoding = "base64";
        $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);    
        $mail->addAddress($_POST["mail"]);
        $mail->Subject = "本登録をお願いします";
        $mail->isHTML(true);
        $body = "24時間以内に下記のURLから本登録をお済ませください"."<br>".$url;
        $mail->Body  = $body; // メール本文
         // ↑メール送信の実行
         
        //DB記録 id,トークン、メール、日時、フラグ
        $sql='INSERT INTO preuser (token,mail,date) VALUES(:token,:mail,now())';
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(':mail',$_POST["mail"],PDO::PARAM_STR);
        $stmt->bindParam(':token',$urltoken,PDO::PARAM_STR);
        $stmt->execute();
        
        if(!$mail->send()) 
          {echo 'メール送信に失敗しました。もう一度入力してください';
           echo 'Mailer Error: ' . $mail->ErrorInfo;
          }
        else{echo 'メールをお送りしました。<br>
                  24時間以内にメール記載のURLから本登録をお願いいたします。';
             //セッション変数を全て解除
             $_SESSION = array();
             //クッキーの削除
             if (isset($_COOKIE["PHPSESSID"])) 
                {setcookie("PHPSESSID", '', time() - 1800, '/');}
             //セッションを破棄する
             session_destroy();
            }    
        }
    else{foreach($errors as $error){echo $error ;}}
    }

?>
 <h1>仮会員登録</h1>
 <form method="POST" action="">
  メールアドレス：<input type="text" name="mail" size="50" value=<?php if(!empty($_POST["mail"])){echo $_POST["mail"];}?> >
                  <input type="submit" name="submit" value="送信">
 </form>
</body>
</html>
   