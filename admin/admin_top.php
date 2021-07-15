<?php
// 管理者ページ
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
include('../functions.php');
check_session_id();
include("../header_and_footer/admin_header.php");
include("../header_and_footer/admin_footer.php");
$pdo = connect_to_db();

?>

<?= $header ?>

<body>
    <div>
        <div>
            <div>
                <h4>About</h4>
                <p>
                    こちらは管理者画面です。
                </p>
            </div>
            <div>
                <h4>Menu</h4>
                <ul>
                    <li><a href="http://localhost/DEV8/album/admin/users_list_read.php">全登録者一覧</a></li>
                    <li><a href="http://localhost/DEV8/album/give/give_read.php">全おさかな一覧</a></li>
                    <li><a href="#">something...</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
<?= $footer ?>