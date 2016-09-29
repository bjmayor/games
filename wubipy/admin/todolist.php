<?php
require_once dirname(dirname(__FILE__))."/include/class.functool.php";
require_once dirname(__FILE__)."/login.php";
checklogin();
$md  = new SaeMysql();
$page = $_GET['page'];
$num = $_GET['num'];
$page = $page?$page:1;
$num || $num=100;
$start = ($page-1)*$num;
$selectSql = "SELECT * FROM `wordsts` WHERE 1 and sts<1 order by cnt desc limit {$start},{$num}";
$countSql= "SELECT count(*) as num  FROM `wordsts` WHERE 1 and sts<1";
$ret = $md->getData($selectSql);
$totalRet = $md->getData($countSql);
$stsdesc = array("-1"=>"未入库","0"=>"入了库，没有对应的字根");
function dispatch($item)
{
    $ret="";
    switch($item['sts'])
    {
        case -1:$ret=sprintf("<a href=\"update.php?word=%s&sts=%d\">入库并更新</a>",$item['word'],$item['sts']);break;
        case 0:$ret=sprintf("<a href=\"update.php?word=%s&sts=%d\">更新</a>",$item['word'],$item['sts']);break;
    }
    return $ret;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
 <HEAD>
  <TITLE> todo列表 </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="需要更新的数据">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

 </HEAD>

 <BODY>
 共有<?=$totalRet[0]['num']; ?>没有入库.
 <table>
<tr><td>汉字</td><td>查询次数</td><td>状态</td><td>操作</td></tr>
<? foreach($ret as $item):?>
<tr><td><?=$item['word']?></td><td><?=$item['cnt'];?></td><td><?=$stsdesc[$item['sts']]?></td><td><?=dispatch($item)?></td></tr>
<? endforeach;?>
</table>
 <script>
 </script>
 </BODY>
</HTML>
