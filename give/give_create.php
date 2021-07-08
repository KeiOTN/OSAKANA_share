<?php
// var_dump($_POST);
// exit();

// エラー検索
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

// 参照する
include('../functions.php');

if (
    !isset($_POST['title']) || $_POST['title'] == '' ||
    !isset($_POST['detail']) || $_POST['detail'] == '' ||
    !isset($_POST['place']) || $_POST['place'] == '' ||
    !isset($_POST['deadline']) || $_POST['deadline'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$title = $_POST['title'];
$detail = $_POST['detail'];
$place = $_POST['place'];
$deadline = $_POST['deadline'];
$created_user_id = $_POST['created_user_id'];

// DB接続
$pdo = connect_to_db();
// echo ('ok');

$sql = 'INSERT INTO fish_list(id, title, detail, place, deadline, created_at, updated_at, created_user_id) VALUES(NULL, :title, :detail, :place, :deadline, sysdate(), sysdate(), :created_user_id)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
$stmt->bindValue(':place', $place, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':created_user_id', $created_user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:give_read.php");
    exit();
}
