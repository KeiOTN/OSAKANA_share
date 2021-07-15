<?php
// 定型文一覧
// session_start();
// include('functions.php');
// check_session_id();
// include("header_and_footer/header.php");
// include("header_and_footer/footer.php");
// $pdo = connect_to_db();
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);


// DB接続
function connect_to_db()
{
    $dbn = 'mysql:dbname=happy_fish;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}

// check session
function check_session_id()
{
    if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] != session_id()) {
        header('Location: login/login.php');
    } else {
        session_regenerate_id(true);
        $_SESSION['session_id'] = session_id();
    }
}
