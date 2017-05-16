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
                <h2>费用录入</h2>
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
                                                          action="?m=User&c=Clearing&a=copyin" method="post">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">手工单号</span>
                                                            <input type="text" name="no" id="tname"
                                                                   class="form-control" style="width:310px;height: 32px"
                                                                   placeholder="手工单号">
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">合同编号</span>
                                                            <select type="text" name="ht_no" class="form-control"
                                                                    style="width:310px;height: auto" placeholder="商户编号"
                                                                    id="ht_no">
                                                                <option value="">请选择签订合同商铺</option>
                                                                <?php foreach ($ht as $key => $value) {
                                                                    echo '<option value="' . $value['ht_code'] . '">' . $value['ht_sourceNO'] . '['.$value['ht_venderName'].']</option>';
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">结算期</span>
                                                            <select type="text" name="js_date" class="form-control"
                                                                    style="width:310px;height: 30px" placeholder="结算期"
                                                                    id="js_date">
                                                                <option value="">请选择结算期</option>
                                                                <?php for ($i = -1; $i < 7; $i++) {
                                                                    echo '<option value="' . date("Y-m", strtotime("-" . $i . " month")) . '" >' . date("Y-m", strtotime("-" . $i . " month")) . '</option>';
                                                                } ?>
                                                            </select>
                                                            <span
                                                                style="color: red;height: auto">注意:最终结算费用是根据结算期计算</span>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">费用名称</span>
                                                            <select type="text" name="fee_no" class="form-control"
                                                                    style="width:310px;height: auto" placeholder="商户编号"
                                                                    id="fee">
                                                                <option value="">请选择费用</option>
                                                                <?php foreach ($fee as $key => $value) {
                                                                    echo '<option value="' . $value['id'] . '"  cid="' . $value['class'] . '">' . $value['name'] . '</option>';
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">费用发生日期</span>
                                                            <input type="text" name="fee_date" class="form-control"
                                                                   style="width:310px;height: 30px"
                                                                   placeholder="费用发生日期" id="fee_date">
                                                        </div>
                                                        <div style="display: none" id="fee_hide">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">费用所属起始日期</span>
                                                                <input type="text" name="fee_start"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       placeholder="费用所属起始日期" id="fee_start">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">费用所属结束日期</span>
                                                                <input type="text" name="fee_end"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       placeholder="费用所属结束日期" id="fee_end">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">费用发生位置</span>
                                                                <input type="text" name="fee_position"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       placeholder="费用发生位置">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"
                                                                      style="width: 150px">起始值</span>
                                                                <input type="text" name="jf_start"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       placeholder="费用起始值" id="jf_start">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"
                                                                      style="width: 150px">结束值</span>
                                                                <input type="text" name="jf_end"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       placeholder="费用结束值" id="jf_end">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">实际用量</span>
                                                                <input type="text" name="jf_use"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       placeholder="实际用量" id="jf_use">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"
                                                                      style="width: 150px">单价</span>
                                                                <input type="text" name="jf_price" id="jf_price"
                                                                       class="form-control clear"
                                                                       style="width:310px;height: 30px"
                                                                       placeholder="单价">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">计费金额</span>
                                                                <input type="text" name="jf_money"
                                                                       class="form-control clear" id="jf_money"
                                                                       style="width:310px;height: 30px"
                                                                       placeholder="计费金额">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="width: 150px">调整金额</span>
                                                                <input type="text" name="jf_adjust"
                                                                       class="form-control clear" id="jf_adjust"
                                                                       style="width:310px;height: 30px"
                                                                       placeholder="调整金额">
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">费用金额</span>
                                                            <input type="text" name="fy_price" class="form-control" id="fy_price"
                                                                   style="width:310px;height: 30px" placeholder="费用金额">
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">备注</span>
                                                            <input type="text" name="content" class="form-control"
                                                                   style="width:310px;height: 30px" placeholder="备注">
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
        $('#fee').change(function () {
            var p1 = $(this).find('option:selected').attr("cid");//这就是selected的属性值
            if (p1 == 1) {
                $.ajax({
                    type: "POST",
                    url: "?m=User&c=Clearing&a=get_fee_name",
                    data: {id: $("#fee").val()},
                    dataType: "json",
                    success: function (obj) {
                        $("#jf_price").val(obj.info);
                    }
                });
                $('.clear').val("");
                document.getElementById('fee_hide').style.display = 'block';
            } else {
                $('.clear').val("");
                document.getElementById('fee_hide').style.display = 'none';
            }
        });
        $("#fee_date,#fee_start,#fee_end").datetimepicker({
            language: 'zh-CN',
            minView: "month",
            format: 'yyyy-mm-dd',//格式化时间
            autoclose: true,
            forceParse: true
        });
        $("#jf_end").keyup(function () {
            if ($("#jf_end").val() != '' && $("#jf_start").val() != '') {
                var js = isNaN($("#jf_end").val())?0:$("#jf_end").val() - $("#jf_start").val();
                var js1 =js * $("#jf_price").val();
                $("#jf_money").val(js1);
                $("#jf_use").val(js);
            }
        });
        $("#jf_adjust").keyup(function () {
            if ($("#jf_adjust").val() != '' && $("#jf_money").val() != '') {
                var js = ($("#jf_money").val()-0) + ((isNaN($("#jf_adjust").val())?0:$("#jf_adjust").val())-0);
                $("#fy_price").val(js);
            }
        });
        $("#jf_end").keydown(function (e) {
            var ev = e || window.event;
            if (ev.keyCode == 8) {
                var js = 0;
                js = isNaN($("#jf_end").val())?0:$("#jf_end").val() - $("#jf_start").val();
                var js1 = isNaN(js)?0:js * $("#jf_price").val();
                $("#jf_money").val(js1);
                $("#jf_use").val(js);
            }
        });
        $("#jf_money").focus(function () {
            if ($("#jf_use").val() != '' && $("#jf_price").val() != '') {

            }
        });
    });

    function checkNull() {
        if ($("#ht_no").val() === "") {
            $("#ht_no").addClass('error');
            return false;
        } else $("#ht_no").removeClass('error');
        if ($("#js_date").val() === "") {
            $("#js_date").addClass('error');
            return false;
        } else $("#js_date").removeClass('error');
        if ($("#fee").val() === "") {
            $("#fee").addClass('error');
            return false;
        } else $("#fee").removeClass('error');
    }
</script>
</html>