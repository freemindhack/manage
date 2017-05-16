<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首页</title>
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/header.tpl.php'; ?>
    <link rel="stylesheet" href="<?php echo $this->RlStaticResource; ?>plugins/css/datapicker/datepicker3.css">
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/echarts.js"></script>
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/datapicker/datepicker.zh-CN.js"></script>
</head>
<style>
    .showblock {
        width: 450px;
        height: 150px;
        float: left;
        margin: 10px 20px;
    }

    .showblock1 {
        width: 600px;
        height: 150px;
        float: left;
        margin: 10px 20px;
    }

    .font-size {
        font-size: 30px;
    }

    .link2 {
        font-size: 22px;
    }

    .ht-height {
        line-height: 20px;
    }

    .fz-3 {
        padding: 20px;
        font-size: 60px;
        color: black;
    }

    .fz-4 {
        font-size: 16px;
    }

    .fz-c2 {
        color: black;
    }

    .fz-c1 {
        color: grey;
    }

</style>
<body>

<?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/leftmenu.tpl.php'; ?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/top.tpl.php'; ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="container-fluid">
            <div style="border-bottom: solid black 1px;margin-top: 20px"></div>
            <h2>商户信息</h2>
            <div class="row" style="margin-top: 20px">
                <div class="showblock">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-5 text-left">
                                    <div class="link2">商户数量（个）</div>
                                </div>
                                <div class="col-xs-7 text-right">
                                    <a href="?m=User&c=shop&a=manageShop" class="link2">商户管理</a>
                                </div>
                                <div class="col-xs-12">
                                    <hr/>
                                </div>
                                <div class="ht-height">
                                    <div>
                                        <div class="text-center"><p
                                                    class="fz-3 fz-c2"><?php echo $shopnum['num']; ?></p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showblock">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <div class="link2">未处理交易（笔）</div>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <a href="" class="link2">销售额管理</a>
                                </div>
                                <div class="col-xs-12">
                                    <hr/>
                                </div>
                                <div class="ht-height">
                                    <div>
                                        <div class="text-center"><p
                                                    class="fz-3 fz-c2"><?php echo $recordnum['num']; ?></p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
            <div style="border-bottom: solid black 1px;margin-top: 20px"></div>
            <h2>卡信息</h2>
            <div class="row" style="margin-top: 20px">
                <div class="showblock">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-5 text-left">
                                    <div class="link2">卡数量（张）</div>
                                </div>
                                <div class="col-xs-7 text-right">
                                    <a href="?m=User&c=card&a=card_class" class="link2">卡分类</a>
                                    <strong>|</strong>
                                    <a href="?m=User&c=card&a=card_liushui" class="link2">卡明细</a>
                                </div>
                                <div class="col-xs-12">
                                    <hr/>
                                </div>
                                <div class="ht-height">
                                    <div>
                                        <div class="text-center"><p
                                                    class="fz-3 fz-c2"><?php echo $cardnum['num']; ?></p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showblock1">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4 text-left">
                                    <div class="link2">卡状态</div>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <a href="?m=User&c=card&a=card_status" class="link2">卡状态管理</a>
                                    <strong>|</strong>
                                    <a href="?m=User&c=card&a=card_liushui" class="link2">卡流水查询</a>
                                </div>
                                <div class="col-xs-12">
                                    <hr/>
                                </div>
                                <div class="ht-height">
                                    <div>
                                        <div class="text-center fz-4">
                                            <p class="col-xs-3 fz-c1">使用中（张）</p>
                                            <p class="col-xs-3 fz-c2"><?php echo $carsYnum['num']; ?></p>
                                            <p class="col-xs-3 fz-c1">卡余额（元）</p>
                                            <p class="col-xs-3 fz-c2"><?php echo $carsYnum['total'] ? $carsYnum['total'] : 0; ?></p>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center fz-4">
                                            <p class="col-xs-3 fz-c1">冻结卡（张）</p>
                                            <p class="col-xs-3 fz-c2"><?php echo $carsDnum['num']; ?></p>
                                            <p class="col-xs-3 fz-c1">卡余额（元）</p>
                                            <p class="col-xs-3 fz-c2"><?php echo $carsDnum['total'] ? $carsDnum['total'] : 0; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="border-bottom: solid black 1px;margin-top: 20px"></div>
            <h2>营业数据</h2>
            <ul id="myTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#home" data-toggle="tab" id="callhome">
                        充值款台
                    </a>
                </li>
                <li><a href="#ios" data-toggle="tab" id="callios">档口收款机</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="home">
                    <div class="alert alert-danger alert-dismissable" id="tips" hidden>
                        <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            &times;
                        </button>
                        开始日期应小于结束日期！最长不超过30天。
                    </div>
                    <div>
                        <div class="col-xs-3">
<!--                            <a type="button" class="btn-info btn-sm" id="down" href="http://manage.cc/download/Product.csv"><i class="fa fa-comments"></i>下载报表-->
                            </a>
                        </div>
                        <div class="col-xs-7 pull-center">
                            <div class="form-group">
                                <div class="col-xs-2"><label>
                                        <input type="radio" name="day" id="opt1" value="7">近7天
                                    </label>
                                    <label>
                                        <input type="radio" name="day" id="opt2" value="30">近30天
                                    </label>
                                </div>
                                <div class="col-xs-2">
                                    <label>
                                        <input type="radio" name="day" value="-1" id="datepicker">时间区间
                                    </label>
                                </div>
                                <div class="input-daterange input-group col-xs-8">
                                    <input type="text" class="form-control" name="start" id="qBeginTime"
                                           value="<?php echo date('Y-m-d', strtotime('-6 days')) ?>"/>
                                    <span class="input-group-addon">至</span>
                                    <input type="text" class="form-control" name="end" id="qEndTime"
                                           value="<?php echo date('Y-m-d', time()) ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="home1">
                        <?php
                        include $this->showTpl('callhome');
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="ios">
                    <div>
                        <div class="alert alert-danger alert-dismissable" id="tips1" hidden>
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">
                                &times;
                            </button>
                            开始日期应小于结束日期！最长不超过30天。
                        </div>
                        <div class="col-xs-3">
<!--                            <button type="button" class="btn-info btn-sm" id="down1"><i class="fa fa-comments"></i>下载报表-->
                            </button>
                        </div>
                        <div class="col-xs-7 pull-center">
                            <div class="form-group">
                                <div class="col-xs-2"><label>
                                        <input type="radio" name="day1" id="opt3" value="7">近7天
                                    </label>
                                    <label>
                                        <input type="radio" name="day1" id="opt4" value="30">近30天
                                    </label>
                                </div>
                                <div class="col-xs-2">
                                    <label>
                                        <input type="radio" name="day1" value="-1" id="datepicker1">时间区间
                                    </label></div>
                                <div class="input-daterange input-group col-xs-8">
                                    <input type="text" class="form-control" name="start1" id="qBeginTime1"
                                           value="<?php echo date('Y-m-d', strtotime('-6 days')) ?>"/>
                                    <span class="input-group-addon">至</span>
                                    <input type="text" class="form-control" name="end1" id="qEndTime1"
                                           value="<?php echo date('Y-m-d', time()) ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="ios1">
                        <?php
                        include $this->showTpl('callios');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/footer.tpl.php'; ?>
</body>
<script type="text/javascript">
    $(function () {
        var $home = $("#callhome");
        var $ios = $("#callios");
        $home.on(
            "click", function () {
                $('#opt1').attr('checked', 'true');
                $.ajax({
                    url: "?m=User&c=index&a=callhome",
                    type: "post",
                    data: {day: 7},
                    success: function (data) {
                        $('#home1').html(data);
                    }
                })
            }
        );
        $ios.on("click", function () {
            $('#opt3').attr('checked', 'true');
            $.ajax({
                url: "?m=User&c=index&a=callios",
                type: "post",
                data: {day: 7},
                success: function (data) {
                    $('#ios1').html(data);
                }
            })
        });
        $("#down").on(
            "click", function () {
                //do something下载数据
                $.ajax({
                    url: "?m=User&c=index&a=down1",
                    type: "post",
                    data: {day: 7},
                    success: function (data) {
                        var href = 'http://' + document.domain + data.data;
                        var newWindow = window.open("_blank");
                        newWindow.location = href;
                    }
                })
            }
        );
        function openUrl(b) {
            if (/msie/g.test(navigator.userAgent.toLowerCase()))
                window.open(b, "_blank");

            else {
                var c = a("<a href='" + b + "' target='_blank'>Game</a>").get(0),
                    d = document.createEvent("MouseEvents");
                d.initEvent("click", !0, !0);
                c.dispatchEvent(d)
            }
        };
        $("#opt1").on(
            "click", function () {
                $.ajax({
                    url: "?m=User&c=index&a=callhome",
                    type: "post",
                    data: {day: 7},
                    success: function (data) {
                        $('#home1').html(data);
                    }
                })
            }
        );
        $("#opt2").on(
            "click", function () {
                $.ajax({
                    url: "?m=User&c=index&a=callhome",
                    type: "post",
                    data: {day: 30},
                    success: function (data) {
                        $('#home1').html(data);
                    }
                })
            }
        );
        $("#opt3").on(
            "click", function () {
                $.ajax({
                    url: "?m=User&c=index&a=callios",
                    type: "post",
                    data: {day: 7},
                    success: function (data) {
                        $('#ios1').html(data);
                    }
                })
            }
        );
        $("#opt4").on(
            "click", function () {
                $.ajax({
                    url: "?m=User&c=index&a=callios",
                    type: "post",
                    data: {day: 30},
                    success: function (data) {
                        $('#ios1').html(data);
                    }
                })
            }
        );
        $("#datepicker").on(
            "click", function () {
                $.ajax({
                    url: "?m=User&c=index&a=callhome",
                    type: "post",
                    data: {
                        bt: $("#qBeginTime").val(), et: $("#qEndTime").val()
                    },
                    success: function (data) {
                        $('#home1').html(data);
                    }
                })
            }
        );
        $("#datepicker1").on(
            "click", function () {
                $.ajax({
                    url: "?m=User&c=index&a=callios",
                    type: "post",
                    data: {
                        bt: $("#qBeginTime1").val(), et: $("#qEndTime1").val()
                    },
                    success: function (data) {
                        $('#ios1').html(data);
                    }
                })
            }
        );
        var date = {
            format: 'yyyy-mm-dd',
            todayBtn: "linked",
            autoclose: true,
            language: 'zh-CN',
            todayHighlight: true,
            endDate: new Date()
        };
        $('#qBeginTime').datepicker(date).on('changeDate', function (e) {
            $("#tips").hide();
            var startTime = e.date;
            $('#qEndTime').datepicker('setStartDate', startTime);
            t1 = $("#qBeginTime").val();
            t2 = $("#qEndTime").val();
            if (checkdate(t1, t2)) {
                Dosearch();
            } else $("#tips").show();
        });
        //结束时间：
        $('#qEndTime').datepicker(date).on('changeDate', function (e) {
            $("#tips").hide();
            var endTime = e.date;
            $('#qBeginTime').datepicker('setEndDate', endTime);
            t1 = $("#qBeginTime").val();
            t2 = $("#qEndTime").val();
            if (checkdate(t1, t2)) {
                Dosearch();
            } else $("#tips").show();
        });
        $('#qBeginTime1').datepicker(date).on('changeDate', function (e) {
            $("#tips1").hide();
            var startTime = e.date;
            $('#qEndTime1').datepicker('setStartDate', startTime);
            var t1 = $("#qBeginTime1").val();
            var t2 = $("#qEndTime1").val();
            if (checkdate(t1, t2)) {
                Dosearch1();
            } else $("#tips1").show();
        });
        //结束时间：
        $('#qEndTime1').datepicker(date).on('changeDate', function (e) {
            $("#tips1").hide();
            var endTime = e.date;
            $('#qBeginTime1').datepicker('setEndDate', endTime);
            t1 = $("#qBeginTime1").val();
            t2 = $("#qEndTime1").val();
            if (checkdate(t1, t2)) {
                Dosearch1();
            } else $("#tips1").show();
        });
        function checkdate(t1, t2) {

            var tb = Date.parse(new Date(t1)) / 1000;
            var te = Date.parse(new Date(t2)) / 1000;
            if (tb > te) {
                return false;
            }
            if ((te - tb) > (30 * 24 * 60 * 60)) {
                return false;
            }
            return true;
        }

        function Dosearch(value) {
            var myChart = echarts.init(document.getElementById('chart'));//初始化
            myChart.showLoading({
                text: '数据获取中',
                effect: 'whirling'
            });
            $.ajax({
                type: 'POST',
                url: '?m=User&c=index&a=callhome',
                data: {bt: $('#qBeginTime').val(), et: $('#qEndTime').val()},
                success: function (data) {
                    myChart.hideLoading();
                    myChart.dispose();
                    $('#home1').html(data);
                }
            });
        }

        function Dosearch1(value) {
            var myChart2 = echarts.init(document.getElementById('chartEx'));//初始化
            myChart2.showLoading({
                text: '数据获取中',
                effect: 'whirling'
            });
            $.ajax({
                type: 'POST',
                url: '?m=User&c=index&a=callios',
                data: {bt: $('#qBeginTime1').val(), et: $('#qEndTime1').val()},
                success: function (data) {
                    myChart2.hideLoading();
                    myChart2.dispose();
                    $('#ios1').html(data);
                }
            });
        }
    })
</script>
</html>
