<!DOCTYPE html>
<html>
<head>
    <title>合同修改</title>
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
                <h2>合同修改</h2>
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
                                                          action="?m=User&c=ht&a=htsave&id=<?php echo $fy['id'];?>" method="post">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">合同编号</span>
                                                            <input type="text" name="ht_sourceNO" id="ht_code"
                                                                   class="form-control" style="width:310px;height: 32px"
                                                                   value="<?php echo $fy['ht_sourceNO'];?>"  readonly>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">商户</span>
                                                            <input type="text" name="ht_venderName" class="form-control"
                                                                    style="width:310px;height: auto" value="<?php echo $fy['ht_venderName'];?>"
                                                                    id="ht_venderName" readonly>
                                                            </input>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">经营方式</span>
                                                            <select type="text" name="ht_business" class="form-control"
                                                                   style="width:310px;height: auto" value="<?php echo $fy['ht_business'];?>"
                                                                   id="ht_business">
                                                                <?php echo $fy['ht_business']==1?'<option value="1" selected>租赁</option><option value="2">联营</option>':'<option value="1" >租赁</option><option value="2" selected>联营</option>';?>
                                                            </select>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">合同起始日期</span>
                                                            <input type="text" name="ht_startT" class="form-control"
                                                                   style="width:310px;height: auto" value="<?php echo $fy['ht_startT'];?>"
                                                                   id="ht_startT">
                                                            </input>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">合同截止日期</span>
                                                            <input type="text" name="ht_endT" class="form-control"
                                                                   style="width:310px;height: auto" value="<?php echo $fy['ht_endT'];?>"
                                                                   id="ht_endT">
                                                            </input>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">经营品牌</span>
                                                            <input type="text" name="ht_pinpai" class="form-control"
                                                                   style="width:310px;height: 30px"
                                                                   value="<?php echo $fy['ht_pinpai'];?>" id="ht_pinpai">
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">保底</span>
                                                            <input type="text" name="ht_baodi" class="form-control"
                                                                   style="width:310px;height: 30px"
                                                                   value="<?php echo $fy['ht_baodi'];?>" id="ht_baodi">
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">扣率</span>
                                                            <input type="text" name="ht_koulv" class="form-control"
                                                                   style="width:310px;height: 30px"
                                                                   value="<?php echo $fy['ht_koulv'];?>" id="ht_koulv">
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">保证金</span>
                                                            <input type="text" name="ht_sure" class="form-control"
                                                                   style="width:310px;height: 30px"
                                                                   value="<?php echo $fy['ht_sure'];?>" id="ht_sure">
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">经营面积</span>
                                                            <input type="text" name="ht_square" class="form-control"
                                                                   style="width:310px;height: 30px"
                                                                   value="<?php echo $fy['ht_square'];?>" id="ht_square">
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">铺位号</span>
                                                            <input type="text" name="ht_puweiNo" class="form-control"
                                                                   style="width:310px;height: 30px"
                                                                   value="<?php echo $fy['ht_puweiNo'];?>" id="ht_puweiNo">
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">备注</span>
                                                            <textarea type="text" name="ht_content" class="form-control"
                                                                   style="width:310px;height: 60px"
                                                                   id="ht_content" ><?php echo $fy['ht_content'];?>
                                                                </textarea>
                                                        </div>
                                                        <div style="margin-top: 20px;margin-right: 20px;">
                                                            <input type="submit" class="btn btn-primary formSubmit"
                                                                    value="保存"> </input>
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
        $("#ht_startT,#ht_endT").datetimepicker({
            language: 'zh-CN',
            minView: "month",
            format: 'yyyy-mm-dd',//格式化时间
            autoclose: true,
            forceParse: true
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