<?php
/*
*Template Name: Newsroom
*/

get_header();
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile; // End of the loop.
?>

<?php get_template_part( 'template-parts/content', 'newsroom' ); ?>


<?php get_footer(); ?>