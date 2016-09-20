<nav class="navbar navbar-default" role="navigation" id="navbar">
  	<div class="container-fluid">
	    <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only"><?php _e('Toggle navigation', 'venture-lite' ); ?></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		       	<span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="<?php echo esc_url(get_home_url()); ?>"><?php bloginfo('name'); ?></a>
	    </div>
        <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
        		'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
    </div>
</nav>