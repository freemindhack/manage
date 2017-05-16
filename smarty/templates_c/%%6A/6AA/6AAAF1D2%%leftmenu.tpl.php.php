<?php /* Smarty version 2.6.18, created on 2016-07-22 16:26:52
         compiled from D:%5CphpStudy%5CWWW%5Cmanagecms%5C./pigcms_tpl/Merchants/System/public/leftmenu.tpl.php */ ?>
<nav role="navigation" class="navbar-default navbar-static-side">
        <div class="sidebar-collapse">
            <ul id="side-menu" class="nav metismenu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
						<img src="<?php echo @PIGCMS_TPL_STATIC_PATH; ?>
images/profile_small.jpg" class="img-circle" style="width: 45px;height: 45px;">
                         </span>
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->_tpl_vars['adminuser']['account']; ?>
</strong>
                             </span> <span class="text-muted text-xs block">收银台管理后台</span> </span> </a>
                    </div>
					<div class="logo-element" style="text-align: center;">
						<img src="<?php echo @PIGCMS_TPL_STATIC_PATH; ?>
images/profile_small.jpg" class="img-circle" style="width: 45px;height: 45px;">
							
					</div>
                </li>
				<li <?php if (ROUTE_CONTROL == 'index' && ROUTE_ACTION != 'ModifyPwd'): ?> class="active" <?php endif; ?>>
					<a href="#"><i class="fa  fa-puzzle-piece"></i> <span class="nav-label">网站商家</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse <?php if (ROUTE_CONTROL == 'index'): ?> in <?php endif; ?>">
                        <li <?php if (ROUTE_CONTROL == 'index' && ROUTE_ACTION == 'merLists'): ?> class="active" <?php endif; ?>><a href="/merchants.php?m=System&c=index&a=merLists">商家列表</a></li>
                        <li <?php if (ROUTE_CONTROL == 'index' && ROUTE_ACTION == 'affiliate'): ?> class="active" <?php endif; ?>><a href="/merchants.php?m=System&c=index&a=affiliate">微信特约商户</a></li>
						<li <?php if (ROUTE_CONTROL == 'index' && ROUTE_ACTION == 'affiliatepay'): ?> class="active" <?php endif; ?>><a href="/merchants.php?m=System&c=index&a=affiliatepay">特约商户支付列表</a></li>
                    </ul>

                </li>

				<li <?php if (ROUTE_CONTROL == 'pay'): ?> class="active" <?php endif; ?>>
					<a href="#"><i class="fa fa-cog"></i> <span class="nav-label">支付配置</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse <?php if (ROUTE_CONTROL == 'pay'): ?> in <?php endif; ?>">
                        <li <?php if (ROUTE_CONTROL == 'pay' && ROUTE_ACTION == 'config'): ?> class="active" <?php endif; ?>><a href="/merchants.php?m=System&c=pay&a=config">支付配置</a></li>
                    </ul>

                </li>
                <li <?php if(ROUTE_CONTROL=='system') echo 'class="active"';?>>
                    <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">系统管理</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse <?php if(ROUTE_CONTROL=='system') echo 'in';?>">
                        <li <?php if(ROUTE_CONTROL=='system' && ROUTE_ACTION=='roles') echo 'class="active"';?>><a href="/merchants.php?m=System&c=system&a=roles">角色管理</a></li>
                    </ul>
                </li>
                <li <?php if(ROUTE_CONTROL=='merchant') echo 'class="active"';?>>
                    <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">操作员管理</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse <?php if(ROUTE_CONTROL=='merchant') echo 'in';?>">
                        <li <?php if(ROUTE_CONTROL=='merchant' && ROUTE_ACTION=='employers') echo 'class="active"';?>><a href="/merchants.php?m=System&c=merchant&a=employers">操作员管理</a></li>
                    </ul>
                </li>
                <li <?php if(ROUTE_CONTROL=='cashier') echo 'class="active"';?>>
                    <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">收银员管理</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse <?php if(ROUTE_CONTROL=='cashier') echo 'in';?>">
                        <li <?php if(ROUTE_CONTROL=='cashier' && ROUTE_ACTION=='manage') echo 'class="active"';?>><a href="/merchants.php?m=User&c=cashier&a=manage">收银员</a></li>
                    </ul>
                </li>
                <li <?php if(ROUTE_CONTROL=='shop') echo 'class="active"';?>>
                    <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">商户管理</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse <?php if(ROUTE_CONTROL=='shop') echo 'in';?>">
                        <li <?php if(ROUTE_CONTROL=='shop' && ROUTE_ACTION=='manageShop') echo 'class="active"';?>><a href="/merchants.php?m=System&c=shop&a=manageShop">商户管理</a></li>
                    </ul>
                </li>
                <li <?php if(ROUTE_CONTROL=='card') echo 'class="active"';?>>
                    <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">卡管理</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse <?php if(ROUTE_CONTROL=='card') echo 'in';?>">
                        <li <?php if(ROUTE_CONTROL=='card' && ROUTE_ACTION=='card_status') echo 'class="active"';?>><a href="/merchants.php?m=System&c=card&a=card_status">卡状态管理</a></li>
                        <li <?php if(ROUTE_CONTROL=='card' && ROUTE_ACTION=='card_liushui') echo 'class="active"';?>><a href="/merchants.php?m=System&c=card&a=card_liushui">卡流水管理</a></li>
                    </ul>
                </li>
                <li <?php if(ROUTE_CONTROL=='report') echo 'class="active"';?>>
                    <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">报表</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse <?php if(ROUTE_CONTROL=='report') echo 'in';?>">
                        <li <?php if(ROUTE_CONTROL=='report' && ROUTE_ACTION=='report_qindan') echo 'class="active"';?>><a href="/merchants.php?m=System&c=report&a=report_qindan">交易清单查询</a></li>
                        <li <?php if(ROUTE_CONTROL=='report' && ROUTE_ACTION=='report_tongji') echo 'class="active"';?>><a href="/merchants.php?m=System&c=report&a=report_tongji">商户日销售统计</a></li>
                    </ul>
                </li>
				<li <?php if (ROUTE_CONTROL == 'index' && ROUTE_ACTION == 'ModifyPwd'): ?> class="active" <?php endif; ?>>
                    <a href="/merchants.php?m=System&c=index&a=ModifyPwd"><i class="fa fa-unlock-alt"></i> <span class="nav-label">修改密码</span><span class="label label-info pull-right"></span></a>
                </li>
            </ul>

        </div>
    </nav>