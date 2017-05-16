<!DOCTYPE html>
<html>
<head>
    <title>报表 | 日充值退卡</title>
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
        .mws-form-col-1-8, .mws-form-col-2-8, .mws-form-col-3-8, .mws-form-col-4-8, .mws-form-col-5-8, .mws-form-col-6-8, .mws-form-col-7-8, .mws-form-col-8-8 {
            float: left;
            padding: 12px 6px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -ms-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -khtml-box-sizing: border-box;
        }
        input[type="text"]{
            height: 28px;
            width: auto;
        }
    </style>
</head>

<body>
<div id="wrapper">
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/leftmenu.tpl.php'; ?>
    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/top.tpl.php'; ?>
        <div class="row wrapper border-bottom white-bg page-heading">
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div id="mws-container" class="clearfix">

                        <!-- Inner Container Start -->
                        <div class="container" style="width: 100%;background-color: white">

                            <div class="mws-panel grid_8">
                                <div class="mws-panel-header">
                                    <h3>订单头:</h3>
                                </div>

                                <div class="mws-panel-body">
                                    <form class="mws-form">
                                        <div class="mws-form-cols clearfix">
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>小票号:</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['no'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8">
                                                <label>应收:</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['remoney'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8">
                                                <label>实收:</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['acmoney'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8">
                                                <label>找零:</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['cgmoney'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8">
                                                <label>收银损益:</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['yyMoney'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8">
                                                <label>整单折扣:</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['discount'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8">
                                                <label>整单折扣额:</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['totalDiscount']?$data['0']['totalDiscount']:0;?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 omega">
                                                <label>单品折扣额:</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['singleDiscount']?$data['0']['singleDiscount']:0;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mws-form-cols clearfix">
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>单据状态</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="正常">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>销售方式</label>
                                                <div class="mws-form-item large">

                                                    <input type="text" class="mws-textinput" value="食堂">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>开单时间</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['startTime'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>人数</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['totalNumer'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>餐桌号</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['tableNo'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>收银员号</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['by'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>商品数量</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['paxNumber'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mws-form-cols clearfix">
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>收银员名</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['cashName'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>服务员号</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['serverNo'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>结账时间</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput"  value="<?php echo $data['0']['endTime'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>会员号</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="<?php echo $data['0']['memberNo'];?>">
                                                </div>
                                            </div>
                                            <div class="mws-form-col-1-8 alpha">
                                                <label>折扣类别</label>
                                                <div class="mws-form-item large">
                                                    <input type="text" class="mws-textinput" value="销售">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="mws-panel grid_8">
                                <div class="mws-panel-header">
                                    <h3>菜品明细:</h3>
                                </div>

                                <div class="mws-panel-body">
                                    <table class="ui-table ui-table-list" data-page-size="10"
                                           style="padding: 0px;">
                                        <thead class="js-list-header-region tableFloatingHeaderOriginal">
                                        <tr class="widget-list-header">
                                            <th title="序号">序号</th>
                                            <th title="品名">品名</th>
                                            <th title="单价">单价</th>
                                            <th title="实际售价">实际售价</th>
                                            <th title="数量">数量</th>
                                            <th title="总价格">总价格</th>
                                            <th title="折扣">折扣</th>
                                            <th title="单品折扣额">单品折扣额</th>
                                            <th title="整单折扣额">整单折扣额</th>
                                            <th title="点菜时间">点菜时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data1 as $key => $value){?>
                                        <tr class="even">
                                            <td><?php echo $key;?></td>
                                            <td><?php echo $value['menus_name'];?></td>
                                            <td><?php echo $value['m_price'];?></td>
                                            <td><?php echo $value['saleprice'];?></td>
                                            <td><?php echo $value['number'];?></td>
                                            <td><?php echo $value['price'];?></td>
                                            <td><?php echo $value['totalDiscount']?$value['totalDiscount']:0;?></td>
                                            <td><?php echo $value['singleDiscount']?$value['singleDiscount']:0;?></td>
                                            <td><?php echo $value['totalDiscount']?$value['totalDiscount']:0;?></td>
                                            <td><?php echo $value['createTime'];?></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="mws-panel grid_8">
                                <div class="mws-panel-header">
                                    <h3>付款方式:</h3>
                                </div>

                                <div class="mws-panel-body">
                                    <table class="ui-table ui-table-list" data-page-size="10"
                                           style="padding: 0px;">
                                        <thead>
                                        <tr>
                                            <th title="金额">金额</th>
                                            <th title="付款方式">付款方式</th>
                                            <th title="付款类型">付款类型</th>
                                            <th title="付款帐号">付款帐号</th>
                                            <th title="优惠劵">优惠劵</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data2 as $key=>$value){?>
                                        <tr class="gradeX odd">
                                            <td><?php echo $value['price_ys'];?></td>
                                            <td><?php echo $value['name'];?></td>
                                            <td><?php echo $value['payType'];?></td>
                                            <td><?php echo $value['UpLoadTime'];?></td>
                                            <td><?php echo $value['UpLoadTime'];?></td>
                                        </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/footer.tpl.php'; ?>
    </div>
</div>

</body>
<!-- iCheck -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/iCheck/icheck.min.js"></script>

</html>