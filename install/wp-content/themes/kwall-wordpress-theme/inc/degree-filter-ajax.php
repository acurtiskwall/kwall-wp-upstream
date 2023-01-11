

<?php

add_action('wp_ajax_nopriv_filter', 'filter_ajax');
add_action('wp_ajax_filter', 'filter_ajax');



function filter_ajax() {

  $category = $_POST['category'];
  $search = $_POST['search'];

  if(empty($search) && !empty($category)) {
    $args = array(
      'post_type' => 'page',
      'posts_per_page' => -1,
      //'relation' => 'AND',
      'tax_query' => array(array(
        'taxonomy' => 'interest_area',
        'field' => 'term_id',
        'terms' => $category
      ),
    )
    );
  }elseif(!empty($search) && !empty($category)){
    $args = array(
      'post_type' => 'page',
      'posts_per_page' => -1,
      'title_filter'=> $search,
      'relation' => 'AND',
      'tax_query' => array(array(
        'taxonomy' => 'interest_area',
        'field' => 'term_id',
        'terms' => $category
      ),
    )
    );
  }elseif(empty($category) && !empty($search)){
    $args = array(
      'taxonomy' => 'interest_area',
      'title_filter'=> $search,
      'post_type' => 'page',
      'posts_per_page' => -1
    );
  }else{
    $custom_tax = get_terms('interest_area');
    $args = array(
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
  }

  add_filter('posts_where', 'title_filter', 10, 2);

  $query = new WP_Query($args);

  remove_filter('posts_where', 'title_filter', 10, 2);

  if($query->have_posts()) :
    while($query->have_posts()) : $query->the_post();
    get_template_part('template-parts/interest-area-list-item');
    endwhile;
  else:
    echo "<p class='no-result'>No match found. Try a different name or search keyword</p>";
  endif;
  wp_reset_postdata();

    die();
}

function load_scripts() {

wp_enqueue_script('ajax' , get_template_directory_uri() . '/js/degree-filter-ajax.js', array('jquery'), NULL, true);
wp_localize_script('ajax', 'ajax_url', admin_url('admin-ajax.php'));

}


add_action( 'wp_enqueue_scripts', 'load_scripts');
 ?>
