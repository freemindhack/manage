<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>打印 | 商家（在线）打印</title>
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
                <h2>商家（在线）打印</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="搜索商户">
                            <form target="_blank" action="?m=User&c=print&a=printSelectOnline" class="employersDelAll"
                                  method="post">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10"
                                       data-filter=#filter>
                                    <thead>
                                    <tr>
                                        <th data-sort-ignore="true" class="check-mail"><input type="checkbox"
                                                                                              class="i-checks"
                                                                                              id="check_box"></th>
                                        <th>结算月</th>
                                        <th>商户名称</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($vender)) {

                                        foreach ($vender as $key => $val) { ?>
                                            <tr>
                                                <td class="check-mail"><input type="checkbox" class="i-checks"   value="<?php echo $val['ht_venderID']; ?>"  name="id[]"></td>
                                                <td><?php echo date('Y-m',time()); ?></td>
                                                <td><?php echo $val['ht_venderName']; ?></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center; font-size: 16px;">无数据</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                            <div class="tooltip-demo">
                                <!-- <button class="btn btn-white btn-sm" data-toggle="modal" data-target="#myModal5" data-toggle="tooltip" data-placement="left" title="" data-original-title="添加"><i class="fa fa-plus"></i> 添加</button>-->
                                <button class="btn btn-white btn-sm info_del_all" data-toggle="tooltip"
                                        data-placement="top" title="" data-original-title="打印选择">打印选择
                                </button>
                                <a class="btn btn-white btn-sm" data-toggle="tooltip"
                                   href="?m=User&c=print&a=printallOnline" target="_blank"
                                   data-placement="top" title="" data-original-title="打印全部">打印全部</a>
                                <ul class="pagination pull-right"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/footer.tpl.php'; ?>

    </div>
</div>
<a href="javascript:void(0)" class="employersEditJump" data-toggle="modal" data-target="#myModal6" data-toggle="tooltip"
   data-placement="left" title="" data-original-title="员工信息编辑" style="display: none;">员工信息编辑</a>
<div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">费用管理</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="col-lg-12">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
            </div>
        </div>
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
                $.post('?m=User&c=Clearing&a=check', {shop_id: b('#shop_id').val()}, function (re) {
                    if (re.status == 0) {
                        b('#shop_id').addClass('error');
                        swal("错误", re.info + " :)", "error");
                    } else if (re.status == 1) {
                        b('#employersForm').submit();
                    }
                }, 'json');
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
</script>
</body>
</html>