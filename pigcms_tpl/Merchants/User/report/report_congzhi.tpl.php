<!DOCTYPE html>
<html>
<head>
    <title>报表 | 日充值退卡</title>
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
                <h2>日充值退卡</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content">
                        <label><span style="">日充值退卡:</span></label>
                        <form class="form-search form-inline" id="report" action="?m=User&c=report&a=report_czSea"
                              method="post">
                            <select style="height: auto" name="rechargeType">
                                <option value="">充值OR退卡</option>
                                <option value="C">充值</option>
                                <option value="T">退卡</option>
                            </select>
                            <input type="text" name="posNo"  style="height:auto"
                                   placeholder="充值款台号码" value="<?php echo $data['posNo'];?>"/>
                            <input type="text" name="dtbegin" id="datepicker1" style="height:auto"
                                   placeholder="请选择开始时间" value="<?php echo $data['dtbegin'];?>"/>
                            <input type="text" name="dtend" id="datepicker2" style="height:auto" placeholder="请选择结束时间" value="<?php echo $data['dtend'];?>"/>
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
                                            <h1 class="realtime-title btn-sm">日充值退卡</h1>
                                            <a href="" class="btn btn-primary btn-big" style="margin-left:20px" id="exprot">导出</a>
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
                                                        <th rowspan="2">充值款台</th>
                                                        <th rowspan="2">充值类型</th>
                                                        <th rowspan="2">报表日期</th>
                                                        <th rowspan="2">合计</th>
                                                        <th colspan="7">其中</th>

                                                    </tr>
                                                    <tr class="widget-list-header">
                                                        <th >现金</th>
                                                        <th >银行卡</th>
                                                        <th >微信</th>
                                                        <th >支付宝</th>
                                                        <th >礼品券</th>
                                                        <th >团购</th>
                                                        <th >其他</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="js-list-body-region" id="table-list-body">
                                                    <?php if (!empty($result)) {
                                                        foreach ($result as $rvv) {
                                                            ?>
                                                            <tr class="widget-list-item">
                                                                <td><?php echo $rvv['posNo']; ?></td>
                                                                <td><?php echo $rechargeType[strtoupper($rvv['rechargeType'])]; ?></td>
                                                                <td><?php echo $rvv['date']; ?></td>
                                                                <td><?php echo $rvv['totalAmount']; ?></td>
                                                                <td><?php echo $rvv['cashAmount']; ?></td>
                                                                <td><?php echo $rvv['bankCardAmount']; ?></td>
                                                                <td><?php echo $rvv['weChatAmount']; ?></td>
                                                                <td><?php echo $rvv['aliPayAmount']; ?></td>
                                                                <td><?php echo $rvv['giftAmount']; ?></td>
                                                                <td><?php echo $rvv['tuanAmount']; ?></td>
                                                                <td><?php echo $rvv['otherAmount']; ?></td>

                                                            </tr>
                                                        <?php }?>
                                                        <tr class="widget-list-item">
                                                            <td colspan="3">合计</td>
                                                            <td><?php echo $sum['num1']; ?></td>
                                                            <td><?php echo $sum['num2']; ?></td>
                                                            <td><?php echo $sum['num3']; ?></td>
                                                            <td><?php echo $sum['num4']; ?></td>
                                                            <td><?php echo $sum['num5']; ?></td>
                                                            <td><?php echo $sum['num6']; ?></td>
                                                            <td><?php echo $sum['num7']; ?></td>
                                                            <td><?php echo $sum['num8']; ?></td>
                                                        </tr>
                                                    <?php } else { ?>
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
        $("#exprot").click(function () {
            if(GetQueryString("a")=="report_congzhi"){
                swal("请查找后在导出！！");
            }else {
                var href = window.location.href;
                $("#exprot").attr('href', href + "&export=1");
            }
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
    function GetQueryString(name){
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if(r!=null)return  unescape(r[2]); return null;
    }
</script>

</html>
