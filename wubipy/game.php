<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE> 五笔拼音互查 </TITLE>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="bjmayor">
  <META NAME="Keywords" CONTENT="五笔，拼音，查找，吃饭照">
  <META NAME="Description" CONTENT="提供五笔和拼音查找的功能，方便用户学习五笔">
  <link href="static/css/global.css" type="text/css" rel="stylesheet">
<script src="static/js/jquery.1.5.2.js"></script>
<style>
body{
    margin:0;
    padding:0;
    background:none repeat scroll 0 0 #F0F0F0;
}
#content{
display:block;
text-align:left;
width :760px;
height:420px;
               }
               #wrap{
                   left:50%;
                       position:absolute;
                           top:50%;
                               margin:-210px 0 0 -380px;
                               }
                               #flashContent
                                   {
                                       position:relative;
                                   }
                                   </style>
                                       </HEAD>

                                       <BODY>
<?php
include_once "header.php";
echo showheader("game");

?>
    <div id="wrap">

    <div id="flashContent">

    </div>

    </div>

    <script type="text/javascript">

    //var isIE = false;
//if (window.ActiveXObject){

    isIE = true;

//}

if(isIE){

    var wbGame=wbGame || [];

    wbGame.push('<object id="radioplayer" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="760" height="420" title="radioplayer">');

    wbGame.push('<param name="movie" value="'+getFlashUrl()+'" />');

    wbGame.push('<param name="allowScriptAccess" value="always" />');

    wbGame.push('<param name="quality" value="high" />');


    wbGame.push('<embed name="radioplayer" src="'+getFlashUrl()+'" FlashVars="" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowScriptAccess="always" width="760" height="420"></embed>');

    wbGame.push('</object>');

    document.getElementById("flashContent").innerHTML=wbGame.join("");

}else{

    <!-- For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. -->

        var swfVersionStr = "10.0.0";

    <!-- To use express install, set to playerProductInstall.swf, otherwise the empty string. -->

        var xiSwfUrlStr ="playerProductInstall.swf"; 

    var flashvars = 'sinaId='+sinaId;

    var flashvars = {};

    flashvars.sinaId = sinaId;

    var params = {};

    params.quality = "high";

    params.allowscriptaccess = "always";

    params.allowfullscreen = "true";

    var attributes = {};

    attributes.id = "radioplayer";

    attributes.name = "radioplayer";

    swfobject.embedSWF(getFlashUrl(), "flashContent", "760", "420", swfVersionStr, xiSwfUrlStr, flashvars, params, attributes);



}



function getBrowser()

{

    var browserInfo = navigator.userAgent.toUpperCase();

    var browser = navigator.appName;

    if(browser == "Microsoft Internet Explorer") //IE,遨游,360,TT,sougou,世界之窗

    {

        if(browserInfo.indexOf("360SE") >= 0){ //360SE

            return "360";

        }

        if(browserInfo.indexOf("TENCENT") >= 0){ //TT

            return "traveler";

        }

        if(browserInfo.indexOf("SE") >= 0){ //SOUGOU

            return "sogou";

        }

        if(browserInfo.indexOf("MSIE") >= 0){ //ie，世界之窗

            try {

                if (external.max_language_id != undefined){

                    return "maxthon"; //遨游

                }

            }catch (e){}

                return "ie";

        }

    }

    else if(browser == "Netscape")

    {

        if(browserInfo.indexOf("FIREFOX") >= 0){ //firefox

            return "firefox";

        }



        if(browserInfo.indexOf("CHROME") >= 0){ //chrome

            return "chorme";

        }

        if(browserInfo.indexOf("SAFARI") >= 0) { //safiri

            return "safari";

        }

    }

    else if(browser == "Opera") //Opera

    {

        return "opera";

    }

    return "ie";

}

function getFlashUrl()

{
    var url="http://wubipy.sinaapp.com/static/wbgame.swf";
    if("maxthon"==getBrowser())

    {

        return url+"?r="+Math.random();

    }

    else

    {

        return url;

    }
}

</script>
 </BODY>
</HTML>
