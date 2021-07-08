<?php
include("../functions.php");

if (
    !isset($_POST['title']) || $_POST['title'] == '' ||
    !isset($_POST['detail']) || $_POST['detail'] == '' ||
    !isset($_POST['place']) || $_POST['place'] == '' ||
    !isset($_POST['deadline']) || $_POST['deadline'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$id = $_POST["id"];
$title = $_POST["title"];
$detail = $_POST["detail"];
$place = $_POST["place"];
$deadline = $_POST["deadline"];
// $created_user_id = $_POST["created_user_id"];

$pdo = connect_to_db();

$sql = "UPDATE fish_list SET title=:title, detail=:detail, place=:place, deadline=:deadline, updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
$stmt->bindValue(':place', $place, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);

$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:give_read.php");
    exit();
}
