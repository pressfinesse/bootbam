<?php get_header(); ?>

<div class="container-fluid">
	<div class="row">
		<?php if ( is_home() ) { ?>
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 float-left">
			<div class="jumbotron">
				<div class="container">
		          		<h1 class="display-3"><?php bloginfo( 'name' ); ?>,</h1>
		         		<p><?php bloginfo( 'description' ); ?></p>
				</div>
			</div>
		</div>


                        <?php if ( is_active_sidebar( 'bootblock-1' ) ) : ?>
				<div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 float-left clearfix">
                                <?php dynamic_sidebar( 'bootblock-1' ); ?>
				</div>
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'bootblock-2' ) ) : ?>
				<div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 float-left clearfix">
                                <?php dynamic_sidebar( 'bootblock-2' ); ?>
				</div>
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'bootblock-3' ) ) : ?>
				<div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 float-left clearfix">
                                <?php dynamic_sidebar( 'bootblock-3' ); ?>
				</div>
                        <?php endif; ?>
		<?php } ?>
	</div>
</div><div class="h25"></div>

<?php get_footer(); ?>

