<?php
	function check_integral($id)
	{	
		include '../db_conn/conn.php';
		$sql = "SELECT * FROM tp_user where studentid = '$id'";
        $result = mysql_query($sql);
        $row = mysql_num_rows($result);
        if($row == 0) 
            $contentStr = "亲！查不到这个学号哦！是你太大意把自己的学号输错了嘛？/:,@P再试一遍吧。";
        else {
            while ($row = mysql_fetch_array($result))
                $market = $row['integral'];

            $contentStr = "您的学号为：".$id."，查询到的积分为".$market."分。";
        }
		return $contentStr;
	}
?>