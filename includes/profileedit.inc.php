<?php

session_start();

if(isset($_POST["change"])){

    include_once "dbh.inc.php";

    $consoleChange = $_POST["consoleChange"];
    echo $consoleChange;

    $sql = "UPDATE user SET favConsole='{$consoleChange}' WHERE UID='{$_SESSION['UID']}'";
    mysqli_query($conn, $sql);

    $_SESSION['favConsole'] = $consoleChange;

    header("location: ../profile.php?msg=changesuccessful");
    exit();

} else {
    header("location: ../profile.php?error=invalidcmd");
    exit();
}

?>