<?php
// 管理者用おさかな一覧
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

// 参照する
include('../functions.php');

// DB接続情報
$pdo = connect_to_db();
// echo ('ok');


// 参照はSELECT文!
$sql = 'SELECT * FROM fish_list';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// $statusにSQLの実行結果が入る(取得したデータではない点に注意)

//  データを表示しやすいようにまとめる
if ($status == false) {
    $error = $stmt->errorInfo(); // 失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll()で全部取れる! あとは配列で処理!!
    // echo '<pre>';
    // var_dump($result[0]['todo']);
    // var_dump($result);
    // echo '</pre>';
    // exit();

    $output = "";
    foreach ($result as $record) {
        $output .= "<div class='card shadow-sm'>";
        $output .= "<img class='card-img-top' src='../fish/kijihata.jpeg' alt=''>";
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
    //print($output);
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
    <p>（管理者用一覧表示画面）</p>

    <div class="card-columns">

        <?= $output ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="../bootstrap.bundle.js"></script>
</body>

</html>