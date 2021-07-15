<?php
// 会員ページ/ユーザー一覧
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
include('../functions.php');
check_session_id();
include("../header_and_footer/header.php");
include("../header_and_footer/footer.php");
$pdo = connect_to_db();

$username = $_SESSION["username"];
$user_id = $_SESSION['user_id'];

// 参照はSELECT文!
$sql = 'SELECT * FROM users_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "";
    foreach ($result as $record) {

        // 自分のアカウントとadminはskip
        if ($username == $record["username"] || $record["is_admin"] == 1) {
            continue;
        }


        $output .= "<div class='card shadow-sm'>";
        $output .= "<img class='card-img-top' src='../img/fisherman.jpeg' alt=''>";
        $output .= "<div class='card-body'><strong>{$record["username"]}</strong><br><p class='card-text'><br>主な釣行エリア:<br>主な受け渡し場所:</p></div>";
        $output .= "<div class='card-footer'>";
        $output .= "<div class='btn-group'>";
        $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'>詳細</button>";
        $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'><a href='../friends/request_create.php?from_id=$user_id&to_id={$record["id"]}'>友達申請</a></button>";
        $output .= "</div>";
        $output .= "<small class='text-muted'>登録日:{$record["created_at"]}</small>";
        $output .= "</div>";
        $output .= "</div>";
    }
}





?>

<?= $header ?>
<main role="main">

    <small><?= $username ?>でログイン中</small>

    <div class="card-columns">

        <?= $output ?>

    </div>

</main>

<?= $footer ?>