<?php 
session_start();

if(isset($_GET['dir'])){
    if($_GET['dir'] == "add"){
        include_once "dbh.inc.php";
        include_once "functions.inc.php";
        
        if(existsInList($conn, $_GET['id'])){
            header("location: ../gamelist.php?error=gamealreadyinlist");
            exit();
        }

        $sql = "INSERT INTO games(gName, gBrand, gGenre, gConsole, UID, PID) 
                VALUES ('{$_GET['name']}','{$_GET['brand']}','{$_GET['genre']}','{$_GET['console']}', '{$_SESSION['UID']}', '{$_GET['id']}')";
        mysqli_query($conn, $sql);
        header("location: ../gamelist.php?msg=gameadded");

    } else if ($_GET['dir'] == "fav"){
        include_once "dbh.inc.php";

        if($_SESSION['favGame'] === $_GET['name']){
            header("location: ../profile.php?error=alreadyfavgame");
            exit();
        }

        $sql = "UPDATE user SET favGame='{$_GET['name']}' WHERE UID='{$_SESSION['UID']}'";
        mysqli_query($conn, $sql);
        $_SESSION['favGame'] = $_GET['name'];
        header("location: ../profile.php?msg=favgamechanged");
    } else {
        header("location: ../catalog.php?error=failedcommand");
        exit();
    }

} else {
    header("location: ../catalog.php?error=failedcommand");
    exit();
}

?>