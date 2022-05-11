<?php

/**
 * Future Career Block Template.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'future-career-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'future-career';
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
<div class="career-container-wrap container">
  <div class="row">

    <div class="col-md-4 col-12">
      <div class="title-wrap">
        <h2 class="request-title"><?php echo get_field('career_title'); ?></h2>
      </div>
      <p><?php echo get_field('career_copy'); ?></p>
      <?php   $link = get_field('career_button_link');
        if( $link ):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <div class="btn-wrap">
      <a href="<?php echo esc_url( $link_url ); ?>"target="<?php echo esc_attr( $link_target ); ?>" class="btn blue-btn">
        <?php echo esc_html( $link_title ); ?>
      </a>
    </div>
    <?php endif; ?>
    </div>
    <div class="col-md-8 col-12">


        <?php

        // Check rows exists.
        if( have_rows('career_repeater') ):
          ?>
      <div class="row justify-content-center">
        <?php
            // Loop through rows.
            while( have_rows('career_repeater') ) : the_row();
            $career_icon = get_sub_field('career_icon');
            $career_title = get_sub_field('career_title');
            $career_link = get_sub_field('career_link');
            $career_bg_color = get_sub_field('career_bg_color');
            ?>
            <a href="<?php echo $career_link; ?>" class="career-wrap">
              <div class="icon-container" style="background-color:<?php echo $career_bg_color;?>">
                <div class="icon-inner align-items-center">
                    <i class="<?php echo $career_icon; ?>"></i>
                </div>

              </div>
              <p class="career-title"><?php echo $career_title ?></p>

            </a>
                <?php // End loop.
                endwhile;
                  ?>
      </div>
<?php
        // No value.
        else :
            // Do something...
        endif;
 ?>

    </div>
  </div>
</div>
<div class="container">
  <hr class="blue-hr">
  <?php

  // Check rows exists.
  if( have_rows('stat_repeater') ):
    ?>
<div class="col-12">
  <div class="row">


  <?php
      // Loop through rows.
      while( have_rows('stat_repeater') ) : the_row();
      $stat_number = get_sub_field('stat_number');
      $stat_title = get_sub_field('stat_title');
      ?>

      <div class="col-md-3 col-6 stat-wrap">
        <span class="blue-stat"><?php echo $stat_number; ?></span>
        <hr class="divider">
        <p class="stat-copy"><?php echo $stat_title; ?></p>
      </div>



          <?php // End loop.
          endwhile;
            ?>
</div>
  </div>
<?php
  // No value.
  else :
      // Do something...
  endif;
?>

</div>

</div>
