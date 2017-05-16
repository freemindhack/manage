<!DOCTYPE html>
<html>
<head>
    <title>报表 | 商户日销售统计(在线)</title>
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/header.tpl.php'; ?>
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/cashier.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo RL_PIGCMS_STATIC_PATH; ?>plugins/css/footable/footable.core.css" rel="stylesheet">
    <style>
        .ibox-title h5 {
            margin: 10px 0 0px;
        }

        select.input-sm {
            height: 35px;
            line-height: 35px;
        }

        .float-e-margins .btn-info {
            margin-bottom: 0px;
            padding: 3px;
        }

        .fa-paste {
            margin-right: 7px;
            padding: 0px;
        }

        .dz-preview {
            display: none;
        }

        .ibox-title ul {
            list-style: outside none none !important;
            margin: 0;
            padding: 0;
        }

        .ibox-title li {
            float: left;
            width: 30%;
        }

        #commonpage {
            float: right;
            margin-bottom: 10px;
        }

        #table-list-body .btn-st {
            background-color: #337ab7;
            border-color: #2e6da4;
            cursor: auto;
        }

        #select_Cardtype .i-checks label {
            cursor: pointer;
        }

        #ewmPopDiv .modal-body {
            text-align: center;
        }

        .modal-footer {
            text-align: center;
        }

        .modal-footer .btn {
            padding: 7px 30px;
        }
    </style>
</head>

<body>
<div id="wrapper">
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/leftmenu.tpl.php'; ?>
    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/top.tpl.php'; ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>商户日销售统计（在线）</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content">
                        <label><span style="">商户日销售统计:</span></label>
                        <form class="form-search form-inline" id="report" action="?m=User&c=report&a=report_OnlineSea"
                              method="post">
                            <select class="input-medium search-query" id="cardNo" type="text"
                                    style="height:auto;width: auto" name="uid">
                                <option value="">请选择商户</option>
                                <?php foreach ($shop as $key=> $va) {
                                    echo '<option value="' .$key. '">' . $va . '</option>';
                                } ?>
                            </select>
<!--                            <select class="input-medium search-query" id="cardNo" type="text"-->
<!--                                    style="height:auto;width: auto" name="payType">-->
<!--                                <option value="">请选择付款方式</option>-->
<!--                                <!-- C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正-->
<!--                                <option value="C">餐卡</option>-->
<!--                                <option value="X">现金</option>-->
<!--                                <option value="W">微信</option>-->
<!--                                <option value="Z">支付宝</option>-->
<!--                                <option value="Y">银行卡</option>-->
<!--                                <option value="R">人工修正</option>-->
<!--                            </select>-->
                            <input type="text" name="dtbegin" id="datepicker1" style="height:auto"
                                   placeholder="请选择开始时间"/>
                            <input type="text" name="dtend" id="datepicker2" style="height:auto" placeholder="请选择结束时间"/>
                            <button class="btn search-query" style="margin-bottom: 20px" onclick="return pin()">查找
                            </button>
                        </form>
                    </div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="app__content js-app-main page-cashier">
                                <div>
                                    <!-- 实时交易信息展示区域 -->
                                    <div class="cashier-realtime">
                                        <div class="realtime-title-block clearfix">
                                            <h1 class="realtime-title">商户日销售统计</h1>
                                        </div>
                                    </div>
                                    <div class="js-real-time-region realtime-list-box loading">
                                        <div class="widget-list">
                                            <div class="js-list-filter-region clearfix ui-box"
                                                 style="position: relative;">
                                                <div class="widget-list-filter"></div>
                                            </div>
                                            <div class="ui-box">
                                                <table class="ui-table ui-table-list" data-page-size="20"
                                                       style="padding: 0px;" >
                                                    <thead class="js-list-header-region tableFloatingHeaderOriginal">
                                                    <tr class="widget-list-header">
                                                        <th rowspan="2">商户</th>
                                                        <th rowspan="2">报表日期</th>
                                                        <th rowspan="2">总销售额</th>
                                                        <th colspan="8">其中</th>
                                                        <th rowspan="2">创建时间</th>
                                                        <th rowspan="2">上一次重算时间</th>
                                                    </tr>
                                                    <tr class="widget-list-header">
                                                        <th >现金</th>
                                                        <th >银行卡</th>
                                                        <th >微信</th>
                                                        <th >支付宝</th>
                                                        <th >礼品券</th>
                                                        <th >团购</th>
                                                        <th >其他</th>
                                                        <th >M1卡</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="js-list-body-region" id="table-list-body">
                                                    <?php if (!empty($result)) {
                                                        foreach ($result as $rvv) {
                                                            ?>
                                                            <tr class="widget-list-item">
                                                                <td><?php echo $shop[$rvv['uid']]; ?></td>
                                                                <td><?php echo $rvv['date']; ?></td>
                                                                <td><?php echo $rvv['totalAmount']; ?></td>
                                                                <td><?php echo $rvv['cashAmount']; ?></td>
                                                                <td><?php echo $rvv['bankCardAmount']; ?></td>
                                                                <td><?php echo $rvv['weChatAmount']; ?></td>
                                                                <td><?php echo $rvv['aliPayAmount']; ?></td>
                                                                <td><?php echo $rvv['giftAmount']; ?></td>
                                                                <td><?php echo $rvv['tuanAmount']; ?></td>
                                                                <td><?php echo $rvv['otherAmount']; ?></td>
                                                                <td><?php echo $rvv['cardAmount']; ?></td>
                                                                <td><?php echo $rvv['createTime']; ?></td>
                                                                <td><?php echo $rvv['resetTime']; ?></td>
                                                                <!--																<td class="footable-last-column">-->
                                                                <!--																	<a href="?m=User&c=card&a=freeze&CardNo=-->
                                                                <?php //echo $rvv['CardNo'];
                                                                ?><!--"><button   class="btn btn-sm btn-primary"><strong>解冻</strong></button></a>-->
                                                                <!--																</td>-->
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr class="widget-list-item">
                                                            <td colspan="19">无数据</td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                                <div class="js-list-empty-region"></div>
                                            </div>
                                            <div class="js-list-footer-region ui-box">
                                                <div class="widget-list-footer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $pagebar; ?>
            </div>
        </div>
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/footer.tpl.php'; ?>
    </div>
</div>

</body>
<!-- iCheck -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $("#datepicker1,#datepicker2").datetimepicker({
            language: 'zh-CN',
            minView: "month",
            format: 'yyyy-mm-dd',//格式化时间
            autoclose: true,
            forceParse: true
        });
    });
    function pin() {
        var t1 = $('#datepicker1').val();
        var t2 = $('#datepicker2').val();
        if (t1 != '' && t2 != '' && t1 > t2) {
            swal('开始时间必须小于结束时间!');
            return false;
        }

        var str = $('#report').attr('action') + '&' + $('#report').serialize();
        $('#report').attr('action', str);
        return true;
    }
</script>

</html>