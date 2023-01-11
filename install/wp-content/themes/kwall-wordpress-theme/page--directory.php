<?php
/*
*Template Name: Directory
*/

get_header();

?>

<h1><?php the_title(); ?></h1>

<?php
  		while ( have_posts() ) :
  			the_post();
  			the_content();
        endwhile; // End of the loop.
        ?>

<div class="search-wrapper" id="directory-search">
  <div class="container">
  <div class="row">
  <form method="get">
                        <label for="#search-input-directory-page">
                            Search
                        </label>
                        <div class="input-wrapper">
                            <input name="search" placeholder="Who are you looking for?" type="text" id="search-input-directory-page">
                            <button type="submit" id="submit-button-search-page" name="submit" value="Search">Search</button>
                            <button class="ml-xl-4" id="reset-button-search-page" name="reset" value="Reset">Reset</button>
                        </div>
                    </form>
</div>
</div>
</div>
<div class="container">
        <div class="js-filter row">

        <?php
        $args = array(
          'post_type' => 'person',
          'posts_per_page' => -1,
          'order' => 'asc',
        );

        $query = new WP_Query($args);

        echo do_shortcode("[directory_ajax_filter]");
        /*if($query->have_posts()) :
          while($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/directory-item');
          endwhile;
        endif;
        wp_reset_postdata();*/

         ?>
        </div>
        </div>





<?php get_footer(); ?>
