<?php

if(isset($_POST["search"])){

    $nameSearch = $_POST["nameSearch"];
    echo $nameSearch;

    require_once "../dbh.inc.php";
    require_once "../friendfunctions.inc.php";

    if(emptyField($nameSearch)){
        header("location: ../../friend.php?error=emptysearchfield");
        exit();
    }

    $resultFilter = filterFriend($conn, $nameSearch);

    if($resultFilter !== false){
        header("location: ../../friend.php?error=none&filter=true&query={$resultFilter}");
    } else {
        header("location: ../../friend.php?error=none&filter=false");
    }

} else {
    header("location: ../friend.php");
    exit();
}

?>