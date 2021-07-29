<?php
// ログインメンバー用おさかな一覧
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

// 参照する
include('../functions.php');

// DB接続情報
$pdo = connect_to_db();
// echo ('ok');

// table結合したい
// 全部結合ver.
// $sql = 'SELECT * FROM fish_list LEFT OUTER JOIN users_table ON fish_list.created_user_id = users_table.id';
// username部分だけ結合ver.
$sql = 'SELECT fish_list.*, username FROM fish_list LEFT OUTER JOIN users_table ON fish_list.created_user_id = users_table.id';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo(); // 失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // var_dump($result[0]['todo']);
    // var_dump($result);
    // echo '</pre>';
    // exit();

    $output = "";
    foreach ($result as $record) {
        $output .= "<div class='card shadow-sm'>";
        $output .= "<img class='card-img-top' src='{$record["image"]}' alt=''>";
        $output .= "<div class='card-body'><strong>{$record["title"]}</strong><br><p class='card-text'>{$record["detail"]}<br>受け渡し場所:{$record["place"]}<br>申込期限:{$record["deadline"]}<br>投稿者:{$record["username"]}</p></div>";
        $output .= "<div class='card-footer'>";
        $output .= "<div class='btn-group'>";
        $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'>詳細</button>";
        // $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'><a href='give_edit.php?id={$record["id"]}'>編集</a></button>";
        $output .= "</div>";
        $output .= "<small class='text-muted'>投稿日時:{$record["updated_at"]}</small>";
        $output .= "</div>";
        $output .= "</div>";
    }
    //print($output);
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインメンバー用おさかな一覧</title>
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap.css" rel="stylesheet">

</head>

<body>
    <h1>🐟🛥おさかな一覧🐟🛥</h1>
    <p>（ログインメンバー用一覧表示画面）</p>

    <div class="card-columns">

        <?= $output ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="../bootstrap.bundle.js"></script>
</body>

</html>