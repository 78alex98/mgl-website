<?php

if(isset($_POST["add"])){

    $nameFind = $_POST["nameFind"];
    echo $nameFind;

    require_once "dbh.inc.php";
    require_once "friendfunctions.inc.php";

    if(emptyField($nameFind)){
        header("location: ../friend.php?error=emptyfindfield");
        exit();
    }

    if(!userExists($conn, $nameFind)){
        header("location: ../friend.php?error=usernotfound");
        exit();
    }

    if(foundItself($conn, $nameFind)){
        header("location: ../friend.php?error=userfounditself");
        exit();
    }

    if(alreadyFriend($conn, $nameFind)){
        header("location: ../friend.php?error=alreadyfriend");
        exit();
    }

    addFriend($conn, $nameFind);
    header("location: ../friend.php?msg=friendadded");
    exit();

 } else if(isset($_POST["remove"])){
    
    $nameFind = $_POST["nameFind"];
    echo $nameFind;

    require_once "dbh.inc.php";
    require_once "friendfunctions.inc.php";

    if(emptyField($nameFind)){
        header("location: ../friend.php?error=emptyfindfield");
        exit();
    }

    if(!userExists($conn, $nameFind)){
        header("location: ../friend.php?error=usernotfound");
        exit();
    }

    if(foundItself($conn, $nameFind)){
        header("location: ../friend.php?error=userfounditself");
        exit();
    }

    removeFriend($conn, $nameFind);
    header("location: ../friend.php?msg=friendremoved");
    exit();

 } else {
    header("location: ../friend.php");
    exit();
}

?>