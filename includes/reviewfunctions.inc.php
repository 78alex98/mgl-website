<?php

function emptyReview($conn, $heading, $content){

    if(empty($heading) || empty($content)){
        return true;
    }
    return false;

}

function createReview($conn, $heading, $content, $rating, $count, $gid){
    session_start();
    $sql = "INSERT INTO review(heading, content, rating, count, UID, GID) 
            VALUES ('{$heading}', '{$content}', '{$rating}', '{$count}', '{$_SESSION['UID']}', '{$gid}')";
    mysqli_query($conn, $sql);
}

?>