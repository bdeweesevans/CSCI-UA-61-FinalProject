<?php
    session_start(); // Start the session.
?>

<div class="header" style="font-weight:bold">
    <a href="./index.html">Home</a> |
    <a href="./products.php">Products</a> |
    <a href="./search.php">Search</a> |
    <a href="./game.php">Game</a> |
    <a href="./contact.html">Contact</a> |

    <?php
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            // Display Logout
            echo '<a href="./logout.php">Logout</a>';
        } else {
            // Display Login and Signup
            echo '<a href="./login.html">Login</a> | ';
            echo '<a href="./signup.html">Sign Up</a>';
        }
    ?>
</div>
