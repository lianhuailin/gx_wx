

var Request = new Object();
Request = GetRequest();
var batch = Request['batch'];
switch(batch)
{
	case '1':
	$("#parttimeInfo").html('新中源大酒店拟招聘多名服务员兼职.<br>要求：女身高不得低于155，男生高不得低于165 。<br>待遇：时薪10块，工资每周二到包接送。<br>工作时间：工作时间为19号（周五）晚上18:00到22:00。<br>集中时间：19号15：30去到校门口');
	break;

	case '2':
	$("#parttimeInfo").html('移动兼职');
	break;

	case '3':
	$("#parttimeInfo").html('兼职信息3');
	break;

	default:
	$("#parttimeInfo").html('暂时没有兼职提供！');
}

//检查还剩多少个名额
var Request = new Object();
Request = GetRequest();
var batch = Request['batch'];
$.post(
"check.php",
{
	data : "remain",
	batch : batch
},
function(data){
if (data != "DatabaseERROR")
	$("#remain").html(data);
else
	$(".hire").html("<h3 style=\"color:red; text-align:center\">数据库连接出错</h3><p style=\"color:#5CB85C; text-align:center\">请尝试<b>刷新</b>或<b>联系工作人员</b></p>");
}
);

//提交表单

$("#signUp").click(function(){
if (dataOK()){
	$('#signUp').button('loading');
	$.post(
	"post.php",
	{	
	"remain": $("#remain").text(),
	"name"  : $("#name").val(),
	"sex"   : $("#sex").val(),
	"mobile": $("#mobile").val(),
	"tele"  : $("#tele").val(),
	"class" : $("#class").val(),
	"ps": $("#ps").val(),
	"batch" : batch   //-----------------------------------------------批次修改------------------
	},
function(data){
if (data == "SUCCESS"){
	$("#signUp").button('reset');
	$("#signUp").html("提交成功！");
	window.location.href="success.php?batch="+batch;
}else{
}
}
);
}
});

//验证表单的合法性
function dataOK(){
var ok = 1;
//验证时否为空
$(".indispensable").each(function(){
console.log($(this).attr("id"));
if ($(this).val() == ""){
$(this).css("border", "2px solid red");
ok = 0;
return false;
}else{
$(this).css("border", "1px solid #ccc");
}
})
if (ok)
return true;
else
return false;
}

function GetRequest() {
var url = location.search; //获取url中"?"符后的字串
var theRequest = new Object();
if (url.indexOf("?") != -1) {
var str = url.substr(1);
strs = str.split("&");
for(var i = 0; i < strs.length; i ++) {
theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
}
}
return theRequest;
}
