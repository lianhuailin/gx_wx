<?php
	function complaint($content,$complainant_name,$complainant_mobile)
	{
		include('../db_conn/conn.php'); 
        if ($content != null && $complaint_mobile != null) {
            $result = mysql_query("INSERT INTO `complained_gx`(`id`, `content`, `complainant_name`, `complainant_mobile`, `time`) VALUES(NULL,'$content','$complainant_name','$complainant_mobile',NOW())");

            if(mysql_affected_rows())
                $contentStr = "您的投诉我们已经收到，谢谢！";
            else
                $contentStr = "对不起，您输入的信息有误，请重新输入。";
        } else {
            $contentStr = "请认真填写投诉信息！";
        }
        return $contentStr;
	}
?>