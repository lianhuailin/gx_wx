<?php
	include("conn.php");
	
	$batch = $_POST['batch'];
	if ($batch == 4) {                      //本次兼职需要招募人数--------------------------------------------
		define('SIGNUP_NUMBER', 6);      //兼职栏目1-------------
	}
	elseif ($batch == 2)
	{
		define('SIGNUP_NUMBER', 10);   //兼职栏目2----------------
	}
	elseif ($batch == 3) {
		define('SIGNUP_NUMBER', 25);   //兼职栏目3-----------------
	}
	$result = mysql_query("SELECT * FROM `db_parttime` WHERE batch = $batch");
	$number = mysql_num_rows($result);
	$remain = 0;
	$remain = SIGNUP_NUMBER-$number; 
	echo $remain;
?>