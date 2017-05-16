<!DOCTYPE html>
<html>
<head>
    <title>报表 | 交易清单</title>
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
                <h2>交易清单</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content">
                        <label><span style="">交易清单:</span></label>
                        <form class="form-search form-inline" id="report" action="?m=User&c=report&a=report_qindanSea"
                              method="post">
                            <select class="input-medium search-query" id="cardNo" type="text"
                                    style="height:auto;width: auto" name="uid">
                                <option value="">请选择商户</option>
                                <?php foreach ($shop as $key => $va) {
					if($key==$data['uid']) $s='selected';
                                    echo '<option value="' . $key . '"'.$s.'>' . $va . '</option>';unset($s);
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
                            <input type="text" name="no" style="height:auto"
                                   placeholder="小票编号" value="<?php echo $data['no'];?>"/>
                            <input type="text" name="cashNo" style="height:auto"
                                   placeholder="收银员号" value="<?php echo $data['cashNo'];?>"/>
                            <input type="text" name="dtbegin" id="datepicker1" style="height:auto"
                                   placeholder="请选择开始时间" value="<?php echo $data['dtbegin'];?>" />
                            <input type="text" name="dtend" id="datepicker2" style="height:auto" placeholder="请选择结束时间" value="<?php echo $data['dtend'];?>" />
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
                                            <h1 class="realtime-title btn-sm">交易清单</h1>
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
                                                <table class="ui-table ui-table-list" data-page-size="10"
                                                       style="padding: 0px;">
                                                    <thead class="js-list-header-region tableFloatingHeaderOriginal">
                                                    <tr class="widget-list-header">
                                                        <th>商户</th>
                                                        <th>小票号</th>
                                                        <th>应收</th>
                                                        <th>实收</th>
                                                        <th>找零</th>
                                                        <th>整单折扣额</th>
                                                        <th>收银员号</th>
                                                        <th>收银机号</th>
                                                        <th>开单时间</th>
                                                        <th>结账时间</th>
                                                        <th>操作</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="js-list-body-region" id="table-list-body">
                                                    <?php if (!empty($result)) {
                                                        foreach ($result as $rvv) {
                                                            ?>
                                                            <tr class="widget-list-item" style="height: 40px">
                                                                <td><?php echo $shop[$rvv['shopNo']]; ?></td>
                                                                <td><?php echo $rvv['no']; ?></td>
                                                                <td><?php echo $rvv['remoney']; ?></td>
                                                                <td><?php echo $rvv['acmoney']; ?></td>
                                                                <td><?php echo $rvv['cgmoney']; ?></td>
                                                                <td><?php echo $rvv['totalDiscount']?$rvv['totalDiscount']:0; ?></td>
                                                                <td><?php echo $rvv['by']; ?></td>
                                                                <td><?php echo $rvv['cashNo']; ?></td>
                                                                <td><?php echo $rvv['startTime']; ?></td>
                                                                <td><?php echo $rvv['endTime']?$rvv['endTime']:$rvv['startTime']; ?></td>
                                                                <td class="footable-last-column">
                                                                    <a href="?m=User&c=report&a=report_detail&sid=<?php echo $rvv['sid']; ?>"
                                                                       target="_blank">
                                                                        <button class="btn btn-sm btn-primary"><strong>订单详情</strong>
                                                                        </button>
                                                                    </a>
                                                                </td>
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
            format: 'yyyy-mm-dd hh:ii:ss',//格式化时间
            autoclose: true,
            forceParse: true
        });
        $("#exprot").click(function () {
            if(GetQueryString("a")=="report_qindan"){
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
    // 调用方法


</script>

</html>
