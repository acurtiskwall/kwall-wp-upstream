<div class="col-12 col-lg-4">
  <a class="interest-link" href="<?= the_permalink(); ?>">
  <?php echo get_the_post_thumbnail( $page->ID, 'large' ); ?>
  <h4 class="interest-title"><?php the_title();?></h4>
  <?php $group = get_field('program_options'); ?>
  <div class="interest-degree-wrap">
  <span class=" <?=$group['degree_icon']; ?>"></span>   <?= $group['degree']; ?>
  </div>
</a>
</div>
