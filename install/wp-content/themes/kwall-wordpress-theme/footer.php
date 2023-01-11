<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kwall_Demo
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info row align-items-center">
			<div class="">
				<div class="container m-auto footer-center">
					<div class="row">
						<div class="col-md-3 col-12">
							<?php
							the_custom_logo();
						?>
						</div>
						<div class="col-md-6 col-12">
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<div>
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</div><!-- #primary-sidebar -->
							<?php endif; ?>
						</div>
						<div class="col-md-3 col-12">
							<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
								<div>
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</div><!-- #primary-sidebar -->
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

		</div><!-- .site-info -->
		<div class="footer-lower row align-items-center">
			<div class="">
			<div class="container m-auto">
				<div class="row">


				<div class="col-6">
					&copy; <?php echo date ('Y'); ?> <?php echo get_bloginfo( 'name' ); ?>
				</div>
			<div class="col-6 to-top">
				<a href="#" id="totop"> BACK TO THE TOP <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
			</div>
			</div>
			</div>
					</div>
		</div>


	</footer><!-- #colophon -->
</div><!-- #page -->

<script type="text/javascript">
	jQuery(document).ready(function( $ ) {
		$("#totop").on("click", function() {
    $("body").scrollTop(0);
});
	});
</script>

<?php wp_footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
