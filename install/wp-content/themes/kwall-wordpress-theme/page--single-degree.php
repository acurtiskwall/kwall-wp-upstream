<?php
/*
*Template Name: Single Degree
*/

 get_header();
 ?>


 		<?php
 		while ( have_posts() ) :
 			the_post();
?>
<?php get_template_part('template-parts/blocks/hero-banner/hero', 'banner'); ?>
<div class="row">
  <div class="col-lg-8 main-content-wrap">
    <?php	the_content(); ?>
  </div>
  <div class="col-lg-4">
    <?php get_template_part('template-parts/blocks/degree-sidebar/degree', 'sidebar'); ?>
  </div>
</div>



 <?php
 endwhile; // End of the loop.
 get_footer();
