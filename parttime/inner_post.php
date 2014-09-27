<?php
	include 'conn.php';
	$batch = $_POST['batch'];
	$result = mysql_query("SELECT * FROM `db_parttime` WHERE batch = $batch");
	
	$flag = 1;
	while($row = mysql_fetch_row($result)){
		if($row[2] == 1)
			$row[2] = "男";
		else
			$row[2] = "女";
		if($row[6] == null)
			$row[6] = "无";
		$info = $flag."&nbsp;&nbsp;&nbsp;"."姓名:".$row[1]."&nbsp;&nbsp;&nbsp;性别:".$row[2]."&nbsp;&nbsp;&nbsp;手机:".$row[3]."&nbsp;&nbsp;&nbsp;短号:".$row[4]."&nbsp;&nbsp;&nbsp;备注:".$row[6]."<br>";
		$flag ++;
    	echo $info;
	}
?>