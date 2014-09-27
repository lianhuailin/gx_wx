<?php
	function lottery($award_code)
	{
		if($award_code == null) {
            $contentStr = "对不起，请发送抽奖+抽奖码到工学助手进行抽奖！";
        } else {
	        include '../db_conn/conn.php';
	        $sql = "SELECT * FROM gx_activity WHERE award_code = '$award_code' AND used = 0";
	        $result = mysql_query($sql);
	        $row = mysql_fetch_array($result);
	        $result = mysql_num_rows($result);
	        $awards = $row[3];
	        if($result == 1) {
	            $sql = "UPDATE gx_activity SET used = 1 WHERE award_code =  '$award_code' AND used = 0";
	            $result = mysql_query($sql);
	            switch ($awards) {
	                case '1':
	                    $contentStr = "恭喜你在工学抽奖活动中获得/:gift一等奖/:gift，快告诉工作人员吧！/:,@-D";
	                    break;

	                case '2':
	                    $contentStr = "恭喜你在工学抽奖活动中获得/:gift二等奖/:gift，快告诉工作人员吧！/:,@-D";
	                    break;

	                case '3':
	                    $contentStr = "恭喜你在工学抽奖活动中获得/:gift三等奖/:gift，快告诉工作人员吧！/:,@-D";
	                    break;
	                
	                default:
	                    $contentStr = "抱歉！你没有中奖哦。";
	                    break;
	            }
	            return $contentStr;
	        }  else
	        	$contentStr = "你的抽奖码无效或已被使用过！";
	    }
		return $contentStr;
	}
?>