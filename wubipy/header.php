<?php

function showheader($cur)
{
	 $header = array(
			array("name"=>"index","text"=>"首页","url"=>"/","sts"=>1,"cur"=>0),
			array("name"=>"game","text"=>"基础教程","url"=>"/","sts"=>1,"cur"=>0),
			array("name"=>"table","text"=>"字根表","url"=>"table.html","sts"=>1,"cur"=>0),
			array("name"=>"game","text"=>"游戏","url"=>"game.php","sts"=>1,"cur"=>0),
			array("name"=>"game","text"=>"用户交流区","url"=>"/","sts"=>1,"cur"=>0),
	);

	$str_header=<<<EOF
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8693049-7']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
		<div class="header_t">
    <div class="newlogo">
	    <div class="mblogo"></div>
	    <div><a href="/" target="_blank" class="mblogolink"></a></div>
	    <h2><a href="/"></a></h2> 
	</div>

    <div class="seacher_r_bg_t">
        <ul>
EOF;
	$str_footer =<<<EOF
		        </ul>
    </div>
</div>
EOF;
	$menus=array();
	foreach($header as $menu)
	{
		if($menu['name']==$cur)
		{
			$menus[]="<li><a href=\"{$menu['url']}\" style=\"color: rgb(65, 65, 65); font-size: 14px;\" class=\"highlight\">{$menu['text']}</a></li>";
		}
		else
		{
			$menus[]="<li><a href=\"{$menu['url']}\" style=\"color: rgb(65, 65, 65); font-size: 14px;\">{$menu['text']}</a></li>";
		}
	}
	return $str_header . implode("<li>|</li>",$menus) . $str_footer;
}
?>
