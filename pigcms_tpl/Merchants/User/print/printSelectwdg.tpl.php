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

                border: 1px #000000 solid;
                height: 100%;

            }

        }

        .edge {
            width: 21cm;
            height: 29.7cm;
            margin: 20px 0;
            padding:0;
            border: 1px solid black;
        }
    </style>
</head>
<body style="width: 60%;margin: 0 auto;overflow: scroll">

<div class="book">
    <?php if ($datas){ ?>
    <?php foreach ($datas as $key => $value) { ?>
        <div class="edge">
            <div class="page w3cbbs">
                <div class="subpage">
                    <h2 align="center">水电费确认表</h2>
                    <h3>商户:<?php echo $value['name']; ?></h3>
                    <h4 align="left"><?php echo $xx[0] . '年' . $xx[1] . '月明细表'; ?></h4>
                    <h4 align="right"><?php echo '各项费用共计'.$value['total'] . '元'; ?></h4>
                    <?php foreach ($value['data'] as $k => $v) { ?>
                    <div><?php echo $v['fee_name'] . '清单:'; ?></div>
                        <div align="center">
                            <table  border="1px solid black" cellpadding="1" cellspacing="0" width="98%" style="margin: 20px 0;text-align: center">
                                <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>表名</th>
                                    <th>起始值</th>
                                    <th>结束值</th>
                                    <th>使用量</th>
                                    <th>单价</th>
                                    <th>单项总价</th>
                                    <th>调整</th>
                                    <th>合计</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                echo '<tr><td>' .$k. '</td>' . '<td>' . $v['fee_position'] . '</td>' . '<td>' . $v['jf_start'] . '</td>' . '<td>' . $v['jf_end'] . '</td>' . '<td>' . $v['jf_use'] . '</td>' . '<td>' . $v['jf_price'] . '</td>' . '<td>' . $v['jf_money'] . '</td>' . '<td>' . $v['jf_adjust'] . '</td>' . '<td>' . $v['fy_price'] .'</td></tr>';
                                ?>
                                </tbody>
                            </table>
                        </div>

                    <?php } ?>
                    <div align="right" >
                        <div style="margin-right: 150px">签字盖章</div>
                        <p ><div>惠大(上海)投资管理有限公司</div><div><?php echo date('Y年m月d日',time());?></div></p>
                    </div>
                </div>
            </div>
        </div>
    <?php }  ?>
    <?php }else{echo '没有数据！';} ?>
</div>
</body>
</html>