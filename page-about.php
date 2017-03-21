<?php
/*
    Template Name: About Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <article role="main" class="type-page about" id="post-<?php the_ID(); ?>">
        <header class="section-header">
            <h1><?php the_title(); ?></h1>
        </header>

        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
            <div class="container">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <?php the_content(); ?>
                
                <div class="founders role-group">
                    <h2>Our Founders</h2>
                    <?php
                        $args = array(
                            'post_type' => 'people',
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                    		'tax_query' => array(
                    			array(
                    				'taxonomy' => 'roles',
                    				'field'    => 'slug',
                    				'terms'    => 'founder',
                    			),
                    		)                            
                        );
                        $founders = new WP_Query( $args);

                        while ( $founders->have_posts() ) : $founders->the_post();
                    ?>
                        <div class="person">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?= get_the_post_thumbnail_url($post, 'medium'); ?>" alt="<?php the_title(); ?>" />
                            <?php endif; ?>
                            <h3 class="name"><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <div class="executives role-group">
                    <h2>Our Executives</h2>
                    <?php
                        $args = array(
                            'post_type' => 'people',
                            'posts_per_page' => -1,
                            'order' => 'DESC',
                    		'tax_query' => array(
                    			array(
                    				'taxonomy' => 'roles',
                    				'field'    => 'slug',
                    				'terms'    => 'executive',
                    			),
                    		)                            
                        );
                        $executives = new WP_Query( $args);

                        while ( $executives->have_posts() ) : $executives->the_post();
                    ?>
                        <div class="person">
                            <?php 
                                if (has_post_thumbnail()) {
                                    $thumb = get_the_post_thumbnail_url($post, 'medium');
                                } else {
                                    $thumb = 'http://placehold.it/180x180';
                                }
                            ?>
                            <img src="<?= $thumb; ?>" alt="<?php the_title(); ?>" />
                            <h3 class="name"><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <div class="coaches">
                    <h2>Our Coaches</h2>
                    <div class="coach-list">
                    <?php
                        $args = array(
                            'post_type' => 'people',
                            'posts_per_page' => -1,
                            'orderby'=> 'title',
                            'order' => 'ASC',
                    		'tax_query' => array(
                    			array(
                    				'taxonomy' => 'roles',
                    				'field'    => 'slug',
                    				'terms'    => 'coach',
                    			),
                    		)                            
                        );
                        $coaches = new WP_Query( $args);

                        while ( $coaches->have_posts() ) : $coaches->the_post();
                    ?>
                        <div class="person">
                            
                            <?php 
                                if (has_post_thumbnail()) {
                                    $thumb = get_the_post_thumbnail_url($post, 'shop_thumbnail');
                                } else {
                                    $thumb = 'http://placehold.it/180x180';
                                }
                            ?>
                            
                            <img src="<?= $thumb; ?>" alt="<?php the_title(); ?>" />
                            <h3 class="name"><?php the_title(); ?></h3>
                        </div>
                    <?php endwhile; wp_reset_query(); ?>
                    </div>
                </div>
            </section>
            <?php get_sidebar(); ?>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); // will include footer-no-sidebar.php; ?>
