<?php
// This file is generated. Do not modify it manually.
return array(
	'goto-parent' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pm/goto-parent',
		'version' => '0.1.0',
		'title' => 'Goto Parent Page',
		'category' => 'widgets',
		'icon' => 'undo',
		'description' => 'If the page a parent page, display its link.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'pm',
		'editorStyle' => 'file:./index.css',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
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
			'interactivity' => true,
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'typography' => array(
				'fontSize' => true
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
			'hasMobileBurger' => array(
				'type' => 'boolean',
				'default' => false
			),
			'selectedMenu' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'textdomain' => 'pm',
		'editorStyle' => 'file:./index.css',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	),
	'meta-fetcher' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pm/meta-fetcher',
		'version' => '0.1.0',
		'title' => 'Meta fetcher',
		'category' => 'widgets',
		'icon' => 'clipboard',
		'description' => 'Pick and display a meta',
		'supports' => array(
			'typography' => array(
				'fontSize' => true,
				'fontStyle' => true
			)
		),
		'attributes' => array(
			'metaKey' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'pm',
		'editorStyle' => 'file:./index.css',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'palmares' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pm/palmares',
		'version' => '0.1.0',
		'title' => 'Palmares',
		'category' => 'widgets',
		'icon' => 'editor-table',
		'description' => 'Palmares',
		'textdomain' => 'pm',
		'viewScriptModule' => 'file:./view.js',
		'editorStyle' => 'file:./index.css',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'supports' => array(
			'interactivity' => true
		)
	),
	'pm-perecs' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pm/perecs',
		'version' => '0.1.0',
		'title' => 'All Perecs',
		'category' => 'widgets',
		'icon' => 'format-status',
		'description' => 'Display all the Perecs',
		'supports' => array(
			'html' => false,
			'interactivity' => true
		),
		'textdomain' => 'pm',
		'editorStyle' => 'file:./index.css',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	),
	'pm-year-filter' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pm/year-filter',
		'version' => '0.1.0',
		'title' => 'Year filter',
		'category' => 'widgets',
		'icon' => 'calendar',
		'description' => 'Display dropdownish menu',
		'supports' => array(
			'html' => false,
			'interactivity' => true
		),
		'textdomain' => 'pm',
		'editorStyle' => 'file:./index.css',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	),
	'related' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pm/related',
		'version' => '0.1.0',
		'title' => 'Related links',
		'category' => 'widgets',
		'icon' => 'admin-links',
		'description' => 'Graduates: display other graduates',
		'textdomain' => 'pm',
		'editorStyle' => 'file:./index.css',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'usesContext' => array(
			'postId',
			'postType'
		)
	)
);
