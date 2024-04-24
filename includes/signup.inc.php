<?php

if(isset($_POST["submit"])){
    
    $displayName = $_POST["displayName"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    //Error Handlers

    if(emptyInputSignup($displayName, $username, $password, $repassword) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if(invalidUsername($username) !== false){
        header("location: ../signup.php?error=invaliduser");
        exit();
    }

    if(pwdMatch($password, $repassword) !== false){
        header("location: ../signup.php?error=invalidpasswordmatch");
        exit();
    }

    if(dnameExists($conn, $displayName) !== false){
        header("location: ../signup.php?error=displaynamealreadyexists");
        exit();
    }

    createUser($conn, $displayName, $username, $password);

} else {
    header("location: ../signup.php");
    exit();
}

?>