<?php
// 初期データは新規会員登録時に入力されたものを使用するのでinput,createは無い
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
$sql = 'SELECT * FROM users_table WHERE id';
$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// fetch()で1レコード取得できる.
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo  '<pre>';
    // var_dump($record);
    // echo  '<pre>';
    // exit();
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイプロフィール（編集画面）</title>
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
                <div class="panel-heading"><strong>【編集画面】マイプロフィール</strong></div>
                <div class="panel-body">
                    <form action="profile_file.php" method="POST" enctype="multipart/form-data">
                        <div class=" form-group">
                            <label class="control-label"></label>
                            <input class="form-control" type="hidden" name="id" value="<?= $record["id"] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">ユーザーネーム</label>
                            <input class="form-control" type="text" name="username" value="<?= $record['username'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">email</label>
                            <input class="form-control" type="text" name="email" value="<?= $record['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">password</label>
                            <input class="form-control" type="text" name="password" value="<?= $record['password'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">写真</label>
                            <input class="form-control" type="file" name="image" value="<?= $record['Image'] ?>" accept="image/*" capture="camera">
                            <!-- <input type="file" name="upfile" accept="image/*" capture="camera"> -->
                        </div>
                        <div class="form-group">
                            <label class="control-label">プロフィール</label>
                            <input class="form-control" type="text" name="comment" value="<?= $record['comment'] ?>" placeholder="自己紹介や普段釣りに行く場所を記載すると、受け取ってくれるかたに発見されやすくなります">
                        </div>
                        <button class="btn btn-secondary my-2">編集完了</button>
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