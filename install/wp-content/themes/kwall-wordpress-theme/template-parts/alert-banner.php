<?php if( have_rows('alert_repeater','option')): ?>
  <div class="alerts_main_container">
  <?php
  while( have_rows('alert_repeater','option') ) : the_row();
  $color = get_sub_field('alert_color','option');
  $value = $color['value'];
  $current_date_time = current_datetime()->format('Y-m-d H:i:s');
  $expiration = get_sub_field('alert_expiration','option');

  if( $expiration > $current_date_time  ) {
    ?>

      <div class="row alert_msg alert alert-dismissible fade show alert_<?php echo esc_attr($value); ?>" role="alert">
                      <div class="d-flex text_wrap align-items-center">
                          <span class="fa-solid fa-circle-exclamation"></span><strong
                                  class="text-uppercase"><?php echo get_sub_field('title', 'option'); ?></strong> <a
                                  class="text"
                                  href="<?php echo get_sub_field('link', 'option'); ?>"> <?php echo get_sub_field('body', 'option'); ?></a>

                      </div>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                      </button>
              </div>
      <?php
    }
    ?>
    <?php endwhile;?>
  </div>
    <?php else: ?>

<?php endif; ?>
