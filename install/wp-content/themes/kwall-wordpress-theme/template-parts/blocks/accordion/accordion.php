<?php

/**
 * Accordion Block.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordion';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( $is_preview ) {
    $className .= ' is-admin';
}

$accordion_id = get_field('accordion_id');
$args = array('accordion_items' => get_field('accordion_items'));

  ?>
<section class="accordian-section bg-white">
	<div class="container">
		<div class="row">

			   <div class="accordion accordion-flush" id="accordion">
			        <?php
			        $s=1;
			        $i = 1;
			        foreach ($args['accordion_items'] as $items) {
			            ?>

                  <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-heading<?php echo $s; ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $s; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $s; ?>">
                      <?php echo $items['title']; ?>
                    </button>
                  </h2>
                  <div id="flush-collapse<?php echo $s; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $s; ?>" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"><?php echo $items['body']; ?>
                    </div>
                  </div>
                </div>


			            <?php
			            $i++;
			            $s++;
			        } ?>
			    </div>

		</div>
	</div>
</section>
