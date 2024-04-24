<?php

if(isset($_POST["search"])){

    $nameSearch = $_POST["nameSearch"];
    $brandSearch = $_POST["brandSearch"];
    $priceSearch = $_POST["priceSearch"];
    $genreSearch = $_POST["genreSearch"];
    $consoleSearch = $_POST["consoleSearch"];

    if($priceSearch === "Free" || $priceSearch === "free"){
        $priceSearch = "0.00";
    }

    require_once "../dbh.inc.php";
    require_once "functions.filter.inc.php";

    //Error Handlers

    if(emptyFilterFields($nameSearch, $brandSearch, $priceSearch, $genreSearch, $consoleSearch) !== false){
        header("location: ../../catalog.php?error=nofilterfields");
        exit();
    }

    $resultFilter = filter($conn, $nameSearch, $brandSearch, $priceSearch, $genreSearch, $consoleSearch);

    if($resultFilter !== false){
        header("location: ../../catalog.php?error=none&filter=true&query={$resultFilter}");
    } else {
        header("location: ../../catalog.php?error=none&filter=false");
    }
    
} else if(isset($_POST["reset"])){
    header("location: ../../catalog.php");
    exit();
} else {
    header("location: ../../catalog.php");
    exit();
}

?>