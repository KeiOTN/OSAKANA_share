<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
include('../functions.php');
check_session_id();
include("../header_and_footer/header.php");
include("../header_and_footer/footer.php");
$pdo = connect_to_db();

// var_dump($_GET);
// exit();

$username = $_SESSION['username'];
$id = $_GET['from_id'];

$sql = 'SELECT * FROM users_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    //     echo '<pre>';
    //     var_dump($record);
    //     echo '<pre>';
    //     exit();

    $output = "";
    $output .= "<div>";
    $output .= "{$record["username"]}さんから友達リクエストが届いています。";

    $output .= "<div class='card shadow-sm w-25'>";
    $output .= "<img class='card-img-top' src='../img/fisherman.jpeg' alt=''>";
    $output .= "<div class='card-body'><strong>{$record["username"]}</strong><br><p class='card-text'><br>主な釣行エリア:<br>主な受け渡し場所:</p></div>";
    $output .= "<div class='card-footer'>";
    $output .= "<div class='btn-group'>";
    $output .= "<button class='btn btn-outline-danger btn-sm my-2'><a href='accept_create.php?user_id={$_GET["user_id"]}&from_id={$_GET["from_id"]}'>承認する</a></button>";
    $output .= "<button class='btn btn-outline-warning btn-sm my-2'><a href='reject_create.php?user_id={$_GET["user_id"]}&from_id={$_GET["from_id"]}'>拒否する</a></button>";
    $output .= "</div>";
    $output .= "<small class='text-muted'>登録日:{$record["created_at"]}</small>";
    $output .= "</div>";
    $output .= "</div>";

    // $output .= "<button class='btn btn-primary btn-sm my-2'>承認する</button><button class='btn btn-warning btn-sm my-2'>拒否する</button>";
    // $output .= "<button class='btn btn-outline-danger btn-sm my-2'><a href='../friends/check_profile.php?user_id=$user_id&from_id={$record["from_id"]}'>プロフィールを確認する</a></button>";
    $output .= "</div>";
}

?>
<?= $header ?>

<body>

    <div>

        <p>
            こちらは<?= $username ?>さんのマイページです。
        </p>

    </div>

    <div>
        <?= $output ?>
        <!-- <button class="btn btn-primary btn-sm my-2">承認する</button><button class="btn btn-warning btn-sm my-2">拒否する</button> -->
    </div>


</body>
<?= $footer ?>