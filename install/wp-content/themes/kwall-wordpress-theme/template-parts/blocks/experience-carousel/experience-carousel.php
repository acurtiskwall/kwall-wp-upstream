<?php

/**
 * your experience Block Template.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'experience-carousel-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'experience-carousel';
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
  <div class="container">


  <div class="title-wrap">
    <h2 class="request-title"><?php echo get_field('experience_title'); ?></h2>
  </div>
</div>
<div class="container">
  <?php
   if( have_rows('experience_repeater') ):

   ?>

   <div class="experience-tab-wrap">
   <div class="owl-carousel" id="thumb">

    <?php while( have_rows('experience_repeater') ): the_row();
      $exp_number = get_sub_field('exp_number');
      $exp_title = get_sub_field('exp_title');
       ?>
       <div class="item">
         <div class="row">
           <div class="">
             <?php echo $exp_number; ?>
           </div>
           <div class="">
             <?php echo $exp_title; ?>
           </div>
         </div>

       </div>



  <?php endwhile; ?>

  <?php else: ?>


  <?php endif; ?>
</div>
</div>
</div>
     <div class="row experience-bg">

  <?php
   if( have_rows('experience_repeater') ):

   ?>


   <div class="owl-carousel" id="carcontent">

    <?php while( have_rows('experience_repeater') ): the_row();

      $feat_img = get_sub_field('experience_image');
      $exp_number = get_sub_field('exp_number');
      $exp_title = get_sub_field('exp_title');
      $exp_copy = get_sub_field('exp_copy');
       ?>
       <div class="item exp-item-wrap">
         <div class="row">
           <div class="col-md-6 col-7">
             <!-- <div class="request-title">
               <?php echo $exp_number; ?>
             </div> -->
             <div class="exp-title">
               <?php echo $exp_title; ?>
             </div>
             <?php $exp_link = get_sub_field('exp_link');
             if( $exp_link ):
              $link_url = $exp_link['url'];
              $link_title = $exp_link['title'];
              $link_target = $exp_link['target'] ? $link['target'] : '_self';
              ?>
             <div class="exp-copy">
               <?php echo $exp_copy;?>
               <a href="<?php echo esc_url( $link_url ); ?>"target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
             </div>
           <?php endif; ?>
           </div>

         <div class="col-md-6 col-6">
           <div class="exp-image-wrap">
             <img src="<?php echo $feat_img['url']; ?>" alt="<?php echo $feat_img['alt']; ?>">
           </div>

         </div>
         </div>
       </div>



  <?php endwhile; ?>

  <?php else: ?>


  <?php endif; ?>
</div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function( $ ){
  var carcontent = $("#carcontent");
  var thumbs = $("#thumbs");
  var syncedSecondary = true;

  thumbs
    .owlCarousel({

    })
  carcontent
    .owlCarousel({

      autoWidth:true,
      items:2,
      loop: false,
      responsiveClass:true,
      nav: true,
      responsive: {
        0:{
          items: 1
        }
      }
    })
});
</script>
