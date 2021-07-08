<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

include("../functions.php");

// 入力チェック
if (
    !isset($_POST['username']) || $_POST['username'] == '' ||
    !isset($_POST['email']) || $_POST['email'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == ''
) {
    exit('ParamError');
}

// データを変数に格納
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


// DB接続
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'INSERT INTO
users_table(id, username, email, password, created_at, updated_at) VALUES(NULL, :username, :email, :password, sysdate(), sysdate())';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute(); // SQLを実行
// exit('ok');


// 失敗時にエラーを出力し，成功時は会員画面に移る
if ($status == false) {
    $error = $stmt->errorInfo(); // データ登録失敗時にエラーを表示 
    exit('sqlError:' . $error[2]);
} else {
    // 登録ページへ移動
    // $alert = "<script type='text/javascript'>alert('登録が完了しました');</script>";
    // echo $alert;
    header('Location:../index_member.php');
}
