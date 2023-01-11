<div class="degree-sidebar-wrap">

    <?php
// Check rows exists.
if( have_rows('button_repeater') ):?>
  <div class="sidebar-buttons">
<?php

    // Loop through rows.
    while( have_rows('button_repeater') ) : the_row();

        // Load sub field value.
        $button = get_sub_field('button');
        $button_url = $button['url'];
        $button_target = $button['target'] ? $button['target'] : '_self';
        $button_title = $button['title'];
?>

    <div class="col-12 button">
      <a href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>"><?php echo $button_title; ?></a>
    </div>




  <?php
      // End loop.
      endwhile;
?>  </div><?php
  // No value.
  else :
    ?>


  <?php endif; ?>
  <?php
  $program_options = get_field('program_options');
  $program_contact = get_field('program_contact');
  $related_resources = get_field('related_resources');
    $accreditation = get_field('accreditation');
  if($program_options):
  ?>
  <div class="program-title">
  <h3>Program Options</h3>
  </div>
  <div class="program-sidebar-group">
    <div class="col-12">
    <span class="<?php echo $program_options['campus_icon']; ?>"></span>
    <?php echo $program_options['campus']; ?>
  </div>
  <div class="">
    <span class="<?php echo $program_options['degree_icon']; ?>"></span>
    <?php echo $program_options['degree']; ?>
  </div>

  </div>
  <?php endif; ?>
  <?php if($program_contact):?>
  <div class="program-title">
    <h3>Contact</h3>

  </div>
  <div class="program-sidebar-group">
    <?php
        $contact = $program_contact['contact_name'];
        $contact_link =   $contact['url'];
        $contact_title = $contact['title'];
     ?>

  <a href="<?php echo $contact_link; ?>"><?php echo $contact_title; ?></a>

  <div class="position">
    <?php echo $program_contact['contact_position']; ?>
  </div>
  <div class="">
      <span class="fa fa-phone"></span> <a href="tel:+1<?php echo $program_contact['contact_phone']; ?>"><?php echo $program_contact['contact_phone']; ?></a>
  </div>

  <div class="">
    <span class="fa fa-mail"></span> <a href="mailto:<?php echo $program_contact['contact_email']; ?>"><?php echo $program_contact['contact_email']; ?></a>
  </div>
  </div>
    <?php endif; ?>

      <?php if($related_resources):
        ?>
        <div class="program-title">
          <h3>Related Resources</h3>
        </div>
    <div class="program-sidebar-group">

      <?php
        if( have_rows( 'related_resources' ) ) : the_row();?>

      <?php

          // Loop through rows.
          while( have_rows('resource_repeater') ) : the_row(); ?>
          <?php
            $icon = get_sub_field('resource_icon');
            $link = get_sub_field('resource_link');
            $link
           ?>
           <div class="col-12">
                  <span class="<?php echo $icon; ?>"></span> <a href="<?php echo $link['url']?>"><?php echo $link['title']?></a>
           </div>


    <?php
        // End loop.
      endwhile;
      endif; ?>
        </div>


      <?php endif; ?>

        <?php if($accreditation):?>

          <img src="<?php echo $accreditation['accreditation_image']['url']; ?>" alt="<?php echo $accreditation['accreditation_image']['alt']; ?>">
          <?php echo $accreditation['accreditation_copy']; ?>

            <?php endif; ?>
</div>
