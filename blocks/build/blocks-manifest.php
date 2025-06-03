<?php
// This file is generated. Do not modify it manually.
return array(
	'menu-fetcher' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pm/menu-fetcher',
		'version' => '0.1.0',
		'title' => 'Menu fetcher',
		'category' => 'widgets',
		'icon' => 'menu',
		'description' => 'Display a classic menu',
		'supports' => array(
			'html' => false,
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'layout' => array(
				'allowOrientation' => true,
				'default' => array(
					'orientation' => 'horizontal'
				),
				'allowSwitching' => true
			)
		),
		'attributes' => array(
			'selectedMenu' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'textdomain' => 'pm',
		'editorStyle' => 'file:./index.css',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	)
);
