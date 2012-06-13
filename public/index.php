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
    $user->id = $record['id'];
    $user->username = $record['username'];
    $user->password = $record['hashed_password'];
    $user->first_name = $record['first_name'];
    $user->last_name = $record['last_name'];
    $user->email = $record['email'];
    echo $user->full_name();
    echo "<hr/>";

    ?>
    </body>
</html>


