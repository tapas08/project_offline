<div class="off-canvas-wrapper">
  <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

    <!-- off-canvas title bar for 'small' screen -->
    <div class="title-bar" data-responsive-toggle="widemenu" data-hide-for="medium">
      <div class="title-bar-left">
        <button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
        <span class="title-bar-title">

			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php endif; ?>
</span>
      </div>
      <div class="title-bar-right">
        <span class="title-bar-title">Login</span>
        <button class="menu-icon" type="button" data-open="offCanvasRight"></button>
      </div>
    </div>

    <!-- off-canvas left menu -->
    <div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
<?php 
$offcanvasnav = array(
	'theme_location'  => 'mobile',
	'menu_class'      => 'menu nav-menu',
	'menu_id'         => 'mobile-menu',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'items_wrap'      => '<ul id="%1$s" class="%2$s vertical dropdown menu data-dropdown-menu">%3$s</ul>',
	'depth'           => -1,
);

wp_nav_menu( $offcanvasnav ); // navigation of you website ?> 
    </div>

    <!-- off-canvas right menu -->
    <div class="off-canvas position-right" id="offCanvasRight" data-off-canvas data-position="right">
   
<?php 
$offcanvasnav = array(
	'theme_location'  => 'mobile',
	'menu_class'      => 'menu nav-menu',
	'menu_id'         => 'mobile-menu',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'items_wrap'      => '<ul id="%1$s" class="%2$s vertical dropdown menu data-dropdown-menu">%3$s</ul>',
	'depth'           => -1,
);

wp_nav_menu( $offcanvasnav ); // navigation of you website ?>  

    </div>

    <!-- "wider" top-bar menu for 'medium' and up -->
  <div class="floatingmenu">  <div id="widemenu" class="top-bar">
   
      <div class="top-bar-left"><nav id="site-navigation" class="main-navigation" role="navigation"><span class="menu-text">Foundation</span>
    <?php wp_nav_menu( array( 'theme_location' => 'primary','fallback_cb' => 'wp_page_menu','items_wrap'      => '<ul id="%1$s" class="%2$s vertical data-drilldown">%3$s</ul>','menu_class'      => 'menu nav-menu' ) ); ?>
</nav>
      </div>
      <div class="top-bar-right">
        <ul class="menu">
           <?php get_search_form(); ?>
        </ul>
      </div>
    </div>
    </div>

    <!-- original content goes in this container -->
    <div data-off-canvas-content>
 