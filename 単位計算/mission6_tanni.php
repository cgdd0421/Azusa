<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"  />
<title>単位登録</title>
</head>
<body>
<?php
session_start();
//クロスサイトフォージ対策
$_SESSION["token"]=base64_encode(openssl_random_pseudo_bytes(32));
//クリックジャッキング対策
header("X-FRAME-OPTIONS:SAMEORIGIN");
//DB接続
$dsn='データベース名';
$user='ユーザー名';
$pass='パスワード';
$pdo= new PDO($dsn,$user,$pass,
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
              );
//ログイン状態の確認             
if(!isset($_SESSION["account"]))
  {header("Location:mission6_login.php");exit();}

if(isset($_POST["submit1"]))
  {if($_POST["grade"]=="first"){$_SESSION["grade"]=1;}
   if($_POST["grade"]=="secound"){$_SESSION["grade"]=2;}
   if($_POST["grade"]=="third"){$_SESSION["grade"]=3;}
   if($_POST["grade"]=="forth"){$_SESSION["grade"]=4;}
  } 
  if(isset($_POST["l_submit2"]))
   {//DBへの登録//
      $grade=$_SESSION["grade"];
      $mail=$_SESSION["account"];
      $l_num1=$_POST["l_num1"];
      $l_num2=$_POST["l_num2"];
      $l_num3=$_POST["l_num3"];
      $l_num4=$_POST["l_num4"];
      $l_num5=$_POST["l_num5"];
      $l_num6a=$_POST["l_num6a"];
      $l_num6b=$_POST["l_num6b"];
      $l_num7=$_POST["l_num7"];
      //既に登録済みかの確認
      $sql='SELECT id FROM lawlaw WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $check=$stmt->fetchAll();
      if(empty($check))//未登録なら
      {$sql='INSERT INTO lawlaw (mail,rui1,rui2,rui3,rui4,rui5,rui6a,rui6b,rui7,grade)
            VALUES (:mail,:rui1,:rui2,:rui3,:rui4,:rui5,:rui6a,:rui6b,:rui7,:grade)';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->bindParam(':rui1',$l_num1,PDO::PARAM_INT);
      $stmt->bindParam(':rui2',$l_num2,PDO::PARAM_INT);
      $stmt->bindParam(':rui3',$l_num3,PDO::PARAM_INT);
      $stmt->bindParam(':rui4',$l_num4,PDO::PARAM_INT);
      $stmt->bindParam(':rui5',$l_num5,PDO::PARAM_INT);
      $stmt->bindParam(':rui6a',$l_num6a,PDO::PARAM_INT);
      $stmt->bindParam(':rui6b',$l_num6b,PDO::PARAM_INT);
      $stmt->bindParam(':rui7',$l_num7,PDO::PARAM_INT);
      $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
      $stmt->execute();
      //表示
      $sql='SELECT*FROM lawlaw WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      foreach($results as $row)
             {echo "以下のように登録しました<br>"."法学部法律学科".$grade."年生<br>". "1類".$row["rui1"]."<br>"."2類".$row["rui2"].
              "<br>"."3類".$row["rui3"]."<br>"."4類".$row["rui4"]."<br>"."5類".$row["rui5"]."<br>"."6類A群".$row["rui6a"].
              "<br>"."6類B群".$row["rui6b"]."<br>"."7類".$row["rui7"];
             }
      }
      if(!empty($check))//既に登録済みなら、変更にする
      {$sql='UPDATE lawlaw SET rui1=:rui1,rui2=:rui2,rui3=:rui3,rui4=:rui4,rui5=:rui5,rui6a=:rui6a,rui6b=:rui6b,rui7=:rui7,grade=:grade
             WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->bindParam(':rui1',$l_num1,PDO::PARAM_INT);
      $stmt->bindParam(':rui2',$l_num2,PDO::PARAM_INT);
      $stmt->bindParam(':rui3',$l_num3,PDO::PARAM_INT);
      $stmt->bindParam(':rui4',$l_num4,PDO::PARAM_INT);
      $stmt->bindParam(':rui5',$l_num5,PDO::PARAM_INT);
      $stmt->bindParam(':rui6a',$l_num6a,PDO::PARAM_INT);
      $stmt->bindParam(':rui6b',$l_num6b,PDO::PARAM_INT);
      $stmt->bindParam(':rui7',$l_num7,PDO::PARAM_INT);
      $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
      $stmt->execute();
      //表示
      $sql='SELECT*FROM lawlaw WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      foreach($results as $row)
             {echo "以下のように変更しました<br>"."法学部法律学科".$grade."年生<br>". "1類".$row["rui1"]."<br>"."2類".$row["rui2"].
              "<br>"."3類".$row["rui3"]."<br>"."4類".$row["rui4"]."<br>"."5類".$row["rui5"]."<br>"."6類A群".$row["rui6a"].
              "<br>"."6類B群".$row["rui6b"]."<br>"."7類".$row["rui7"];
             }
      }
    ;}
//法政の場合
  if(isset($_POST["lp_submit2"]))
   {//DBへの登録//
      $grade=$_SESSION["grade"];
      $mail=$_SESSION["account"];
      $lp_num1=$_POST["lp_num1"];
      $lp_num2=$_POST["lp_num2"];
      $lp_num3A=$_POST["lp_num3A"];
      $lp_num3B=$_POST["lp_num3B"];
      $lp_num3C=$_POST["lp_num3C"];
      $lp_num4=$_POST["lp_num4"];
      $lp_num5=$_POST["lp_num5"];
      $lp_num6a=$_POST["lp_num6a"];
      $lp_num6b=$_POST["lp_num6b"];
      $lp_num7=$_POST["lp_num7"];
      //既に登録済みかの確認
      $sql='SELECT id FROM lawpoli WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $check=$stmt->fetchAll();
      if(empty($check))//未登録なら
      {$sql='INSERT INTO lawpoli (mail,rui1,rui2,rui3A,rui3B,rui3C,rui4,rui5,rui6a,rui6b,rui7,grade)
            VALUES (:mail,:rui1,:rui2,:rui3A,:rui3B,:rui3C,:rui4,:rui5,:rui6a,:rui6b,:rui7,:grade)';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->bindParam(':rui1',$lp_num1,PDO::PARAM_INT);
      $stmt->bindParam(':rui2',$lp_num2,PDO::PARAM_INT);
      $stmt->bindParam(':rui3A',$lp_num3A,PDO::PARAM_INT);
      $stmt->bindParam(':rui3B',$lp_num3B,PDO::PARAM_INT);
      $stmt->bindParam(':rui3C',$lp_num3C,PDO::PARAM_INT);
      $stmt->bindParam(':rui4',$lp_num4,PDO::PARAM_INT);
      $stmt->bindParam(':rui5',$lp_num5,PDO::PARAM_INT);
      $stmt->bindParam(':rui6a',$lp_num6a,PDO::PARAM_INT);
      $stmt->bindParam(':rui6b',$lp_num6b,PDO::PARAM_INT);
      $stmt->bindParam(':rui7',$lp_num7,PDO::PARAM_INT);
      $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
      $stmt->execute();
      //表示
      $sql='SELECT*FROM lawpoli WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      foreach($results as $row)
             {echo "以下のように登録しました<br>"."法学政治学科".$grade."年生<br>". "1類".$row["rui1"]."<br>"."2類".$row["rui2"].
              "<br>"."3類A群".$row["rui3A"]."<br>"."3類B群".$row["rui3B"]."3類C群".$row["rui3C"]."<br>"."4類".$row["rui4"]."<br>"."5類".$row["rui5"]."<br>"."6類A群".$row["rui6a"].
              "<br>"."6類B群".$row["rui6b"]."<br>"."7類".$row["rui7"];
             }
      }
      if(!empty($check))//既に登録済みなら、変更にする
      {$sql='UPDATE lawpoli SET rui1=:rui1,rui2=:rui2,rui3A=:rui3A,rui3B=:rui3B,rui3C=:rui3C,rui4=:rui4,rui5=:rui5,rui6a=:rui6a,rui6b=:rui6b,rui7=:rui7,grade=:grade
             WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->bindParam(':rui1',$lp_num1,PDO::PARAM_INT);
      $stmt->bindParam(':rui2',$lp_num2,PDO::PARAM_INT);
      $stmt->bindParam(':rui3A',$lp_num3A,PDO::PARAM_INT);
      $stmt->bindParam(':rui3B',$lp_num3B,PDO::PARAM_INT);
      $stmt->bindParam(':rui3C',$lp_num3C,PDO::PARAM_INT);
      $stmt->bindParam(':rui4',$lp_num4,PDO::PARAM_INT);
      $stmt->bindParam(':rui5',$lp_num5,PDO::PARAM_INT);
      $stmt->bindParam(':rui6a',$lp_num6a,PDO::PARAM_INT);
      $stmt->bindParam(':rui6b',$lp_num6b,PDO::PARAM_INT);
      $stmt->bindParam(':rui7',$lp_num7,PDO::PARAM_INT);
      $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
      $stmt->execute();
      //表示
      $sql='SELECT*FROM lawpoli WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      foreach($results as $row)
             {echo "以下のように変更しました<br>"."法学政治学科".$grade."年生<br>". "1類".$row["rui1"]."<br>"."2類".$row["rui2"].
              "<br>"."3類A群".$row["rui3A"]."<br>"."3類B群".$row["rui3B"]."3類C群".$row["rui3C"]."<br>"."4類".$row["rui4"]."<br>"."5類".$row["rui5"]."<br>"."6類A群".$row["rui6a"].
              "<br>"."6類B群".$row["rui6b"]."<br>"."7類".$row["rui7"];
             }
      }
    ;}
//神学部の場合   
if(isset($_POST["g_submit2"]))
   {//DBへの登録//
      $grade=$_SESSION["grade"];
      $mail=$_SESSION["account"];
      $g_numr=$_POST["g_numr"];
      $g_num1=$_POST["g_num1"];
      $g_num2=$_POST["g_num2"];
      $g_num3=$_POST["g_num3"];
      $g_num4=$_POST["g_num4"];
      $g_num5=$_POST["g_num5"];
      $g_num6=$_POST["g_num6"];
      //既に登録済みかの確認
      $sql='SELECT id FROM god WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $check=$stmt->fetchAll();
      if(empty($check))//未登録なら
      {$sql='INSERT INTO god (mail,ruir,rui1,rui2,rui3,rui4,rui5,rui6,grade)
            VALUES (:mail,:ruir,:rui1,:rui2,:rui3,:rui4,:rui5,:rui6,:grade)';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->bindParam(':ruir',$g_numr,PDO::PARAM_INT);
      $stmt->bindParam(':rui1',$g_num1,PDO::PARAM_INT);
      $stmt->bindParam(':rui2',$g_num2,PDO::PARAM_INT);
      $stmt->bindParam(':rui3',$g_num3,PDO::PARAM_INT);
      $stmt->bindParam(':rui4',$g_num4,PDO::PARAM_INT);
      $stmt->bindParam(':rui5',$g_num5,PDO::PARAM_INT);
      $stmt->bindParam(':rui6',$g_num6,PDO::PARAM_INT);
      $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
      $stmt->execute();
      //表示
      $sql='SELECT*FROM god WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      foreach($results as $row)
             {echo "以下のように登録しました<br>"."神学部神学科".$grade."年生<br>". "必修".$row["ruir"]."<br>"."1類".$row["rui1"]."<br>"."2類".$row["rui2"].
              "<br>"."3類".$row["rui3"]."<br>"."4類".$row["rui4"]."<br>"."5類".$row["rui5"]."<br>"."6類".$row["rui6"].
              "<br>";
             }
      }
      if(!empty($check))//既に登録済みなら、変更にする
      {$sql='UPDATE god SET ruir=:ruir, rui1=:rui1,rui2=:rui2,rui3=:rui3,rui4=:rui4,rui5=:rui5,rui6=:rui6,grade=:grade
             WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->bindParam(':ruir',$g_numr,PDO::PARAM_INT);
      $stmt->bindParam(':rui1',$g_num1,PDO::PARAM_INT);
      $stmt->bindParam(':rui2',$g_num2,PDO::PARAM_INT);
      $stmt->bindParam(':rui3',$g_num3,PDO::PARAM_INT);
      $stmt->bindParam(':rui4',$g_num4,PDO::PARAM_INT);
      $stmt->bindParam(':rui5',$g_num5,PDO::PARAM_INT);
      $stmt->bindParam(':rui6',$g_num6,PDO::PARAM_INT);
      $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
      $stmt->execute();
      //表示
      $sql='SELECT*FROM god WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      foreach($results as $row)
             {echo "以下のように変更しました<br>"."神学部神学科".$grade."年生<br>". "必修".$row["ruir"]."<br>"."1類".$row["rui1"]."<br>"."2類".$row["rui2"].
              "<br>"."3類".$row["rui3"]."<br>"."4類".$row["rui4"]."<br>"."5類".$row["rui5"]."<br>"."6類".$row["rui6"].
              "<br>";
             }
      }
    ;}
//英文の場合
if(isset($_POST["E_submit2"]))
   {//DBへの登録//
      $grade=$_SESSION["grade"];
      $mail=$_SESSION["account"];
      $E_numr=$_POST["E_numr"];
      $E_num1A=$_POST["E_num1A"];
      $E_num1B=$_POST["E_num1B"];
      $E_num1C=$_POST["E_num1C"];
      $E_num1D=$_POST["E_num1D"];
      $E_num1E=$_POST["E_num1E"];
      $E_num1F=$_POST["E_num1F"];
      $E_num2G=$_POST["E_num2G"];
      $E_num2=$_POST["E_num2"];
      //既に登録済みかの確認
      $sql='SELECT id FROM English WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $check=$stmt->fetchAll();
      if(empty($check))//未登録なら
      {$sql='INSERT INTO English (mail,ruir,rui1A,rui1B,rui1C,rui1D,rui1E,rui1F,rui2G,rui2,grade)
            VALUES (:mail,:ruir,:rui1A,:rui1B,:rui1C,:rui1D,:rui1E,:rui1F,:rui2G,:rui2,:grade)';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->bindParam(':ruir',$E_numr,PDO::PARAM_INT);
      $stmt->bindParam(':rui1A',$E_num1A,PDO::PARAM_INT);
      $stmt->bindParam(':rui1B',$E_num1B,PDO::PARAM_INT);
      $stmt->bindParam(':rui1C',$E_num1C,PDO::PARAM_INT);
      $stmt->bindParam(':rui1D',$E_num1D,PDO::PARAM_INT);
      $stmt->bindParam(':rui1E',$E_num1E,PDO::PARAM_INT);
      $stmt->bindParam(':rui1F',$E_num1F,PDO::PARAM_INT);
      $stmt->bindParam(':rui2G',$E_num2G,PDO::PARAM_INT);
      $stmt->bindParam(':rui2',$E_num2,PDO::PARAM_INT);
      $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
      $stmt->execute();
      //表示
      $sql='SELECT*FROM English WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      foreach($results as $row)
             {echo "以下のように登録しました<br>"."文学部英文学科".$grade."年生<br>". "必修".$row["ruir"]."<br>"."1類A群".$row["rui1A"]."<br>"."1類B群".$row["rui1B"].
              "<br>"."1類C群".$row["rui1C"]."<br>"."1類D群".$row["rui1D"]."<br>"."1類E群".$row["rui1E"]."<br>"."1類F群".$row["rui1F"].
              "<br>"."2類　外国語科目".$row["rui2G"]."<br>"."2類　外国語以外".$row["rui2"];
             }
      }
      if(!empty($check))//既に登録済みなら、変更にする
      {$sql='UPDATE English SET ruir=:ruir, rui1A=:rui1A,rui1B=:rui1B,rui1C=:rui1C,rui1D=:rui1D,rui1E=:rui1E,rui1F=:rui1F,rui2G=:rui2G,rui2=:rui2
      ,grade=:grade WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->bindParam(':ruir',$E_numr,PDO::PARAM_INT);
      $stmt->bindParam(':rui1A',$E_num1A,PDO::PARAM_INT);
      $stmt->bindParam(':rui1B',$E_num1B,PDO::PARAM_INT);
      $stmt->bindParam(':rui1C',$E_num1C,PDO::PARAM_INT);
      $stmt->bindParam(':rui1D',$E_num1D,PDO::PARAM_INT);
      $stmt->bindParam(':rui1E',$E_num1E,PDO::PARAM_INT);
      $stmt->bindParam(':rui1F',$E_num1F,PDO::PARAM_INT);
      $stmt->bindParam(':rui2G',$E_num2G,PDO::PARAM_INT);
      $stmt->bindParam(':rui2',$E_num2,PDO::PARAM_INT);
      $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
      $stmt->execute();
      //表示
      $sql='SELECT*FROM English WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      foreach($results as $row)
             {echo "以下のように変更しました<br>"."文学部英文学科".$grade."年生<br>". "必修".$row["ruir"]."<br>"."1類A群".$row["rui1A"]."<br>"."1類B群".$row["rui1B"].
              "<br>"."1類C群".$row["rui1C"]."<br>"."1類D群".$row["rui1D"]."<br>"."1類E群".$row["rui1E"]."<br>"."1類F群".$row["rui1F"].
              "<br>"."2類　外国語科目".$row["rui2G"]."<br>"."2類　外国語以外".$row["rui2"];
             }
      }
    ;}
 //国文の場合   
if(isset($_POST["J_submit2"]))
   {//DBへの登録//
      $grade=$_SESSION["grade"];
      $mail=$_SESSION["account"];
      $J_numr=$_POST["J_numr"];
      $J_num1A=$_POST["J_num1A"];
      $J_num1B=$_POST["J_num1B"];
      $J_num1C=$_POST["J_num1C"];
      $J_num2P=$_POST["J_num2P"];
      $J_num2=$_POST["J_num2"];
      $J_num3E=$_POST["J_num3E"];
      $J_num3=$_POST["J_num3"];
      //既に登録済みかの確認
      $sql='SELECT id FROM Japanese WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $check=$stmt->fetchAll();
      if(empty($check))//未登録なら
      {$sql='INSERT INTO Japanese (mail,ruir,rui1A,rui1B,rui1C,rui2P,rui2,rui3E,rui3,grade)
            VALUES (:mail,:ruir,:rui1A,:rui1B,:rui1C,:rui2P,:rui2,:rui3E,:rui3,:grade)';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->bindParam(':ruir',$J_numr,PDO::PARAM_INT);
      $stmt->bindParam(':rui1A',$J_num1A,PDO::PARAM_INT);
      $stmt->bindParam(':rui1B',$J_num1B,PDO::PARAM_INT);
      $stmt->bindParam(':rui1C',$J_num1C,PDO::PARAM_INT);
      $stmt->bindParam(':rui2P',$J_num2P,PDO::PARAM_INT);
      $stmt->bindParam(':rui2',$J_num2,PDO::PARAM_INT);
      $stmt->bindParam(':rui3E',$J_num3E,PDO::PARAM_INT);
      $stmt->bindParam(':rui3',$J_num3,PDO::PARAM_INT);
      $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
      $stmt->execute();
      //表示
      $sql='SELECT*FROM Japanese WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      foreach($results as $row)
             {echo "以下のように登録しました<br>"."文学部国文学科".$grade."年生<br>". "必修".$row["ruir"]."<br>"."1類A群".$row["rui1A"]."<br>"."1類B群".$row["rui1B"].
              "<br>"."1類C群".$row["rui1C"]."<br>"."2類 保健体育".$row["rui2P"]."<br>"."2類 保健体育以外".$row["rui2"]."<br>"."3類 英語".$row["rui3E"].
              "<br>"."3類　英語以外".$row["rui3"]."<br>";
             }
      }
      if(!empty($check))//既に登録済みなら、変更にする
      {$sql='UPDATE Japanese SET ruir=:ruir, rui1A=:rui1A,rui1B=:rui1B,rui1C=:rui1C,rui2P=:rui2P,rui2=:rui2,rui3E=:rui3E,rui3=:rui3
      ,grade=:grade WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->bindParam(':ruir',$J_numr,PDO::PARAM_INT);
      $stmt->bindParam(':rui1A',$J_num1A,PDO::PARAM_INT);
      $stmt->bindParam(':rui1B',$J_num1B,PDO::PARAM_INT);
      $stmt->bindParam(':rui1C',$J_num1C,PDO::PARAM_INT);
      $stmt->bindParam(':rui2P',$J_num2P,PDO::PARAM_INT);
      $stmt->bindParam(':rui2',$J_num2,PDO::PARAM_INT);
      $stmt->bindParam(':rui3E',$J_num3E,PDO::PARAM_INT);
      $stmt->bindParam(':rui3',$J_num3,PDO::PARAM_INT);
      $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
      $stmt->execute();
      //表示
      $sql='SELECT*FROM Japanese WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      foreach($results as $row)
             {echo "以下のように変更しました<br>"."文学部国文学科".$grade."年生<br>". "必修".$row["ruir"]."<br>"."1類A群".$row["rui1A"]."<br>"."1類B群".$row["rui1B"].
              "<br>"."1類C群".$row["rui1C"]."<br>"."2類 保健体育".$row["rui2P"]."<br>"."2類 保健体育以外".$row["rui2"]."<br>"."3類 英語".$row["rui3E"].
              "<br>"."3類　英語以外".$row["rui3"]."<br>";
             }
      }
    ;}

?>
<?php if(!isset($_POST["submit1"]) && !isset($_POST["l_submit2"]) &&!isset($_POST["lp_submit2"])  &&!isset($_POST["g_submit2"])
    && !isset($_POST["E_submit2"]) && !isset($_POST["J_submit2"])):?>
 <form method="POST" action=<?php $_SERVER["SCRIPT_NAME"] ;?>>
  <select name="faculty" required>
   <option value="">学部・学科を選択してください</option>
   <optgroup label="法学部">
　 <option value="lawlaw">法学部　法律学科</option>
　 <option value="lawpoli">法学部　政治学科</option>
   </optgroup>
   <optgroup label="神学部">
   <option value="god">神学部　神学科</option>
   </optgroup>
   <optgroup label="文学部">
   <option value="English">文学部　英文学科</option>
   <option value="Japanese">文学部　国文学科</option>
   <!--<option value="philosophy">文学部　哲学科</option>
   <option value="art">文学部　美学芸術学科</option>
   <option value="culture">文学部　文化史学科</option>
   </optgroup>
   <optgroup label="社会学部">
   <option value="social">社会学部　社会学科</option>
   <option value="welfare">社会学部　社会福祉学科</option>
   <option value="media">社会学部　メディア学科</option>
   <option value="industry">社会学部　産業関係学科</option>
   <option value="education">社会学部　教育文化学科</option>
   </optgroup>-->
  </select>
  <br>
  <select name="grade" required>
  <option value="first">１</option>
  <option value="secound">２</option>
  <option value="third">３</option>
  <option value="forth">4</option>
  </select>
  年生<br>
  <input type="submit" name="submit1" value="次へ">
  </form>
<?php endif ?>
<!--法法の時-->
<?php if(isset($_POST["submit1"]) && $_POST["faculty"]=="lawlaw") :?>
<form method="POST" action=<?php $_SERVER["SCRIPT_NAME"] ;?>>
1類<input required type="num" name="l_num1" placeholder="数字を入力"><br>
2類<input required type="num" name="l_num2" placeholder="数字を入力"><br>
3類<input required type="num" name="l_num3" placeholder="数字を入力"><br>
4類<input required type="num" name="l_num4" placeholder="数字を入力"><br>
5類<input required type="num" name="l_num5" placeholder="数字を入力"><br>
6類A群<input required type="num" name="l_num6a" placeholder="数字を入力"><br>
6類B群<input required type="num" name="l_num6b" placeholder="数字を入力"><br>
7類<input required type="num" name="l_num7" placeholder="数字を入力"><br>
<input type="submit" name="l_submit2" value="送信">
</form>
<?php endif ?>

<!--法政の時-->
<?php if(isset($_POST["submit1"]) && $_POST["faculty"]=="lawpoli") :?>
<form method="POST" action=<?php $_SERVER["SCRIPT_NAME"] ;?>>
1類<input required type="num" name="lp_num1" placeholder="数字を入力"><br>
2類<input required type="num" name="lp_num2" placeholder="数字を入力"><br>
3類A群<input required type="num" name="lp_num3A" placeholder="数字を入力"><br>
3類B群<input required type="num" name="lp_num3B" placeholder="数字を入力"><br>
3類C群<input required type="num" name="lp_num3C" placeholder="数字を入力"><br>
4類<input required type="num" name="lp_num4" placeholder="数字を入力"><br>
5類<input required type="num" name="lp_num5" placeholder="数字を入力"><br>
6類A群<input required type="num" name="lp_num6a" placeholder="数字を入力"><br>
6類B群<input required type="num" name="lp_num6b" placeholder="数字を入力"><br>
7類<input required type="num" name="lp_num7" placeholder="数字を入力"><br>
<input type="submit" name="lp_submit2" value="送信">
</form>
<?php endif ?>
<!--神学部の場合-->
<?php if(isset($_POST["submit1"]) && $_POST["faculty"]=="god") :?>
<form method="POST" action=<?php $_SERVER["SCRIPT_NAME"] ;?>>
必修<input required type="num" name="g_numr" placeholder="数字を入力"><br>
1類<input required type="num" name="g_num1" placeholder="数字を入力"><br>
2類<input required type="num" name="g_num2" placeholder="数字を入力"><br>
3類<input required type="num" name="g_num3" placeholder="数字を入力"><br>
4類<input required type="num" name="g_num4" placeholder="数字を入力"><br>
5類<input required type="num" name="g_num5" placeholder="数字を入力"><br>
6類<input required type="num" name="g_num6" placeholder="数字を入力"><br>
<input type="submit" name="g_submit2" value="送信">
</form>
<?php endif ?>
<!--英文の場合-->
<?php if(isset($_POST["submit1"]) && $_POST["faculty"]=="English") :?>
<form method="POST" action=<?php $_SERVER["SCRIPT_NAME"] ;?>>
必修<input required type="num" name="E_numr" placeholder="数字を入力"><br>
選択科目1 A群<input required type="num" name="E_num1A" placeholder="数字を入力"><br>
選択科目1 B群<input required type="num" name="E_num1B" placeholder="数字を入力"><br>
選択科目1 C群<input required type="num" name="E_num1C" placeholder="数字を入力"><br>
選択科目1 D群<input required type="num" name="E_num1D" placeholder="数字を入力"><br>
選択科目1 E群<input required type="num" name="E_num1E" placeholder="数字を入力"><br>
選択科目1 F群<input required type="num" name="E_num1F" placeholder="数字を入力"><br>
選択科目2 外国語科目<input required type="num" name="E_num2G" placeholder="数字を入力"><br>
選択科目2 外国語以外<input required type="num" name="E_num2" placeholder="数字を入力"><br>
<input type="submit" name="E_submit2" value="送信">
</form>
<?php endif ?>
<!--国文の場合-->
<?php if(isset($_POST["submit1"]) && $_POST["faculty"]=="Japanese") :?>
<form method="POST" action=<?php $_SERVER["SCRIPT_NAME"] ;?>>
必修<input required type="num" name="J_numr" placeholder="数字を入力"><br>
選択科目1 A群<input required type="num" name="J_num1A" placeholder="数字を入力"><br>
選択科目1 B群<input required type="num" name="J_num1B" placeholder="数字を入力"><br>
選択科目1 C群<input required type="num" name="J_num1C" placeholder="数字を入力"><br>
選択科目2 保健体育<input required type="num" name="J_num2P" placeholder="数字を入力"><br>
選択科目2　保健体育以外<input required type="num" name="J_num2" placeholder="数字を入力"><br>
選択科目3　英語<input required type="num" name="J_num3E" placeholder="数字を入力"><br>
選択科目2　英語以外<input required type="num" name="J_num3" placeholder="数字を入力"><br>
<input type="submit" name="J_submit2" value="送信">
</form>
<?php endif ?>


<?php if((isset($_POST["l_submit2"])) ||(isset($_POST["lp_submit2"]))||(isset($_POST["E_submit2"]))
||(isset($_POST["E_submit2"])) || (isset($_POST["J_submit2"]))):?>
<br><a href="http://tech-base.net/tb-230168/mission6/mission6_login2.php">ホームに戻る</a>
<?php endif ?>
</body>
</html>