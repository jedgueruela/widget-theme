<?php get_header(); ?>

    <main role="main">
    
        <!-- start of carousel -->
        
        <?php
            $args = array( 'post_type' => 'sliders', 'posts_per_page' => -1 );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) :
        ?>
        <section id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                    $count = 0;
                    while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;
                ?>
                    <div class="carousel-item <?php echo ($count == 1) ? 'active' : ''; ?>">
                        <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail();
                            } else {
                        ?>
                            <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
                        <?php } ?>
                        <div class="container">
                            <div class="carousel-caption text-left">
                                <h2><?php the_title(); ?></h2>
                                <p><?php the_content(); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php if ($count > 1) : ?>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <ol class="carousel-indicators">
                <?php foreach (range(1, $count) as $number) : ?>
                <li data-target="#myCarousel" data-slide-to="<?php echo $number; ?>" class="<?php echo ($count == 1) ? 'active' : ''; ?>"></li>
                <?php endforeach; ?>
            </ol>
            <?php endif; ?>
        </section>
        <?php wp_reset_postdata(); endif; ?>

        <!-- end of carousel -->

        <!-- start of projects -->

        <section id="recent-projects" class="projects">
            <div class="container">
                <h2 class="text-center mb-5">Recent Projects</h2>
                <?php
                    $args = array( 'post_type' => 'projects', 'posts_per_page' => 4 );
                    $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ) : $count = 0;
                ?>
                <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); $count++; ?>
                    <div class="bg-light mb-3 mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                        <div class="my-3 p-3">
                            <h2 class="display-5"><?php the_title(); ?></h2>
                            <p class="lead"><?php the_content(); ?></p>
                        </div>
                        <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'medium', array( 
                                    'class' => 'box-shadow mx-auto',
                                    'style' => 'width: 80%; border-radius: 21px 21px 0 0;'
                                ));
                            } else {
                                ?>
                                <div class="bg-dark box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
                                <?php
                            }
                        ?>
                    </div>
                    <?php if ($count % 2 === 0) : ?>
                        </div>
                        <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
                    <?php endif; endwhile; ?>
                </div>
                <?php else : ?>
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <p class="display-4 text-center"><?php _e( 'No project found', 'jons-widget' ); ?></p>
                        </div>
                    </div>
                <?php wp_reset_postdata(); endif; ?>
            </div>
        </section>

        <!-- end of projects -->

        <!-- start of map -->

        <?php if ( get_theme_mod( 'office_address') != "" ) : ?>
        <section id="map" class="map">
            <div class="map-container">
                <?php
                    $query_string = http_build_query(array(
                        'q' => get_theme_mod( 'office_address'),
                        't' => '',
                        'z' => 15,
                        'ie' => 'UTF8',
                        'iwloc' => '',
                        'output' => 'embed'
                    ));
                ?>
                <iframe width="1080" height="500" src="https://maps.google.com/maps?<?php echo $query_string; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
        </section>
        <?php endif; ?>

        <!-- end of map -->
        
    </main>

<?php get_footer(); ?>