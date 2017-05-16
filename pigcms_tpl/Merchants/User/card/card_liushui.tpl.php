<!DOCTYPE html>
<html>
<head>
    <title>卡管理 | 卡流水管理</title>
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
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/footable/footable.all2.min.js"></script>
</head>

<body>
<div id="wrapper">
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/leftmenu.tpl.php'; ?>
    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/top.tpl.php'; ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>卡流水管理</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content">
                        <label><span style="">卡流水查询:</span></label>
                        <form id="xinxi1" action="?m=User&c=card&a=card_liushuiSea" method="post">
                            <input id="cardNo" type="text" style="height:auto" placeholder="请输入卡号" name="cardNo"/>
                            <select name="vender" class="input-medium search-query" style="height:auto;width: auto">
                                <option value="">所有店铺</option>
                                <?php
                                foreach ($shop as $k => $v) {
                                    echo  "<option value='".$k."'>".$v."</option>";
                                }
                                ?>
                            </select>
                            <select name="payType" class="input-medium search-query" style="height:auto;width: auto" >
                                <option value="">付款方式</option>
                                <?php
                                foreach ($payType as $k => $v) {
                                    echo  "<option value='".$k."'>".$v."</option>";
                                }
                                ?>
                            </select>
                            <select name="saleType" class="input-medium search-query" style="height:auto;width: auto">
                                <option value="">交易类型</option>
                                <?php
                                foreach ($saleType as $k => $v) {
                                    echo  "<option value='".$k."'>".$v."</option>";
                                }
                                ?>
                            </select>
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
                                            <h1 class="realtime-title">卡流水</h1>
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
                                                       style="padding: 0px;">
                                                    <thead class="js-list-header-region tableFloatingHeaderOriginal">
                                                    <tr class="widget-list-header">
                                                        <th data-hide="phone">卡号</th>
                                                        <th data-hide="phone">收银员</th>
                                                        <th data-hide="phone">设备id</th>
                                                        <th data-hide="phone">订单号</th>
                                                        <th data-hide="phone">订单时间</th>
                                                        <th data-hide="phone">卡原始id</th>
                                                        <th data-hide="phone">卡交易前金额</th>
                                                        <th data-hide="phone">卡交易后金额</th>
                                                        <th data-hide="phone">卡押金</th>
                                                        <th data-hide="phone">变更金额</th>
                                                        <th data-hide="phone">记录上传时间</th>
                                                        <th data-hide="phone">记录处理时间</th>
                                                        <th data-hide="phone">记录处理状态</th>
                                                        <th data-hide="phone">应收金额</th>
                                                        <th data-hide="phone">实收金额</th>
                                                        <th data-hide="phone">找零金额</th>
                                                        <th data-hide="phone">付款方式</th>
                                                        <th data-hide="phone">交易类型</th>
                                                        <!--														<th data-hide="phone">操作</th>-->
                                                    </tr>
                                                    </thead>
                                                    <tbody class="js-list-body-region" id="table-list-body">
                                                    <?php if (!empty($result)) {
                                                        foreach ($result as $rvv) {
                                                            ?>
                                                            <tr class="widget-list-item">
                                                                <td><?php echo $rvv['cardNo']; ?></td>
                                                                <td><?php echo $names[$rvv['SYYId']] ? $names[$rvv['SYYId']] : $rvv['SYYId']; ?></td>
                                                                <td><?php echo $rvv['deviceNo']; ?></td>
                                                                <td><?php echo $rvv['OrderNo']; ?></td>
                                                                <td><?php echo $rvv['OrderTime_Time']; ?></td>
                                                                <td><?php echo $rvv['cardUid']; ?></td>
                                                                <td><?php echo $rvv['cardOldAmount']; ?></td>
                                                                <td><?php echo $rvv['cardNowAmount']; ?></td>
                                                                <td><?php echo $rvv['cardMortgage']; ?></td>
                                                                <td><?php echo $rvv['changeAmount']; ?></td>
                                                                <td><?php echo $rvv['UpLoadTime_Time']; ?></td>
                                                                <td><?php echo $rvv['HandlerTime']; ?></td>
                                                                <td><?php echo $proState[$rvv['flag']]; ?></td>
                                                                <td><?php echo $rvv['receivableAmount']; ?></td>
                                                                <td><?php echo $rvv['paidInAmount']; ?></td>
                                                                <td><?php echo $rvv['giveChangeAmount']; ?></td>
                                                                <td><?php echo $payType[$rvv['payType']]; ?></td>
                                                                <td><?php echo $saleType[$rvv['saleType']]; ?></td>
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
            showSecond: true, //显示秒
            format: 'yyyy-mm-dd hh:ii:ss',//格式化时间
            stepHour: 1,//设置步长
            stepMinute: 1,
            stepSecond: 1,
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

        var str = $('#xinxi1').attr('action') + '&' + $('#xinxi1').serialize();
        $('#xinxi1').attr('action', str);
        return true;
    }
</script>

</html>