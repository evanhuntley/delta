<?php
/*
    Template Name: Home Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <?php
        $banner_title = types_render_field("home-banner-title", array("raw" => true));
        $banner_subtitle = types_render_field("home-banner-subtitle", array("raw" => true));
        $banner_text = types_render_field("home-banner-text", array("raw" => true));

        $about_text = types_render_field("home-about-text", array("raw" => true));

        $six_domains_text = types_render_field("home-domains-text", array("raw" => true));

        $certification_sb = types_render_field("certification-small-block", array("raw" => true));
        $education_sb = types_render_field("education-small-block", array("raw" => true));
        $survey_sb = types_render_field("survey-small-block", array("raw" => true));
        $coaching_sb = types_render_field("coaching-small-block", array("raw" => true));
        $course_sb = types_render_field("course-materials-small-block", array("raw" => true));

        $video_img = types_render_field("home-about-image", array("raw" => true));
    ?>

    <article role="main" class="type-page" id="post-<?php the_ID(); ?>">
        <header class="section-header">
            <h1>
                <span class="subtitle">
                    <?= $banner_subtitle; ?>
                </span>
                <?= $banner_title; ?>
            </h1>
            <p><?= $banner_text; ?></p>
        </header>

        <div class="about block">
            <div class="container">
                <div class="about-info">
                    <div class="subsection-header">
                        <h2>About Us</h2>
                    </div>
                    <?= $about_text; ?>
                </div>
                <div class="video">
                    <img src="<?= $video_img ?>" / >
                </div>
            </div>
        </div>

        <div class="six-domains block">
            <div class="container">
                <div class="subsection-header">
                    <h2>The Six Domains Leadership Model</h2>
                    <?= $six_domains_text ?>
                </div>
                <div class="info-block">
                    <h3>Professional Leadership Coaching Certification Program</h3>
                    <?= $certification_sb; ?>
                </div>
                <div class="info-block">
                    <h3>Education</h3>
                    <?= $education_sb; ?>
                </div>
                <div class="info-block">
                    <h3>360° Leadership Survey</h3>
                    <?= $survey_sb; ?>
                </div>
                <div class="info-block">
                    <h3>Coaching</h3>
                    <?= $coaching_sb; ?>
                </div>
                <div class="info-block">
                    <h3>Leadership Materials</h3>
                    <?= $course_sb; ?>
                </div>
            </div>
        </div>

        <?php
            $args = array(
                'post_type' => 'testimonials',
                'posts_per_page' => -1,
                'order' => 'RAND'
            );
            $slides = new WP_Query( $args);
        ?>
        <?php if ($slides->have_posts()) : ?>
        <div class="testimonials block">
            <div class="container">
                <h2>What Others Are Saying</h2>
                
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                            while ( $slides->have_posts() ) : $slides->the_post();
                        ?>
                        <li class="testimonial">
                            <div class="slide-content">
                                <?php the_content(); ?>
                                <h3 class="name"><?php the_title(); ?></h3>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                
            </div>
        </div>
        <?php endif; wp_reset_query();?>

    </article>
<?php endwhile; ?>

<?php get_footer(); // will include footer-no-sidebar.php; ?>
