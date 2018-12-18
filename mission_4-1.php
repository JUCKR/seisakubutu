<?php
//接続
$dsn='http://github.com/JUCKR/seisakubutu';
$user='JUCKR';
$password='ryo19980313';
$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));



$sql='SELECT * FROM MISSIONTEST';
$stmt=$pdo->query($sql);
$content=$stmt->fetchAll();
//ループ処理
foreach($content as $data){
//編集機能
	//編集番号とIDが同じとき
	if($_POST["hensyuu"]==$data['id']){
		//パスワードが同じとき
		if($_POST["password3"]==$data['password1']){
		$data1=$data['name'];
		$data2=$data['comment'];
		$data0=$data['id'];
		}
		//パスワードが違うとき
		else if($_POST["password3"]!=$data['password1']){
		$miss="パスワードが違います";
		}
	}//編集番号とIDが同じとき終了
//編集機能終了

//削除機能
	//削除番号とIDが同じとき
	if($_POST["sakujo"]==$data['id']){
		//パスワードが違うとき
		if($_POST["password2"]!=$data['password1']){
		$miss="パスワードが違います";
		}
	}//削除番号とIDが同じとき終了
//削除機能終了

}//ループ処理終了

echo $miss;//パスワードが違うとき表示
?>
<html>
<head>
<title>mission_4</title>
<meta charset="utf-8">
</head>
<body>




<form method="POST" action="mission_4-1.php">

<input type ="text" name="name" placeholder="名前" value=<?php echo $data1 ?>>
<br />
<input type ="text" name="comment" placeholder="コメント" value=<?php echo $data2 ?>>
<br />
<input type ="text" name="password1" placeholder="パスワード">
<input type ="submit" name="btn"value="送信">
<br />
<input type="hidden" name="number" value=<?php echo $data0 ?>>


<br />
<br />

<input type="text" name="sakujo" placeholder="削除対象番号">
<br />
<input type ="text" name="password2" placeholder="パスワード">
<input type="submit" name="btn" value="削除">
<br />
<br />

<input type="text" name="hensyuu" placeholder="編集対象番号">
<br />
<input type ="text" name="password3" placeholder="パスワード">
<input type="submit" name="btn" value="編集">
</form>
</body>
</html>


<?php
//接続
$dsn='http://github.com/JUCKR/seisakubutu';
$user='JUCKR';
$password='ryo19980313';
$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));




//テーブルにデータ入力
//新規投稿
if(!empty($_POST["name"])&&!empty($_POST["comment"])&&empty($_POST["number"])&&!empty($_POST["password1"])){
//時刻設定
$datetime='SELECT NOW()';
$sql=$pdo->prepare("INSERT INTO MISSIONTEST(name,comment,datetime,password1)VALUES(:name,:comment,NOW(),:password1)");
$sql->bindParam(':name',$name,PDO::PARAM_STR);
$sql->bindParam(':comment',$comment,PDO::PARAM_STR);
$sql->bindParam(':password1',$password,PDO::PARAM_STR);
$name=$_POST["name"];
$comment=$_POST["comment"];
$password=$_POST["password1"];
$sql->execute();
}//新規投稿終了

//編集実行
//隠し番号が空ではないとき
if(!empty($_POST["number"])){
$sql='SELECT * FROM MISSIONTEST';
$stmt=$pdo->query($sql);
$content=$stmt->fetchAll();
 //ループ処理
 foreach($content as $data){
	//編集番号とIDが同じとき 
	if($_POST["number"]==$data['id']){
		//パスワードが同じとき
		if($_POST["password1"]==$data['password1']){
		$datetime='SELECT NOW';
		$sql='update MISSIONTEST set name=:name,comment=:comment,datetime=NOW() where id=:id';
		$stmt=$pdo->prepare($sql);
		$stmt->bindParam(':name',$name,PDO::PARAM_STR);
		$stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
		$stmt->bindParam(':id',$id,PDO::PARAM_INT);
		$id=$_POST["number"];
		$name=$_POST["name"];
		$comment=$_POST["comment"];
		$stmt->execute();
		}
	}//編集番号とIDが同じとき終了
 }//ループ処理終了
}//編集実行機能終了


//削除実行
//削除番号が空ではないとき
if(!empty($_POST["sakujo"])){
$sql='SELECT * FROM MISSIONTEST';
$stmt=$pdo->query($sql);
$content=$stmt->fetchAll();
 //ループ処理
 foreach($content as $data){
	//削除番号とIDが同じとき
	if($_POST["sakujo"]==$data['id']){
		//パスワードが同じとき
		if($_POST["password2"]==$data['password1']){
		$id=$_POST["sakujo"];
		$sql='delete from MISSIONTEST where id=:id';
		$stmt=$pdo->prepare($sql);
		$stmt->bindParam('id',$id,PDO::PARAM_INT);
		$stmt->execute();
		}
	}//削除番号とIDが同じとき終了
 }//ループ処理終了
}//削除実行機能終了

//データ表示
$sql='SELECT*FROM MISSIONTEST order by id';
$stmt=$pdo->query($sql);
$content=$stmt->fetchAll();
//ループ処理
foreach($content as $data){
	//表示
	echo $data['id'].'　';
	echo $data['name'].'　';
	echo $data['comment'].'　';
	echo $data['datetime'].'<br />';
}
//ループ処理終了
//データ表示終了
?>