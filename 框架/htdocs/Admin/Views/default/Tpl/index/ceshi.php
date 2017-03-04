<taglib name="rfcms" />
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>24k88</title>
<link href="../Public/menu.css" rel="stylesheet"/>
<link href="../Public/style.css" rel="stylesheet" media="screen, handheld, print, projection" />

</head>
<body>
<p id="back-to-top"><a href="#top"></a></p>
<div id="slos">
	<div class="sli">
		<div class="logo"><a href="index.php"></a></div>
		<nav id="menu" class="nav">					
				<ul>
					<li><a href="index.php" class="ho tra3"></a></li>
					<li><a href="index.php?s=/Page_detail_item_tpromo.html" class="tra3" style="position:relative">优惠活动<span class="tra3"></span></a></li>
					<li><a href="index.php?s=/Page_game_item_XGgame.html" class="tra3">游戏</a></li>
					<li><a href="index.php?s=/Page_faq_item_howplay.html" class="tra3">存取款说明</a></li>
					<li><a href="index.php?s=/Page_detail_item_Vipmember.html" class="tra3">VIP</a></li>
					<li><a href="user.php?s=/Index_play_platform_hg_mode_0.html" target="_blank" class="tra3">一键试玩</a></li>
				
				</ul>
		</nav>
        <div class="logab">
        	<div class="mnav">
            	<a href="#" class="mic"></a>
                <ul class="mac rad6 tra3">
                	<div class="acm"><span>欢迎<b></b></span>
                    <span>账户余额：<b><?=123; ?></b></span></div>
            		<li><a href="" class="tra3">存款</a></li>
            		
            		<li><a href="user.php?s=/Deposit_insert_transplat_BBIN.html" class="tra3">户内转账</a></li>
            		
            		<li><a href="" class="hid tra3">绑定银行卡</a></li>
                    <li><a href="" class="tra3">取款</a></li>
                    <li><a href="user.php" class="tra3">我的账户</a></li>
                    <li><a href="" class="tra3">登出</a></li>
                </ul>
            </div>
        </div>
	</div>
</div>
<div class="main">
	<div class="subt">我的账户</div>
    <div class="cde">
        <div class="cl clc rline ac2">
            <a href="user.php" class="act tra3">我的账户</a>
            <a href="{:U('Xianjin/index')}" class="tra3">交易记录</a>
            <a href="{:U('Deposit/index')}" class="tra3">转账记录</a>
            <a href="{:U('User/modify',array('id'=>$adminId, 'jumpUri'=>'run' ))}" class="tra3">修改资料</a>
            <a href="{:U('User/eligible')}" class="tra3">红包榜</a>
        </div>
        <div class="cl ac5">
        	<form class="control">
            	<div class="group">
                    <span>我的账户余额</span><b>
                    <?php 
                    foreach ($result as $r){
                        echo '<font color="red">'. $r['id'].'sfsdfda56f4s56df'.'</font>';
                    }
                    ?>
                    </b>
                    <?=5498498456;?>
                </div>
                <volist name='balances' id='balan'>
	                <div class="group">
	                    <span>余额</span><b class="balance-check"  id="balance-{$balan.short_name_lc}-qty" style="cursor: pointer;"></b>
	                </div>
           			</volist>
            </form>
        </div>
        <div class="cl ac3 hid">
        	<include file="Public:game" />
        	<include file="Public:livechat" />
        </div>
    </div>
</div>
<div class="footl">

    <span><h4>我们的游戏</h4>
    	<div class="fl2">
        	<ul>
            	<li>视觉感观和品牌</li>
                <li>游戏产品</li>
                <li>营销策略</li>
                <li>稳定产品质量</li>
            </ul>
        </div>
    </span>
    <span class="fn"><h4>在线支持</h4>
    	<div class="fl3">
        	<dl>
            	<dd><font>客服QQ:</font>2879754052</dd>
                <div class="clear"></div>
				<dd><font>Skype:</font>cs.24k</dd>
				<div class="clear"></div>
            	<dd><font>Email:</font>cs@24k88.com</dd>
            </dl>
        </div>
    </span>
</div>
<div class="footer">
	<div class="fl">
    	<div class="footicon"></div>
    </div>
    <div class="fr adi">
    	<span>认证机构</span>
    	<span><img src="__PUBLIC__/24k88/images/adc1.png"></span>
    </div>
    <div class="clear"></div>
</div>
		

</body>
</html>

