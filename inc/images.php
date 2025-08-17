<?php defined('ABSPATH') or die();

add_filter( 'image_editor_output_format', 'pm__filter_image_editor_output_format' );
function df__filter_image_editor_output_format( array $formats ): array {
	$formats['image/jpeg'] = 'image/avif';
	$formats['image/png'] = 'image/avif';
	/*
		Notes : the .gifs has to be converted in webp with the command
		`ffmpeg -i ./inputfile -vcodec webp -loop 0 -pix_fmt yuva420p ./output.webp`
	 */
	return $formats;
}