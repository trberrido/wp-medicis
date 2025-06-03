<?php if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_head', 'pm__meta_tags' );
function pm__meta_tags(): void {

	$image = get_site_icon_url();
	$canonical = get_the_permalink();
	
	if ( is_home() ) {
		$title = get_bloginfo( 'name' );
		$description = get_bloginfo( 'description' );
	} else if ( is_404() ) {
		$title = get_bloginfo( 'name' );
		$description = 'Aucun contenu à cette page (erreur 404)';
	} else {
		$title = get_the_title();
		$description = strip_tags( get_the_excerpt() );
	}

?>

	<meta name="description" content="<?php echo esc_attr( $description ); ?>">
	<link rel="canonical" href="<?php echo esc_attr( $canonical ); ?>" />
	<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
	<meta property="og:title" content="<?php echo esc_attr( $title ); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo esc_attr( $canonical ); ?>" />
	<meta property="og:image" content="<?php echo esc_attr( $image ); ?>" />
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>" />

<?php

}

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );

add_action( 'init', 'pm__disable_emojis' );
function pm__disable_emojis(): void {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}