<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>费用管理 | 费用定义</title>
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/header.tpl.php'; ?>


    <!-- FooTable -->
    <link href="<?php echo RL_PIGCMS_STATIC_PATH; ?>plugins/css/footable/footable.core.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/iCheck/custom.css" rel="stylesheet">
    <style>
        .ibox {
            border: 1px solid #e7eaec;
        }

        .part_item {
            background: none repeat scroll 0 0 #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding-bottom: 15px;
            margin-bottom: 10px;
        }

        .form .part_item p {
            display: inline-block;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 20px 0;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .part_item_b {
            border-top: 1px solid #ccc;
            margin-top: 10px;
        }

        .form .part_item p.active {
            color: #f87b00;
        }

        .part_item input {
            font-size: 14px;
            margin-bottom: 2px;
            margin-right: 5px;
        }

        .pagination {
            margin: 0px;
        }

        .input-group {
            margin: 5px 0;
        }

        .mustInput {
            color: red;
            margin-right: 5px;
        }

        @media (min-width: 768px) {
            .form .part_item p {
                width: 37%;
            }
        }

        @media (min-width: 992px) {
            .form .part_item p {
                width: 24%;
            }
        }

        .form-control, .single-line {
            width: 50%;
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
                <h2>列表</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h3 style="left: 10%">编辑</h3>
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
                                                  action="?m=User&c=qita&a=qitaEsave" method="post">
                                                <input name="id" value="<?php echo $data['id'] ?>" hidden>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">选择商户</span>
                                                    <input type="text"
                                                           class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="" id="" value="<?php echo $data['shop_name'] ?>"
                                                           readonly>
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">销售日期</span>
                                                    <input type="text" name="check_date"
                                                           class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="费用发生日期" id="check_date1"
                                                           value="<?php echo $data['check_date'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">餐卡</span>
                                                    <input type="text" name="sg_ck" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="微信" value="<?php echo $data['sg_ck'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">微信</span>
                                                    <input type="text" name="sg_wx" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="微信" value="<?php echo $data['sg_wx'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">支付宝</span>
                                                    <input type="text" name="sg_zfb" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="支付宝" value="<?php echo $data['sg_zfb'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">美团</span>
                                                    <input type="text" name="sg_mt" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="美团" value="<?php echo $data['sg_mt'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">大众点评</span>
                                                    <input type="text" name="sg_dzdp" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="大众点评" value="<?php echo $data['sg_dzdp'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">百度外卖</span>
                                                    <input type="text" name="sg_lm" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="糯米" value="<?php echo $data['sg_lm'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">饿了么</span>
                                                    <input type="text" name="sg_elm" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="饿了么" value="<?php echo $data['sg_elm'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">点我吧</span>
                                                    <input type="text" name="sg_dwb" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="点我吧" value="<?php echo $data['sg_dwb'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">抵用券/储值卡</span>
                                                    <input type="text" name="sg_dyqcz" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="抵用券/储值卡"
                                                           value="<?php echo $data['sg_dyqcz'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">现金</span>
                                                    <input type="text" name="sg_xj" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="现金" value="<?php echo $data['sg_xj'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">银行内卡</span>
                                                    <input type="text" name="sg_yhnk" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="银行内卡" value="<?php echo $data['sg_yhnk'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">银行外卡</span>
                                                    <input type="text" name="sg_yhwk" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="银行外卡" value="<?php echo $data['sg_yhwk'] ?>">
                                                </div>
                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">转账</span>
                                                    <input type="text" name="sg_zz" class="form-control"
                                                           style="width:310px;height: 30px"
                                                           placeholder="转账" value="<?php echo $data['sg_zz'] ?>">
                                                </div>


                                                <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="width: 150px">备注</span>
                                                    <textarea type="text" name="option5"
                                                              class="form-control"
                                                              style="width:310px;height: 130px"
                                                              placeholder="备注" rows="5"><?php echo $data['option5'] ?>
                                                                    </textarea>
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
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary " onclick="return checkNull()">保存</button>
        </div>
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/footer.tpl.php'; ?>

    </div>
</div>

<script type="text/html" id="employersEditTpl">
    <figure>
        <iframe width="425" height="349" src="?m=User&c=Clearing&a=edit&id={($id)}" frameborder="0"></iframe>
    </figure>
</script>

<!-- FooTable -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/footable/footable.all.min.js"></script>

<!-- iCheck -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/iCheck/icheck.min.js"></script>

<!-- Jquery Validate -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/validate/jquery.validate.min.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function () {
        employers.init();
    });
    !function (a, b) {
        var employers = employers || {};
        employers.init = function () {
            var c = employers;
            b('.footable').footable();
            b('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            b('#check_box').on('ifChanged', function () {
                c.selectall('id[]', 'check_box');
            });
            b('.info_del_all').click(function () {
                c.delAll();
            });
            b('.part_item .checkAll').click(function () {
                var checkItems = b(this).parents('.part_item_t').siblings('.part_item_b').find('p').find('input[name="authority[]"]');
                if (b(this).is(':checked') == false) {
                    checkItems.each(function (ke, el) {
                        $(el).iCheck('uncheck');
                    });
                } else {
                    checkItems.each(function (ke, el) {
                        $(el).iCheck('check');
                    });
                }
            });
            jQuery.extend(jQuery.validator.messages, {
                required: "必填字段",
                remote: "请修正该字段",
                email: "请输入正确格式的电子邮件",
                equalTo: "请再次输入相同的值",
                maxlength: jQuery.validator.format("请输入一个长度最多是 {0} 的字符串"),
                minlength: jQuery.validator.format("请输入一个长度最少是 {0} 的字符串"),
            });
            b('#employersForm').validate({
                errorPlacement: function (error, element) {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    },
                    account: {
                        minlength: 4
                    },
                    password: {
                        minlength: 4
                    }
                }
            });
            b('.formSubmit').click(function () {
                b('#employersForm').submit();
            });
            b('.status-checkbox').change(function () {
                var i = b(this).attr('data-id'), s = b(this).is(':checked') ? 'N' : 'Y';
                $.post('?m=User&c=Clearing&a=field', {id: i, Isdel: s}, function (re) {
                    if (re.status == 0) {
                        swal("错误", re.msg + " :)", "error");
                    }
                }, 'json');
            });
            b('.employersDel').click(function () {
                var c = b(this);
                swal({
                    title: "是否删除这条数据?",
                    text: "删除数据后将无法恢复，确认要删除吗！",
                    type: "warning",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "删除",
                    cancelButtonText: "取消",
                    closeOnConfirm: false,
                    showCancelButton: true,
                }, function () {
                    $.post('?m=User&c=Clearing&a=Del', {id: c.attr('data-id')}, function (re) {
                        if (re.status == 0) {
                            swal("错误", re.info + " :)", "error");
                        } else if (re.status == 1) {
                            swal("成功", re.info + " :)", "success");
                            c.parents('tr').remove();
                            b('.footable').footable();
                        }
                    }, 'json');
                });
            });
            b('.employersEdit').click(function () {
                c.edit(b(this).attr('data-id'));
            });
        };
        employers.selectall = function (name, id) {
            var checkItems = b('input[name="' + name + '"]');
            if ($("#" + id).is(':checked') == false) {
                checkItems.each(function (ke, el) {
                    $(el).iCheck('uncheck');
                });
            } else {
                checkItems.each(function (ke, el) {
                    $(el).iCheck('check');
                });
            }
        }
        employers.delAll = function () {
            swal({
                title: "是否删除选中?",
                text: "删除数据后将无法恢复，确认要删除吗！",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "删除",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                showCancelButton: true,
            }, function () {
                var checkItems = b('input[name="id[]"]'), c = false;

                checkItems.each(function (ke, el) {
                    if ($(el).is(':checked') == true) {
                        c = true;
                    }
                });
                if (c == false) {
                    swal("错误", "你至少需要选中一项 :)", "error");
                    return false;
                }
                $('.employersDelAll').submit();
            });
        }
        employers.edit = function (data) {
            var $data = b('#employersEditTpl').html().replace('{($id)}', data);
            b('#myModal6').find('.modal-content .modal-body').find('.col-lg-12').html($data);
            b('.employersEditJump').click();
            employers.iframeRresponsible();
            var index = window.setTimeout(function () {
                $(window).resize();
            }, 200);
        }
        employers.iframeRresponsible = function () {
            var $allObjects = $("iframe, object, embed"),
                $fluidEl = $("figure");

            $allObjects.each(function () {
                $(this)
                // jQuery .data does not work on object/embed elements
                    .attr('data-aspectRatio', this.height / this.width)
                    .removeAttr('height')
                    .removeAttr('width');
            });
            $(window).resize(function () {
                var newWidth = $fluidEl.width();
                $allObjects.each(function () {
                    var $el = $(this);
                    $el
                        .width(newWidth)
                        .height(newWidth * $el.attr('data-aspectRatio'));
                });
            }).resize();
        }
        a.employers = employers;
    }(window, jQuery);
    $("#check_date,#check_date1").datetimepicker({
        language: 'zh-CN',
        minView: "month",
        format: 'yyyy-mm-dd',//格式化时间
        autoclose: true,
        forceParse: true
    });
    function checkNull() {
        $("#check_date1,#shop_id1").removeClass('error');
        if ($("#shop_id1").val() == "") {
            swal('请选择商户');
            $("#shop_id1").addClass('error');
            return false;
        }

        if ($("#check_date1").val() == "") {
            swal('请选择销售日期');
            $("#check_date1").addClass('error');
            return false;
        }

        $('#form1').submit();
    }
</script>
</body>
</html>