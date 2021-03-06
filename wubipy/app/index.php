<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> 五笔拼音互查 </TITLE>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="bjmayor">
  <META NAME="Keywords" CONTENT="五笔，拼音，查找，吃饭照">
  <META NAME="Description" CONTENT="提供五笔和拼音查找的功能，方便用户学习五笔">
  <link href="../static/css/global.css" type="text/css" rel="stylesheet">
  <script src="http://app.baidu.com/static/appstore/monitor.st"></script>
  <script src="../static/js/jquery.1.5.2.js"></script>
  <style>
  body{
	margin:0;
	padding:0;
	background:none repeat scroll 0 0 #F0F0F0;
}
#content{
	display:block;
	text-align:left;
	width :400px;
	height:200px;
}
#wrap{
	left:50%;
	position:absolute;
	top:50%;
	margin:-150px 0 0 -230px;
}
#flashContent
{
	position:relative;
    background:url("../static/img/bg.png") no-repeat scroll 0px 0px transparent;
    width:450px;
    height:300px;
}
#main
{
    margin-left:74px;
    width:300px;
    height:300px;
    padding-top:66px;
}
</style>
 </HEAD>

 <BODY>
<div id="wrap">
<div id="flashContent">
<div id="main">
<div id="note">
<pre>
功能：获取一个汉字的拼音和五笔(<a href="http://wubipy.sinaapp.com/table.html" target="_blank" >字根口诀</a>)
请输入一个汉字：
</pre>
</div>
<form name="search"  action="javascript:search();">
<div class="form_wap">
    <input type="input" name="key" id="key" autocomplete="off"  maxlength=1/>
    <input type="submit" onmouseout="this.className='btn'" onmousedown="this.className='btn btn_h'" class="btn" id="su" value="">
</div>
</form>
<!--div class="message"　style="display:none"></div-->
<div style="display:none" id="result">
<div><ul class="li_float head"><li class="hanzi-bg"></li><li class="pinyin-bg"></li><li class="wubi-bg"></li></ul></div>
<div><ul class="li_float"><li  class="zi"><span id="hanzi"></span></li><li  class="zi"><span id="pinyin"></span></li><li  class="zi"><span id="wubi"></span></li></ul></div>
<p class="clr"></p>
</div>
</div>
</div>
</div>
</div>




<script>
var isshow=false;
var url={};
url.search = "../port/s.php";

function clean()
{
		$("#pinyin").html("");
		$("#wubi").html("");
}
function search()
{
	var hanzi =$("#key").val();
//    if(!/^[\u4E00-\u9FA5]$/.test(hanzi))//check
//    {
//        $(".message").html("请输入一个汉字");
//        $(".message").show();
//    }
//    else
//    {
//        $(".message").hide();
//    }
	$("#hanzi").html(hanzi);
    if(hanzi)
    {
        $.get(url.search+"?h="+encodeURIComponent(hanzi)+"&rand="+(new Date()-0),function(data)
        {
            var res = eval("("+data+")");
            if(res.wubi){
                $("#wubi").html(res.wubi);
                $("#pinyin").html(res.pinyin);
            }
            else{
                clean();
            }
        });
    }
    else{
         clean();
    }
     if(!isshow)
    {
        $("#result").show();
        isshow=true;
    }
}

</script>

 </BODY>
</HTML>
