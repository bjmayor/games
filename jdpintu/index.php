<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
 <HEAD>
  <TITLE> New Document </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="bjmayor">
  <META NAME="Keywords" CONTENT="经典,拼图">
  <META NAME="Description" CONTENT="小时玩的经典拼图游戏">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

 <script type="text/javascript" src="static/js/jquery.1.5.2.js"></script>
<style>
#main{
    margin:0 auto;
    width:460px;
    height:310px;
}
.bkg{
background:url("static/img/22.jpg") no-repeat scroll 0 0 transparent;
width:100px;
height:100px;
float:left;
border:1px solid red;
}
#left{
    width:310px;
    height:310px;
	float:left;
}
#right{
	width:140px;
	float:right;
}
div#right div img{
width:80px;
height:80px;
}

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
	margin:-160px 0 0 -148px;
}
#flashContent
{
	position:relative;
}
div#playuser{
height:200px;
width:80%;
}
div#wrap-left{
width:75%;
}
div#wrap-right{
float:right;
width:20%;
}
</style>
<script src="http://app.baidu.com/static/appstore/monitor.st"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8693049-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
 </HEAD>

 <BODY>
 <div> <div id="wrap-right">
 得分榜
 <ul>
 <li></li>
 </ul>
 </div>
 <div id="wrap-left">
 <div id="playuser">谁在玩。 </div>
 <div id="main">
 <div id="left"></div>
 <div id="right">
	<div class="demo"><img src="static/img/22.jpg"/></div>
	<div class="timer">
	<pre>

时间：<span id="time">0</span>秒
步数：<span id="step">0</span>步
	</pre>
	</div>
	<div class="intro">
	<pre>
↑:图片往上移
↓:图片往下移
←:图片往左移
→:图片往右移
	</pre>
	</div>
 </div>
 </div>
 </div>

 </div>
 <script>

function timer()
{
	this.init = new Date();
	this.fate = function()
	{
		return this.getCurrentTime()-this.starttime;
	}
	this.start=function(vtimer)
	{
		this.starttime = new Date();
		setInterval (function(){		$("#time").html(Math.round(vtimer.fate()/1000));},500);
	}
	this.getCurrentTime = function()
	{
		var time = new Date();
		return time;
	}

}
var pintu=(function()
{
    var obj={blocks:[[],[],[]],rightblocks:9,btime:(new Date()-0),imgw:100,imgh:100};

     function block(x,y)
    {
        this.x=x;
        this.y=y;
        if(x==2 && y==2)
        {
            this.str="<div class=\"bkg\" style=\"background:url('static/img/22.jpg') no-repeat scroll transparent "+-5*obj.imgw+"px  "+-5*obj.imgh+"px;\"></div>";
        }
        else
        {
            this.str="<div class=\"bkg\" style=\"background:url('static/img/22.jpg') no-repeat scroll transparent "+-x*obj.imgw+"px  "+-y*obj.imgh+"px;\"></div>";
        }

    }

    obj.init = function()
    {
        for(i=0;i<3;i++)
        {
            for(j=0;j<3;j++)
            {
                obj.blocks[i][j]=new block(j,i);
            }
        }
    }


    obj.show=function()
    {
		$("#left").html("");
        for(i=0;i<3;i++)
        {
            for(j=0;j<3;j++)
            {
                $("#left").append(obj.blocks[i][j].str);
            }
        }

    }


    obj.shuffle=function(times)
    {
        for(i=0;i<times;i++)
        {
			var r=Math.round(Math.random()*3);
			switch(r)
			{
				case 0:d=obj.right;break;
				case 1:d=obj.left;break;
				case 2:d=obj.up;break;
				case 3:d=obj.down;break;
			}
			if(d)
			{
				obj.swap(obj.empty.i,obj.empty.j, d.i,d.j);
				obj.resetwrap(d.i,d.j);
			}
			else
			{
				i--;
			}
        }
    }

	obj.initwrap = function()
	{
			obj.resetwrap(2,2);
	}
	//重设可移动块i=>y,j=>x
	obj.resetwrap = function(i,j)
	{
			obj.empty={i:i,j:j};
			obj.right=j+1<3?{i:i,j:j+1}:null;
			obj.left=j-1>=0?{i:i,j:j-1}:null;
			obj.down=i+1<3?{i:i+1,j:j}:null;
			obj.up=i-1>=0?{i:i-1,j:j}:null;
	}
	//判断块x,y是否正确
	obj.isright = function(i,j)
	{
		if(obj.blocks[i][j].x==j && obj.blocks[i][j].y==i)
		{
			return 1;
		}
		return 0;
	}
    obj.swap = function(i1,j1,i2,j2)
    {

		var before=obj.isright(i1,j1)+obj.isright(i2,j2);
        var temp=obj.blocks[i1][j1];
        obj.blocks[i1][j1] =  obj.blocks[i2][j2];
        obj.blocks[i2][j2] = temp;
		var after=obj.isright(i1,j1)+obj.isright(i2,j2);
		obj.rightblocks+= after-before;
    }

    obj.canmove=function(block)
    {
    }

    obj.showsuc=function ()
    {
		obj.blocks[2][2].str="<div class=\"bkg\" style=\"background:url('static/img/22.jpg') no-repeat scroll transparent "+-2*obj.imgw+"px  "+-2*obj.imgh+"px;\"></div>";
		obj.show();
		$(document).unbind();
        alert("恭喜您，完成任务");
    }

    obj.isfinish = function()
    {
        return this.rightblocks==9?true:false;
    }

	obj.doaction = function(d)
	{
			if(d)
			{
				$("#step").html(parseInt($("#step").html())+1);
				obj.swap(obj.empty.i,obj.empty.j, d.i,d.j);
				obj.resetwrap(d.i,d.j);
				obj.show();
				if(obj.isfinish())
				{
					obj.showsuc();
				}
			}
	}
	obj.addlistener = function()
	{
			$(document).keydown(function(e){
						var e = e || event;
						var currKey = e.keyCode || e.which || e.charCode;
					switch(currKey)
					{
						case 37://left
						{
							obj.doaction(obj.right);
							break;
						}
						case 38://up
						{
							obj.doaction(obj.down);
							break;
						}
						case 39://right
						{
							obj.doaction(obj.left);
							break;
						}
						case 40://down
						{
							obj.doaction(obj.up);
							break;
						}
					}
				});
	}
    obj.init();
	obj.initwrap();
    obj.shuffle(200);
    obj.show();
	obj.addlistener();
    return obj;
})();

var vtimer = new timer();
vtimer.start(vtimer);
 </script>
 </BODY>
</HTML>
