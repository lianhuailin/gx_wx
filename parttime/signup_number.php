<?php
	include 'conn.php';
	$batch = $_POST['batch'];
	$result = mysql_query("SELECT * FROM `db_parttime` WHERE batch = $batch");
	
	$flag = 1;
	while($row = mysql_fetch_row($result)){
		$info = $flag."&nbsp;&nbsp;&nbsp;姓名:".substr_cut($row[1],5)."&nbsp;&nbsp;&nbsp;&nbsp;电话:".substr($row['3'], 0 , 3)."****".substr($row['3'], 7 , 4)."<br>";
		$flag ++;
    	echo $info;
	}
	function substr_cut($str_cut,$length)
	{
	    if (strlen($str_cut) > $length)
	    {
	        for($i=0; $i < $length; $i++)
	        if (ord($str_cut[$i]) > 128)    $i++;
	        $str_cut = substr($str_cut,0,$i)."*";
	    }
	    return $str_cut;
	}
?>