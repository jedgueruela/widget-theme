    <footer class="py-5" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md">
                    <h5><?php echo bloginfo('name'); ?></h5>
                    <small class="d-block mb-3 text-muted">&copy; <?php echo date('Y'); ?></small>
                </div>
                <div class="col-6 col-md">
                    <?php
                        if ( is_active_sidebar( 'footer-column-2' ) ) :
                            dynamic_sidebar( 'footer-column-2' );
                        endif; 
                    ?>
                </div>
                <div class="col-6 col-md">
                    <?php
                        if ( is_active_sidebar( 'footer-column-3' ) ) :
                            dynamic_sidebar( 'footer-column-3' );
                        endif; 
                    ?>
                </div>
                <div class="col-6 col-md">
                    <?php
                        if ( is_active_sidebar( 'footer-column-4' ) ) :
                            dynamic_sidebar( 'footer-column-4' );
                        endif; 
                    ?>
                </div>
                <div class="col-6 col-md">
                    <?php
                        if ( is_active_sidebar( 'footer-column-5' ) ) :
                            dynamic_sidebar( 'footer-column-5' );
                        endif; 
                    ?>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>