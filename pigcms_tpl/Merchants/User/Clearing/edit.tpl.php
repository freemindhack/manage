<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>收银台 | 员工列表</title>

    <link href="<?php echo $this->RlStaticResource; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="<?php echo RL_PIGCMS_STATIC_PATH; ?>plugins/css/footable/footable.core.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/iCheck/custom.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/app.css" rel="stylesheet">
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
    </style>
</head>

<body>

<div id="wrapper">
    <div class="gray-bg">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <form id="editForm" class="form" action="?m=User&c=Clearing&a=edit" method="post">
                    <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="form-group">
                                    <label>费用名称:</label>
                                    <input type="text" id="lease_fee" value="<?php echo $res['name'] ?>"
                                           name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>分类:</label>
                                    <select type="text" id="health_fee"  name="class" class="form-control">
                                        <option value="0" <?php if ($res['class']=='0') echo 'selected'; ?>>普通</option>
                                        <option value="1" <?php if ($res['class']=='1') echo 'selected'; ?>>水电燃气</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>基数(单价):</label>
                                    <input type="text" id="split_fee" value="<?php echo $res['base'] ?>"
                                           name="base" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary pull-right">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Mainly scripts -->
<script src="<?php echo $this->RlStaticResource; ?>js/jquery-2.1.1.js"></script>
<script src="<?php echo $this->RlStaticResource; ?>bootstrap/js/bootstrap.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/pace/pace.min.js"></script>

<!-- iCheck -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/iCheck/icheck.min.js"></script>

<!-- Sweet alert -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/sweetalert/sweetalert.min.js"></script>

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
        };
        a.employers = employers;
    }(window, jQuery);
</script>
</body>
</html>