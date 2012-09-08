<?php /* The Comments Template — with, er, comments! */ ?>			
			<div id="comments">
<?php /* Run some checks for bots and password protected posts */ ?>	
<?php
	$req = get_option('require_name_email'); // Checks if fields are required.
	if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
		die ( 'Please do not load this page directly. Thanks!' );
	if ( ! empty($post->post_password) ) :
		if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
?>
				<div class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'your-theme') ?></div>
			</div><!-- .comments -->
<?php
		return;
	endif;
endif;
?>

<?php /* See IF there are comments and do the comments stuff! */ ?>						
<?php if ( have_comments() ) : ?>

<?php /* Count the number of comments and trackbacks (or pings) */
$ping_count = $comment_count = 0;
foreach ( $comments as $comment )
	get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
?>

<?php /* IF there are comments, show the comments */ ?>
<?php if ( ! empty($comments_by_type['comment']) ) : ?>

				<div id="comments-list" class="comments">
					<h3><?php printf($comment_count > 1 ? __('<span>%d</span> Comments', 'your-theme') : __('<span>One</span> Comment', 'your-theme'), $comment_count) ?></h3>

<?php /* If there are enough comments, build the comment navigation  */ ?>					
<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
					<div id="comments-nav-above" class="comments-navigation">
								<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
					</div><!-- #comments-nav-above -->					
<?php endif; ?>					
				
<?php /* An ordered list of our custom comments callback, custom_comments(), in functions.php   */ ?>				
					<ul class="comments-list">
<?php wp_list_comments('type=comment&callback=custom_comments'); ?>
					</ul>

<?php /* If there are enough comments, build the comment navigation */ ?>
<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>					
	  			<div id="comments-nav-below" class="comments-navigation">
						<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
	        </div><!-- #comments-nav-below -->
<?php endif; ?>					
					
				</div><!-- #comments-list .comments -->

<?php endif; /* if ( $comment_count ) */ ?>
<?php endif /* if ( $comments ) */ ?>

<?php /* If comments are open, build the respond form */ ?>
<?php if ( 'open' == $post->comment_status ) : ?>
				<div id="respond">
    				<h3><?php comment_form_title( __('Post a Comment', 'your-theme'), __('Post a Reply to %s', 'your-theme') ); ?></h3>
    				
    				<div id="cancel-comment-reply"><?php cancel_comment_reply_link() ?></div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
					<p id="login-req"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.', 'your-theme'),
					get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>

<?php else : ?>
					<div class="formcontainer">	
					

						<form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">

<?php if ( $user_ID ) : ?>
							<p id="login"><?php printf(__('<span class="loggedin">Logged in as <a href="%1$s" title="Logged in as %2$s">%2$s</a>.</span> <span class="logout"><a href="%3$s" title="Log out of this account">Log out?</a></span>', 'your-theme'),
								get_option('siteurl') . '/wp-admin/profile.php',
								wp_specialchars($user_identity, true),
								wp_logout_url(get_permalink()) ) ?></p>
<?php else : ?>
							<p id="comment-notes"><?php _e('Your email is <em>never</em> published nor shared.', 'your-theme') ?> <?php if ($req) _e('Required fields are marked <span class="required">*</span>', 'your-theme') ?></p>

              <div id="form-section-author" class="form-section control-group">
								<label for="author"<?php if ($req) _e(' class="required"', 'your-theme') ?>><?php _e('Name', 'your-theme') ?></label>
								<div class="form-input controls"><input id="author" name="author" type="text" value="<?php echo $comment_author ?>" class="span4" maxlength="20" tabindex="3" /></div>
              </div><!-- #form-section-author .form-section -->

              <div id="form-section-email" class="form-section control-group">
								<label for="email"<?php if ($req) _e(' class="required"', 'your-theme') ?>><?php _e('Email', 'your-theme') ?></label>
								<div class="form-input controls"><input id="email" name="email" type="text" value="<?php echo $comment_author_email ?>" class="span4" maxlength="50" tabindex="4" /></div>
              </div><!-- #form-section-email .form-section -->

              <div id="form-section-url" class="form-section control-group">
								<label for="url"><?php _e('Website', 'your-theme') ?></label>
								<div class="form-input controls"><input id="url" name="url" type="text" value="<?php echo $comment_author_url ?>" class="span4" maxlength="50" tabindex="5" /></div>
              </div><!-- #form-section-url .form-section -->

<?php endif /* if ( $user_ID ) */ ?>

              <div id="form-section-comment" class="form-section control-group">
								<label for="comment"><?php _e('Comment', 'your-theme') ?></label>
								<div class="form-textarea controls"><textarea id="comment" name="comment" class="span4" rows="5" tabindex="6"></textarea></div>
              </div><!-- #form-section-comment .form-section -->
              
              <div id="form-allowed-tags" class="form-section">
	              <p><span><?php _e('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'your-theme') ?></span> <code><?php echo allowed_tags(); ?></code></p>
              </div>
							
<?php do_action('comment_form', $post->ID); ?>
                  
							<div class="form-submit"><button id="submit" name="submit" type="submit" class="btn btn-large btn-primary" tabindex="7"><i class="icon-comment icon-white"></i> <?php _e('Post Comment', 'your-theme') ?></button><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></div>

<?php comment_id_fields(); ?>  

<?php /* Just … end everything. We're done here. Close it up. */ ?>  

						</form><!-- #commentform -->										
					</div><!-- .formcontainer -->
<?php endif /* if ( get_option('comment_registration') && !$user_ID ) */ ?>
				</div><!-- #respond -->
<?php endif /* if ( 'open' == $post->comment_status ) */ ?>
			</div><!-- #comments -->
