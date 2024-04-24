<?php
session_start();

if(isset($_POST["edit"])){

    include_once "dbh.inc.php";

    $ratingChange = $_POST["ratingChange"];
    $statusChange = $_POST["statusChange"];

    $sql = "UPDATE games SET rating='{$ratingChange}' WHERE UID='{$_SESSION['UID']}' AND PID='{$_GET['id']}'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE games SET status='{$statusChange}' WHERE UID='{$_SESSION['UID']}' AND PID='{$_GET['id']}'";
    mysqli_query($conn, $sql);

    header("location: ../gamelist.php?msg=gamechangesuccessful");
    exit();

} else if (isset($_POST["remove"])){

    include_once "dbh.inc.php";

    $sql = "DELETE FROM games WHERE UID='{$_SESSION['UID']}' AND PID='{$_GET['id']}'";
    mysqli_query($conn, $sql);

    header("location: ../gamelist.php?msg=removesuccessful");
    exit();

} else {
    header("location: ../gamelist.php?error=invalidcmd");
    exit();
}

?>