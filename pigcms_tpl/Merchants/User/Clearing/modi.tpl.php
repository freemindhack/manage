<!DOCTYPE html>
<html>
<head>
    <title>费用 | 费用修改</title>
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/header.tpl.php'; ?>
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/cashier.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo RL_PIGCMS_STATIC_PATH; ?>plugins/css/footable/footable.core.css" rel="stylesheet">
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/footable/footable.all.min.js"></script>
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/validate/jquery.validate.min.js"></script>
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

        .pagination {
            margin: 0px;
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
                <h2>费用修改</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content">
                        <label><span style="">查询:</span></label>
                        <form class="form-search form-inline" id="report" action="?m=User&c=Clearing&a=modiSea"
                              method="post">
                            <select class="input-medium search-query" id="cardNo" type="text"
                                    style="height:auto;width: auto" name="shop_id">
                                <option value="">请选择商户</option>
                                <?php foreach ($info2 as $key => $va) {
                                    echo '<option value="' . $va['ht_venderID'] . '">' . $va['ht_venderName'] . '</option>';
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
                            <select class="input-medium search-query" id="cardNo" type="text"
                                    style="height:auto;width: auto" name="fee_no">
                                <option value="">请选择费用类型</option>
                                <?php foreach ($info1 as $key => $va) {
                                    echo '<option value="' . $va['id'] . '">' . $va['name'] . '</option>';
                                } ?>
                            </select>
                            <button class="btn search-query" style="margin-bottom: 20px" onclick="return pin()">查找
                            </button>
                        </form>
                    </div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="app__content js-app-main page-cashier">
                                <div>
                                    <div class="js-real-time-region realtime-list-box loading">
                                        <div class="widget-list">
                                            <div class="ui-box">
                                                <form class="rolesDelAll"
                                                      method="post">
                                                    <table class="footable ui-table ui-table-list" data-page-size="12"
                                                           style="padding: 0px;">
                                                        <thead
                                                            class="js-list-header-region tableFloatingHeaderOriginal">
                                                        <tr class="widget-list-header">
                                                            <th data-sort-ignore="true" class="check-mail"><input
                                                                    type="checkbox" class="i-checks" id="check_box">
                                                            </th>
                                                            <th>商户名称</th>
                                                            <th>结算期</th>
                                                            <th>费用名称</th>
                                                            <th>费用发生日期</th>
                                                            <th>起始日期</th>
                                                            <th>结束日期</th>
                                                            <th>位置</th>
                                                            <th>计费起始值</th>
                                                            <th>计费结束值</th>
                                                            <th>实际用量</th>
                                                            <th>单价</th>
                                                            <th>计费金额</th>
                                                            <th>调整金额</th>
                                                            <th>费用金额</th>
                                                            <th>备注</th>
                                                            <th>状态[Y:已审核]</th>
                                                            <th>操作</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="js-list-body-region" id="table-list-body">
                                                        <?php if (!empty($info)) {
                                                            foreach ($info as $rvv) {
                                                                ?>
                                                                <tr class="widget-list-item">
                                                                    <td class="check-mail"><input type="checkbox"
                                                                                                  class="i-checks"
                                                                                                  value="<?php echo $rvv['id']; ?>"
                                                                                                  name="id[]"></td>
                                                                    <td><?php echo $rvv['shop_name']; ?></td>
                                                                    <td><?php echo $rvv['js_date']; ?></td>
                                                                    <td><?php echo $rvv['fee_name']; ?></td>
                                                                    <td><?php echo $rvv['fee_date']; ?></td>
                                                                    <td><?php echo $rvv['fee_start']; ?></td>
                                                                    <td><?php echo $rvv['fee_end']; ?></td>
                                                                    <td><?php echo $rvv['fee_position']; ?></td>
                                                                    <td><?php echo $rvv['jf_start']; ?></td>
                                                                    <td><?php echo $rvv['jf_end']; ?></td>
                                                                    <td><?php echo $rvv['jf_use']; ?></td>
                                                                    <td><?php echo $rvv['jf_price']; ?></td>
                                                                    <td><?php echo $rvv['jf_money']; ?></td>
                                                                    <td><?php echo $rvv['jf_adjust']; ?></td>
                                                                    <td><?php echo $rvv['fy_price']; ?></td>
                                                                    <td><?php echo $rvv['content']; ?></td>
                                                                    <td><?php echo $rvv['check']; ?></td>
                                                                    <td class="footable-last-column">
                                                                        <a href="?m=User&c=Clearing&a=Lrfix&id=<?php echo $rvv['id']; ?>"
                                                                           class="btn btn-white btn-sm employersEdit" <?php if ($rvv['check'] == "Y") echo 'disabled'; ?> ><i
                                                                                class="fa fa-pencil"></i> 修改</a>
                                                                        <a href="javascript:void(0)"
                                                                           class="btn btn-white btn-sm checklr"
                                                                           data-id="<?php echo $rvv['id']; ?>" <?php if ($rvv['check'] == "Y") echo 'disabled'; ?>>审核</a>
                                                                        <a href="javascript:void(0)"
                                                                           class="btn btn-white btn-sm feeDel"
                                                                           data-id="<?php echo $rvv['id']; ?>" <?php if ($rvv['check'] == "Y") echo 'disabled'; ?>><i
                                                                                class="fa fa-times"></i> 删除</a>
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
                                                </form>
                                                <div class="js-list-empty-region"></div>
                                            </div>
                                            <div class="tooltip-demo">
                                                <button class="btn btn-white btn-sm info_del_all" data-toggle="tooltip"
                                                        data-placement="bottom" title="" data-original-title="审核选中">审核选中
                                                </button>
                                                <ul class="pagination pull-right"></ul>
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
            b('#shopForm').validate({
                errorPlacement: function (error, element) {
                    element.before(error);
                },
                rules: {
                    tel: {
                        minlength: 11,
                        maxlength: 11
                    }
                }
            });
            b('.formSubmit').click(function () {
                if (b('#shopname').val() != '') {
                    $.post('?m=User&c=shop&a=check&' + $("form").serialize(), function (re) {
                        if (re.status == 0) {
                            b('#tel').addClass('error');
                            swal("错误", re.msg + " :)", "error");
                        } else if (re.status == 1) {
                            b('#shopForm').submit();
                        }
                    }, 'json');
                } else {
                    b('#shopForm').submit();
                }
            });
            b('.status-checkbox').change(function () {
                var i = b(this).attr('data-id'), s = b(this).is(':checked') ? 1 : 0;
                $.post('?m=User&c=system&a=field', {eid: i, status: s}, function (re) {
                    if (re.status == 0) {
                        swal("错误", re.msg + " :)", "error");
                    }
                }, 'json');
            });
            b('.shopDel').click(function () {
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
                    $.post('?m=User&c=shop&a=shopDel', {Id: c.attr('data-id')}, function (re) {
                        if (re.status == 0) {
                            swal("错误", re.msg + " :)", "error");
                        } else {
                            swal("成功", re.msg + " :)", "success");
                            c.parents('tr').remove();
                            b('.footable').footable();
                        }
                    }, 'json');
                });
            });
            b('.shopEdit').click(function () {
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
                title: "是否审核选中?",
                text: "审核后将无法恢复，确认要审核吗！",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "审核",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                showCancelButton: true,
            }, function () {
                var tt=new Array();
                var checkItems = b('input[name="id[]"]'), c = false;

                checkItems.each(function (ke, el) {
                    if ($(el).is(':checked') == true) {
                       b=tt.push($(el).val());
                        c = true;
                    }
                });

                if (c == false) {
                    swal("错误", "你至少需要选中一项:)", "error");
                    return false;
                }
                $.post('?m=User&c=Clearing&a=allcheck',{id:tt},function(re){
                    if(re.status ==1){
                        window.location.reload();
                        swal("错误", re.info+"", "success");
                    }
                },'json');
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
    $(function () {
        $("#datepicker1,#datepicker2").datetimepicker({
            language: 'zh-CN',
            minView: "month",
            format: 'yyyy-mm-dd',//格式化时间
            autoclose: true,
            forceParse: true
        });
        $(".feeDel").click(function () {
            var y = $(this);
            //var id=$(this).attr('data-id');
            swal({
                    title: "删除",
                    text: "删除后不可恢复,确定删除?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "删除",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        type: "POST",
                        url: "?m=User&c=Clearing&a=modiDel",
                        data: {id: y.attr('data-id')},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 1) {
                                y.parents('tr').remove();
                                swal('删除成功!');
                            } else swal('删除失败!');
                        }
                    });
                }
            );

        });
        $(".checklr").click(function () {
            var y = $(this);
            //var id=$(this).attr('data-id');
            swal({
                    title: "审核",
                    text: "审核后不可修改,确定审核?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "审核",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        type: "POST",
                        url: "?m=User&c=Clearing&a=checklr",
                        data: {id: y.attr('data-id')},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 1) {
                                swal({
                                    title: "审核!",
                                    text: "审核成功!",
                                    timer: 1000,
                                    showConfirmButton: false
                                });
                                location.replace(location.href);
                            } else swal('删除失败!');
                        }
                    });
                }
            );

        });


    });
    function pin() {
        var str = $('#report').attr('action') + '&' + $('#report').serialize();
        $('#report').attr('action', str);
        return true;
    }
</script>

</html>