<?php
    include_once "header.php";
    include_once "includes/dbh.inc.php";
    include_once "includes/functions.inc.php";

    if(isset($_GET['id'])){
        $catID = $_GET['id'];
        $result = displayCatInfo($conn, $catID);
        $row = mysqli_fetch_assoc($result);
    } else {
        header("location: catalog.php?error=idnotfound");
        exit();
    }

    $sql = "SELECT COUNT(*) as total FROM review WHERE GID='{$_GET['id']}'";
    $resultC = mysqli_query($conn, $sql);
    $val = mysqli_fetch_assoc($resultC);

?>

    <section class="catalog-info">
        <br>
        <h2 class='title-format'>Game Information</h2>
        <br>

        <?php 
            echo "<div class='info-content'>";
            echo "<p> <b>Name:</b> " . $row['pName'] . "</p>";
            echo "<p> <b>Brand:</b> " . $row['pBrand'] . "</p>";
            echo "<p> <b>Price:</b> $" . $row['pPrice'] . "</p>";
            echo "<p> <b>Genres:</b> " . $row['pGenre'] . "</p>";
            echo "<p> <b>Platforms:</b> " . $row['pConsole'] . "</p>";
            echo "<p> <b>Reviews:</b> " . $val['total'] . "</p>";
            echo "</div>";


            echo "<br><div class='info-buttons'>";
            if(isset($_GET['gamelist'])){
                echo "<a href='review.php?id={$_GET['id']}&gamelist=true&rating={$_GET['rating']}'><button>View Reviews</button></a>";
            } else {
                echo "<a href='review.php?id={$_GET['id']}'><button>View Reviews</button></a>";
            }
            

            if(isset($_SESSION['UID'])){
                echo "<a href='includes/gameadd.inc.php?dir=add&id={$row['PID']}&name={$row['pName']}&brand={$row['pBrand']}&genre={$row['pGenre']}&console={$row['pConsole']}'><button>Add to gamelist</button></a>";
                echo "<a href='includes/gameadd.inc.php?dir=fav&id={$row['PID']}&name={$row['pName']}'><button>Set as Favorite</button></a>";
                
            }
            echo "</div>";

            echo "<br>";

            if(isset($_GET['gamelist'])){

                echo "
                <div class='contain-form'>
                    <h3 class='form-head'><u>Edit Gamelist</u></h3>
                    <form class='form-content' action='includes/edit.inc.php?id={$_GET['id']}' method='post'>
                        Rating:
                        <select name='ratingChange'>
                            <option value='N/A'>N/A</option>
                            <option value='0'>0</option>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                            <option value='4'>4</option>
                            <option value='5'>5</option>
                            <option value='6'>6</option>
                            <option value='7'>7</option>
                            <option value='8'>8</option>
                            <option value='9'>9</option>
                            <option value='10'>10</option>
                        </select>
                        <br>
                        Status:
                        <select name='statusChange'>
                            <option value='N/A'>N/A</option>
                            <option value='Unplayed'>Unplayed</option>
                            <option value='Will Played'>Will Play</option>
                            <option value='Playing'>Playing</option>
                            <option value='Completed'>Completed</option>
                            <option value='Replaying'>Replaying</option>
                        </select>
                        <br>
                        <div class='form-button-contain'>
                            <button type='submit' name='edit'>Edit</button>
                            <button type='submit' name='remove'>Remove From Gamelist</button>
                        </div>
                    </form>
                </div>
                ";
            }
        ?>
        
    </section>

<?php
    include_once "footer.php";
?>