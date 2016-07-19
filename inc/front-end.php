<?php

	global $wpdb;
	
	echo $before_widget;
	
/*	if(isset($_GET['table'])) { $title = $_GET['table']; }*/
	
	echo $before_title . $title . $after_title;	
	
	if(isset($_GET['table'])) {
				
		echo '<a href="?">Back to Table List</a>
		
		<div class="postbox" style="overflow: scroll;">';
				
		$result = $wpdb->get_results( "SELECT * FROM " . $_GET['table']); 
		$colx = $wpdb->get_col( "DESC " . $_GET['table'], 0 );
		$num = 0;
				
		echo '<table border><tr>';
		foreach($colx as $column_name) {
			echo '<th>' . $column_name . '</th>';
		}
		echo '</tr>';
		foreach($result as $row) {
			echo '<tr>';
			foreach($colx as $column_name) {
				echo '<td>' . $row->$column_name . '</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
		echo '</div>';
		}
		
		else {
		$sql1 = "SHOW TABLES LIKE '%'";
		$results = $wpdb->get_results($sql1);

		foreach($results as $index => $value) {
			foreach($value as $db_name) {
        			echo '<a href="?table=' . $db_name . '">' . $db_name . '</a><br />';
    			}
		}
	}
	
	echo $after_widget; 

?>
