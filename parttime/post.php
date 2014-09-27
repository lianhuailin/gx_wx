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
	
	if("男" == trim($str_sex))
	{
		$sex = 1;
	}
	else
	{
		$sex = 0;
	}

	if (0<$remain)
	 {
		$result = mysql_query("INSERT INTO  `db_parttime` (  `id` ,  `name` ,  `sex` ,  `mobile` ,  `tele` ,  `classname` , `ps`,  `time` ,  `batch` ) 
VALUES ( NULL,  '$name', $sex,  '$mobile', '$tele',  '$class', '$ps', NOW( ) , $batch )");
	}

	$result = mysql_affected_rows();
	
	if ($result==1) 
	{
		$data = "SUCCESS";
	}
	else
	{
		$data = "ERROR";
	}
	
	echo $data;

?>