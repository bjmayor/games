<?php
require_once dirname(dirname(__FILE__))."/include/class.functool.php";
require_once dirname(__FILE__)."/login.php";
checklogin();
$hanzi = $_GET['word']?$_GET['word']:$_GET['hanzi'];
$gbkHanzi = iconv("utf8","gbk", $hanzi);
$url = "http://dict.baidu.com/s?wd=". urlencode($gbkHanzi) . "&tn=dict&dt=explain";
$dictFromBaidu = file_get_contents($url);
function parseHtml($html)
{
    $wubireg = '/<span class="enfont">86:(\w{1,4})&nbsp;&nbsp;<\/span>/';
    $pinyinreg = '/<span class="pinyin">([^<]*)<\/span>/';
    preg_match($wubireg, $html, $wubiMatch);
    preg_match($pinyinreg, $html, $pinyinMatch);
    return array("pinyin"=>iconv("gbk","utf8",$pinyinMatch[1]),"wubi"=>$wubiMatch[1]);
}
$finder = parseHtml($dictFromBaidu);
$sts = $_GET['sts'];
$pinyin = $_GET['pinyin'];
$wubi = $_GET['wubi'];
$md  = new SaeMysql();
$select="select * from wubipinyin where hanzi='$hanzi'";
$ret =$md->getLine($select);
if($_REQUEST['submit'])
{
    if($sts==0)
    {
        $sql = "update wubipinyin set pinyin='$pinyin', wubi='$wubi' where hanzi='$hanzi' and pinyin is  NULL";
    }
    elseif ($sts== -1)
    {
        $sql = "insert into wubipinyin set pinyin='$pinyin', wubi='$wubi', hanzi='$hanzi'";
    }
    $md->runSql($sql);
    if(!$md->errno())
    {
        $sql = "update `wordsts` set sts=1 where word='$hanzi'";
        $md->runSql($sql);
        if($md->errno())
        {
            die($md->error());
            echo "<a href='todolist.php?page=1&num=100'>待处理列表</a>";
            exit();
        }
    }
    else
    {
            die($md->error());
            echo "<a href='todolist.php?page=1&num=100'>待处理列表</a>";
            exit();
    }
     header("Location: todolist.php?page=1&num=100");
}
else
{
    $pinyin = $finder['pinyin'];
    $wubi = $finder['wubi'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
 <HEAD>
  <TITLE> 更新数据页 </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 </HEAD>
 <BODY>
<form>
汉字:<input type="text" name="hanzi" value="<?=$hanzi?>"/> (<a href="http://dict.baidu.com/s?wd=<?=urlencode($gbkHanzi)?>&tn=dict&dt=explain" target="_blank">查百度词典</a>) <br/> 
拼音:<input type="text" name="pinyin" value="<?=$pinyin?>"/><br/>
五笔:<input type="text" name="wubi" value="<?=$wubi?>"/><br/>
<input type="submit" name="submit" value="提交"/><input type="reset" name="reset" value="重置"/><br/>
</form>
 </BODY>
</HTML>
