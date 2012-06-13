<?php
require_once( "../include/database.php" );
require_once( "../include/user.php" );
?>

<html>
    <head>
        <title>OO PHP</title>
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
    <?php
    
    $record = User::find_by_id(1);
    $user = new User();
    echo "<hr/>";

    ?>
    </body>
</html>


