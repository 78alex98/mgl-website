<?php
    include_once "header.php";
    require_once "includes/dbh.inc.php";

    $sql = "SELECT * FROM review WHERE UID='{$_SESSION['UID']}'";
    $result = mysqli_query($conn, $sql);
?>

    <section class="profile-info">
        <h2 class='title-format'>Profile Information</h2>
        <?php
            echo "<br><div class='info-content'>";
            echo "<p><b>Display Name</b>: " . $_SESSION["displayName"] . "</p>";
            echo "<p><b>Username</b>: " . $_SESSION["username"] . "</p>";
            echo "<p><b>Favorite Console</b>: " . $_SESSION["favConsole"] . "</p>";
            echo "<p><b>Favorite Game</b>: " . $_SESSION["favGame"] . "</p>";
            echo "</div><br>";

            echo "
            <div class='contain-form'>
                <h3 class='form-head'><u>Change Favorite Console</u></h3>
                <form class='form-content' action='includes/profileedit.inc.php' method='post'>
                    <select name='consoleChange'>
                        <option value='N/A'>N/A</option>
                        <option value='PC'>PC</option>
                        <option value='PlayStation'>PlayStation</option>
                        <option value='Xbox'>Xbox</option>
                        <option value='Mobile'>Mobile</option>
                        <option value='Nintendo Switch'>Nintendo Switch</option>
                    </select>
                    <div class='form-button-contain'>
                        <button type='submit' name='change'>Change</button>
                    </div>
                </form>
            </div>
            <br>
            ";

            echo "<div class='info-buttons'>";
            echo "<a href='friend.php'><button>See Friends</button></a>";
            echo "</div>";

            echo "<br><br><h3 class='title-format'><u>Your Reviews</u></h3>";
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $sql = "SELECT * FROM catalog WHERE PID='{$row['GID']}'";
                    $resultP = mysqli_query($conn, $sql);
                    $rowP = mysqli_fetch_assoc($resultP);
                    echo "<div class='review-block'>";
                    echo "<h3 class='review-title'>" . $row['heading'] . " - " . $row['rating'] . " Stars</h3> <h4 class='review-author'><i>by " . $_SESSION['displayName'] . "</i></h4>";
                    echo "<p class='review-content'>" . $row['content'] . "</p>";
                    echo "<p class='review-creation'><i>Created on " . $row['date'] . " about " . $rowP['pName'] . "</i> / <a href='includes/reviewremove.inc.php?reviewid={$row['RID']}'>Remove this Review</a></p>";
                    echo "</div>";
                    
                }
            } else {
                echo "<p class='title-format'>There are no reviews</p>";
            }
        ?>
    </section>

<?php
    include_once "footer.php"
?>