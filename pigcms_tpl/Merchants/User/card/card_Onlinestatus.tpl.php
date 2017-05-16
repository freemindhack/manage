<!DOCTYPE html>
<!--suppress ALL -->
<html>
<head>
    <title>卡管理 | 卡状态管理(在线)</title>
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
                <h2>卡状态管理（在线）</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content">
                        <label><span style="">卡状态查询:</span></label>
                        <form class="form-search form-inline" id="card_infoma" action="?m=User&c=card&a=card_Onlininfoma"
                              method="post">
                            <input class="input-medium search-query" type="text" style="height:auto" placeholder="请输入卡号"
                                   name="cardNo"/>
                            <input class="input-medium search-query" type="text" style="height:auto"
                                   placeholder="请输入卡上余额下限" name="down"/>
                            <input class="input-medium search-query" type="text" style="height:auto"
                                   placeholder="请输入卡上余额上限" name="up"/>
                            <button type="submit" onclick="return card_infoma()" class="btn search-query"
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
                                            <h1 class="realtime-title">冻结信息</h1>
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
                                                        <th data-hide="phone">卡原始id</th>
                                                        <th data-hide="phone">卡类型</th>
<!--                                                        <th data-hide="phone">发卡门店</th>-->
<!--                                                        <th data-hide="phone">卡状态</th>-->
                                                        <th data-hide="phone">卡上可用金额</th>
<!--                                                        <th data-hide="phone">卡上押金</th>-->
<!--                                                        <th data-hide="phone">卡总金额</th>-->
<!--                                                        <th data-hide="phone">系统中卡金额</th>-->
<!--                                                        <th data-hide="phone">系统中卡押金</th>-->
<!--                                                        <th data-hide="phone">系统中卡卡总金额</th>-->
                                                        <th data-hide="phone">最后一次变更金额</th>
                                                        <th data-hide="phone">最后一次变更时间</th>
                                                        <th data-hide="phone">启用时间</th>
                                                        <th data-hide="phone">记录创建时间</th>
                                                        <th data-hide="phone">上次矫正时间</th>
                                                        <th data-hide="phone">备注</th>
                                                        <th data-hide="phone">操作</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="js-list-body-region" id="table-list-body">
                                                    <?php if (!empty($data)) {
                                                        foreach ($data as $rvv) {
                                                            ?>
                                                            <tr class="widget-list-item">
                                                                <td><?php echo $rvv['cardNo']; ?></td>
                                                                <td><?php echo $rvv['cardUid']; ?></td>
                                                                <td><?php echo $rvv['cardType']; ?></td>
                                                                <td><?php echo $rvv['cardAmount']; ?></td>
                                                                <td><?php echo $rvv['lastChangeAmount']; ?></td>
                                                                <td><?php echo $rvv['lastChangeTime']; ?></td>
                                                                <td><?php echo $rvv['enableTime']; ?></td>
                                                                <td><?php echo $rvv['createTime']; ?></td>
                                                                <td><?php echo $rvv['correctingTime']; ?></td>
                                                                <td><?php echo $rvv['note']; ?></td>
                                                                <?php if ($rvv['cardStatus'] == 'Y') { ?>
                                                                    <td class="footable-last-column">
                                                                        <a>
                                                                            <button
                                                                                onclick="return card_freeze(<?php echo $rvv['cardNo']; ?>)"
                                                                                class="btn btn-primary btn-small">
                                                                                冻结
                                                                            </button>
                                                                        </a>
                                                                    </td>
                                                                <?php } elseif ($rvv['cardStatus'] == 'D') { ?>
                                                                    <td class="footable-last-column">
                                                                        <a>
                                                                            <button
                                                                                onclick="return card_unfreeze(<?php echo $rvv['cardNo']; ?>)"
                                                                                class="btn btn-danger btn-small">
                                                                                解冻
                                                                            </button>
                                                                        </a>
                                                                    </td>
                                                                <?php }else{ ?>
                                                                    <td class="footable-last-column">
                                                                        <a>

                                                                        </a>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr class="widget-list-item">
                                                            <td colspan="18">没有数据!</td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                                <div class="js-list-empty-region"></div>
                                            </div>

                                            <!-- 模态框（Modal） -->
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal" aria-hidden="true">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel">
                                                                冻结
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input id="cardno" class="input-medium search-query"
                                                                   type="text" style="visibility: hidden"
                                                                   name="cardNo"/>
                                                            <textarea id="info" class="input-medium search-query"
                                                                      type="text" style="height:300px;width: 100%"
                                                                      placeholder="请输入冻结说明"
                                                                      name="note"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">关闭
                                                            </button>
                                                            <button onclick="return freeze()" type="button"
                                                                    class="btn btn-primary">
                                                                提交
                                                            </button>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal -->
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