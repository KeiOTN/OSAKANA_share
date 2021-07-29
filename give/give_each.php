<?php
// ログイン中ユーザー用おさかな一覧（自分が出品したものだけ）
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();

// 参照する
include('../functions.php');
check_session_id();

// var_dump($_SESSION["user_id"]);
// exit();

// $_SESSION["user_id"]=$record["created_user_id"]のデータだけ取り出したい
// DB接続&id名でテーブルから検索
$created_user_id = $_SESSION["user_id"];
$pdo = connect_to_db();
$sql = 'SELECT * FROM fish_list WHERE created_user_id=:created_user_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':created_user_id', $created_user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // var_dump($result);
    // echo '<pre>';

    //  データを表示しやすいようにまとめる
    $output = "";
    foreach ($result as $record) {
        $output .= "<div class='card shadow-sm'>";
        $output .= "<img class='card-img-top' src='{$record["image"]}' alt=''>";
        $output .= "<div class='card-body'><strong>{$record["title"]}</strong><br><p class='card-text'>{$record["detail"]}<br>受け渡し場所:{$record["place"]}<br>申込期限:{$record["deadline"]}</p></div>";
        $output .= "<div class='card-footer'>";
        $output .= "<div class='btn-group'>";
        $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'>詳細</button>";
        $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'><a href='give_edit.php?id={$record["id"]}'>編集</a></button>";
        $output .= "</div>";
        $output .= "<small class='text-muted'>投稿日時:{$record["updated_at"]}</small>";
        $output .= "</div>";
        $output .= "</div>";
    }
    // print($output);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>おさかな一覧</title>
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap.css" rel="stylesheet">

</head>

<body>
    <h1>🐟🛥おさかな一覧🐟🛥</h1>
    <p>（<?= $_SESSION["username"] ?>さんの個人投稿一覧）</p>

    <div class="card-columns">

        <?= $output ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="../bootstrap.bundle.js"></script>
</body>

</html>