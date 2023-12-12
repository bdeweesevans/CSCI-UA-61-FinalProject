<?php
    session_start();
?>

<div class="header" style="font-weight:bold">
    <a href="./index.php">Home</a> |
    <a href="./products.php">Products</a> |
    <a href="./search.php">Search</a> |

    <?php
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            echo '<a href="./contact.php">Contact</a> | ';
            echo '<a href="./game.php">Game</a> | ';
            echo '<a href="./logout.php">Logout</a>';
        } 
        else {
            echo '<a href="./login.html">Login</a> | ';
            echo '<a href="./signup.html">Sign Up</a>';
        }
    ?>
</div>
