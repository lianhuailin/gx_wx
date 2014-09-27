<?php

define(SCHOOL_BUY_134, "06:50广州→南海
\n11:30广州→南海
\n13:20广州→南海
\n09:50南海→广州
\n11:30南海→广州
\n16:20南海→广州
\n18:00南海→广州");

define(SCHOOL_BUY_TUE, "06:50广州→南海
\n11:30广州→南海
\n18:00广州→南海
\n11:30南海→广州
\n18:00南海→广州
\n22:00南海→广州");

define(SCHOOL_BUY_FRI, "18:30广州→南海
\n22:00南海→广州");

define(SCHOOL_BUY_WEEKEND, "16:30广州→南海
\n17:50南海→广州 ");

	function schoolbus($day)
	{
		if($day == null) {
            $contentStr = "●●周一、三、四、五\n".SCHOOL_BUY_134."
                        \n●●周二\n".SCHOOL_BUY_TUE."
                        \n●●周五\n".SCHOOL_BUY_FRI."
                        \n●●周末\n".SCHOOL_BUY_WEEKEND."
                        \n/:jump您还可以查询某一天校车。例如查询周一校车，可发送指令【校车+周一】。或者查看<a href='http://218.244.133.27/wx/function/schoolbus/index.html'>图片版</a>"
                        ;
                        return $contentStr;
        }
        switch ($day) {
            case '周一':
            case '周三':
            case '周四':
                $contentStr = SCHOOL_BUY_134;
                break;

            case '周二':
                $contentStr = SCHOOL_BUY_TUE;
                break;

            case '周五':
                $contentStr = SCHOOL_BUY_FRI;
                break;

            case '周六':
            case '周日':
            case '周末':
                $contentStr = SCHOOL_BUY_FRI;
                break;
            
            default:
                $contentStr = "亲！出错了！你再发送【校车】试试吧！或查看<a href='http://218.244.133.27/wx/function/schoolbus/index.html'>图片版</a>";
                break;
		}
        return $contentStr;
	}
?>