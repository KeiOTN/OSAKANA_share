<?php
// var_dump($_GET);
// exit();
// いいね！実装
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

include('../functions.php');


$from_id = $_GET['from_id'];
$to_id = $_GET['to_id'];

$pdo = connect_to_db();

//SQL作成 
$sql = 'INSERT INTO friends_table(id, from_id, to_id, request, accept, requested_at, accepted_at) VALUES(NULL, :from_id, :to_id, 1, NULL, sysdate(), NULL)';

// SQL実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':from_id', $from_id, PDO::PARAM_INT);
$stmt->bindValue(':to_id', $to_id, PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:../users/user_all.php");
    exit();
}

// $sql = 'SELECT COUNT(*) FROM friends_table WHERE from_id=:from_id AND to_id=:to_id';

// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
// $stmt->bindValue(':fish_id', $fish_id, PDO::PARAM_INT);
// $status = $stmt->execute();
// if ($status == false) {
//     $error = $stmt->errorInfo();
//     echo json_encode(["error_msg" => "{$error[2]}"]);
//     exit();
// } else {
//     $like_count = $stmt->fetch();
//     // var_dump($like_count[0]);
//     // exit();
//     if ($like_count[0] != 0) {
//         $sql = 'DELETE FROM like_table WHERE user_id=:user_id AND fish_id=:fish_id';
//     } else {
//         $sql = 'INSERT INTO like_table(id, user_id, fish_id, created_at)VALUES(NULL, :user_id, :fish_id, sysdate())';
//     }
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
//     $stmt->bindValue(':fish_id', $fish_id, PDO::PARAM_INT);
//     $status = $stmt->execute();
//     if ($status == false) {
//         $error = $stmt->errorInfo();
//         echo json_encode(["error_msg" => "{$error[2]}"]);
//         exit();
//     } else {
//         header("Location:../index_member.php");
//         exit();
//     }
// }