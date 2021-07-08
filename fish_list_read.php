<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);


// DB接続情報
$dbn = 'mysql:dbname=tabitoto;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = ''; // 空文字


// DB接続
try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

// 参照はSELECT文!
$sql = 'SELECT * FROM event_list';
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
    //var_dump($result);
    // echo '</pre>';
    // exit();
    $output = "";
    foreach ($result as $record) {
        $output .= "<div class='event_each'>";
        $output .= "<h1>{$record["event_name"]}</h1>";
        $output .= "<p>{$record["event_detail"]}</p><br>";
        $output .= "<p>カテゴリー:{$record["event_category"]}</p>";
        $output .= "<p>開催地:{$record["pref"]}</p>";
        $output .= "<p>{$record["city"]}</p>";
        $output .= "<p>オンライン:{$record["remote_or_not"]}</p>";
        $output .= "<p>募集人数:{$record["how_many"]}人</p>";
        $output .= "<p>所要時間:{$record["how_long"]}時間</p>";
        $output .= "<p>料金(大人):{$record["how_much_adult"]}円</p>";
        $output .= "<p>申込期限:{$record["limit_date"]}</p>";
        $output .= "<p>{$record["limit_time"]}</p>";
        $output .= "<p>最小遂行人数:{$record["min_person"]}</p>";
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
    <title>おさかな一覧(管理用)</title>

</head>

<body>
    <div>
        <div>おさかな一覧(管理用)</div>
        <a href="give_input.php">おさかな登録画面</a>


        <div class="fish_all_list">
            <?= $output ?>
        </div>
</body>

</html>