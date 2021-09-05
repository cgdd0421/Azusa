<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<style>
.mgr-80{margin-right:80px;}
.mgr-30{margin-right:30px;}
</style>
</head>
<body>
<?php
session_start();
//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//エラーメッセージの初期化
$errors = array();

//DB接続
$dsn='データベース名';
$user='ユーザー名';
$pass='パスワード';
$pdo= new PDO($dsn,$user,$pass,
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
              );

if(empty($_GET))//$_GETでurlトークン取得。なかったら、仮登録に飛ぶ
  {header("Location: mission6_mail.php");
   exit();
  }
else{$urltoken= isset($_GET["urltoken"]) ? $_GET["urltoken"] : NULL;
     if($urltoken==""){$errors["notoken"]="もう１度登録をやり直してください";}//urlトークンが空の場合
     else{try{$sql='SELECT mail FROM preuser WHERE token=(:token)';//tokenが35行目の条件を満たしたidをpreuserテーブルから取り出す
              $stmt=$pdo->prepare($sql);
              $stmt->bindParam(':token',$urltoken,PDO::PARAM_STR);
              $stmt->execute();
              //上記条件に一致したレコード数のカウント
              $row_count=$stmt->rowCount();
              //上記条件（２４時間以内、フラグ０、トークン一致）に一致した数が０ならOK
              if($row_count==1){$mail_array=$stmt->fetch();
                                $mail=$mail_array["mail"];
                                $_SESSION["mail"]=$mail;
                               }
              else{$errors["token_date"]="URLが無効です。２４時間を過ぎた可能性があります。登録をやり直してください";
                  }
              $stmt=null;
             }
           catch(PDOException $e)
                {echo('Error:'.$e->getMessage());
                die();
                }
          }
    }
//確認ボタン（name:check)を押した後の処理
if(isset($_POST["check"]))
  {if(empty($_POST["check"]))
     {header("Location: mission6_mail.php");
      exit();
     }
   else{$name=isset($_POST["name"])?$_POST["name"]:NULL;
        $password=isset($_POST["password"])?$_POST["password"]:NULL;
        $_SESSION["password"]=$password;$_SESSION["name"]=$name;
       }
       
   if($password==""){$errors["password"]="パスワードが設定されていません";}
   else{$password_hide=str_repeat('*',strlen($password));}//パスワードを*で隠す
   
   if($name==""){$errors["name"]="名前が入力されていません";}
   }

//登録ボタンを押した後の処理
if(isset($_POST['btn_submit']))
  {//パスワードのハッシュ化 ハッシュ化：復号できない暗号にする。パスワードの管理用
	$password_hash = password_hash($_SESSION["password"], PASSWORD_DEFAULT);
   //ここでデータベースに登録する
  try{//tryは予期不可能なエラーが起こりうる場合に使う。後でcatchの中にエラーが起きた場合の処理を書く
      $sql= 'INSERT INTO user (name,password,mail,status,created_at,update_at) VALUES (:name,:password,:mail,1,now(),now())';
      $stmt= $pdo->prepare($sql);
      $stmt->bindParam(':name', $_SESSION['name'], PDO::PARAM_STR);
      $stmt->bindParam(':mail', $_SESSION['mail'], PDO::PARAM_STR);
      $stmt->bindValue(':password', $password_hash, PDO::PARAM_STR);
      $stmt->execute();
      //pre_userのflagを1にする(トークンの無効化)
      $sql = "UPDATE preuser SET flag=1 WHERE mail=:mail";
	  $stmt= $pdo->prepare($sql);
	  //プレースホルダへ実際の値を設定する
	  $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
      $stmt->execute();
      
      //本登録完了者にメール送信
      require 'src/Exception.php';
         require 'src/PHPMailer.php';
         require 'src/SMTP.php';
         require 'setting.php';
      // PHPMailerのインスタンス生成
        $mail2= new PHPMailer\PHPMailer\PHPMailer();
        $mail2->isSMTP(); // SMTPを使うようにメーラーを設定する
        $mail2->SMTPAuth = true;
        $mail2->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
        $mail2->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
        $mail2->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
        $mail2->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
        $mail2->Port = SMTP_PORT; // 接続するTCPポート
        
        $mail2->CharSet = "UTF-8";
        $mail2->Encoding = "base64";
        $mail2->setFrom(MAIL_FROM,MAIL_FROM_NAME);    
        $mail2->addAddress($_SESSION["mail"]);
        $mail2->Subject = "本登録完了しました";
        $mail2->isHTML(true);
        $body = "本登録が完了しました。"."<br>"."ありがとうございます。";
        $mail2->Body  = $body; // メール本文
         // ↑メール送信の実行
         
        if(!$mail2->send()) 
          {echo 'メール送信に失敗しました。もう一度入力してください';
           echo 'Mailer Error: ' . $mail2->ErrorInfo;
          }
        else{echo "本登録完了メールをお送りしました。";
        
             //データベース接続切断
		     $stm = null;

		     //セッション変数を全て解除
		     $_SESSION = array();
		     //セッションクッキーの削除
		     if (isset($_COOKIE["PHPSESSID"])) 
		        {setcookie("PHPSESSID", '', time() - 1800, '/');}
		    //セッションを破棄する
		     session_destroy();
            }

	  }
  catch(PDOException $e)//$e=Exceptionを受ける（捕捉する）ための任意の変数
       {//トランザクション取り消し（ロールバック）
		$pdo->rollBack();
		$errors["error"] = "もう一度やりなおして下さい。";
		echo('Error:'.$e->getMessage());
	   }
}


   
   


          
     






?>


<?php if(!isset($errors["notoken"]) && !isset($_POST["check"]) && !isset($_POST["back"]) && !isset($_POST["btn_submit"])): ?>
 <? if(count($errors)===0) : ?>
 <h1>本登録画面</h1>
 <form method="POST" action="<?= $_SERVER['SCRIPT_NAME'] ?>?urltoken=<?= $urltoken; ?>">
 <span class="mgr-80"></span>名前:<input type="text" name="name" placeholder="フルネーム">
      <br><br>
 <span class="mgr-30"></span>パスワード:<input type="text" name="password" placeholder="希望するパスワード">
      <br><br>
       メールアドレス:<?=htmlspecialchars($mail,ENT_QUOTES, 'UTF-8')?>
<input type="hidden" name="token" value=<?= $token?>>
      <br><br>
                                        <input type="submit" name="check" value="確認">
 </form>
<?php endif ?>
 
<?php if (isset($_POST["check"]) && count($errors) === 0 && !isset($_POST["back"]) && !isset($_POST["btn_submit"])): ?>
<h1>確認画面</h1>
<form method="POST" action="<?=$_SERVER['SCRIPT_NAME'] ?>?urltoken=<?= $urltoken; ?>">
<span class="mgr-80"></span>名前：<?=$name?>
     <br><br>
 <span class="mgr-30"></span>パスワード：<?=$password_hide?>
     <br><br>
	  メールアドレス：<?=htmlspecialchars($mail,ENT_QUOTES, 'UTF-8')?>
	 <br><br>	
<input type="button" name="back" value="戻る" onClick="history.back()">
<input type="hidden" name="token2" value="<?=$_POST["token"]?>">
<input type="submit" name="btn_submit" value="登録">
	</form>
<?php endif ?>	
<?php if(isset($_POST["btn_submit"]) && count($errors)===0):?>
本登録ありがとうございます。
<?php endif;?>

<?php if(count($errors)>0):?>
<?php foreach($errors as $error){echo $error;}?>
<?php endif ;?>
</body>
</html>