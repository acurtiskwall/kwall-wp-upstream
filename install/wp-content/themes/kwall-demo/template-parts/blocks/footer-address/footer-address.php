<?php

/**
 * Footer Address Template.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'footer-address-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'footer-address';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( $is_preview ) {
    $className .= ' is-admin';
}

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> ">
  <div class="col-12">
    <h3> <?php echo get_field('school_name'); ?></h3>
    <?php echo get_field('school_address'); ?>
  </div>

  <?php

  // Check rows exists.
  if( have_rows('social_repeater') ):
    ?>
    <div class="social-links">


    <?php
      // Loop through rows.
      while( have_rows('social_repeater') ) : the_row();

          // Load sub field value.
          $social_icon = get_sub_field('social_icon');
          $social_link = get_sub_field('social_link');
          // Do something...?>

          <a class="social-link <?php echo $social_icon; ?>" href="<?php echo $social_link; ?>"></a>


<?php  // End loop.
      endwhile;

  // No value.
  else :?>
    </div>
  <?php
      // Do something...
  endif;
?>



</div>
