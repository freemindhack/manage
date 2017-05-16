<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>商户管理 | 商户列表</title>
    <script src="<?php echo $this->RlStaticResource;?>js/jquery-2.1.1.js"></script>
    <link href="<?php echo $this->RlStaticResource; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="<?php echo RL_PIGCMS_STATIC_PATH; ?>plugins/css/footable/footable.core.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/iCheck/custom.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/app.css" rel="stylesheet">

    <script src="<?php echo $this->RlStaticResource;?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/datetimepicker/bootstrap-datetimepicker.zh-cn.js"></script>


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
                <form id="shopForm" class="form" action="?m=User&c=activity&a=acsave" method="post">
                    <input type="hidden" name="id" value="<?php echo $edit['id']; ?>">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="form-group">
                                    <label><span class="mustInput">*</span>活动名称:<span
                                                class="f999">(20字以内)</span></label>
                                    <input type="text" id="shopname" placeholder="请输入活动名称" name="name"
                                           value="<?php echo $edit['name']; ?>" class="form-control required"
                                           aria-required="true">
                                </div>
                                <div class="form-group">
                                    <label><span class="mustInput">*</span>开始时间:</label>
                                    <input type="text" id="datepicker1" placeholder="请输入开始时间" name="acstart"
                                           value="<?php echo $edit['acstart']; ?>" class="form-control required"
                                           aria-required="true">
                                </div>
                                <div class="form-group">
                                    <label><span class="mustInput">*</span>结束时间:</label>
                                    <input type="text" id="datepicker2" placeholder="请输入结束时间" name="acend"
                                           value="<?php echo $edit['acend']; ?>" class="form-control required"
                                           aria-required="true">
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

<!-- Page-Level Scripts -->
<script>
    $("#datepicker1,#datepicker2").datetimepicker({
        language: 'zh-CN',
        format: 'yyyy-mm-dd hh:ii:ss',//格式化时间
        autoclose: true,
        forceParse: true
    });

</script>
</body>
</html>