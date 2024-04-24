<?php
    include_once "header.php"
?>

    <section class="signup-form">
        <div class='contain-form-signup'>
        <h2 class='form-head-signup'>Sign up</h2>
        <form class='form-content-signup' action="includes/signup.inc.php" method="post">
            Display Name: 
            <input type="text" name="displayName" placeholder="Display Name">
            <br>
            Username: 
            <input type="text" name="username" placeholder="Username">
            <br>
            Password:
            <input type="password" name="password" placeholder="Password">
            <br>
            Reenter Password:
            <input type="password" name="repassword" placeholder="Password Again">
            <br>
            <div class='form-button-contain'>
                <button type="submit" name="submit">Sign Up</button>
            </div>
        </form>   
        </div>

        <?php
        if (isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo "<p class='compare-msg'>Fill in all fields.</p>";
            } else if ($_GET["error"] == "invaliduser") {
                echo "<p class='compare-msg'>Invalid username, must be alphanumerical.</p>";
            } else if ($_GET["error"] == "invalidpasswordmatch") {
                echo "<p class='compare-msg'>Passwords do not match.</p>";
            } else if ($_GET["error"] == "displaynamealreadyexists") {
                echo "<p class='compare-msg'>Display name already exists.</p>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<p class='compare-msg'>Something went wrong. Please try again.</p>";
            } else if ($_GET["error"] == "none") {
                echo "<p class='compare-msg'>Success! Account was created!</p>";
            }
        }
        ?>
    
    </section>



<?php
    include_once "footer.php"
?>