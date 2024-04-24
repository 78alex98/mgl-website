<?php


function emptyInputSignup($displayName, $username, $password, $repassword){
    if(empty($displayName) || empty($username) || empty($password) || empty($repassword)){
        return true;
    }
    return false;
}

function invalidUsername($username){
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        return true;
    }
    return false;
}

function pwdMatch($password, $repassword){
    if($password !== $repassword){
        return true;
    }
    return false;
}

function dnameExists($conn, $displayName) {
    $sql = "SELECT * FROM user WHERE displayName = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $displayName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;

    mysqli_stmt_close($stmt);
}

function createUser($conn, $displayName, $username, $password){
    $sql = "INSERT INTO user (username, password, displayName) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPassword, $displayName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $password){
    if(empty($username) || empty($password)){
        return true;
    }
    return false;
}

function loginUser($conn, $username, $password){
    $uidExists = "";
    
    $sql = "SELECT * FROM user WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        $uidExists = $row;
    } else {
        header("location: ../login.php?error=loginfailed");
        exit();
    }

    mysqli_stmt_close($stmt);

    $passwordHashed = $uidExists["password"];
    $checkPassword = password_verify($password, $passwordHashed);

    if($checkPassword === false) {
        header("location: ../login.php?error=loginfailed");
        exit();
    } else if ($checkPassword === true) {
        session_start();
        $_SESSION["UID"] = $uidExists["UID"];
        $_SESSION["username"] = $uidExists["username"];
        $_SESSION["displayName"] = $uidExists["displayName"];
        $_SESSION["favConsole"] = $uidExists["favConsole"];
        $_SESSION["favGame"] = $uidExists["favGame"];
        header("location: ../index.php");
        exit();
    }
    
}

function displayCatalog($conn){
    global $conn;
    $sql = "SELECT * FROM catalog;";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function displayCatInfo($conn, $id){
    $sql = "SELECT * FROM catalog WHERE PID='$id';";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function existsInList($conn, $id){
    session_start();
    $sql = "SELECT * FROM games WHERE PID='$id' AND UID='{$_SESSION['UID']}';";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        return true;
    }
    return false;
}

?>