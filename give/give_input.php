<?php
session_start();
include('../functions.php');
check_session_id();
$pdo = connect_to_db();

// var_dump($_SESSION["user_id"]);
// exit();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="../bootstrap.css"> -->
    <title>あげます登録</title>
    <style>
        h1 {
            font-size: 1.5em;
        }
    </style>
</head>

<body>
    <header>
        <!-- <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About</h4>
                        <p class="text-muted">
                            釣りって楽しいですよね。ボウズもあるのに、クーラーボックスが溢れることもある。おさかなシェアはクーラーボックスから溢れたお魚を、喜んで貰ってくれる人とシェアできたらいいな、という想いから生まれたサービスです。
                        </p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Follow on Twitter</a></li>
                            <li><a href="#" class="text-white">Like on Facebook</a></li>
                            <li><a href="#" class="text-white">Email me</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="login/logout.php" class="navbar-brand d-flex align-items-center"> -->
        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2"
            viewBox="0 0 24 24" focusable="false">
            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
            <circle cx="12" cy="13" r="4" />
          </svg> -->
        <!-- <a href="../login/logout.php" class="navbar-brand d-flex align-items-center">
            <small id="logout">ログアウト</small>
        </a> -->
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </div>
        </div> -->
    </header>
    <main role="main">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>シェアしていただける魚について入力してください</strong></div>
                <div class="panel-body">
                    <form action="give_create.php" method="POST">
                        <div class="form-group">
                            <label class="control-label">タイトル</label>
                            <input class="form-control" type="text" name="title">
                        </div>
                        <div class="form-group">
                            <label class="control-label">内容</label>
                            <input class="form-control" type="text" name="detail">
                        </div>
                        <div class="form-group">
                            <label class="control-label">受け渡し場所</label>
                            <input class="form-control" type="text" name="place">
                        </div>
                        <div class="form-group">
                            <label class="control-label">申込締め切り</label>
                            <input class="form-control" type="date" name="deadline">
                        </div>
                        <div class="form-group">
                            <label class="control-label"></label>
                            <input class="form-control" type="hidden" name="created_user_id" value="<?= $_SESSION["user_id"] ?>">
                        </div>

                        <button class="btn btn-secondary my-2">送信</button>
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