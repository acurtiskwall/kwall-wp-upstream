<?php

/**
 * home-slider Block Template.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'home-slider-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'home-slider';
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
<?php
 if( have_rows('slides') ):

 ?>
<div class="row">
<div class="flexslider hero-slideshow">
  <ul class="slides">
  <?php while( have_rows('slides') ): the_row();
    $bg_img = get_sub_field('hero_image'); ?>
    <li class="">
        <div class="home-bg-img" style="background:url('<?php echo $bg_img['url']; ?>');">
            <div class="container">
              <div class="row align-items-center banner-inner">
              <div class="col-md-7 col-12">
                <div class="title-wrap">
                  <h1 class="hero-title"><?php echo get_sub_field('hero_title'); ?></h1>
                </div>
              <p class="hero-copy"><?php echo get_sub_field('hero_copy'); ?></p>
            </div>
              </div>
            </div>
        </div>

    </li>
<?php endwhile; ?>
</ul>
</div>
</div>
<?php else: ?>
<?php endif; ?>

<div class="hero-white-corner-wrap">
  <div class="container m-auto">

      <?php

      // Check rows exists.
      if( have_rows('slides') ):
        ?>
        <div class="row align-items-center justify-content-center hero-white-corner-inner">

          <ol class="flex-control-nav flex-control-paging custom-controls-container">


        <?php
          // Loop through rows.
          while( have_rows('slides') ) : the_row();

              // Load sub field value.
              $number = get_sub_field('number');
              $cta = get_sub_field('cta');
              // Do something...?>

              <li class="col-sm-3 col-12 custom-navigation">
                <a href="#" class="">
                <div class="hero-number">
                    <?php echo $number; ?>
                    <span class="progress_bar"></span>
                  </div>
                <div class="hero-cta-wrap">
                  <?php echo $cta; ?>
                </div>
                </a>
              </li>


    <?php  // End loop.
          endwhile;

      // No value.
      else :?>
      </ol>
    </div>
      <?php
          // Do something...
      endif;
    ?>
  </div>
</div>

</div>
</div>
<script type="text/javascript">
		jQuery( document ).ready(function($) {
$(window).load(function() {
$('.flexslider').flexslider({
  animation: "slide",
  customControlsContainer: $(".custom-controls-container"),
  manualControls: $(".custom-controls-container li"),
  controlNav: true,
  pauseOnHover: true,
  directionNav: false,
  //after: function(slider){
//    $(silder).find(".flex-active-slide").addClass("active");
//  },
  //before: function (slider) {
  //$('.hero-number .progress_bar').removeClass('active');
//  $('.flex-control-nav li a .progress_bar').addClass('active');
//      },
});
});
});
</script>
