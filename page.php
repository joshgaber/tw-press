<?php get_header(); ?>

	<div id="content">
	
<?php the_post(); ?>
		
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>					
<?php tb_edit_button(); ?>
			</div><!-- .entry-content -->
		</div><!-- #post-<?php the_ID(); ?> -->			
	
<?php if ( get_post_custom_values('comments') ) comments_template() // Add a custom field with Name and Value of "comments" to enable comments on this page ?>			
	
	</div><!-- #content -->	
		
<?php get_footer(); ?>