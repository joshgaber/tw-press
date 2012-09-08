<?php get_header(); ?>

	<div id="content">
	
<?php
if (($page = get_page_by_title("Index"))) {
	print $page->post_content;
	print '<hr>';
}
?>
	
<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
		<ul class="navigation pager">
<?php if (get_previous_post()) : ?>
			<li class="previous"><?php previous_posts_link( '&larr; Older Posts', 'your-theme' ) ?></li>
<?php endif; ?>
<?php if (get_next_post()) : ?>
			<li class="next"><?php next_posts_link( 'Newer Posts &rarr;', 'your-theme' ) ?></li>
<?php endif; ?>
		</ul><!-- #nav-below -->
<?php } ?>		

<div class="row">
<?php /* The Loop — with comments! */ ?>			
<?php while ( have_posts() ) : the_post() ?>

<?php /* Create a div with a unique ID thanks to the_ID() and semantic classes with post_class() */ ?>		
		<div id="post-<?php the_ID(); ?>" <?php post_class("span6"); ?>>				
<?php /* an h2 title */ ?>							
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			
<?php /* Microformatted, translatable post meta */ ?>										
			<div class="entry-meta">
				<span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'your-theme'); ?></span>
				<span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
			</div><!-- .entry-meta -->

<?php /* The entry content */ ?>					
			<div class="entry-content">	
<?php the_excerpt(); ?>
				<p class="entry-commands"><a class="btn btn-info" href="<?php the_permalink(); ?>"><i class="icon-book icon-white"></i> <?php _e( 'Continue reading', 'your-theme' ); ?></a></p>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
			</div><!-- .entry-content -->

<?php /* Microformatted category and tag links along with a comments link */ ?>					
			<div class="entry-utility well well-small">
				<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', 'your-theme' ); ?></span><?php echo get_the_category_list(', '); ?></span>
				<span class="meta-sep"> | </span>
				<?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged ', 'your-theme' ) . '</span>', ", ", "</span> <span class=\"meta-sep\">|</span>\n" ) ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'your-theme' ), __( '1 Comment', 'your-theme' ), __( '% Comments', 'your-theme' ) ) ?></span>
				<?php edit_post_link( __( 'Edit', 'your-theme' ), "<span class=\"meta-sep\">|</span> <span class=\"edit-link\">", "</span>" ) ?>
			</div><!-- #entry-utility -->	
		</div><!-- #post-<?php the_ID(); ?> -->

<?php /* Close up the post div */ ?>			

<?php endwhile; ?>
	
	</div><!-- #content -->

<?php get_footer(); ?>