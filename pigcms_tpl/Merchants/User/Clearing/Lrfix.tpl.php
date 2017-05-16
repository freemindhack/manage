<!DOCTYPE html>
<html>
<head>
    <title>费用录入</title>
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/header.tpl.php'; ?>
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/cashier.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/sweetalert/sweetalert.css" rel="stylesheet">
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

        .form-control {
            height: 30px;
            width: 50%;
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

        .input-group {
            margin-top: 10px;
        }

    </style>
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/footable/footable.all2.min.js"></script>
</head>

<body>
<div id="wrapper">
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/leftmenu.tpl.php'; ?>
    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/top.tpl.php'; ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>费用修改</h2>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="app__content js-app-main page-cashier">
                                <div>
                                    <div class="js-real-time-region realtime-list-box loading">
                                        <div class="widget-list">
                                            <div class="js-list-filter-region clearfix ui-box"
                                                 style="position: relative;">
                                                <div class="widget-list-filter"></div>
                                            </div>
                                            <div class="ui-box">
                                                <div style="padding: 10px 10px 10px;">
                                                    <form id='form1' class="bs-example bs-example-form" role="form"
                                                          action="?m=User&c=Clearing&a=fixsave&id=<?php echo $fy['id'];?>" method="post">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">手工单号</span>
                                                            <input type="text" name="no" id="tname"
                                                                   class="form-control" style="width:310px;height: 32px"
                                                                   value="<?php echo $fy['no'];?>" >
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">合同编号</span>
                                                            <input type="text" name="ht_no" class="form-control"
                                                                    style="width:310px;height: auto" value="<?php echo $fy['ht_no'];?>"
                                                                    id="ht_no" readonly>
                                                            </input>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">结算期</span>
                                                            <input type="text" name="ht_no" class="form-control"
                                                                   style="width:310px;height: auto" value="<?php echo $fy['js_date'];?>"
                                                                   id="ht_no" readonly>
                                                            </input>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">费用名称</span>
                                                            <input type="text" name="ht_no" class="form-control"
                                                                   style="width:310px;height: auto" value="<?php echo $fy['fee_name'];?>"
                                                                   id="ht_no" readonly>
                                                            </input>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">费用发生日期</span>
                                                            <input type="text" name="fee_date" class="form-control"
                                                                   style="width:310px;height: 30px"
                                                                   value="<?php echo $fy['fee_date'];?>" id="fee_date">
                                                        </div>
                                                        <div style="display:<?php echo $fy['fee_class']?'block':'none';?>" id="fee_hide">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">费用所属起始日期</span>
                                                                <input type="text" name="fee_start"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       value="<?php echo $fy['fee_start'];?>" id="fee_start">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">费用所属结束日期</span>
                                                                <input type="text" name="fee_end"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       value="<?php echo $fy['fee_end'];?>" id="fee_end">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">费用发生位置</span>
                                                                <input type="text" name="fee_position"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       value="<?php echo $fy['fee_position'];?>">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">费用起始值</span>
                                                                <input type="text" name="jf_start"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       value="<?php echo $fy['jf_start'];?>" id="jf_start">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">费用结束值</span>
                                                                <input type="text" name="jf_end"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       value="<?php echo $fy['jf_end'];?>" id="jf_end">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">实际用量</span>
                                                                <input type="text" name="jf_use"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       value="<?php echo $fy['jf_use'];?>" id="jf_use">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"
                                                                      style="width: 150px">单价</span>
                                                                <input type="text" name="jf_price"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       value="<?php echo $fy['jf_price'];?>">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">计费金额</span>
                                                                <input type="text" name="jf_money"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       value="<?php echo $fy['jf_money'];?>">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">调整金额</span>
                                                                <input type="text" name="jf_adjust"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       value="<?php echo $fy['jf_adjust'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">费用金额</span>
                                                            <input type="text" name="fy_price" class="form-control"
                                                                   style="width:310px;height: 30px" value="<?php echo $fy['fy_price'];?>">
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">备注</span>
                                                            <input type="text" name="content" class="form-control"
                                                                   style="width:310px;height: 30px" value="<?php echo $fy['content'];?>">
                                                        </div>
                                                        <div style="margin-top: 20px;margin-right: 20px;">
                                                            <input type="submit" class="btn btn-primary formSubmit"
                                                                   onclick="return checkNull()" value="保存"> </input>
                                                        </div>
                                                    </form>
                                                </div>
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
            </div>
        </div>
    </div>
</div>
</body>
<script language="javascript">
    //选择水电燃气时候显示隐藏
    $(document).ready(function () {
        $("#fee_date,#fee_start,#fee_end").datetimepicker({
            language: 'zh-CN',
            minView: "month",
            format: 'yyyy-mm-dd',//格式化时间
            autoclose: true,
            forceParse: true
        });
        $("#jf_use").focus(function () {
            if ($("#jf_end").val() != '' && $("#jf_start").val() != '') {
                var js = $("#jf_end").val() - $("#jf_start").val();
                $("#jf_use").val(js);
            }
        });
    });

    function checkNull() {
        if ($("#ht_no").val() === "") {
            $("#ht_no").addClass('error');
            return false;
        }else $("#ht_no").removeClass('error');
        if ($("#js_date").val() === "") {
            $("#js_date").addClass('error');
            return false;
        }else $("#js_date").removeClass('error');
        if ($("#fee").val() === "") {
            $("#fee").addClass('error');
            return false;
        }else $("#fee").removeClass('error');
    }
</script>
</html>