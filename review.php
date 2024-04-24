<?php
    include_once "header.php";
    require_once "includes/dbh.inc.php";
?>

<?php
    if(isset($_GET['gamelist'])){
        echo "
        <br>
        <div class='contain-form'>
            <h3 class='form-head'><u>Make a Review</u></h3>
            <form class='form-content' action='includes/reviewadd.inc.php?id={$_GET['id']}&rating={$_GET['rating']}' method='post'>
                Heading:
                <input type='text' name='heading' placeholder='Heading'>
                <br><br>
                Content:<br>
                <textarea name='content' placeholder='Content...'></textarea>
                <br><br>
                <div class='form-button-contain'>
                    <button type='submit' name='create'> Create </button>
                </div>
            </form>
        </div>
       
        ";

        if (isset($_GET["error"])){
            if($_GET["error"] == "emptyreviewfield"){
                echo "<p class='compare-msg'>Fill in all fields.</p>";
            }
        }
    }

?>

<br>

<?php

    echo "<h2 class='title-format'>Reviews</h2><br>";

    $sql = "SELECT * FROM review WHERE GID='{$_GET['id']}'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $sql = "SELECT * FROM catalog WHERE PID='{$row['GID']}'";
            $resultP = mysqli_query($conn, $sql);
            $rowP = mysqli_fetch_assoc($resultP);

            $sql = "SELECT * FROM user WHERE UID='{$row['UID']}'";
            $resultU = mysqli_query($conn, $sql);
            $rowU = mysqli_fetch_assoc($resultU);

            echo "<div class='review-block'>";
            echo "<h3 class='review-title'>" . $row['heading'] . " - " . $row['rating'] . " Stars</h3> <h4 class='review-author'><i>by " . $rowU['displayName'] . "</i></h4>";
            echo "<p class='review-content'>" . $row['content'] . "</p>";
            echo "<p class='review-creation'><i>Created on " . $row['date'] . " about " . $rowP['pName'] . "</i></p>";
            echo "<br>";
            echo "</div>";
        }
    } else {
        echo "<p>There are no reviews</p>";
    }
?>       

<?php
    include_once "footer.php";
?>