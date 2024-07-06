<?php

/**
 * Register a custom menu page.
 */
function test_plugin_custom_menu_page(){
	add_menu_page( 
		__( 'Test plugin', 'textdomain' ),
		__( 'Test plugin', 'textdomain' ),
		'manage_options',
		'test-plugin',
		'test_plugin_menu_page',
		'dashicons-pets',
		25
	); 
}
add_action( 'admin_menu', 'test_plugin_custom_menu_page' );

/**
 * Display a custom menu page
 * 
 */
function data_table_search($item){
	$name = strtolower($item['name']);
	$search_name = strtolower( $_REQUEST['s']);
	if(strstr($name, $search_name) !== false){
		return true;
	}
	return false;
		
}

function test_plugin_menu_page(){
	  
	include_once 'list_table.php';
	include_once 'data.php';

	

	$orderby = $_REQUEST['orderby'] ?? '';
	$order = $_REQUEST['order'] ?? '';
	 

	if( isset( $_REQUEST['s'] ) && !empty( $_REQUEST['s']) ){
		$search_name = $_REQUEST['s'];
		$data = array_filter($data, 'data_table_search' ); 
	}

	if($orderby == 'age'){
		if( $order == 'asc'){
			usort($data, function($item1, $item2){				
				return $item2['age'] <=> $item1['age'];
			});
		}else{
			usort($data, function($item1, $item2){
				return $item1['age'] <=> $item2['age'];
			});
		}
	}

	if($orderby == 'name'){
		if( $order == 'asc'){
			usort($data, function($item1, $item2){				
				return $item2['name'] <=> $item1['name'];
			});
		}else{
			usort($data, function($item1, $item2){
				return $item1['name'] <=> $item2['name'];
			});
		}
	}



	$table = new Test_table();
	$table->set_deta($data);
	$table->prepare_items();
	?> 
		<div class="wrap">
			<h2> <?php _e('person', 'textdomain') ?></h2>
			<form action="" method="GET">
				<?php 
				$table-> search_box('search', 'search_id');
				$table->display();
				?>
				<input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>">
			</form>
		</div>
	<?php
	
	
}

// include 'list_table.php';



