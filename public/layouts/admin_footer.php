    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.7.2.min.js"><\/script>')</script>

    <!-- scripts should be concatenated and minified via build script -->
    <script src="../js/main.js"></script>
    <script src="../js/vendor/lightbox/jquery.lightbox.js"></script>

    </div><!-- .inside -->
    </div><!-- #main -->
    <footer class="inside clearfix">
        <div class="upper-footer">
            <ul class="footer-nav">
                <h4>Contact</h4>
            	<li>Facebook</li>
            	<li>Twitter</li>
            </ul>
            <ul class="footer-nav">
                <h4>Second Column</h4>
            	<li>Link 1</li>
            	<li>Second</li>
            	<li>Fasd asd</li>
            </ul>
            
        </div>
        <div class="footer-nav-left">
            Copyright &copy; <?php echo date("Y", time()); ?>, Mihai Rotaru
            <p>
            This website uses PHP, HTML5 si CSS3. Coffeescript is used for
            accessing JQuery functionality.
            </p>
        </div>
    </footer>
    </body>
</html>
<?php if( isset( $database )) { $database->close_connection(); } ?>
