<?php
    include_once "header.php";
    include_once "includes/dbh.inc.php";
    include_once "includes/functions.inc.php";

    $connection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if(isset($_GET['query'])){
        $sql = $_GET['query'];
        $result = mysqli_query($connection, $sql);
    } else {
        $sql = "SELECT * FROM friends WHERE UID='{$_SESSION['UID']}'";
        $result = mysqli_query($connection, $sql);
    }
?>
<br>
<h2 class='title-format'>Friends List</h2>
<br>

<div class='contain-form'>
    <h3 class='form-head'><u>Edit Friends</u></h3>
    <form class='form-content' action="includes/friendadd.inc.php" method="post">
            Name:
            <input type="text" name="nameFind" placeholder="Display Name">
            <div class='form-button-contain'>   
                <button type="add" name="add"> Add </button>
                <button type="remove" name="remove"> Remove </button>
            </div>
    </form>
</div>

<br>

<div class='contain-form'>
    <h3 class='form-head'><u>Search Friend</u></h3>
    <form class='form-content' action="includes/filters/friendsearch.filter.inc.php" method="post">
            Name:
            <input type="text" name="nameSearch" placeholder="Display Name">
            <div class='form-button-contain'>
                <button type="search" name="search"> Search </button>
            </div>
    </form>
</div>

<?php
        if (isset($_GET["error"])){
            if($_GET["error"] == "emptyfindfield"){
                echo "<p class='compare-msg'>Fill in find field for result.</p>";
            } else if($_GET["error"] == "emptysearchfield"){
                echo "<p class='compare-msg'>Fill in search field for result.</p>";
            }else if ($_GET["error"] == "usernotfound") {
                echo "<p class='compare-msg'>User was not found.</p>";
            } else if ($_GET["error"] == "nomatchfound") {
                echo "<p class='compare-msg'>No Match Found.</p>";
            } else if ($_GET["error"] == "userfounditself") {
                echo "<p class='compare-msg'>User found themselves.</p>";
            } else if ($_GET["error"] == "alreadyfriend") {
                echo "<p class='compare-msg'>User was already friends.</p>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<p class='compare-msg'>Something went wrong. Please try again.</p>";
            } 
        }

        if (isset($_GET["msg"])){
            if ($_GET["msg"] == "friendadded") {
                echo "<p class='compare-msg'>Friend added!</p>";
            } else if ($_GET["msg"] == "friendremoved") {
                echo "<p class='compare-msg'>Friend removed.</p>";
            }
        }
        ?>

<br>

<?php
    echo "<table class='table-format'>
        <tr>
            <th>Friend Name</th>
            <th>Compare</th>
        </tr>";
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "
                <tr>
                    <td>". $row['fName'] ."</td>
                    <td> <a href='compare.php?relation={$row['REID']}'> Compare Game Lists </a> </td>
                </tr>
                ";
            }
        }
    echo "</table>";
?>

<?php
    include_once "footer.php"
?>