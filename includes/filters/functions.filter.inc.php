<?php

function emptyFilterFields($nameSearch, $brandSearch, $priceSearch, $genreSearch, $consoleSearch){
    if(empty($nameSearch) && empty($brandSearch) && empty($priceSearch) && empty($genreSearch) && empty($consoleSearch)){
        return true;
    }
    return false;
}

function filter($conn, $nameSearch, $brandSearch, $priceSearch, $genreSearch, $consoleSearch){

    $sql = "SELECT * FROM catalog WHERE ";
    $prior = false;
    if(!empty($nameSearch)){
        $sql .= "pName LIKE '%{$nameSearch}%'";
        $prior = true;
    }

    if(!empty($brandSearch) && $prior === true){
        $sql .= " AND pBrand LIKE '%{$brandSearch}%'";
    } else if (!empty($brandSearch)){
        $sql .= "pBrand LIKE '%{$brandSearch}%'";
        $prior = true;
    }

    if(!empty($priceSearch) && $prior === true){
        $sql .= " AND pPrice LIKE '%{$priceSearch}%'";
    } else if (!empty($priceSearch)){
        $sql .= "pPrice LIKE '%{$priceSearch}%'";
        $prior = true;
    }

    if(!empty($genreSearch) && $prior === true){
        $sql .= " AND pGenre LIKE '%{$genreSearch}%'";
        
    } else if (!empty($genreSearch)){
        $sql .= "pGenre LIKE '%{$genreSearch}%'";
        $prior = true;
    }

    if(!empty($consoleSearch) && $prior === true){
        $sql .= " AND pConsole LIKE '%{$consoleSearch}%'";
    } else if (!empty($consoleSearch)){
        $sql .= "pConsole LIKE '%{$consoleSearch}%'";
        $prior = true;
    }

    $sql .= ";";

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        return $sql;
    } else {
        header("location: ../../catalog.php?error=nomatchfound");
        exit();
    }
}

?>