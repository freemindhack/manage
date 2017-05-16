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
                border: 1px #D3D3D3 solid;
                border-radius: 5px;
                background: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }

            .subpage {

                border: 5px #000000 solid;
                height: 100%;

            }

        }

        .edge {
            width: 21cm;
            height: 29.7cm;
            margin: 5px 0;
            padding:0;
            border: 1px solid black;
        }
    </style>
</head>
<body style="width: 60%;margin: 0 auto;overflow: scroll">

<div class="book">
    <?php foreach ($data as $key => $value) { ?>
        <div class="edge">
            <div class="page w3cbbs">
                <div class="subpage">
                    <h3>商户:<?php echo $value['name']; ?></h3>
                    <h4 style="right: auto"><?php echo $xx[0] . '年' . $xx[1] . '月收银明细表'; ?></h4>
                    <table border="1px solid black" cellpadding="1" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>日期</th>
                            <th>餐卡</th>
                            <th>微信</th>
                            <th>支付宝</th>
                            <th>微信</th>
                            <th>支付宝</th>
                            <th>美团</th>
                            <th>大众</th>
                            <th>糯米</th>
                            <th>抵/储</th>
                            <th>现金</th>
                            <th>内卡</th>
                            <th>外卡</th>
                            <th>合计</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($value['data'] as $k => $v) {
                            echo '<tr><td>' .substr($v['check_date'],5)  . '</td>' . '<td>' . $v['sg_ck'] . '</td>' . '<td>' . $v['sy_wx'] . '</td>' . '<td>' . $v['sy_zfb'] . '</td>' . '<td>' . $v['sg_wx'] . '</td>' . '<td>' . $v['sg_zfb'] . '</td>' . '<td>' . $v['sg_mt'] . '</td>' . '<td>' . $v['sg_dzdp'] . '</td>' . '<td>' . $v['sg_lm'] . '</td>' . '<td>' . $v['sg_dyqcz'] . '</td>' . '<td>' . $v['sg_xj'] . '</td>' . '<td>' . $v['sg_yhnk'] . '</td>' . '<td>' . $v['sg_yhwk'] . '</td>' . '<td>' . $v['sum'] . '</td></tr>';
                        } ?>
                        <?php echo '<tr><td>合计</td>' . '<td>' . $value['sum']['1'] . '</td>' . '<td>' . $value['sum']['2'] . '</td>' . '<td>' . $value['sum']['3'] . '</td>' . '<td>' . $value['sum']['4'] . '</td>' . '<td>' . $value['sum']['5'] . '</td>' . '<td>' . $value['sum']['6'] . '</td>' . '<td>' . $value['sum']['7'] . '</td>' . '<td>' . $value['sum']['8'] . '</td>' . '<td>' . $value['sum']['9'] . '</td>' . '<td>' . $value['sum']['10'] . '</td>' . '<td>' . $value['sum']['11'] . '</td>' . '<td>' . $value['sum']['12'] . '</td>' . '<td>' . $value['sum']['13'] . '</td></tr>'; ?>
                        </tbody>

                    </table>
                    <div style="right: 300px">
                        <p >结算金额:<?php echo $value['sum']['13'] ?>元</p>
                        <p ><div>请于25日前确认交还至收银部</div><div>确认无误,请在此盖公章</div></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>