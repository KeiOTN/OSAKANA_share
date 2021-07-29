<?php
echo '<pre>';
var_dump($_FILES);
echo '<pre>';
exit();
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
include("../functions.php");
check_session_id();

$pdo = connect_to_db();

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

// ここからファイルアップロード&DB登録の処理を追加しよう！！！
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
    $uploaded_file_name = $_FILES['upfile']['name']; //ファイル名の取得
    $temp_path = $_FILES['upfile']['tmp_name']; //tmpフォルダの場所
    $directory_path = 'upload/'; //アップロード先フォルダ(↑自分で決める,作る,macは権限変更する)
    // ファイル名の準備
    $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
    $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
    $filename_to_save = $directory_path . $unique_name;
    // var_dump($filename_to_save);
    // exit();
    if (is_uploaded_file($temp_path)) {
        if (move_uploaded_file($temp_path, $filename_to_save)) {
            chmod($filename_to_save, 0644); // 権限の変更 
            // $img = '<img src="' . $filename_to_save . '" >'; // imgタグを設定
            // var_dump($img);
            // exit();

            // new code
            $sql = 'INSERT INTO fish_list(id, title, detail, place, deadline, image, created_at, updated_at, created_user_id) VALUES(NULL, :title, :detail, :place, :deadline, :image, sysdate(), sysdate(), :created_user_id)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
            $stmt->bindValue(':place', $place, PDO::PARAM_STR);
            $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
            $stmt->bindValue(':image', $filename_to_save, PDO::PARAM_STR);
            $stmt->bindValue(':created_user_id', $created_user_id, PDO::PARAM_INT);
            $status = $stmt->execute();

            // sample code
            // $sql = 'INSERT INTO todo_table(id, todo, deadline, image, created_at, updated_at) VALUES(NULL, :todo, :deadline, :image, sysdate(), sysdate())';
            // $stmt = $pdo->prepare($sql);
            // $stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
            // $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
            // $stmt->bindValue(':image', $filename_to_save, PDO::PARAM_STR);
            // $status = $stmt->execute();

            if ($status == false) {
                $error = $stmt->errorInfo();
                echo json_encode(["error_msg" => "{$error[2]}"]);
                exit();
            } else {
                header("Location:give_all.php");
                exit();
            }
        } else {
            exit('Error:アップロードできませんでした'); // 画像の保存に失敗 
        }
    } else {
        exit('Error:画像がありません'); // tmpフォルダにデータがない 
    }
} else {
    exit('Error:画像が送信されていません');
    // new code
    $sql = 'INSERT INTO fish_list(id, title, detail, place, deadline, created_at, updated_at, created_user_id) VALUES(NULL, :title, :detail, :place, :deadline, sysdate(), sysdate(), :created_user_id)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
    $stmt->bindValue(':place', $place, PDO::PARAM_STR);
    $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
    $stmt->bindValue(':created_user_id', $created_user_id, PDO::PARAM_INT);
    $status = $stmt->execute();

    // sample code
    // $sql = 'INSERT INTO todo_table(id, todo, deadline, created_at, updated_at) VALUES(NULL, :todo, :deadline, sysdate(), sysdate())';
    // $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
    // $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
    // $status = $stmt->execute();

    if ($status == false) {
        $error = $stmt->errorInfo();
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
    } else {
        header("Location:give_all.php");
        exit();
    }
}
