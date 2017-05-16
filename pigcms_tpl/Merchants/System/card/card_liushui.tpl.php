card_status.tpl.php<!DOCTYPE html>
<html>
<head>
    <title>卡管理 | 卡流水管理</title>
    {pg:include file="$tplHome/System/public/header.tpl.php"}
    <link href="{pg:$smarty.const.PIGCMS_TPL_STATIC_PATH}css/cashier.css" rel="stylesheet">
    <link href="{pg:$smarty.const.RlStaticResource}plugins/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="{pg:$smarty.const.RlStaticResource}plugins/css/iCheck/custom.css" rel="stylesheet">
    <link href="{pg:$smarty.const.RlStaticResource}plugins/css/footable/footable.core.css" rel="stylesheet">
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
    <script src="{pg:$smarty.const.RlStaticResource}plugins/js/footable/footable.all2.min.js"></script>
</head>

<body>
<div id="wrapper">
    {pg:include file="$tplHome/System/public/leftmenu.tpl.php"}
    <div id="page-wrapper" class="gray-bg">
        {pg:include file="$tplHome/System/public/top.tpl.php"}
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
                        <form class="form-search form-inline" id="xinxi" action="?m=System&c=card&a=card_liushuiSea"
                              method="post">
                            <input class="input-medium search-query" id="cardNo" type="text" style="height:auto"
                                   placeholder="请输入卡号" name="cardNo"/>
                            <input type="text" name="dtbegin" id="datepicker1" style="height:auto"
                                   placeholder="请选择开始时间"/>
                            <input type="text" name="dtend" id="datepicker2" style="height:auto" placeholder="请选择结束时间"/>
                            <button class="btn search-query" style="margin-bottom: 20px" onclick="return pin()">查找</button>
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
                                                        <th data-hide="phone">客户端ID</th>
                                                        <th data-hide="phone">收银员id</th>
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
                                                    {pg:if !empty($data)}
                                                    {pg:section name=vv loop=$data}
                                                    <tr class="widget-list-item">
                                                        <td>{pg:$data[vv].cardNo}</td>
                                                        <td>{pg:$data[vv].sid}</td>
                                                        <td>{pg:$data[vv].SYYId}</td>
                                                        <td>{pg:$data[vv].deviceNo}</td>
                                                        <td>{pg:$data[vv].OrderNo}</td>
                                                        <td>{pg:$data[vv].OrderTime_Time}</td>
                                                        <td>{pg:$data[vv].cardUid}</td>
                                                        <td>{pg:$data[vv].cardOldAmount}</td>
                                                        <td>{pg:$data[vv].cardNowAmount}</td>
                                                        <td>{pg:$data[vv].cardMortgage}</td>
                                                        <td>{pg:$data[vv].changeAmount}</td>
                                                        <td>{pg:$data[vv].UpLoadTime_Time}</td>
                                                        <td>{pg:$data[vv].HandlerTime}</td>
                                                        <td>{pg:$data[vv].flag}</td>
                                                        <td>{pg:$data[vv].receivableAmount}</td>
                                                        <td>{pg:$data[vv].paidInAmount}</td>
                                                        <td>{pg:$data[vv].giveChangeAmount}</td>
                                                        <td>{pg:$data[vv].payTyped}</td>
                                                        <td>{pg:$data[vv].saleTyped}</td>
                                                    </tr>
                                                    {pg:/section}
                                                    {pg:else}
                                                    <tr class="widget-list-item">
                                                        <td colspan="18">没有数据!</td>
                                                    </tr>
                                                    {pg:/if}
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
                {pg:$pagebar}
            </div>
        </div>
        {pg:include file="$tplHome/System/public/footer.tpl.php"}
    </div>
</div>

</body>
<!-- iCheck -->
<script src="{pg:$smarty.const.RlStaticResource}plugins/js/iCheck/icheck.min.js"></script>
<script>
    $(function(){
        $("#datepicker1,#datepicker2").datetimepicker({
            language: 'zh-CN',
            showSecond: true, //显示秒
            format: 'yyyy-mm-dd hh:ii:ss',//格式化时间
            stepHour: 1,//设置步长
            stepMinute: 1,
            stepSecond: 1,
            autoclose:true,
            forceParse:true
        });
    });
    function pin() {
        var t1=$('#datepicker1').val();
        var t2=$('#datepicker2').val();
        if(t1!=''&&t2!=''&&t1>t2){
            swal('开始时间必须小于结束时间!');
            return false;
        }

        var str = $('#xinxi').attr('action') + '&' + $('#xinxi').serialize();
        $('#xinxi').attr('action', str);return true;
    }
</script>

</html>