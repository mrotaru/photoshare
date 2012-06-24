    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.7.2.min.js"><\/script>')</script>

    <!-- scripts should be concatenated and minified via build script -->
    <script src="../js/main.js"></script>

    </div><!-- .inside -->
    </div><!-- #main -->
    <footer class="inside">
        Copyright <?php echo date("Y", time()); ?>, Mihai Rotaru
    </footer>
    </body>
</html>
<?php if( isset( $database )) { $database->close_connection(); } ?>
