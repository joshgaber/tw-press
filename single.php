<?php get_header(); ?>

	<div id="content">
	
<?php the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<p class="entry-meta">
				<span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'your-theme'); ?></span>
				<span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
				<?php edit_post_link( __( 'Edit', 'your-theme' ), "<span class=\"meta-sep\">|</span> <span class=\"edit-link\">", "</span>" ) ?>						
			</p><!-- .entry-meta -->
			
			<div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
			</div><!-- .entry-content -->
			
			<div class="entry-utility well well-small">
			<?php printf( __( 'This entry was posted in %1$s%2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>. Follow any comments here with the <a href="%5$s" title="Comments RSS to %4$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.', 'your-theme' ),
				get_the_category_list(', '),
				get_the_tag_list( __( ' and tagged ', 'your-theme' ), ', ', '' ),
				get_permalink(),
				the_title_attribute('echo=0'),
				get_post_comments_feed_link() ) ?>

			</div><!-- .entry-utility -->													
		</div><!-- #post-<?php the_ID(); ?> -->	

<?php if (get_previous_post() or get_next_post()) : ?>
		<ul class="navigation pager">
<?php if (get_previous_post()) : ?>
			<li class="previous"><?php previous_post_link( '%link', '&larr; %title' ) ?></li>
<?php endif; ?>
<?php if (get_next_post()) : ?>
			<li class="next"><?php next_post_link( '%link', '%title &rarr;' ) ?></li>
<?php endif; ?>
		</ul><!-- #nav-below -->
<?php endif; ?>

<?php #comments_template('', true); ?>
<?php comments_template('', true); ?>
	
	</div><!-- #content -->	

<?php get_footer(); ?>