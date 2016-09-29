<?php
//require_once dirname(dirname(__FILE__))."/include/class.SaeMysql.php";
require_once dirname(dirname(__FILE__))."/include/class.functool.php";

$hanzi = trim(urldecode($_REQUEST['h']));
if(!is_utf8($hanzi))
{
    $hanzi = iconv("gbk","utf8",$hanzi);
}
$defaultarr = array('id'=>0,'hanzi'=>$hanzi,'wubi'=>'','pianpang'=>'','pinyin'=>'');
$md  = new SaeMysql();
$execsql = "select * from wubipinyin where hanzi='$hanzi'";

$showret = $md->getLine($execsql);

if($md->errno())
{
    echo json_encode($defaultarr);
    exit();
}
else
{
    $showret = $showret?$showret:$defaultarr;
}
$sts=$showret['id'] ? ($showret['wubi'] ? 1 : 0) : -1;//0是没有字根,1有字根，-1是汉字没有录入
$selectsql = "select * from wordsts where word='$hanzi'";
$ret = $md->getLine($selectsql);
if($ret)
{
    $updatesql = "update wordsts set cnt=cnt+1 where word='$hanzi'";
    $ret = $md->runSql($updatesql);
}
else
{
        $insertsql = "insert into  wordsts(`word`,`cnt`,`sts`) values('$hanzi',1,$sts)";
        $ret = $md->runSql($insertsql);
}
echo json_encode($showret);
?>