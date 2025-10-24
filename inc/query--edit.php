<?php if ( ! defined( 'ABSPATH' ) ) exit;

add_filter('query_loop_block_query_vars','pm__modify_jury_query_exclude_memoriam');
function pm__modify_jury_query_exclude_memoriam($query_vars){
	$search=isset($query_vars['s'])?$query_vars['s']:'';
	if($search==='!mem'&&(isset($query_vars['post_type'])&&$query_vars['post_type']==='jury')){
		$query_vars['tax_query']=array(
			'relation'=>'AND',
			array(
				'taxonomy'=>'jury_category',
				'field'=>'name',
				'terms'=>array('In memoriam'),
				'operator'=>'NOT IN'
			)
		);
		$query_vars['s']='';
	}
	return $query_vars;
}