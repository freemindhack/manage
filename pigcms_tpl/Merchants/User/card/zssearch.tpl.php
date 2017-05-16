<!DOCTYPE html>
<!--suppress ALL -->
<html>
<head>
    <title>卡管理 | 卡赠送金额查询</title>
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/header.tpl.php'; ?>
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/cashier.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/iCheck/custom.css" rel="stylesheet">
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
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/footable/footable.all2.min.js"></script>
</head>

<body>
<div id="wrapper">
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/leftmenu.tpl.php'; ?>
    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/top.tpl.php'; ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>卡赠送金额查询</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content">
                        <label><span style="">卡赠送金额查询:</span></label>
                        <form class="form-search form-inline" id="card_infoma" action="?m=User&c=card&a=zssearch"
                              method="post">
                            <input class="input-medium search-query" type="text" style="height:auto" placeholder="请输入卡号"
                                   name="cardno" value="<?php echo $zs['cardno']; ?>"/>
                            <button type="submit"  class="btn search-query"
                                    style="margin-bottom: 20px">查找
                            </button>
                        </form>
                    </div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="app__content js-app-main page-cashier">
                                <div>
                                    <!-- 实时交易信息展示区域 -->
                                    <div class="cashier-realtime">
                                        <div class="realtime-title-block clearfix">
                                            <h1 class="realtime-title">赠送金额信息</h1>
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
                                                        <th data-hide="phone">可赠送金额</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="js-list-body-region" id="table-list-body">
                                                            <tr class="widget-list-item">
                                                                <td><?php echo $zs['cardno']; ?></td>
                                                                <td><?php echo $zs['maygive']; ?></td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                                <div class="js-list-empty-region"></div>
                                            </div>

                                            <!-- 模态框（Modal） -->
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
<script>
    function card_freeze(a) {
        $("#cardno").attr('data-id', a);
        $("#myModal").modal('show');
    }
    function card_infoma() {
        var str = $('#card_infoma').attr('action') + '&' + $('#card_infoma').serialize();
        $('#card_infoma').attr('action', str);
    }
    function freeze() {
        var c = $("#cardno").attr('data-id');
        var info = $("#info").val();
        if (!info) {
            swal('冻结说明为空');
            return false;
        }
        $.post('?m=User&c=card&a=freeze', {CardNo: c, Note: info}, function (re) {
            if (re.status == 1) {
                $("#myModal").modal('hide');
                swal({title:"成功", text:re.info + " :)", type: "success"},function(){  history.go(0); });
            } else {
                swal("错误", re.info + " :)", "error");
            }
        }, 'json');
    }
    function card_unfreeze(b) {
        swal({
            title: "解冻",
            text: "您确定要解冻吗?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
                $.post('?m=User&c=card&a=card_unfreeze', {CardNo: b,}, function (re) {
                    if (re.status == 1) {
                        $("#myModal").modal('hide');
                        swal({title:"成功", text:re.info + " :)", type: "success"},function(){  history.go(0); });
                    } else {
                        swal("错误", re.info + " :)", "error");
                    }
                }, 'json');
        });

    }

</script>

</html>