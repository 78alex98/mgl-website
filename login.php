<?php
    include_once "header.php"
?>

    <section class="login-form">
        <div class='contain-form'>
            <h2 class='form-head'>Log in to Your Account</h2>
            <form class='form-content' action="includes/login.inc.php" method="post">
                Username: 
                <input type="text" name="username" placeholder="Username">
                <br>
                Password:
                <input type="password" name="password" placeholder="Password">
                <br>
                <div class='form-button-contain'>
                    <button type="submit" name="submit">Log in</button>
                </div>
            </form> 
        </div>
        <?php
        if (isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo "<p class='compare-msg'>Fill in all fields.</p>";
            } else if ($_GET["error"] == "loginfailed") {
                echo "<p class='compare-msg'>Incorrect Login.</p>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<p class='compare-msg'>Something went wrong. Please try again.</p>";
            }
        }
        ?>
    
    </section>

<?php
    include_once "footer.php"
?>