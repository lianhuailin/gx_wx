<?php
	include "conn.php";
	include 'target_number.php';
	$result = mysql_query("SELECT * FROM `db_parttime` WHERE batch = $batch");
	$number = mysql_num_rows($result);
	$remain = 0;
	$remain = SIGNUP_NUMBER-$number; 
	echo $remain;
?>