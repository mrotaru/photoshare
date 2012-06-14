<?php
require_once( "../../include/functions.php" );
require_once( "../../include/database.php" );
require_once( "../../include/session.php" );
if( !$session->is_logged_in() ) { redirect_to( "login.php" ); }
?>

<html>
    <head>
        <title>OO PHP</title>
        <link rel="stylesheet" href="../css/style.css"/>
    </head>
    <body>
    <header>
        <h1>Pictures</h1>
    </header>
    <?php
    
    $user = User::find_by_id(1);
    echo $user->full_name();

    echo "<hr/>";
    echo "<h4>All users:</h4><br/>";
    $users = User::find_all();
    foreach( $users as $user ) {
        echo "User: " . $user->username . "<br/>";
        echo "Name: " . $user->full_name() . "<br/><br/>";
    }
    ?>

    <footer>
        Copyright <?php echo date("Y", time()); ?>, Mihai Rotaru
    </footer>
    </body>
</html>
