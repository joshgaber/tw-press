<?php
	
// [row]
function shortcode_row ( $atts, $content = "" ) {
	return '<div class="row">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'row', 'shortcode_row' );

// [col lg="" md="" sm="" xs="" lg-offset="" md-offset="" sm-offset="" xs-offset=""]
function shortcode_col ( $atts, $content = "" ) {
	$a = shortcode_atts( array(
		'lg' => "",
		'md' => "",
		'sm' => "",
		'xs' => "",
		'lg-offset' => "",
		'md-offset' => "",
		'sm-offset' => "",
		'xs-offset' => "",
	), $atts );
	return '<div class="col-lg-' . $a['lg'] . ' col-md-' . $a['md'] . ' col-sm-' . $a['sm'] . ' col-xs-' . $a['xs'] . ' col-lg-offset-' . $a['lg-offset'] . ' col-md-offset-' . $a['md-offset'] . ' col-sm-offset-' . $a['sm-offset'] . ' col-xs-offset-' . $a['xs-offset'] . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'col', 'shortcode_col' );

// [icon i=""]
function shortcode_icon ( $atts ) {
	return '<span class="glyphicon glyphicon-' . $atts['i'] . '"></span>';
}
add_shortcode( 'icon', 'shortcode_icon' );

// [btn link="#" type="default" target="" class="" title=""]
function shortcode_btn ( $atts, $content = "" ) {
	$a = shortcode_atts( array(
		'link' => "#",
		'type' => "default",
		'target' => "",
		'class' => "",
		'title' => "",
	), $atts );
	
	return '<a class="btn btn-' . $a['type'] . ' ' . $a['class'] . '" href="' . $a['link'] . '" title="' . $a['title'] . '" ' . (empty($a['target']) ? '' : 'target="' . $a['target'] . '"') . '>' . do_shortcode( $content ) . '</a>';
}
add_shortcode( 'btn', 'shortcode_btn' );