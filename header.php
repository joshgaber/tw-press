<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php
    	bloginfo('name'); print ' | ';
        if ( is_single() ) { single_post_title(); }       
        elseif ( is_home() || is_front_page() ) { bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { print 'Search results for ' . esc_html($s); get_page_number(); }
        elseif ( is_404() ) { print 'Not Found'; }
        else { wp_title(''); get_page_number(); }
    ?></title>
	
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/prettify.css">
	
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/png">
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php wp_head(); ?>
	
	<!--[if lt IE 9]>
	<script type="text/javascript" src="/wp-includes/js/html5shiv.js"></script>
	<![endif]-->
	
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'your-theme' ), esc_html( get_bloginfo('name') ) ); ?>">
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'your-theme' ), esc_html( get_bloginfo('name') ) ); ?>">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">	
</head>

<body <?php body_class(); ?> onload="prettyPrint()">

<ul id="access" class="sr-only">
	<li><a href="#topnav-collapse">Go to navigation</a></li>
	<li><a href="#content" title="<?php _e( 'Skip to content', 'your-theme' ) ?>"><?php _e( 'Skip to content', 'your-theme' ) ?></a></li>
</ul>
	
<div id="wrapper" class="hfeed">
	
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topnav-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php bloginfo('siteurl'); ?>"><?php bloginfo("name"); ?></a>
			</div>
		
			<div class="navbar-collapse collapse" id="topnav-collapse">
				<?php wp_nav_menu(
					array(
						'theme_location' => "topnav",
						'container' => NULL,
						'menu_class' => "nav navbar-nav",
						'walker' => new Walker_tb_nav()
					)
				); ?>
				<ul id="recent-posts-nav" class="navbar-nav nav">
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Recent Posts <b class="caret"></b></a>
						<ul class="dropdown-menu">
		<?php foreach (wp_get_recent_posts(array('numberposts' => 5, 'post_status' => 'publish')) as $p) : ?>
		
							<li><a href="<?php print get_permalink($p['ID']); ?>" title="<?php print $p['post_title']; ?>"><strong><?php print strftime("%B %e, %Y", strtotime($p['post_date'])); ?></strong> - <?php print $p['post_title']; ?></a></li>
							
		<?php endforeach; ?>
						</ul>
					</li>
				</ul>
				<?php get_search_form(); ?>
			</div>
		</div>
	</nav><!-- nav.navbar -->

	<header><div id="header-inner" class="container">
		
		<div id="masthead">
		
			<a id="blog-title" href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a>
			<?php if (is_front_page()) { ?>
				<h1 id="blog-description"><?php bloginfo( 'description' ) ?></h1>
			<?php } else { ?>
				<div id="blog-description"><?php bloginfo( 'description' ) ?></div>
			<?php } ?>
			
		</div><!-- #masthead -->
		
	</div></header><!-- header -->
	
	<section>
		<div id="section-inner" class="container inner">
