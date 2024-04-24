<?php
    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="css/syle.css">
</head>

<body>
    <div id='pagecontainer'>
    <div id="content-wrap">
    <nav class='navbar'>
        <div class="wrapper">
            <ul>
                <li> <a href="index.php"> Home </a></li>
                <li> <a href="catalog.php"> See Catalog </a> </li>
                <li> <a href="gamelist.php"> See Gamelist </a> </li>
                <?php
                    if(isset($_SESSION["username"])){
                        echo "<li> <a href='friend.php'> Friends List </a> </li>";
                        echo "<li> <a href='profile.php'> Hello, " . $_SESSION["displayName"] . "</a> </li>";
                        echo "<li> <a href='includes/logout.inc.php'> Log out </a> </li>";
                    } else {
                        echo "<li> <a href='signup.php'> Create Account </a> </li>";
                        echo "<li> <a href='login.php'> Login </a> </li>";
                    }
                ?>
                
            </ul>
        </div>
    </nav>

    