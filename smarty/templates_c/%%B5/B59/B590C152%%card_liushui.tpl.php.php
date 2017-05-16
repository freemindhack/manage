<?php /* Smarty version 2.6.18, created on 2016-07-22 18:35:21
         compiled from D:%5CphpStudy%5CWWW%5Cmanagecms%5C./pigcms_tpl/Merchants/System/card/card_liushui.tpl.php */ ?>
card_status.tpl.php<!DOCTYPE html>
<html>
<head>
    <title>卡管理 | 卡流水管理</title>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <link href="<?php echo @PIGCMS_TPL_STATIC_PATH; ?>
css/cashier.css" rel="stylesheet">
    <link href="<?php echo @RlStaticResource; ?>
plugins/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="<?php echo @RlStaticResource; ?>
plugins/css/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo @RlStaticResource; ?>
plugins/css/footable/footable.core.css" rel="stylesheet">
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
    <script src="<?php echo @RlStaticResource; ?>
plugins/js/footable/footable.all2.min.js"></script>
</head>

<body>
<div id="wrapper">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/leftmenu.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/top.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
                                                    <?php if (! empty ( $this->_tpl_vars['data'] )): ?>
                                                    <?php unset($this->_sections['vv']);
$this->_sections['vv']['name'] = 'vv';
$this->_sections['vv']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['vv']['show'] = true;
$this->_sections['vv']['max'] = $this->_sections['vv']['loop'];
$this->_sections['vv']['step'] = 1;
$this->_sections['vv']['start'] = $this->_sections['vv']['step'] > 0 ? 0 : $this->_sections['vv']['loop']-1;
if ($this->_sections['vv']['show']) {
    $this->_sections['vv']['total'] = $this->_sections['vv']['loop'];
    if ($this->_sections['vv']['total'] == 0)
        $this->_sections['vv']['show'] = false;
} else
    $this->_sections['vv']['total'] = 0;
if ($this->_sections['vv']['show']):

            for ($this->_sections['vv']['index'] = $this->_sections['vv']['start'], $this->_sections['vv']['iteration'] = 1;
                 $this->_sections['vv']['iteration'] <= $this->_sections['vv']['total'];
                 $this->_sections['vv']['index'] += $this->_sections['vv']['step'], $this->_sections['vv']['iteration']++):
$this->_sections['vv']['rownum'] = $this->_sections['vv']['iteration'];
$this->_sections['vv']['index_prev'] = $this->_sections['vv']['index'] - $this->_sections['vv']['step'];
$this->_sections['vv']['index_next'] = $this->_sections['vv']['index'] + $this->_sections['vv']['step'];
$this->_sections['vv']['first']      = ($this->_sections['vv']['iteration'] == 1);
$this->_sections['vv']['last']       = ($this->_sections['vv']['iteration'] == $this->_sections['vv']['total']);
?>
                                                    <tr class="widget-list-item">
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['cardNo']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['sid']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['SYYId']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['deviceNo']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['OrderNo']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['OrderTime_Time']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['cardUid']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['cardOldAmount']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['cardNowAmount']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['cardMortgage']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['changeAmount']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['UpLoadTime_Time']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['HandlerTime']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['flag']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['receivableAmount']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['paidInAmount']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['giveChangeAmount']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['payTyped']; ?>
</td>
                                                        <td><?php echo $this->_tpl_vars['data'][$this->_sections['vv']['index']]['saleTyped']; ?>
</td>
                                                    </tr>
                                                    <?php endfor; endif; ?>
                                                    <?php else: ?>
                                                    <tr class="widget-list-item">
                                                        <td colspan="18">没有数据!</td>
                                                    </tr>
                                                    <?php endif; ?>
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
                <?php echo $this->_tpl_vars['pagebar']; ?>

            </div>
        </div>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
</div>

</body>
<!-- iCheck -->
<script src="<?php echo @RlStaticResource; ?>
plugins/js/iCheck/icheck.min.js"></script>
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