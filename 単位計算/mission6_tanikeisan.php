<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>単位計算</title>
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
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
              
 //ログイン状態の確認             
if(!isset($_SESSION["account"]))
  {header("Location:mission6_login.php");exit();}
              
if(isset($_POST["submit1"]))
  {$mail=$_SESSION["account"];
   if($_POST["faculty"]=="lawlaw")
     {$sql='SELECT*FROM lawlaw WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      if(empty($results))
        {$errors["nodate"]="学部・学科が違います。又は登録されていません。";}
      if(!empty($results))
        {foreach($results as $row)
         {if(18-$row["rui2"]>=0){$rui2=18-$row["rui2"];$rui2_3=0;}
          else{$rui2=0;$rui2_3=$row["rui2"]- 18;}//残り単位
          if(52-$row["rui3"]-$rui2_3>=0){$rui3=52-$row["rui3"]-$rui2_3;$rui3_7=0;}
          else{$rui3=0;$rui3_7=$row["rui3"]-52;}
          if(8-$row["rui6a"]>=0){$rui6a=8-$row["rui6a"];$rui6a_7=0;}
          else{$rui6a=0;$rui6a_7=$row["rui6a"]-8;}
          if(8-$row["rui6b"]>=0){$rui6b=8-$row["rui6b"];$rui6b_7=0;}
          else{$rui6b=0;$rui6b_7=$row["rui6b"]-8;}
          if(42-$row["rui7"]-$row["rui1"]-$rui3_7-$row["rui4"]-$row["rui5"]-$rui6a_7-$rui6b_7>=0)
            {$rui7=42-$row["rui7"]-$row["rui1"]-$rui3_7-$row["rui4"]-$row["rui5"]-$rui6a_7-$rui6b_7;}
          else{$rui7=0;}
          
          echo "卒業に必要な単位は以下の通りです<br><br>".
               "1類 残り0（最低必要単位数0単位*7類に入る）<br><br>".
               "2類 残り".$rui2."(最低必要単位数18単位*過剰分は3類に入る)<br><br>".
               "3類 残り".$rui3."(最低必要単位数52単位*過剰分は7類に入る)<br><br>".
               "4類 残り0（最低必要単位数0単位*7類に入る）<br><br>".
               "5類 残り0（最低必要単位数0単位*7類に入る）<br><br>".
               "6類A群　残り".$rui6a."(最低必要単位数8単位*過剰分は7類に入る)<br><br>".
               "6類B群　残り".$rui6b."(最低必要単位数8単位*過剰分は7類に入る)<br><br>".
               "7類　残り".$rui7;
          }
        }
      }
    if($_POST["faculty"]=="lawpoli")
     {$sql='SELECT*FROM lawpoli WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      if(empty($results))
        {$errors["nodate"]="学部・学科が違います。又は登録されていません。";}
      if(!empty($results))
        {foreach($results as $row)
         {if(20-$row["rui1"]-$row["rui2"]>=0){$rui12=20-$row["rui1"]-$row["rui2"];$rui12_7=0;}
          else{$rui12=0;$rui12_7=$row["rui1"]+$row["rui2"]-20;}
          if(14-$row["rui3A"]>=0){$rui3Ak=14-$row["rui3A"];$rui3Ak_7=0;}
          else{$rui3Ak=0;$rui3Ak_7=$row["rui3A"]-14;}
          if(4-$row["rui3B"]>=0){$rui3Bk=4-$row["rui3B"];$rui3Bk_7=0;}
          else{$rui3Bk=0;$rui3Bk_7=$row["rui3B"]-4;}
          if(4-$row["rui3C"]>=0){$rui3Ck=4-$row["rui3C"];$rui3Ck_7=0;}
          else{$rui3Ck=0;$rui3Ck_7=$row["rui3C"]-4;}
          if(4-$row["rui3A"]>=0){$rui3As=4-$row["rui3A"];$rui3As_7=0;}
          else{$rui3As=0;$rui3As_7=$row["rui3A"]-4;}
          if(14-$row["rui3B"]>=0){$rui3Bs=14-$row["rui3B"];$rui3Bs_7=0;}
          else{$rui3Bs=0;$rui3Bs_7=$row["rui3B"]-14;}
          if(4-$row["rui3C"]>=0){$rui3Cs=4-$row["rui3C"];$rui3Cs_7=0;}
          else{$rui3Cs=0;$rui3Cs_7=$row["rui3C"]-4;}
          if(4-$row["rui3A"]>=0){$rui3Ar=4-$row["rui3A"];$rui3Ar_7=0;}
          else{$rui3Ar=0;$rui3Ar_7=$row["rui3A"]-4;}
          if(4-$row["rui3B"]>=0){$rui3Br=4-$row["rui3B"];$rui3Br_7=0;}
          else{$rui3Br=0;$rui3Br_7=$row["rui3B"]-4;}
          if(14-$row["rui3C"]>=0){$rui3Cr=14-$row["rui3C"];$rui3Cr_7=0;}
          else{$rui3Cr=0;$rui3Cr_7=$row["rui3C"]-14;}
          if(8-$row["rui6a"]>=0){$rui6a=8-$row["rui6a"];$rui6a_7=0;}
          else{$rui6a=0;$rui6a_7=$row["rui6a"]-8;}
          if(8-$row["rui6b"]>=0){$rui6b=8-$row["rui6b"];$rui6b_7=0;}
          else{$rui6b=0;$rui6b_7=$row["rui6b"]-8;}
          if(42-$row["rui7"]-$rui12_7-$rui3Ak_7-$rui3Bk_7-$rui3Ck_7>=0){$rui7k=42-$row["rui7"]-$rui12_7-$rui3Ak_7-$rui3Bk_7-$rui3Ck_7;}
          else{$rui7k=0;}
          if(42-$row["rui7"]-$rui12_7-$rui3As_7-$rui3Bs_7-$rui3Cs_7>=0){$rui7s=42-$row["rui7"]-$rui12_7-$rui3As_7-$rui3Bs_7-$rui3Cs_7;}
          else{$rui7s=0;}
          if(42-$row["rui7"]-$rui12_7-$rui3Ar_7-$rui3Br_7-$rui3Cr_7>=0){$rui7r=42-$row["rui7"]-$rui12_7-$rui3Ar_7-$rui3Br_7-$rui3Cr_7;}
          else{$rui7r=0;}
          
          
          echo "卒業に必要な単位は以下の通りです<br><br>".
               "1類+2類 残り".$rui12."（最低必要単位数0単位(1類２類合計で）*過剰分は7類に入る）<br><br>".
               "__国際関係コースの場合___"."<br>".
               "3類A群 残り".$rui3Ak."(最低必要単位数14*過剰分は7類)<br><br>".
               "3類B群 残り".$rui3Bk."(最低必要単位数4*過剰分は7類)<br><br>".
               "3類C群 残り".$rui3Ck."(最低必要単位数4*過剰分は7類)<br><br>".
               "__現代政治コースの場合___"."<br>".
               "3類A群 残り".$rui3As."(最低必要単位数4*過剰分は7類)<br><br>".
               "3類B群 残り".$rui3Bs."(最低必要単位数14*過剰分は7類)<br><br>".
               "3類C群 残り".$rui3Cs."(最低必要単位数4*過剰分は7類)<br><br>".
               "__歴史思想コースの場合___"."<br>".
               "3類A群 残り".$rui3Ar."(最低必要単位数4*過剰分は7類)<br><br>".
               "3類B群 残り".$rui3Br."(最低必要単位数14*過剰分は7類)<br><br>".
               "3類C群 残り".$rui3Cr."(最低必要単位数4*過剰分は7類)<br><br>".
               "4類 残り0（最低必要単位数0単位*7類に入る）<br><br>".
               "5類 残り0（最低必要単位数0単位*7類に入る）<br><br>".
               "6類A群　残り".$rui6a."(最低必要単位数8*過剰分は7類)<br><br>".
               "6類B群　残り".$rui6b."(最低必要単位数8*過剰分は7類)<br><br>".
               "__国際関係コースの場合___"."<br>".
               "7類　残り".$rui7k."<br><br>".
               "__現代政治コースの場合___"."<br>".
               "7類　残り".$rui7s."<br><br>".
               "__歴史思想コースの場合___"."<br>".
               "7類　残り".$rui7r."<br>";
          }
        }
      } 
    if($_POST["faculty"]=="god")
      {$sql='SELECT*FROM god WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      if(empty($results))
        {$errors["nodate"]="学部・学科が違います。又は登録されていません。";}
      if(!empty($results))
        {foreach($results as $row)
         {if(2-$row["ruir"]>=0){$ruir=2-$row["ruir"];}
          else{$ruir=0;}
          if(68-$row["rui1"]>=0){$rui1=68-$row["rui1"];}
          else{$rui1=0;}
          if(6-$row["rui2"]>=0){$rui2=6-$row["rui2"];}
          else{$rui2=0;}
          if(8-$row["rui3"]>=0){$rui3=8-$row["rui3"];}
          else{$rui3=0;}
          if(36-$row["rui4"]-$row["rui5"]-$row["rui6"]>=0){$rui456=36-$row["rui4"]-$row["rui5"]-$row["rui6"];}
          else{$rui456=0;}
          if($ruit=124-$row["ruir"]-$row["rui1"]-$row["rui2"]-$row["rui3"]-$row["rui4"]-$row["rui5"]-$row["rui6"]>=0)
            {$ruit=124-$row["ruir"]-$row["rui1"]-$row["rui2"]-$row["rui3"]-$row["rui4"]-$row["rui5"]-$row["rui6"]>=0;}
          else{$ruit=0;}
          
          echo "卒業に必要な単位は以下の通りです<br><br>".
               "必修 残り".$ruir."（最低必要単位数2単位）<br><br>".
               "1類 残り".$rui1."（最低必要単位数68単位）<br><br>".
               "2類 残り".$rui2."(最低必要単位数6単位)<br><br>".
               "3類 残り".$rui3."(最低必要単位数8単位)<br><br>".
               "4類+5類+6類 残り".$rui456."（最低必要単位数36単位）<br><br>".
               "4類+5類+6類 残り".$rui456."（最低必要単位数36単位）<br><br>".
               "合計　残り".$ruit."（最低必要単位数124単位）";
          }
        }
      }
    if($_POST["faculty"]=="English")
      {$sql='SELECT*FROM English WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      if(empty($results))
        {$errors["nodate"]="学部・学科が違います。又は登録されていません。";}
      if(!empty($results))
        {foreach($results as $row)
         {if(60-$row["ruir"]>=0){$ruir=60-$row["ruir"];}
          else{$ruir=0;}
          if(4-$row["rui1B"]>=0){$rui1BB=4-$row["rui1B"];}
          else{$rui1BB=4;}
          if(6-$row["rui1A"]-$rui1BB>=0){$rui1AB=6-$row["rui1B"];$rui1ABt=0;}
          else{$rui1AB=0;$rui1ABt=$row["rui1A"]+$rui1BB-6;}
          if(2-$row["rui1B"]>=0){$rui1B=2-$row["rui1B"];}
          else{$rui1B=0;}
          if(4-$row["rui1D"]>=0){$rui1D=4-$row["rui1D"];}
          else{$rui1D=0;}
          if(4-$row["rui1E"]>=0){$rui1E=4-$row["rui1E"];}
          else{$rui1E=0;}
          if(18-$row["rui1C"]-$row["rui1D"]-$row["rui1E"]>=0){$rui1CDE=18-$row["rui1C"]-$row["rui1D"]-$row["rui1E"];$rui1CDEt=0;}
          else{$rui1CDE=0;$rui1CDEt=$row["rui1C"]+$row["rui1D"]+$row["rui1E"]-18;}
          if(8-$row["rui2G"]>=0){$rui2G=4-$row["rui2G"];}
          else{$rui2G=0;}
          if(64-$rui1ABt-$rui1CDEt>=0){$ruit=64-$rui1ABt-$rui1CDEt;}
          else{$ruit=0;}
          
          echo "卒業に必要な単位は以下の通りです<br><br>".
               "必修 残り".$ruir."（最低必要単位数2単位）<br><br>".
               "1類A群 残り0". "（最低必要単位数なし）<br><br>".
               "1類B群 残り".$rui1B."（最低必要単位数2単位）<br><br>".
               "1類A群+1類B群 残り".$rui1AB."（最低必要単位数6単位,B群は4単位までしか入りません）<br><br>".
               "1類C群 残り0" ."(最低必要単位数なし)<br><br>".
               "1類D群 残り".$rui1D. "(最低必要単位数4単位)<br><br>".
               "1類E群 残り".$rui1E. "(最低必要単位数4単位)<br><br>".
               "1類C群+1類D群+1類E群 残り".$rui1CDE. "(最低必要単位数4単位)<br><br>".
               "1類F群 残り0" ."(最低必要単位数なし)<br><br>".
               "2類外国語科目 残り".$rui2G. "(最低必要単位数8単位)<br><br>".
               "2類外国語以外 残り0". "(最低必要単位数なし)<br><br>".
               "1類+2類 残り".$ruit."（最低必要単位数64単位）<br><br>";
          }
        }
       }
    //国文の場合
    if($_POST["faculty"]=="Japanese")
      {$sql='SELECT*FROM Japanese WHERE mail=:mail';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
      $stmt->execute();
      $results=$stmt->fetchAll();
      if(empty($results))
        {$errors["nodate"]="学部・学科が違います。又は登録されていません。";}
         if(!empty($results))
           {foreach($results as $row)
           {if(28-$row["ruir"]>=0){$ruir=28-$row["ruir"];}
            else{$ruir=0;}
            if(14-$row["rui1A"]>=0){$rui1A=14-$row["rui1A"];}
            else{$rui1A=0;}
            if(10-$row["rui1B"]>=0){$rui1B=10-$row["rui1B"];}
            else{$rui1B=0;}
            if(12-$row["rui1C"]>=0){$rui1D=12-$row["rui1C"];}
            else{$rui1C=0;}
            if(4-$row["rui2P"]>=0){$rui2P=4-$row["rui2P"];}
            else{$rui2P=0;}
            if(96-$row["rui1A"]-$row["rui1B"]-$row["rui1C"]-$row["rui2P"]-$row["rui2"]>=0){$rui12=96-$row["rui1A"]-$row["rui1B"]-$row["rui1C"]-$row["rui2P"]-$row["rui2"];}
            else{$rui12=0;}
            if(4-$row["rui3E"]>=0){$rui3E=4-$row["rui3E"];}
            else{$rui3E=0;}
            if(8-$row["rui3E"]-$row["rui3"]>=0){$rui3t=8-$row["rui3E"]-$row["rui3"];}
            else{$rui3t=0;}
          
            echo "卒業に必要な単位は以下の通りです<br><br>".
                 "必修 残り".$ruir."（最低必要単位数28単位）<br><br>".
                 "1類A群 残り".$rui1A."（最低必要単位数14単位）<br><br>".
                 "1類B群 残り".$rui1B."（最低必要単位数10単位）<br><br>".
                 "1類C群 残り0" ."(最低必要単位数なし)<br><br>".
                 "2類保健体育 残り".$rui2P. "(最低必要単位数4単位)<br><br>".
                 "2類保健体育以外 残り0". "(最低必要単位数なし)<br><br>".
                 "1類+2類　残り".$rui12. "(最低必要単位数96単位)<br><br>".
                 "3類 英語 残り".$rui3E."(最低必要単位数4単位)<br><br>".
                 "3類 英語以外 残り0". "(最低必要単位数なし)<br><br>".
                 "3類合計 残り".$rui3t. "(最低必要単位数8単位)<br><br>";
           }
           }
        } 
   }
//エラーがあった場合
if(isset($errors)){foreach($errors as $error){echo $error;};}

?>
<?php if(!isset($results)) :?>
<form method="POST", action=<?php $_SERVER["SCRIPT_NAME"]?>>
   <select name="faculty" required>
   <option value="">登録した学部・学科を選択してください</option>
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
   <input type="submit" name="submit1" value="次へ">
  </select>
</form>
<?php endif?>
<?php if(isset($results)) : ?>
<br><a href="http://tech-base.net/tb-230168/mission6/mission6_login2.php">ホームに戻る</a>
<?php endif ?>
</body>
</html>