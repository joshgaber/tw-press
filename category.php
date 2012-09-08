
<?php get_header(); ?>

	<div id="content">
	
<?php the_post(); ?>			
	
		<h1 class="page-title"><?php _e( 'Category Archives:', 'your-theme' ) ?> <span><?php single_cat_title() ?></span></span></h1>
		<?php $categorydesc = category_description(); if ( !empty($categorydesc) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); ?>

<?php rewind_posts(); ?>
	
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

<?php while ( have_posts() ) :

the_post(); ?><div id="post-<?php the_ID(); ?>" <?php post_class("span6"); ?>>

			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'your-theme'); ?></span>
				<span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
				<?php edit_post_link( __( 'Edit', 'your-theme' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>
			</div><!-- .entry-meta -->
			
			<div class="entry-summary">	
<?php the_excerpt(); ?>
				<p class="entry-commands"><a class="btn btn-info" href="<?php the_permalink(); ?>"><i class="icon-book icon-white"></i> <?php _e( 'Continue reading', 'your-theme' ); ?></a></p>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
			</div><!-- .entry-summary -->

			<div class="entry-utility well well-small">
<?php if ( $cats_meow = cats_meow(', ') ) : // Returns categories other than the one queried ?>
				<span class="cat-links"><?php printf( __( 'Also posted in %s', 'your-theme' ), $cats_meow ) ?></span>
				<span class="meta-sep"> | </span>
<?php endif ?>
				<?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged ', 'your-theme' ) . '</span>', ", ", "</span>\n\t\t\t\t\t\t<span class=\"meta-sep\">|</span>\n" ) ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'your-theme' ), __( '1 Comment', 'your-theme' ), __( '% Comments', 'your-theme' ) ) ?></span>
				<?php edit_post_link( __( 'Edit', 'your-theme' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
			</div><!-- #entry-utility -->	
		</div><?php endwhile; ?><!-- .post -->
	
	</div><!-- #content -->

<?php get_footer(); ?>