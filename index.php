<?php

/* 配置项目 */
define(PARTTIME, false); // 现在是否有兼职
define(IS_SELLING, false); //现在是否有商品出售
define(CMD_BRIEF, "输入命令即可为你服务：
【国庆放假】国庆放假
【兼职信息】兼职
【打印文件】打印
【音响租借】音响
【校车信息】校车
【商品信息】订购
【工学简介】简介");

define(CMD_MENU, CMD_BRIEF."\n【移动优惠】优惠
【积分查询】积分+你的学号
【建议】建议+内容+姓名+长短号
【投诉】投诉+内容+姓名+长短号");

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
/* ------- */

define("TOKEN", "gx_wx");
$wechatObj = new wechatCallbackapiTest();
if(isset($_GET['echostr'])) //是否验证
    $wechatObj->valid();
else
    $wechatObj->responseMsg();

class wechatCallbackapiTest
{
    public function valid() {
        $echoStr = $_GET["echostr"];

        if($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $msgType = $postObj->MsgType;
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";

            if ($msgType == 'event')
                if (($postObj->Event) == 'subscribe') {
                    include 'parttime/conn.php';
                    $msgType = "text";
                    $sql = "INSERT INTO `user_gx`(`username`, `userid`, `password`, `sex`, `mobile`, `tele`, `classname`) VALUES 
                    ('$fromUsername',null,null,null,null,null,null)";
                    $result = mysql_query($sql);
                    if (mysql_affected_rows() == 1)  {
                        $contentStr = "你好，这里是工学助手，欢迎您的订阅！工学咨询工作室主要校内业务：环保积分兑换、环保回收、音响租借、积分复印打印、兼职发布、商品活动、广轻纪念明信片出售等业务。详情请咨询工作人员。".CMD_MENU;
                    }
                    else {
                        $contentStr = "欢迎您再次关注工学助手！";
                    }
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    return;
            }

            $msgType = "text";
            $query = explode("+", $keyword);
            switch ($query[0]) {
                case '兼职':
                    if(PARTTIME)
                        $contentStr = "点击此链接进行报名：
                                        \n/:,@f/:,@f/:,@f/:,@f/:,@f
                                        \n<a href='218.244.133.27/wx/parttime/index.php?batch=6'>嘉逸酒店国庆兼职六号</a>
                                        \n/:,@f/:,@f/:,@f/:,@f/:,@f
                                        \n<a href='218.244.133.27/wx/parttime/index.php?batch=7'>嘉逸酒店国庆兼职七号</a>
                                        \n/:,@f/:,@f/:,@f/:,@f/:,@f
                                        \n<a href='218.244.133.27/wx/parttime/index.php?batch=8'>嘉逸酒店国庆兼职一号</a>";
                    else
                        $contentStr = "国庆1、6、7号还有兼职名额，将在今天下午发布信息！";
                    break;

                case '功能':
                    $contentStr = CMD_MENU;
                    break;

                case '积分':  
                    include 'function/integral/integral.php';
                    $contentStr = check_integral($query[1]);
                    break;

                case '订购':
                    include 'function/order/order.php';
                    $contentStr = order(IS_SELLING,$query[1],$query[2],$query[3],$query[4],$query[5],$query[6]);
                    break;

                case '打印':
                    include 'function/print/print.php';
                    $contentStr = print_gx();
                    break;

                case '音响':
                    include 'function/sound_equipment/sound_equipment.php';
                    $contentStr = sound_equipment();
                    break;

                case '优惠':
                    include 'function/privilege/privilege.php';
                    $contentStr = priviliege();
                    break;

                case '简介':
                    include 'function/brief_gx/brief_gx.php';
                    $contentStr = brief_gx();
                    break;

                case '校车':
                    include 'function/schoolbus/schoolbus.php';
                    $contentStr = schoolbus($query[1]);
                    break;

                case 'K5 || k5':
                    $contentStr = "(3元)广轻->阳光在线广场->华师->东软->穆院->狮山广场->狮山政府->罗村医院->罗村政府->乐安桥->佛山火车站->佛山汽车站->佛山中医院->祖庙->祖庙汽车站->建新路->普君北路(地铁站)";
                    break;

                case '抽奖':
                    include 'function/lottery/lottery.php';
                    $contentStr = lottery($query[1]);
                    break;

                case '建议':
                    include 'function/advise/advise.php';
                    $contentStr = advise($query[1],$query[2],$query[3]);
                    break;
                
                case '投诉':
                    include 'function/complaint/complaint.php';
                    $contentStr = complaint($query[1],$query[2],$query[3]);
                    break;
				
				case '国庆放假':
                    include 'function/holiday/holiday.php';
					$contentStr = nationalDay();
                    break;
				
                case '内部at工学':
                    $contentStr = "点击此链接进行报名：
                                        \n/:,@f/:,@f/:,@f/:,@f/:,@f
                                        \n<a href='218.244.133.27/wx/parttime/index.php?batch=6'>嘉逸酒店国庆兼职六号</a>
                                        \n/:,@f/:,@f/:,@f/:,@f/:,@f
                                        \n<a href='218.244.133.27/wx/parttime/index.php?batch=7'>嘉逸酒店国庆兼职七号</a>
                                        \n/:,@f/:,@f/:,@f/:,@f/:,@f
                                        \n<a href='218.244.133.27/wx/parttime/index.php?batch=8'>嘉逸酒店国庆兼职一号</a>";
                    break;

                default: 
                    $contentStr = "工学微信小助手祝你学习进步！\n".CMD_BRIEF."\n更多功能请发送【功能】";
            }

            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
            
        }else{
            echo "";
            exit;
        }
    }



    private function checkSignature()//检查签名
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];    
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );//加密
        if( $tmpStr == $signature )
            return true;
        else
            return false;
        
    }
}

?>
