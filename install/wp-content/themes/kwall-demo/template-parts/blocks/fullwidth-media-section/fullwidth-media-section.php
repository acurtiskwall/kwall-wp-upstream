<?php

/**
 * Next Step Block Template.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'next-step-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'next-step';
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
$bg_img = get_field('background_image');
 ?>
 <div class="banner-wrap next-step-banner-wrap ">
 <div class="row home-bg-img" style="background-image:url('<?php echo $bg_img['url']; ?>')">
   <div class="banner-overlay d-none d-sm-table">
     <div class="container">
       <div class="next-step-white-corner-wrap">
         <div class="container m-auto">
           <h2 class="request-title"><?php echo get_field('title'); ?></h2>
             <?php

             // Check rows exists.
             if( have_rows('buttons') ):
               ?>
               <div class="row align-items-center justify-content-center next-step-white-corner-inner">


               <?php
                 // Loop through rows.
                 while( have_rows('buttons') ) : the_row();

                     // Load sub field value.

                     $link = get_sub_field('button_link');
                       if( $link ):
                           $link_url = $link['url'];
                           $link_title = $link['title'];
                           $link_target = $link['target'] ? $link['target'] : '_self';

                     // Do something...?>

                     <a href="<?php echo esc_url( $link_url ); ?>"target="<?php echo esc_attr( $link_target ); ?>" class="btn blue-btn">
                      <?php echo esc_html( $link_title ); ?>
                     </a>
                    <?php endif; ?>

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
       </div>
     </div>

     </div>
     </div>
       </div>
       <div class="banner-overlay d-sm-none">
        <div class="container-fluid">
          <div class="next-step-white-corner-wrap">
            <div class="container m-auto">
              <h2 class="request-title"><?php echo get_field('title'); ?></h2>
                <?php

                // Check rows exists.
                if( have_rows('buttons') ):
                  ?>
                  <div class="row align-items-center justify-content-center next-step-white-corner-inner">


                  <?php
                    // Loop through rows.
                    while( have_rows('buttons') ) : the_row();

                        // Load sub field value.

                        $link = get_sub_field('button_link');
                          if( $link ):
                              $link_url = $link['url'];
                              $link_title = $link['title'];
                              $link_target = $link['target'] ? $link['target'] : '_self';

                        // Do something...?>

                        <a href="<?php echo esc_url( $link_url ); ?>"target="<?php echo esc_attr( $link_target ); ?>" class="btn blue-btn">
                         <?php echo esc_html( $link_title ); ?>
                        </a>
                       <?php endif; ?>

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
          </div>
        </div>

        </div>
</div>
</div>
