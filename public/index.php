<?php
require_once( "../include/functions.php" );
require_once( "../include/database.php" );
require_once( "../include/user.php" );
?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!-- Consider specifying the language of your content by adding the `lang` attribute to <html> -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <!-- Use the .htaccess and remove these lines to avoid edge case issues.  More info: h5bp.com/i/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Photo Share</title>
    <meta name="description" content="Upload and share pictures">

    <!-- Mobile viewport optimized: h5bp.com/viewport -->
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

    <link rel="stylesheet" href="css/main.css">

    <!-- All JavaScript at the bottom, except this Modernizr build. -->
    <script src="js/vendor/modernizr.js"></script>
</head>
<body>
    <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
         chromium.org/developers/how-tos/chrome-frame-getting-started -->
    <!--[if lt IE 7]><p class="chromeframe">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
    <header>
        <h1>Photo Share</h1>
    </header>

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

    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    <!--
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.7.2.min.js"><\/script>')</script>
    -->

    <!-- scripts concatenated and minified via build script -->
    <!--
    <script src="js/main.js"></script>
    -->

    <footer>
        Copyright <?php echo date("Y", time()); ?>, Mihai Rotaru
    </footer>
    </body>
</html>


