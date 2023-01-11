  <?php $group = get_field('program_options');
  $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-size', true )[0];
  $alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
  $bio = get_field('short_bio');
  $email =  get_field('email');
  $phone = get_field('phone');
  $caption = wp_trim_words(get_field('caption'), 15, '...');
   ?>

<div class="col-12 col-lg-6 person-info-wrapper">
  <div class="person-info-wrapper-col">

    <?php if(empty($thumbnail_src) ):?>
      <img src="<?= $thumbnail_src; ?>" alt="<?=$alt_text?>">

    <?php else: ?>

      <img src="/wp-content/uploads/2022/09/silhouette.png" alt="" >
		<?php endif; ?>


<div class="user-person-info">
  <h4 class="user-name"><?php the_title();?></h4>
  <div class="user-caption">
    <?= $caption;  ?>
  </div>
  <div class="user-email">
    <a href="mailto:<?=$email;?>"> <?= $email;?></a>
  </div>
  <div class="user-phone">
    <a href="tel:<?=$phone?>"><?= $phone;?></a>
  </div>
  <div class="user-bio">
    <?= $bio;?>
  </div>


  <div class="interest-degree-wrap">
  <span class=" <?=$group['degree_icon']; ?>"></span>   <?= $group['degree']; ?>
  </div>
</div>
</div>
</div>
