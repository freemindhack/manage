<!DOCTYPE html>
<html>
<head>
    <title>报表 | 充值台销售统计</title>
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
                <h2>充值台销售统计</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content">
                        <label><span style="">充值台销售统计:</span></label>
                        <form class="form-search form-inline" id="report" action="?m=User&c=report&a=report_czCardsea"
                              method="post">
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
                                            <h1 class="realtime-title btn-sm">充值台销售统计</h1>
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
                                                        <th rowspan="2">充值款台号码</th>
                                                        <th rowspan="2">报表日期</th>
                                                        <th rowspan="2">收银员</th>
                                                        <th rowspan="2">充值合计</th>
                                                        <th colspan="7">其中</th>
                                                        <th rowspan="2">退卡合计</th>
                                                        <th rowspan="2">退卡张数</th>
                                                    </tr>
                                                    <tr>

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
                                                                <td><?php echo $rvv['date']; ?></td>
                                                                <td><?php echo $cashiers[$rvv['obj1']]; ?></td>
                                                                <td><?php echo $rvv['czzje']; ?></td>
                                                                <td><?php echo $rvv['czCash']; ?></td>
                                                                <td><?php echo $rvv['czbank']; ?></td>
                                                                <td><?php echo $rvv['czweChat']; ?></td>
                                                                <td><?php echo $rvv['czaliPay']; ?></td>
                                                                <td><?php echo $rvv['czgift']; ?></td>
                                                                <td><?php echo $rvv['cztuan']; ?></td>
                                                                <td><?php echo $rvv['czother']; ?></td>
                                                                <td><?php echo $rvv['tkzje']; ?></td>
                                                                <td><?php echo $rvv['num']; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr class="widget-list-item">
                                                            <td colspan="3">合计</td>
                                                            <td><?php echo $sum['czzje']; ?></td>
                                                            <td><?php echo $sum['czCash']; ?></td>
                                                            <td><?php echo $sum['czbank']; ?></td>
                                                            <td><?php echo $sum['czweChat']; ?></td>
                                                            <td><?php echo $sum['czaliPay']; ?></td>
                                                            <td><?php echo $sum['czgift']; ?></td>
                                                            <td><?php echo $sum['cztuan']; ?></td>
                                                            <td><?php echo $sum['czother']; ?></td>
                                                            <td><?php echo $sum['tkzje']; ?></td>
                                                            <td><?php echo $sum['num']; ?></td>
                                                        </tr>
                                                    <?php } else { ?>
                                                        <tr class="widget-list-item">
                                                            <td colspan="11">无数据</td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                                <?php echo $pagebar; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
            if(GetQueryString("a")=="report_czCard"){
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
