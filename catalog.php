<?php
    include_once "header.php";
    include_once "includes/dbh.inc.php";
    include_once "includes/functions.inc.php";
    
    $connection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
?>

    <div class='catalog'>
    <br>
    <h2 class='title-format'> Catalog </h2>
    <br>

        <div class='contain-form'>
            <h3 class='form-head'><u>Search and Filter</u></h3>
            <form class='form-content' action="includes/filters/catalog.filter.inc.php" method="post">
                Name:
                <input type="text" name="nameSearch" placeholder="Name">
                <br>
                Brand:
                <input type="text" name="brandSearch" placeholder="Brand">
                <br>
                Price: $
                <input type="text" name="priceSearch" placeholder="Price">
                <br>
                Genre:
                <input type="text" name="genreSearch" placeholder="Genre">
                <br>
                Console:
                <input type="text" name="consoleSearch" placeholder="Console">
                <br>
                <div class='form-button-contain'>
                    <button type="search" name="search"> Search </button>
                    <button type="search" name="reset"> Reset </button>
                </div>
            </form>
        </div>

        <?php
        if (isset($_GET["error"])){
            if($_GET["error"] == "nofilterfields"){
                echo "<p class='compare-msg'>Fill in at least one field to search.</p>";
            } else if ($_GET["error"] == "nomatchfound") {
                echo "<p class='compare-msg'>No Match Found.</p>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<p class='compare-msg'>Something went wrong. Please try again.</p>";
            } else if ($_GET["error"] == "none") {
                echo "<p class='compare-msg'>Filtered and Searched.</p>";
            }
        }
        ?>
        
        <br>

        <table class='table-format' >
            <tr>
                <th>Name</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Genre</th>
                <th>Console</th>
            </tr> 
            <?php
                if(isset($_GET['query'])){
                    $sql = $_GET['query'];
                    $result = mysqli_query($connection, $sql);
                } else {
                    $sql = "SELECT * FROM catalog";
                    $result = mysqli_query($connection, $sql);
                }

                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><a href='info.php?id={$row['PID']}'>" . $row['pName'] . "</a></td>";
                    echo "<td>" . $row['pBrand'] . "</td>";
                    if($row['pPrice'] == "0.00"){
                        echo "<td>Free</td>";
                    } else {
                        echo "<td>" . $row['pPrice'] . "</td>";
                    }
                    
                    echo "<td>" . $row['pGenre'] . "</td>";
                    echo "<td>" . $row['pConsole'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </table>

        <br>
    </div>

<?php
    include_once "footer.php"
?>