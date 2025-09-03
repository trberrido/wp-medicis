<?php defined('ABSPATH') or die();

add_filter( 'image_editor_output_format', 'pm__filter_image_editor_output_format' );
function pm__filter_image_editor_output_format( array $formats ): array {
	$formats['image/jpeg'] = 'image/avif';
	$formats['image/png'] = 'image/avif';
	/*
		Notes : the .gifs has to be converted in webp with the command
		`ffmpeg -i ./inputfile -vcodec webp -loop 0 -pix_fmt yuva420p ./output.webp`
	 */
	return $formats;
}


// WordPress bug when converting .png to .avif
// see https://github.com/WordPress/performance/issues/2018
add_filter( 'wp_handle_upload_prefilter', 'convert_palette_png_to_truecolor' );
function convert_palette_png_to_truecolor( $file ) {
	if ( ! isset( $file['tmp_name'], $file['name'] ) ) {
		return $file;
	}

	$ext = strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) );

	if ( 'png' !== $ext ) {
		return $file;
	}

	$editor = wp_get_image_editor( $file['tmp_name'] );

	if ( is_wp_error( $editor ) || ! $editor instanceof WP_Image_Editor_GD ) {
		return $file; // Skip conversion if not using GD.
	}

	$image = imagecreatefrompng( $file['tmp_name'] );
	if ( ! $image || imageistruecolor( $image ) ) {
		return $file;
	}

	// Preserve transparency.
	imagealphablending( $image, false );
	imagesavealpha( $image, true );

	// Convert the palette to truecolor.
	imagepalettetotruecolor( $image );

	// Overwrite the upload with the new truecolor PNG.
	imagepng( $image, $file['tmp_name'] );
	imagedestroy( $image );

	return $file;
}