<nav role="navigation" class="navbar-default navbar-static-side">
    <div class="sidebar-collapse">
        <ul id="side-menu" class="nav metismenu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
					   <?php if (!empty($this->merchant['logo'])) { ?>
                           <img src="<?php echo $this->merchant['logo']; ?>" class="img-circle" alt="image"
                                height="70px" width="70px">
                       <?php } elseif (defined('RESOURCEURL')) { ?>
                           <img src="<?php echo RESOURCEURL; ?>/pigcms_tpl/Merchants/Static/images/profile_small.jpg"
                                class="img-circle" alt="image">
                       <?php } elseif (defined('ABS_UPLOAD_PATH')) { ?>
                           <img
                               src=".<?php echo ABS_UPLOAD_PATH; ?>/pigcms_tpl/Merchants/Static/images/profile_small.jpg"
                               class="img-circle" alt="image">
                       <?php } else { ?>
                           <img src="./pigcms_tpl/Merchants/Static/images/profile_small.jpg" class="img-circle"
                                style="width: 45px;height: 45px;">
                       <?php } ?>
                             </span>
                    <a href="javascript:;" class="dropdown-toggle">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                        class="font-bold"><?php if (!empty($this->merchant['username'])) {
                                            echo $this->merchant['username'];
                                        } else {
                                            echo 'My Cashier';
                                        } ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $this->merchant['weixin']; ?>
                                    <!--<b class="caret"></b>--></span> </span> </a>
                    <!--<ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>-->
                </div>
                <div class="logo-element" style="text-align: center;">
                    <?php if (!empty($this->merchant['logo'])) { ?>
                        <img src="<?php echo $this->merchant['logo']; ?>" class="img-circle"
                             style="width: 45px;height: 45px;">
                    <?php } elseif (defined('RESOURCEURL')) { ?>
                        <img src="<?php echo RESOURCEURL; ?>/pigcms_tpl/Merchants/Static/images/profile_small.jpg"
                             class="img-circle" alt="image">
                    <?php } elseif (defined('ABS_UPLOAD_PATH')) { ?>
                        <img src=".<?php echo ABS_UPLOAD_PATH; ?>/pigcms_tpl/Merchants/Static/images/profile_small.jpg"
                             class="img-circle" alt="image">
                    <?php } else { ?>
                        <img src="./pigcms_tpl/Merchants/Static/images/profile_small.jpg" class="img-circle"
                             style="width: 45px;height: 45px;">
                    <?php } ?>
                </div>
            </li>
            <li <?php if (ROUTE_CONTROL == 'index' && ROUTE_ACTION == 'index') echo 'class="active"'; ?>>
                <a href="/merchants.php?m=User&c=index&a=index"><i class="fa fa-home"></i> <span
                        class="nav-label">首页</span><span class="label label-info pull-right"></span></a>
            </li>
            <li <?php if (ROUTE_CONTROL == 'card') echo 'class="active"'; ?>>
                <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">卡管理</span></a>
                <ul class="nav nav-second-level collapse <?php if (ROUTE_CONTROL == 'card') echo 'in'; ?>">
                    <li <?php if (ROUTE_CONTROL == 'card' && ROUTE_ACTION == 'card_class') echo 'class="active"'; ?>><a
                            href="/merchants.php?m=User&c=card&a=card_class">卡类别管理</a></li>
                    <li <?php if (ROUTE_CONTROL == 'card' && ROUTE_ACTION == 'card_status') echo 'class="active"'; ?>><a
                            href="/merchants.php?m=User&c=card&a=card_status">卡状态管理</a></li>
                    <li <?php if (ROUTE_CONTROL == 'card' && ROUTE_ACTION == 'card_liushui') echo 'class="active"'; ?>>
                        <a href="/merchants.php?m=User&c=card&a=card_liushui">卡流水管理</a></li>
                    <li <?php if (ROUTE_CONTROL == 'card' && ROUTE_ACTION == 'zssearch') echo 'class="active"'; ?>>
                        <a href="/merchants.php?m=User&c=card&a=zssearch">活动赠送金额查询</a></li>
                </ul>
            </li>
            <li <?php if (ROUTE_CONTROL == 'shop' || ROUTE_CONTROL == 'ht') echo 'class="active"'; ?>>
                <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">商户管理</span></a>
                <ul class="nav nav-second-level collapse <?php if (ROUTE_CONTROL == 'shop') echo 'in'; ?>">
                    <li <?php if (ROUTE_CONTROL == 'shop' && ROUTE_ACTION == 'manageShop') echo 'class="active"'; ?>><a
                            href="/merchants.php?m=User&c=shop&a=manageShop">商户管理</a></li>
                </ul>
            </li>
            <li <?php if (ROUTE_CONTROL == 'activity') echo 'class="active"'; ?>>
                <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">活动管理</span></a>
                <ul class="nav nav-second-level collapse <?php if (ROUTE_CONTROL == 'activity') echo 'in'; ?>">
                    <li <?php if (ROUTE_CONTROL == 'activity' && ROUTE_ACTION == 'set') echo 'class="active"'; ?>><a
                                href="/merchants.php?m=User&c=activity&a=set">活动时间设置</a></li>
                </ul>
            </li>
            <li <?php if (ROUTE_CONTROL == 'report') echo 'class="active"'; ?>>
                <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">报表</span></a>
                <ul class="nav nav-second-level collapse <?php if (ROUTE_CONTROL == 'report') echo 'in'; ?>">
                    <li <?php if (ROUTE_CONTROL == 'report' && ROUTE_ACTION == 'report_qindan'||ROUTE_ACTION == 'report_qindanSea') echo 'class="active"'; ?>>
                        <a href="/merchants.php?m=User&c=report&a=report_qindan">交易清单查询</a></li>
		    <li <?php if (ROUTE_CONTROL == 'report' && ROUTE_ACTION == 'report_sum'||ROUTE_ACTION == 'report_sumget') echo 'class="active"'; ?>>
                        <a href="/merchants.php?m=User&c=report&a=report_sum">商户时间段销售统计</a></li>
                    <li <?php if (ROUTE_CONTROL == 'report' && ROUTE_ACTION == 'report_congzhi' || 'report_czSea' == ROUTE_ACTION) echo 'class="active"'; ?>>
                        <a href="/merchants.php?m=User&c=report&a=report_congzhi">充值退卡日统计</a></li>
                    <li <?php if (ROUTE_CONTROL == 'report' && ROUTE_ACTION == 'report_czCard' || 'report_czCardsea' == ROUTE_ACTION) echo 'class="active"'; ?>>
                        <a href="/merchants.php?m=User&c=report&a=report_czCard">充值台销售统计</a></li>
                    <li <?php if (ROUTE_CONTROL == 'report' && ROUTE_ACTION == 'zsday') echo 'class="active"'; ?>>
                        <a href="/merchants.php?m=User&c=report&a=zsday">充值台日赠送</a></li>
                </ul>
            </li>
            <li <?php if (ROUTE_CONTROL == 'index' && ROUTE_ACTION == 'ModifyPwd') echo 'class="active"'; ?>>
                <a href="/merchants.php?m=User&c=index&a=ModifyPwd"><i class="fa fa-unlock-alt"></i> <span
                        class="nav-label">修改密码</span><span class="label label-info pull-right"></span></a>
            </li>
        </ul>

    </div>
</nav>
