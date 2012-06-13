<?php
require_once( "../include/functions.php" );
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
    
    $user = User::find_by_id(1);
    echo $user->full_name();

    echo "<hr/>";

    $users = User::find_all();
    foreach( $users as $user ) {
        echo "User: " . $user->username . "<br/>";
        echo "Name: " . $user->full_name() . "<br/><br/>";
    }
    ?>
    </body>
</html>


