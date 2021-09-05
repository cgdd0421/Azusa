<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"  />
</head>
<body>

<?php
//DB接続//
$dsn='データベース名';
$user='ユーザー名';
$pass='パスワード';
$pdo= new PDO($dsn,$user,$pass,
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
              );

//mission5-1テーブル作成//
$sql='CREATE TABLE IF NOT EXISTS mission5_01'
     ."("
     ."id INT AUTO_INCREMENT PRIMARY KEY,"
     ."name char(32),"
     ."comment TEXT,"
     ."password char(32)"
     .");";
$stmt=$pdo->query($sql);

//編集番号の指定//
if(!empty($_POST["num_e"]))
{$sql='SELECT*FROM mission5_01';
$stmt=$pdo->query($sql);
$lines=$stmt->fetchAll();
foreach($lines as $row)
 {if($row['id']==$_POST["num_e"])//指定番号と投稿番号の比較
  {if($row['password']==$_POST["pass_e"] && $row['password']!="")//パスワードが一致した場合
   {echo "編集ができます<br>*パスワードは編集されません*<br>";
    $newname=$row['name']; $newstr=$row['comment'];$edinum=$row['id'];
   ;}//編集したい投稿の表示
 else{echo "パスワードが違います";//パスワードが違った場合
      $newname="名前を入力してください";$newstr="コメント";$edinum=""
     ;}
   }
  }
}
else{$newname="名前を入力してください"; $newstr="コメント";$edinum=""
    ;}//編集しないとき
     
//削除の場合
if(!empty($_POST["num_d"]))
{$sql='SELECT*FROM mission5_01';
 $stmt=$pdo->query($sql);
 $lines=$stmt->fetchAll();
 foreach($lines as $row)
  {if($row['id']==$_POST["num_d"])
    {if($_POST["pass_d"]==$row['password'] && $row['password']!="")
     {echo "削除完了!";
      $id=$_POST["num_d"];
      $sql='DELETE FROM mission5_01 WHERE id=:id';
      $stmt= $pdo->prepare($sql);
      $stmt->bindParam(':id',$id,PDO::PARAM_INT);
      $stmt->execute();
      }
     else{echo "パスワードが違います";} 
    }
  }
}
  
//ファイルへの書き込み
if(!empty($_POST["submit"]))//コメントまたは名前があった場合
  {if(!empty($_POST["edinum"]))//編集の場合
     {$id=$_POST["edinum"];
      $sql='UPDATE mission5_01 SET name=:name, comment=:comment
            WHERE id=:id';
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':name',$_POST["name"],PDO::PARAM_STR);//名前の変更
      $stmt->bindParam(':comment',$_POST["comment"],PDO::PARAM_STR);//コメントの変更
      $stmt->bindParam(':id',$id,PDO::PARAM_INT);
      $stmt->execute();
      echo "編集完了";
      }
    else{$stmt='INSERT INTO mission5_01 (name, comment, password) 
                VALUE (:name,:comment,:password)';
         $stmt=$pdo->prepare($stmt);
         $stmt->bindParam(':name',$_POST["name"],PDO::PARAM_STR);
         $stmt->bindParam(':comment',$_POST["comment"],PDO::PARAM_STR);
         $stmt->bindParam(':password',$_POST["comment"],PDO::PARAM_STR);
         $stmt->execute();
         echo "書き込み完了";
         }
    
  }      






   
      
      
    



?>
   <form method="POST" action="">
     <input type="text" name="name" value=<?= $newname?>>
     <br>
     <input type="text" name="comment" value=<?= $newstr?>> 
     <br>
     <input type="num" name="new_pass" placeholder="パスワード設定">
     <br>
     <input type="hidden" name="edinum" value=<?= $edinum?>>
     <br>
     <input type="submit" name="submit" volume="送信">
     <br>
     <input type="num" name="num_e" placeholder="編集したい投稿番号">
     <input type="num" name="pass_e" placeholder="パスワード">
     <input type="submit" name="submit_num1" value="編集">
     <br>
     <input type="num" name="num_d" placeholder="削除したい投稿番号">
     <input type="num" name="pass_d" placeholder="パスワード">
     <input type="submit" name="submit_num2" value="削除">
   </form>
  </body>
</html>
<?php
//DB接続//
$dsn='mysql:dbname=tb230168db;host=localhost';
$user='tb-230168';
$pass='r2nu3S3hnv';
$pdo= new PDO($dsn,$user,$pass,
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
              );
//投稿の表示//
$sql='SELECT*FROM mission5_01';
$stmt=$pdo->query($sql);
foreach($stmt as $row)
       {echo $row['id']."<br>";
        echo $row['name']."<br>";
        echo $row['comment']."<br>";
        echo "<hr>";
       }
?>

  
  