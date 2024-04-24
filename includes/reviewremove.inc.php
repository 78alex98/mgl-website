<?php

if(isset($_GET["reviewid"])) {

    require_once "dbh.inc.php";

    $sql = "DELETE FROM review WHERE RID='{$_GET["reviewid"]}'";
    mysqli_query($conn, $sql);

    header("location: ../profile.php");
    exit();

} else {
    header("location: ../profile.php");
    exit();
}

?>