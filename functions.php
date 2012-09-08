<?php


// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'your-theme', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);


// Get the page number
function get_page_number() {
    if (get_query_var('paged')) {
        print ' | ' . __( 'Page ' , 'your-theme') . get_query_var('paged');
    }
} // end get_page_number


// For category lists on category archives: Returns other categories except the current one (redundant)
function cats_meow($glue) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list($separator) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset($cats[$i]);
			break;
		}
	}
	if ( empty($cats) )
		return false;

	return trim(join( $glue, $cats ));
} // end cats_meow


// For tag lists on tag archives: Returns other tags except the current one (redundant)
function tag_ur_it($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset($tags[$i]);
			break;
		}
	}
	if ( empty($tags) )
		return false;

	return trim(join( $glue, $tags ));
} // end tag_ur_it


// Register widgetized areas
function theme_init() {
  	// footer area
  register_sidebar( array (
  'name' => 'Footer Area',
  'id' => 'widget_footer',
  'before_widget' => '',
  'after_widget' => '',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
  ) );
	// Top Nav
  register_nav_menus( array (
  'topnav' => 'Top Navigation'
  ) );
} // end theme_widgets_init

// Add elements to head
function header_scripts() {
	wp_enqueue_script("jquery");
	wp_enqueue_script("jquery-innerlabel", get_bloginfo('template_directory') . "/js/jquery.innerlabel.js", array("jquery"), "0.1");
	wp_enqueue_script("jquery-scrollTo", get_bloginfo('template_directory') . "/js/jquery.scrollTo.js", array("jquery"), "1.4.2");
	wp_enqueue_script("bootstrap", get_bloginfo('template_directory') . "/js/bootstrap.js", array("jquery"), "2.0.4");
	wp_enqueue_script("google-code-prettify", get_bloginfo('template_directory') . "/js/prettify/prettify.js", array(), "1");
}

function header_init() {
	?>
	<script>
	jQuery(document).ready( function() {
		jQuery("#s").innerlabel({
			text: function() { return "Type your search here"; },
			css: {'color': '#ccc', 'font-style': 'italic'}
		});
		jQuery("a.scrollTo[href^='#']").click( function(e) {
			e.preventDefault();
			
			jQuery.scrollTo(jQuery(this).attr("href"));
		});
	});
	</script>
	<?php
}

add_action( 'init', 'theme_init' );
add_action( 'wp_enqueue_scripts', 'header_scripts' );
add_action( 'wp_head', 'header_init' );

// Check for static widgets in widget-ready areas
function is_sidebar_active( $index ){
  global $wp_registered_sidebars;

  $widgetcolumns = wp_get_sidebars_widgets();
		 
  if ($widgetcolumns[$index]) return true;
  
	return false;
} // end is_sidebar_active


// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
	$commenter = get_comment_author_link();
	if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
		$commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	} else {
		$commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	}
	$avatar_email = get_comment_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
	echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link


// Custom callback to list comments in the your-theme style
function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
	?>
  	<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
  		<div class="comment-wrapper well">
	  		<div class="comment-author vcard"><?php commenter_link() ?></div>
	  		
	  		<?php if ($comment->comment_approved == '0') _e("<span class='unapproved'>Your comment is awaiting moderation.</span>", 'your-theme') ?>
	  		<div class="comment-content">
	  			<?php comment_text() ?>
	  		</div>
	  		<div class="comment-meta">
			<?php // echo the comment reply link
				printf(__('Posted %1$s at %2$s', 'your-theme'),
					get_comment_date(),
					get_comment_time());
				if($args['type'] == 'all' || get_comment_type() == 'comment') :
					comment_reply_link(array_merge($args, array(
						'reply_text' => __('Reply','your-theme'), 
						'login_text' => __('Log in to reply.','your-theme'),
						'depth' => $depth,
						'before' => ' <span class="meta-sep">|</span> '
					)));
				endif;
	  			edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>');
			?>
			</div>
	  	</div>
<?php } // end custom_comments


// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
    		<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
    			<div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'your-theme'),
    					get_comment_author_link(),
    					get_comment_date(),
    					get_comment_time() );
    					edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('<span class="unapproved">Your trackback is awaiting moderation.</span>', 'your-theme') ?>
            <div class="comment-content">
    			<?php comment_text() ?>
			</div>
<?php } // end custom_pings



// Bootstrap Elements
function get_tb_edit_button () {
	if (current_user_can('edit_posts')) {
		$html = '<a class="post-edit-link btn btn-info" href="' . get_edit_post_link() . '" title="' . __( 'Edit Page', 'your-theme' ) . '"><i class="icon-pencil icon-white"></i> ' . __( 'Edit', 'your-theme' ) . '</a>';
	} else {
		$html = "";
	}
	
	return $html;
}

function tb_edit_button () {
	print get_tb_edit_button ();
}

class Walker_tb_nav extends Walker_Nav_Menu {

	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
	    $id_field = $this->db_fields['id'];
	    $element->has_parent = (empty($children_elements[$element->$id_field]) ? false : true); 
	    Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

	function start_lvl ( &$output, $depth ) {
		if ($depth == 0)
			$classes = "dropdown-menu";
		
		$output .= "<ul class=\"{$classes}\">";
	}
	
	function start_el ( &$output, $item, $depth ) {
		
		$a = ' title="'.($item->attr_title ? $item->attr_title : $item->title).'"';
		if ($item->xfn)
			$a .= " rel=\"{$item->xfn}\"";
		if ($item->target)
			$a .= " target=\"{$item->target}\"";
	
		if ($item->has_parent) {
			$output .= '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"'.$a.'>'.$item->title.' <b class="caret"></b>';
		} else {
			$output .= '<li><a href="'.$item->url.'"'.$a.'>'.$item->title;
		}
		
		$output .= "</a>";
	}
}