<?php
// 会員ページ
session_start();
include('functions.php');
check_session_id();
include("header_and_footer/header.php");
include("header_and_footer/footer.php");
$pdo = connect_to_db();

// 参照はSELECT文!
// 初期値
// $sql = 'SELECT * FROM fish_list';
// JOIN
$sql = 'SELECT * FROM fish_list LEFT OUTER JOIN (SELECT fish_id, COUNT(id) AS cnt FROM like_table GROUP BY fish_id) AS likes ON fish_list.id = likes.fish_id';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// $statusにSQLの実行結果が入る(取得したデータではない点に注意)

// いいねボタン用
$username = $_SESSION["username"];
$user_id = $_SESSION['user_id'];

//  データを表示しやすいようにまとめる
if ($status == false) {
    $error = $stmt->errorInfo(); // 失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll()で全部取れる! あとは配列で処理!!

    $output = "";
    foreach ($result as $record) {
        $output .= "<div class='card shadow-sm'>";
        $output .= "<img class='card-img-top' src='give/{$record["image"]}' alt=''>";
        $output .= "<div class='card-body'><strong>{$record["title"]}</strong><br><p class='card-text'>{$record["detail"]}<br>受け渡し場所:{$record["place"]}<br>申込期限:{$record["deadline"]}</p></div>";
        $output .= "<div class='card-footer'>";
        $output .= "<div class='btn-group'>";
        $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'><a href='give/give_detail.php?fish_id={$record["id"]}'>詳細</button>";
        $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'><a href='like/like_create.php?user_id=$user_id&fish_id={$record["id"]}'>❤️{$record["cnt"]}</a></button>";
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
                <a href="users/user_all.php" class="btn btn-secondary my-2">登録メンバー一覧を見る</a>
            </p>
        </div>
    </section>

    <div class="card-columns">

        <?= $output ?>

    </div>

</main>
<?= $footer ?>