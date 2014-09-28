<?php
	include ("conn.php");

	$remain = $_POST['remain'];
	$name = $_POST['name'];
	$str_sex = $_POST['sex'];
	$mobile = $_POST['mobile'];
	$tele = $_POST['tele'];
	$class = $_POST['class'];
	$batch = $_POST['batch'];
	$ps = $_POST['ps'];
	$companyName = $_POST['companyName'];
	
	if("男" == trim($str_sex)) {
		$sex = 1;
	} else {
		$sex = 0;
	}

	$batch = $_POST['batch'];
	include 'target_number.php';
	/*if ($batch == 4) {                      //本次兼职需要招募人数--------------------------------------------
		define('SIGNUP_NUMBER', 100);      //兼职栏目1-------------
	}
	elseif ($batch == 5)
	{
		define('SIGNUP_NUMBER', 50);   //兼职栏目2----------------
	}
	elseif ($batch == 3) {
		define('SIGNUP_NUMBER', 25);   //兼职栏目3-----------------
	}*/

	$sql = "SELECT * FROM db_parttime WHERE batch = ".$batch;
	$result = mysql_query($sql);
	$row = mysql_num_rows($result);

	if ($remain > 0 && $row < SIGNUP_NUMBER) {
		$result = mysql_query("INSERT INTO  `db_parttime` (  `id` ,  `name` ,  `sex` ,  `mobile` ,  `tele` ,  `classname` , `ps`,  `time` ,  `batch` ,`companyname` ) 
VALUES ( NULL,  '$name', $sex,  '$mobile', '$tele',  '$class', '$ps', NOW( ) , $batch ,'$companyName' )");
	}

	$result = mysql_affected_rows();
	
	if ($result == 1) {
		$data = "SUCCESS";
	} else {
		$data = "ERROR";
	} 
	echo $data;
?>