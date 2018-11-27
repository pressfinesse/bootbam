<footer class="text-muted blog-footer">
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'footerblock' ) ) : ?>
			<div class="col-lg-4 col-md-4 col-xs-12 col-xl-4 col-sm-12 text-center">
				<?php dynamic_sidebar( 'footerblock' ); ?>
			</div>
			<?php endif; ?>

			<div class="col-lg-4 col-md-4 col-xs-12 col-xl-4 col-sm-12 text-center">
		        <span class="text-muted"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
			</div>

			<div class="col-lg-4 col-md-4 col-xs-12 col-xl-4 col-sm-12">
		        <p class="float-right"><a href="#">Back to top</a></p>
			</div>

	        </div>
	</div>
</footer>

<?php wp_footer(); ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body></html>
