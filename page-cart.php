<?php
/*
    Template Name: Cart Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
        <div class="container">
            <?php if(function_exists('bcn_display'))
            {
                bcn_display();
            }?>
        </div>
    </div>

    <article role="main" class="type-page cart">
        
        <div class="primary container">
            <section class="content">
                <h1>Cart</h1>
                <?php the_content(); ?>
            </section>
        </div>
        
    </article>
<?php endwhile; ?>

<?php get_footer(); // will include footer-no-sidebar.php; ?>
