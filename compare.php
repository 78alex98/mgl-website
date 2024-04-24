<?php
    include_once "header.php";
    include_once "includes/dbh.inc.php";

    $connection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    $sql = "SELECT * FROM friends WHERE REID='{$_GET['relation']}'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
?>

<?php
    echo "<br><h2 class='title-format'>Comparison between " . $row['uName'] . "'s and " . $row['fName'] . "'s Game List</h2><br>";

    $sql = "SELECT COUNT(*) as 'total' FROM games g1, games g2 WHERE g1.UID={$row['UID']} AND g2.UID={$row['FID']} AND g1.gName=g2.gName;";
    $resultC = mysqli_query($connection, $sql);
    $val = mysqli_fetch_assoc($resultC);

    echo "<p class='compare-msg'>There are " . $val['total']. " similar games</p>";

    $sql = "SELECT * FROM user WHERE UID='{$row['UID']}'";
    $resultu1 = mysqli_query($connection, $sql);
    $rowu1 = mysqli_fetch_assoc($resultu1);

    $sql = "SELECT * FROM user WHERE UID='{$row['FID']}'";
    $resultu2 = mysqli_query($connection, $sql);
    $rowu2 = mysqli_fetch_assoc($resultu2);


    if($rowu1['favConsole'] === $rowu2['favConsole']){
        echo "<p class='compare-msg'>You guys both really like " . $rowu1['favConsole']. "!</p>";
    }

    if($rowu1['favGame'] === $rowu2['favGame']){
        echo "<p class='compare-msg'>You guys both really like " . $rowu1['favGame']. "!</p>";
    }

    $sql = "SELECT * FROM games g1, games g2 WHERE g1.UID={$row['UID']} AND g2.UID={$row['FID']} AND g1.gName=g2.gName;";
    $resultS = mysqli_query($connection, $sql);
    if(mysqli_num_rows($resultS) > 0){
        echo "<br><h2 class='title-format'> Shared Games </h2>";
            echo "
            <table class='table-format' >
                <tr>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Genre</th>
                    <th>Console</th>
                </tr>
            ";
            while($rowS = mysqli_fetch_assoc($resultS)) {
                echo "
                <tr>
                <td><a href='info.php?id={$rowS['PID']}'>" . $rowS['gName'] . "</a></td>
                <td>" . $rowS['gBrand'] . "</td>
                <td>" . $rowS['gGenre'] . "</td>
                <td>" . $rowS['gConsole'] . "</td>
                </tr>
                ";
            }
            echo "</table>";
    } else {
        echo "<br><p class='compare-msg'>No Similar Games.</p>";
    }

    echo "<br>";

    $sql = "SELECT * FROM games WHERE UID='{$row['UID']}'";
    $resultU = mysqli_query($connection, $sql);

    if(mysqli_num_rows($resultU) > 0){
        echo "<h2 class='title-format'>" . $row["uName"] . "'s Full Game List</h2>";
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
            while($rowU = mysqli_fetch_assoc($resultU)) {
                echo "
                <tr>
                <td><a href='info.php?id={$rowU['PID']}'>" . $rowU['gName'] . "</a></td>
                <td>" . $rowU['gBrand'] . "</td>
                <td>" . $rowU['gGenre'] . "</td>
                <td>" . $rowU['gConsole'] . "</td>
                <td>" . $rowU['status'] . "</td>
                <td>" . $rowU['rating'] . "</td>
                </tr>
                ";
            }
            echo "</table>";
    } else {
        echo "<p class='compare-msg'>{$row['uName']} has no games in list</p>";
    }

    echo "<br>";

    $sql = "SELECT * FROM games WHERE UID='{$row['FID']}'";
    $resultF = mysqli_query($connection, $sql);

    if(mysqli_num_rows($resultF) > 0){
        echo "<h2 class='title-format'>" . $row["fName"] . "'s Full Game List</h2>";
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
            while($rowF = mysqli_fetch_assoc($resultF)) {
                echo "
                <tr>
                <td><a href='info.php?id={$rowF['PID']}'>" . $rowF['gName'] . "</a></td>
                <td>" . $rowF['gBrand'] . "</td>
                <td>" . $rowF['gGenre'] . "</td>
                <td>" . $rowF['gConsole'] . "</td>
                <td>" . $rowF['status'] . "</td>
                <td>" . $rowF['rating'] . "</td>
                </tr>
                ";
            }
            echo "</table>";
    } else {
        echo "<p class='compare-msg'>{$row['fName']} has no games in list</p>";
    }

?>

<br>

<?php
    include_once "footer.php";
?>