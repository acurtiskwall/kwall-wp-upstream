<?php

/**
 * Hero Banner Block Template.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-banner-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero-banner';
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
<?php $img = get_field('hero_banner');
?>

<div class="hero-banner-block hero-section row">

    <div class="image p-0">
        <img src="<?php echo $img['url']; ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
    </div>
    <div class="container">
        <div class="hero-banner-captions">
            <h1><?php echo get_the_title(); ?></h1>
            <?php  //wpcustomtheme_breadcrumb(true, '/'); ?>
            <?php //bcn_display();?>
            <?php
              // if ( function_exists( 'menu_breadcrumb') ) {
              //     menu_breadcrumb(
              //         'breadcrumb-menu',                             // Menu Location to use for breadcrumb
              //         ' &#47; ',                        // separator between each breadcrumb
              //         '<p class="breadcrumb-items">',      // output before the breadcrumb
              //         '</p>'                              // output after the breadcrumb
              //     );
              // }

          ?>

        </div>
    </div>
</div>
