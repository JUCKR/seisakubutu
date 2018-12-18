<?php
//接続
$dsn='http://github.com/JUCKR/seisakubutu';
$user='JUCKR';
$password='ryo19980313';
$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

//テーブル作成
$sql="CREATE TABLE IF NOT EXISTS MISSIONTEST"
."("
."id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,"
."name char(32),"
."comment TEXT,"
."date DATE,"
."datetime DATETIME,"
."password1 char(30)"
.");";
$stmt=$pdo->query($sql);
//テーブル作成終了
?>