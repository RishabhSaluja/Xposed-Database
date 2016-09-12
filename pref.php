<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function xposed_db_create_table() {

	// Create table according to the details given for each column
	global $table_prefix;
	$table_name = $table_prefix . $_POST['db_name'];

	$qryx;

	for($i = 0; $i < $col_num; $i++) {
		$qryy;
		if ($_POST['primary'][$i] == "on") {
			$qryy = " PRIMARY KEY";
		}	
		if ($_POST['nullx'][$i] == "on") { 
			$qryy = $qryy . " NOT NULL";
		}
		if ($_POST['autoincr'][$i] == "on") { 
			$qryy = $qryy . " AUTO_INCREMENT";
		}
		$qryx = $qryx . $_POST['col_name'][$i] . " " . $_POST['col_type'][$i] . "(" . $_POST['col_len'][$i] . ")" . $qryy . ", ";
	}
	$sql = "CREATE TABLE $table_name (" .$qryx . ");";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
?>
