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

    if( isset( $database ) ) { echo "TRUE"; } else { echo "FALSE"; }
    echo( "<br/>" );
    echo $database->escape_value( "It's working?<br/>" );

    //$sql  = "INSERT INTO users (id, username, hashed_password, first_name, last_name, email) ";
    //$sql .= "VALUES (1, 'derp', 'secretpwd', 'Derp', 'Derpowsky', 'derp@mail.com')";
    //$result = $database->query($sql);

    echo("<hr/>");
    $found = User::find_by_id(1);
    echo $found['username'];

    echo "<hr />";

    $user_set = User::find_all();
    while ($user = $database->fetch_array($user_set)) {
        echo "User: ". $user['username'] ."<br />";
        echo "Name: ". $user['first_name'] . " " . $user['last_name'] ."<br /><br />";
    }

    ?>
    </body>
</html>


