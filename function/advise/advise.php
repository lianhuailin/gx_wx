<?php
	function advise($content,$adviserName,$adviserMobile)
	{
		include('../db_conn/conn.php'); 
        if ($content != null) {
            $result = mysql_query("INSERT INTO `ad_gx`(`id`, `content`, `ad_name`, `ad_mobile`, `time`) 
            	VALUES(NULL,'$content','$adviserName','$adviserMobile',NOW())");

            if(mysql_affected_rows())
                $contentStr = "感谢您对工学提供宝贵的建议！";
            else
                $contentStr = "对不起，您输入的信息有误，请重新输入。";
        } else {
            $contentStr = "对不起，您还没有填写对工学的建议！";
        }
        return $contentStr;
	}
?>