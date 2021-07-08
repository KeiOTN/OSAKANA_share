<?php
// var_dump($_GET);
// exit();

include('../functions.php');
$pdo = connect_to_db();

// idをgetで受け取る
$id = $_GET['id'];

// idを指定して更新するSQLを作成 -> 実行の処理
$sql = 'DELETE FROM fish_list WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
// 一覧画面にリダイレクト
header('Location:give_read.php');
