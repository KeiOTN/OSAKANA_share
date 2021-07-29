<?php
// var_dump($_FILES['upfile']);
// echo '<pre>';
// var_dump($_FILES);
// echo '<pre>';
// exit();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
include("../functions.php");
check_session_id();

$pdo = connect_to_db();

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

// ここからファイルアップロード&DB登録の処理を追加しよう！！！
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $uploaded_file_name = $_FILES['image']['name']; //ファイル名の取得
    $temp_path = $_FILES['image']['tmp_name']; //tmpフォルダの場所
    $directory_path = 'profile_image/'; //アップロード先フォルダ(↑自分で決める,作る,macは権限変更する)
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
            // $sql = 'INSERT INTO users_list(id, title, detail, place, deadline, image, created_at, updated_at, created_user_id) VALUES(NULL, :title, :detail, :place, :deadline, :image, sysdate(), sysdate(), :created_user_id)';
            $sql = "UPDATE users_table SET username=:username, email=:email, password=:password, Image=:image, comment=:comment, updated_at=sysdate() WHERE id=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->bindValue(':image', $filename_to_save, PDO::PARAM_STR);
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
        } else {
            exit('Error:アップロードできませんでした'); // 画像の保存に失敗 
        }
    } else {
        exit('Error:画像がありません'); // tmpフォルダにデータがない 
    }
} else {
    exit('Error:画像が送信されていません');
    // new code
    $sql = "UPDATE users_table SET username=:username, email=:email, password=:password, comment=:comment, updated_at=sysdate() WHERE id=:id";
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
}
