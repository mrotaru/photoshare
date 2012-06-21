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
    <header class="clearfix">
        <div class="inside">
            <div id="logo">
                <h1>Photo Share</h1>
                <h4>Upload and share your photos</h4>
            </div>
            <div id="actions">
                <?php
                global $session;
                if( $session->is_logged_in() ) {
                    $user = User::find_by_id( $session->user_id );
                    if( !$user ) die( "Cannot find user with id " . $session->user_id . " in the database." );
                    $username = $user->username;
                    $html =  "<p>logged in as: <strong>" . $username . "</strong>";
                    $html .= "<a class=\"header-link\" href=\"index.php?logout=true\">Logout</a></p>";
                    echo $html;
                } else {
                    echo "<p><a class=\"header-link\" href=\"admin/login.php\">Login</a></p>";
                }
                ?>
                <form action="search.php">
                    <input type="text" />
                    <button class="header-button">Search</button>
                </form>
            </div><!-- #actions -->
        </div><!-- .inside -->
    </header>

    <div id="main">
        <div class="inside">
