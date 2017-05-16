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
        $(document).ready(function(){
           $(".book").jqprint({debug: false,importCSS: true, printContainer: true, operaSupport: true});
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

            .w3cbbs { page-break-after:auto;}
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
        .edge{
            width: 21cm;
            height: 29.7cm;
            margin: 10px 0;
            padding: 2%;
            border: 1px solid black;
        }
    </style>
</head>
<body style="width: 60%;margin: 0 auto;overflow: scroll">

<div class="book">
    <?php foreach ($da as $key=>$value){?>
        <div class="edge">
    <div class="page w3cbbs">
        <div class="subpage">
            <h1>商户:<?php echo $shop[$value[shop_id]];?></h1>
            <h2 style="right: auto">结算月:<?php echo $value['last_jiesuan']?></h2>
            <HR align=left width=100% color=black SIZE=3 noShade>
            <a style="font-size: 24px">总销售额:<?php echo $value[total];?></a>
            <HR align=left width=100% color=black SIZE=1 noShade>
            <a>各项结算费用如下(单位:元)</a>
            <table border="0" cellspacing="0" style="width:100%;margin-top:20px;font-size: 18px">
                <tr height="50px" >
                    <td>电费:<a><?php echo $value[dian_fee];?></a></td>
                    <td>水费:<a><?php echo $value[water_fee];?></a></td>
                </tr>
                <tr height="50px" >
                    <td>租赁费:<a><?php echo $value[lease_fee];?></a></td>
                    <td>卫生费:<a><?php echo $value[health_fee];?></a></td>
                </tr>
                <tr height="50px" >
                    <td>分成:<a><?php echo $value[split_fee];?></a></td>
                    <td>保底:<a><?php echo $value[baodi_fee];?></a></td>
                </tr>
            </table>
            <HR  width=100% color=black SIZE=3 noShade />
            <div style="font-size: 22px;">扣款金额:<?php echo $value[baodi_fee];?></div>
            <div style="font-size: 22px">金额大写:11111111111111111111</div>
            <HR  width=100% color=black SIZE=3 noShade />
            <div style="font-size: 22px;">应退金额:<?php echo $value[baodi_fee];?></div>
            <div style="font-size: 22px">金额大写:<?php echo num2rmb($value[baodi_fee]);?></div>
        </div>
    </div>
            </div>
    <?php }?>
</div>
</body>
</html>