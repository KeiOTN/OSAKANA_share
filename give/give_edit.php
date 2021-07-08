<?php
// var_dump($_GET);
// exit();
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

session_start();
include('../functions.php');
check_session_id();

$id = $_GET['id'];
// var_dump($_SESSION);
// exit();

// DB接続&id名でテーブルから検索
$pdo = connect_to_db();
$sql = 'SELECT * FROM fish_list WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// fetch()で1レコード取得できる.
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>提供できる魚（編集画面）</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="../bootstrap.css"> -->
    <style>
        a {
            text-decoration: none;
            color: inherit;
        }

        a:hover {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <main role="main">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>【編集画面】シェアしていただける魚について記入してください</strong></div>
                <div class="panel-body">
                    <form action="give_update.php" method="POST">
                        <div class="form-group">
                            <label class="control-label"></label>
                            <input class="form-control" type="hidden" name="id" value="<?= $record["id"] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">タイトル</label>
                            <input class="form-control" type="text" name="title" value="<?= $record['title'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">内容</label>
                            <input class="form-control" type="text" name="detail" value="<?= $record['detail'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">受け渡し場所</label>
                            <input class="form-control" type="text" name="place" value="<?= $record['place'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">申込締め切り</label>
                            <input class="form-control" type="date" name="deadline" value="<?= $record['deadline'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"></label>
                            <input class="form-control" type="hidden" name="created_user_id" value="<?= $record['created_user_id'] ?>">
                        </div>



                        <button class="btn btn-secondary my-2">編集完了</button>
                        <button class="btn btn-danger my-2"><a href='give_delete.php?id=<?= $record['id'] ?>'>削除</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>