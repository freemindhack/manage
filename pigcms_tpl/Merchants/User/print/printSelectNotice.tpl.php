<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>结算单打印</title>
    <!--    <script language="javascript" src="jquery-1.4.4.min.js"></script>-->
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/print/print.css" rel="stylesheet" media="print">
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/print/jquery-1.4.4.min.js"></script>
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/print/jquery.jqprint-0.3.js"></script>
    <script src="<?php echo $this->RlStaticResource; ?>plugins/js/print/jquery-migrate-1.1.0.js"></script>
    <script language="javascript">
        $(document).ready(function () {
            $(".book").jqprint({debug: false, importCSS: true, printContainer: true, operaSupport: true});
        })

    </script>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: auto;
            }

            .w3cbbs {
                page-break-after: auto;
            }

            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }

            .page {
                width: 21cm;
                height: 29.7cm;

                margin: 0 auto;
                border: 3px #D3D3D3 solid;
                border-radius: 5px;
                background: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }

            .subpage {

                border: 4px #000000 solid;
                height: 100%;

            }

        }

        .edge {
            width: 21cm;
            height: 29.7cm;
            margin: 5px;
            padding: 0;
            border: 1px solid black;
        }
    </style>
</head>
<body style="width: 60%;margin:auto;overflow: scroll">

<div class="book">
    <?php foreach ($datas as $key => $value) { ?>
        <?php if ($value['data']['ht_class'] == 1) { ?>
            <div class="edge">
                <div class="page w3cbbs">
                    <div class="subpage">
                        <div style="float:left;width: 100%;margin-top: 20px">
                            <div style="float:left;width: 50%;font-size: 16px">惠大(上海)投资管理有限公司</div>
                            <div style="float:left;text-align:right;font-size: 20px">租金商户付款通知单</div>
                        </div>
                        <hr/>
                        <hr/>
                        <div>
                            <div style="float: left;width: 50%">厂商名称:<?php echo $value['data']['shop_name']; ?></div>
                            <div style="float: left;width: 50%">合约编号:<?php echo $value['data']['ht_no']; ?></div>
                        </div>
                        <div style="height:30px;"></div>
                        <div>
                            <div style="float: left;width: 33%">铺位号:<?php echo $value['data']['ht_pwh']; ?></div>
                            <div style="float: left;width: 33%">经营品牌:<?php echo $value['data']['ht_jypp']; ?></div>
                            <div style="float: left;width: 33%">店铺面积:<?php echo $value['data']['ht_square']; ?></div>
                        </div>
                        <div style="height:40px;"></div>
                        <div>贵租户下述款项尚未支付,请核实后及时支付.预期按双方合约约定收取滞纳金!</div>
                        <table style="margin-top: 50px" cellpadding="1" cellspacing="0" width="100%">
                            <tr>
                                <td>营业款:<?php echo $value['data']['xse']; ?></td>
                                <td>所属期:<?php echo $value['data']['riqi']; ?></td>
                            </tr>
                            <tr>
                                <td>租金:<?php echo $value['data']['zj']; ?></td>
                                <td>所属期:<?php echo date('Y-m', strtotime('+1 month')); ?></td>
                            </tr>
                            <tr>
                                <td>银行手续费:</td>
                            </tr>
                            <tr>
                                <td>工程部水电燃气费:<?php echo $value['fee1']['wdgtotal']; ?></td>
                                <td>
                                    所属期:<?php echo $value['fee1']['fee_start'] . '  ' . $value['fee1']['fee_end']; ?></td>
                                <td><?php echo $value['ht_pwh']; ?></td>
                            </tr>
                        </table>
                        <table style="margin-top: 40px">
                            <?php if ($value['fee2']){foreach ($value['fee2'] as $v) { ?>
                                <tr>
                                    <td><?php echo $v['fee_name']; ?>:<?php echo $v['fy_price']; $fee+=$v['fy_price'];?></td>
                                    <td><?php echo $v['fee_start'] . '  ' . $v['fee_end']; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $v['content']; ?></td>
                                </tr>
                            <?php }} ?>
                        </table>
                        <div style="margin-top: 30px;margin-left: 100px;font-size: 20px ">合计扣款金额：￥<?php $fee=$fee+$value['data']['zj']+$value['fee1']['wdgtotal'];echo $fee; ?> 大写：<?php echo num2rmb($fee);unset($fee);?></div>
                        <table cellpadding="1" cellspacing="0" border="2px" width="100%" style="margin-top: 30px">
                            <tr>
                                <td rowspan="4" width="20px">账户信息</td>
                                <td>单位名称</td>
                                <td>惠大（上海）投资管理有限公司</td>
                            </tr>
                            <tr>
                                <td>帐号</td>
                                <td>3100151220005063640</td>
                            </tr>
                            <tr>
                                <td>开户银行</td>
                                <td>中国建设银行徐汇支行营业室</td>
                            </tr>
                            <tr>
                                <td>汇入地点</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php } elseif ($value['data']['ht_class'] == 2) { ?>
            <div class="edge">
                <div class="page w3cbbs">
                    <div class="subpage">
                        <div style="float:left;width: 100%;margin-top: 20px">
                            <div style="float:left;width: 50%;font-size: 16px">惠大(上海)投资管理有限公司</div>
                            <div style="float:left;text-align:right;font-size: 20px">美食广场商户结算单</div>
                        </div>
                        <hr/>
                        <hr/>
                        <div>
                            <div style="float: left;width: 50%">厂商名称:<?php echo $value['data']['shop_name']; ?></div>
                            <div style="float: left;width: 50%">合约编号:<?php echo $value['data']['ht_no']; ?></div>
                        </div>
                        <div style="height:30px;"></div>
                        <div>
                            <div style="float: left;width: 33%">铺位号:<?php echo $value['data']['ht_pwh']; ?></div>
                            <div style="float: left;width: 33%">经营品牌:<?php echo $value['data']['ht_jypp']; ?></div>
                            <div style="float: left;width: 33%">店铺面积:<?php echo $value['data']['ht_square']; ?></div>
                        </div>
                        <div style="height:40px;"></div>
                        <div>贵租户下述款项尚未支付,请核实后及时支付.预期按双方合约约定收取滞纳金!</div>
                        <table style="margin-top: 50px" cellpadding="1" cellspacing="0" width="100%">
                            <tr>
                                <td>销售额:<?php echo -$value['data']['xse']; ?></td>
                            </tr>
                            <tr>
                                <td>联营扣点:<?php echo $value['data']['zj']; ?></td>
                            </tr>
                            <tr>
                                <td>应退销售额:<?php echo -$value['data']['xse']+$value['data']['zj']; ?></td>
                            </tr>
                            <tr>
                                <td>工程部水电燃气费:<?php echo $value['fee1']['wdgtotal']; ?></td>
                                <td>
                                    所属期:<?php echo $value['fee1']['fee_start'] . '  ' . $value['fee1']['fee_end']; ?></td>
                                <td><?php echo $value['ht_pwh']; ?></td>
                            </tr>
                        </table>
                        <table style="margin-top: 40px">
                            <?php foreach ($value['fee2'] as $v) { ?>
                                <tr>
                                    <td><?php echo $v['fee_name']; ?>:<?php echo $v['fy_price'];$tt+=$v['fy_price']; ?></td>
                                    <td><?php echo $v['fee_start'] . '  ' . $v['fee_end']; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $v['content']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <div style="margin-top: 30px;font-size: 20px ">合计扣款金额：￥<?php $tt=-$value['data']['xse']+$value['data']['zj']+$tt+$value['fee1']['wdgtotal'];echo $tt;?> 大写：<?php echo num2rmb($tt);unset($tt);?></div>
                        <table cellpadding="1" cellspacing="0" border="2px" width="100%" style="margin-top: 30px">
                            <tr>
                                <td rowspan="4" width="20px">账户信息</td>
                                <td>单位名称</td>
                                <td>惠大（上海）投资管理有限公司</td>
                            </tr>
                            <tr>
                                <td>帐号</td>
                                <td>3100151220005063640</td>
                            </tr>
                            <tr>
                                <td>开户银行</td>
                                <td>中国建设银行徐汇支行营业室</td>
                            </tr>
                            <tr>
                                <td>汇入地点</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
</body>
</html>