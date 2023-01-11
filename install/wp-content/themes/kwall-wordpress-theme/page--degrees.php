<?php
/*
*Template Name: Degree Archive
*/

get_header();
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
      <input name="search" placeholder="What area of interest are you looking for?" type="text" id="search-input-degree-page">
      <button type="submit" id="submit-button-degree-page" name="submit" value="Search">Search</button>
      <button class="ml-xl-4" id="reset-button-degree-page" name="reset" value="Reset">Reset</button>
  </div>
</form>
</div>
</div>
</div>


<div class="categories container">
  <div class="row">

    <!-- <li class="js-filter-item"><a >All</a></li> -->
  <?php
  $cat_args = array(
    'taxonomy' => 'interest_area',
    'orderby' => 'name',
    'order'   => 'ASC',
    'hide_empty' => false,
     'exclude' => array(1),
     'option_all' => 'All',


  );

  $categories = get_categories($cat_args);

  foreach($categories as $cat) : ?>

  <div class="col-xl-2 col-md-3 col-sm-4 col-xs-6 mt-5 filter-button">
    <div class="js-filter-item filter-toggle degree_cat"  data-category="<?= $cat->term_id; ?>">
      <a data-category="<?= $cat->term_id; ?>">
      <div class="fontawesome-icons">
        <span class="icon <?php echo get_field('taxonomy_icon', $cat); ?>"></span>
      </div>
  <div > <?= $cat->name ?></div>
  </a>
  </div>
  </div>

  <?php
  endforeach;
   ?>
  </div>
  <?php $reset_tax = get_terms('interest_area'); ?>
  <div class="reset-btn-container">
    <div class="btn blue-btn">
      <a data-category="" id="reset_degree_cat_filter">Reset</a>
    </div>
  </div>
</div>



<div class="filter-container container">


<div class="js-filter row">

<?php
$custom_tax = get_terms('interest_area');
$argss = array(
  'post_type' => 'page',
  'posts_per_page' => -1,
  'tax_query' => (array(
    array(
      'taxonomy' => 'interest_area',
      'field' => 'term_id',
      'terms' => wp_list_pluck($custom_tax, 'term_id')
    ),
)
),
  'order' => 'asc',
);

$query = new WP_Query($argss);

if($query->have_posts()) :
  while($query->have_posts()) : $query->the_post();
  get_template_part('template-parts/interest-area-list-item');
endwhile;
endif;
wp_reset_postdata();

 ?>
</div>

</div>



 <?php

  get_footer(); ?>
