<?php

if(isset($_POST["create"])) {

    $heading = $_POST["heading"];
    $content = $_POST["content"];

    echo $heading;
    echo $content;

    require_once "dbh.inc.php";
    require_once "reviewfunctions.inc.php";

    if(emptyReview($conn, $heading, $content)){
        header("location: ../review.php?error=emptyreviewfield&id={$_GET['id']}&gamelist=true&rating={$_GET['rating']}");
        exit();
    }

    $sql = "SELECT COUNT(*) as 'total' FROM review WHERE GID='{$_GET['id']}';";
    $resultC = mysqli_query($conn, $sql);
    $val = mysqli_fetch_assoc($resultC);
    echo $val['total'] + 1;

    createReview($conn, $heading, $content, $_GET['rating'], $val['total'] + 1, $_GET['id']);

    header("location: ../review.php?msg=reviewcreated&id={$_GET['id']}&gamelist=true&rating={$_GET['rating']}");
    exit();

} else {
    header("location: ../review.php?id={$_GET['id']}&gamelist=true&rating={$_GET['rating']}");
    exit();
}

?>