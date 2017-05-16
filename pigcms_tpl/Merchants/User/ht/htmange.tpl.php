<!DOCTYPE html>
<!--suppress ALL -->
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>合同 | 合同管理</title>
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
                <h2>合同管理</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content">
                        <label><span style="">查询:</span></label>
                        <form class="form-search form-inline" id="card_infoma" action="?m=User&c=ht&a=htsear"
                              method="post">
                            <select class="input-medium search-query" type="text" style="height:auto" placeholder="请输入卡号"
                                   name="ht_venderID">
                                <option value="">请选择商户合同</option>
                                <?php foreach ($shop as $key=>$value){
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }?>
                            </select>
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
                                    <div class="js-real-time-region realtime-list-box loading">
                                        <div class="widget-list">
                                            <div class="js-list-filter-region clearfix ui-box"
                                                 style="position: relative;">
                                                <div class="widget-list-filter"></div>
                                            </div>
                                            <div class="ui-box">
                                                <table class="ui-table ui-table-list" data-page-size="1"
                                                       style="padding: 0px;">
                                                    <thead class="js-list-header-region tableFloatingHeaderOriginal">
                                                    <tr class="widget-list-header">
                                                        <th data-hide="phone">合同编码</th>
                                                        <th data-hide="phone">状态</th>
                                                        <th data-hide="phone">商户名称</th>
                                                        <th data-hide="phone">经营方式</th>
                                                        <th data-hide="phone">起始日期</th>
                                                        <th data-hide="phone">截止日期</th>
                                                        <th data-hide="phone">经营品牌</th>
                                                        <th data-hide="phone">保底</th>
                                                        <th data-hide="phone">扣率</th>
                                                        <th data-hide="phone">面积</th>
                                                        <th data-hide="phone">铺位号</th>
                                                        <th data-hide="phone">备注</th>
                                                        <th data-hide="phone">录入人</th>
                                                        <th data-hide="phone">录入时间</th>
                                                        <th data-hide="phone">审核人</th>
                                                        <th data-hide="phone">审核时间</th>
                                                        <th data-hide="phone">操作</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="js-list-body-region" id="table-list-body">
                                                    <?php if (!empty($data)) {
                                                        foreach ($data as $kk=> $rvv) {
                                                            ?>
                                                            <tr class="widget-list-item">
                                                                <td><?php echo $rvv['ht_sourceNO']; ?></td>
                                                                <td><?php echo $rvv['ht_status']=='Y'?'可用':'不可用'; ?></td>
                                                                <td><?php echo $rvv['ht_venderName']; ?></td>
                                                                <td><?php echo $rvv['ht_business']==1?'租赁':'联营'; ?></td>
                                                                <td><?php echo $rvv['ht_startT']; ?></td>
                                                                <td><?php echo $rvv['ht_endT']; ?></td>
                                                                <td><?php echo $rvv['ht_pinpai']; ?></td>
                                                                <td><?php echo $rvv['ht_baodi']; ?></td>
                                                                <td><?php echo $rvv['ht_koulv']; ?></td>
                                                                <td><?php echo $rvv['ht_square']; ?></td>
                                                                <td><?php echo $rvv['ht_puweiNo']; ?></td>
                                                                <td><?php echo $rvv['ht_content']; ?></td>
                                                                <td><?php echo $rvv['ht_lururen']; ?></td>
                                                                <td><?php echo $rvv['ht_luruTime']; ?></td>
                                                                <td><?php echo $rvv['ht_shenheren']; ?></td>
                                                                <td><?php echo $rvv['ht_shenheTime']; ?></td>
                                                                <td class="footable-last-column">
                                                                    <a href="?m=User&c=ht&a=htfix&id=<?php echo $rvv['id']; ?>"
                                                                       class="btn btn-white btn-sm employersEdit" <?php if ($rvv['ht_check'] == "Y") echo 'disabled'; ?> ><i
                                                                            class="fa fa-pencil"></i> 修改</a>
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-white btn-sm checklr"
                                                                       data-id="<?php echo $rvv['id']; ?>" <?php if ($rvv['ht_check'] == "Y") echo 'disabled'; ?>>审核</a>
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-white btn-sm feeDel"
                                                                       data-id="<?php echo $rvv['id']; ?>" <?php if ($rvv['ht_check'] == "Y") echo 'disabled'; ?>><i
                                                                            class="fa fa-times"></i> 删除</a>
                                                                </td>
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
    $(function () {
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
                        url: "?m=User&c=ht&a=checkht",
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
                        url: "?m=User&c=ht&a=htDel",
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
    })

</script>

</html>