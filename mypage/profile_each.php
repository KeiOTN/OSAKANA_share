<?php
// 個人のプロフィール画面
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);
session_start();

// 参照する
include('../functions.php');
check_session_id();
// var_dump($_SESSION);
// exit();

// DB接続&id名でテーブルから検索
$id = $_SESSION["user_id"];
$pdo = connect_to_db();
$sql = 'SELECT * FROM users_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($result);
    // exit();
    $output .= "<div class='card shadow-sm'>";
    if ($result["Image"] !== NULL) {
        $output .= "<img class='card-img-top' src='{$result["Image"]}' alt=''>";
    } else {
        $output .= "<img class='card-img-top' src='../img/fisherman.jpeg' alt=''>";
    }
    $output .= "<div class='card-body'>ユーザーネーム:<strong>{$result["username"]}</strong><br><p class='card-text'>email:{$result["email"]}<br>password:{$result["password"]}<br>プロフィール:{$result["comment"]}</p></div>";
    $output .= "<div class='card-footer'>";
    $output .= "<div class='btn-group'>";
    $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'><a href='profile_edit.php?id={$result["id"]}'>編集</a></button>";
    $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'><a href='mypage_top.php'>戻る</a></button>";
    $output .= "</div>";
    // $output .= "<small class='text-muted'>投稿日時:{$record["updated_at"]}</small>";
    $output .= "</div>";
    $output .= "</div>";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイプロフィール</title>
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap.css" rel="stylesheet">

</head>

<body>
    <p>マイプロフィール</p>

    <div class="card-columns">

        <?= $output ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="../bootstrap.bundle.js"></script>
</body>

</html>