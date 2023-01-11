<?php 
if ( $query->have_posts() )
{
	?>
<div class="container newsroom-search-results-container">



	<?php
	while ($query->have_posts())
	{
       $query->the_post();
       $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail', true )[0];
       $alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
       $title = get_the_title( $post->ID );
       $link = get_permalink($post->ID );
       $caption = wp_trim_words(get_the_content(), 15, '...');
    ?>
    <div class="newsroom-article row">
        <a href="<?= $link;?>" class="image-wrapper">
            <img src="<?= $thumbnail_src; ?>" alt="<?=$alt_text?>">
        </a>
        <div class="content-wrapper">
            <div class="category-date">
                    <?php 
                    $terms = get_the_terms( $post->ID, 'category');
                    foreach ( $terms as $term ) {
                        echo '<span class="news-category">' . $term->name . '</span>';
                    }
                    ?>
                <span>|</span>
                <span class="date"><?php the_date(); ?></span>
            </div>
            <h2><a href="<?= $link;?>"><?= $title;?></a></h2>
            <p><?= $caption;?></p>
        </div>
    </div>

    <?php
    }
    ?> 
</div>

    <?php
}?>