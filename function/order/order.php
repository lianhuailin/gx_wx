<?php
	function order($isTrue,$goodsName,$number,$buyerName,$buyerMobile,$buyerRidgepole,$buyerRoom)
	{
		if(isTrue == "true") {
			include('../parttime/conn.php');   
			$sql = "INSERT INTO `dd_goods`(`id`, `goodsname`, `number`, `buyername`, `buyermobile`, `buyerridgepole`, `buyerroom`, `time`) 
                                    VALUES (null,'$goodsName',$number,'$buyerName','$buyerMobile',$buyerRidgepole,$buyerRoom,NOW())";
            $result = mysql_query($sql);
            $row = mysql_affected_rows();
            if($row == 1) 
                $contentStr = "$buyerName同学成功订购$goodsName$number份!请等待工作人员配送！";
            else
                $contentStr = "订购失败！请正确输入订购指令。";
            mysql_close($conn);	
		} else {
			$contentStr = "抱歉，现在没有商品在售。";
		}
		return $contentStr;
	}
?>