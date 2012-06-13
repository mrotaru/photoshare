<?php
require_once( "../include/database.php" );
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

    $sql = "SELECT * FROM users WHERE id = 1";
    $result_set = $database->query($sql);
    $found_user =  mysql_fetch_array($result_set);
    echo $found_user['username'];

    ?>
    </body>
</html>


