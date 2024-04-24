<?php
    include_once "header.php";
    include_once "includes/dbh.inc.php";
    include_once "includes/functions.inc.php";

    $connection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if(isset($_SESSION["UID"])) {
        $sql = "SELECT * FROM games WHERE UID={$_SESSION["UID"]}";
        $result = mysqli_query($connection, $sql);
    }
?>

<section class="gamelist-display">
    <?php
        if(isset($_SESSION["displayName"]) && mysqli_num_rows($result) > 0){
            echo "<br><h2 class='title-format'>" . $_SESSION["displayName"] . "'s Game List</h2>";

            if (isset($_GET["error"])){
                if($_GET["error"] == "gamealreadyinlist"){
                    echo "<br><p class='compare-msg'>Game already in list.</p>";
                }
            }

            if (isset($_GET["msg"])){
                if($_GET["msg"] == "removesuccessful"){
                    echo "<br><p class='compare-msg'>Game Removed.</p>";
                } else if($_GET["msg"] == "gameadded"){
                    echo "<br><p class='compare-msg'>Game Added.</p>";
                } else if($_GET["msg"] == "gamechangesuccessful"){
                    echo "<br><p class='compare-msg'>Game Changed.</p>";
                }
            }

            echo "
            <table class='table-format' >
                <tr>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Genre</th>
                    <th>Console</th>
                    <th>Status</th>
                    <th>Rating</th>
                </tr>
            ";
            while($row = mysqli_fetch_assoc($result)) {
                echo "
                <tr>
                <td><a href='info.php?id={$row['PID']}&gamelist=true&rating={$row['rating']}'>" . $row['gName'] . "</a></td>
                <td>" . $row['gBrand'] . "</td>
                <td>" . $row['gGenre'] . "</td>
                <td>" . $row['gConsole'] . "</td>
                <td>" . $row['status'] . "</td>
                <td>" . $row['rating'] . "</td>
                </tr>
                ";
            }
            echo "</table>";
        } else if (isset($_SESSION["displayName"])){
            echo "<br><p class='gamelist-message'>No games have been added to gamelist</p>";
            echo "<p class='gamelist-message'>Add games to your gamelist in the <a href='catalog.php'>catalog</a></p><br>";
        } else {
            echo "<br><p class='gamelist-message'><a href='login.php'>Log in</a> to view Game List.</p><br>";
        }
    ?>
</section>

<?php
    include_once "footer.php"
?>