<?php

/**
 * graduation Block Template.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'countdown-cta-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'countdown-cta';
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
<div class="banner-wrap">
<div class="row grad-bg-img" style="background-image:url('<?php echo $bg_img['url']; ?>')">
  <div class="banner-overlay">
    <div class="container">
    <div class="row grad-inner">
      <div class="col-12 align-self-center">
        <h2 class="grad-title"><?php echo get_field('title'); ?></h2>
        <div class="row align-items-center">
          <div class="col-lg-9 col-12">
            <div id="timer"></div>
          </div>
            <div class="col-lg-3 col-12 grad-btn-wrap">
              <?php   $link = get_field('button_link');
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
          <a href="<?php echo esc_url( $link_url ); ?>"target="<?php echo esc_attr( $link_target ); ?>" class="grad-btn btn"><?php echo esc_html( $link_title ); ?></a>
            <?php endif; ?>


            </div>
        </div>

        </div>
        <!-- <div class="col-md-2 col-12 align-self-end">

        </div> -->
      </div>

    </div>
    </div>
  </div>
  </div>
  <div class="grad-bottom row align-items-center ">
    <div class="col-6 grad-bottom-blue">

    </div>
  </div>
  </div>
<script type="text/javascript">
// Set the date we're counting down to
var countDownDate = new Date("<?php echo get_field('timer_end_date'); ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

  // Output the result in an element with id="demo"
  document.getElementById("timer").innerHTML = '<span class="timer-number">' + days + '</span>' + '<span class="timer-word"> days </span>' + '<span class="timer-number">' +hours + '</span>' + '<span class="timer-word"> hours </span>'
  + '<span class="timer-number">' + minutes + '</span>' + '<span class="timer-word"> minutes </span>';

  // If the count down is over, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "EXPIRED";
  }
}, 1000);

</script>
