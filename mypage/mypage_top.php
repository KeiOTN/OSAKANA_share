<?php
// マイページ
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
include('../functions.php');
check_session_id();
include("../header_and_footer/header.php");
include("../header_and_footer/footer.php");
$pdo = connect_to_db();

// var_dump($_SESSION);
// exit();

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

$sql = 'SELECT friends_table.*, username FROM friends_table LEFT OUTER JOIN users_table ON friends_table.from_id = users_table.id';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // var_dump($result);
    // echo '<pre>';
    // exit();

    $output = "";
    foreach ($result as $record) {

        if ($user_id != $record["to_id"]) {
            continue;
        }

        $output .= "<div>";
        $output .= "{$record["username"]}さんから友達リクエストが届いています。";
        $output .= "<button class='btn btn-outline-warning btn-sm my-2'><a href='../friends/check_profile.php?user_id=$user_id&from_id={$record["from_id"]}'>プロフィールを確認する</a></button>";
        $output .= "</div>";
    }
}
?>

<?= $header ?>

<body>
    <div>
        <div>

            <div>
                <h4>About</h4>
                <p>
                    こちらは<?= $username ?>さんのマイページです。
                </p>
            </div>
            <div>
                <h4>Infomation</h4>
                <div>
                    <?= $output ?>
                </div>

            </div>
            <div>
                <h4>Menu</h4>
                <ul>
                    <li><a href="#">取引一覧(未)</a></li>
                    <li><a href="#">友人一覧(未)</a></li>
                    <li><a href="http://localhost/DEV8/album/mypage/profile_each.php?id=<?= $record['id'] ?>">プロフィールを確認/編集</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
<?= $footer ?>