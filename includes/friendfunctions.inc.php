<?php

function emptyField($change){
    if(empty($change)){
        return true;
    }
    return false;
}

function userExists($conn, $name){
    $sql = "SELECT * FROM user WHERE displayName='{$name}' OR username='{$name}'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        return true;
    }
    return false;
}

function foundItself($conn, $name){
    session_start();
    if($name == $_SESSION['displayName'] || $name == $_SESSION['username']){
        return true;
    }
    return false;
}

function alreadyFriend($conn, $name){
    $sql = "SELECT * FROM friends WHERE fName='{$name}' AND UID='{$_SESSION['UID']}'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        return true;
    }
    return false;
}

function addFriend($conn, $name){
    
    $sql = "SELECT * FROM user WHERE displayName='{$name}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $fid = $row['UID'];

    $sql = "INSERT INTO friends (UID, uName, FID, fName) VALUES ('{$_SESSION['UID']}', '{$_SESSION['displayName']}', '{$fid}', '{$name}');";
    mysqli_query($conn, $sql);

    $sql = "INSERT INTO friends (FID, fName, UID, uName) VALUES ('{$_SESSION['UID']}', '{$_SESSION['displayName']}', '{$fid}', '{$name}');";
    mysqli_query($conn, $sql);
}

function filterFriend($conn, $name){
    session_start();
    $sql = "SELECT * FROM friends WHERE fName LIKE '%{$name}%' AND UID='{$_SESSION['UID']}';";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        return $sql;
    } else {
        header("location: ../../friend.php?error=nomatchfound");
        exit();
    }
}

function removeFriend($conn, $name){
    $sql = "DELETE FROM friends WHERE UID='{$_SESSION['UID']}' AND fName='{$name}'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM friends WHERE uName='{$name}' AND FID='{$_SESSION['UID']}'";
    mysqli_query($conn, $sql);
}

?>