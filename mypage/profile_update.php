<?php
// echo '<pre>';
// var_dump($_POST);
// echo '<pre>';
// exit();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

include('../functions.php');

if (
    !isset($_POST['id']) || $_POST['id'] == '' ||
    !isset($_POST['username']) || $_POST['username'] == '' ||
    !isset($_POST['email']) || $_POST['email'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$comment = $_POST['comment'];

$pdo = connect_to_db();

$sql = "UPDATE users_table SET username=:username, email=:mail, password=:password, comment=:comment, updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);

$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:http://localhost/DEV8/album/mypage/profile_each.php");
    exit();
}
