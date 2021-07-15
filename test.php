<?php
// 管理者用おさかな一覧 作成者名取得myadminテスト
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

// 参照する
include('functions.php');
include("header_and_footer/header.php");
include("header_and_footer/footer.php");
// DB接続情報
$pdo = connect_to_db();
// echo ('ok');

// table結合したい
$sql = 'SELECT * FROM fish_list LEFT OUTER JOIN users_table ON fish_list.created_user_id = users_table.id';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo(); // 失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // var_dump($result);
    // echo '<pre>';
    $output = "";
    foreach ($result as $record) {
        $output .= "<div class='card shadow-sm'>";
        $output .= "<img class='card-img-top' src='fish/kijihata.jpeg' alt=''>";
        $output .= "<div class='card-body'><strong>{$record["title"]}</strong><br><p class='card-text'>{$record["detail"]}<br>受け渡し場所:{$record["place"]}<br>申込期限:{$record["deadline"]}<br>投稿者:{$record["username"]}</p></div>";
        $output .= "<div class='card-footer'>";
        $output .= "<div class='btn-group'>";
        $output .= "<button type='button' class='btn btn-sm btn-outline-secondary' href='#'>詳細</button>";
        $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'>❤️</button>";
        $output .= "</div>";
        $output .= "<small class='text-muted'>投稿日時:{$record["updated_at"]}</small>";
        $output .= "</div>";
        $output .= "</div>";
    }
}
?>
<?= $header ?>
<main role="main">

    <section class="jumbotron text-center top-img" id="top-img">
        <div class="container">
            <small><?= $username ?>でログイン中</small>
            <h1>おさかなシェア</h1>
            <p class="lead text-muted"><br>たくさん釣れた魚、シェアしたい。<br><br>持ち帰るのも困るほど大漁だった日は、<br>おさかなシェアで魚を貰ってくれる人を見つけましょう。</p>
            <p>
                <a href="give/give_input.php" class="btn btn-primary my-2">魚の貰い手を募集する</a><br>
                <a href="give/give_read.php" class="btn btn-secondary my-2">魚一覧を見る</a>
            </p>
        </div>
    </section>

    <div class="card-columns">

        <?= $output ?>

    </div>

</main>
<?= $footer ?>